<?php
/**
 * Plugin Name: Vercel Site Rebuild
 * Description: Adds a button to manually trigger Vercel deployments
 * Version: 1.0.0
 * Author: Colin O'Brien
 */

// Prevent direct access
if (!defined('ABSPATH')) {
	exit;
}

class VercelRebuildPlugin {
	private $option_name = 'vercel_rebuild_webhook_url';

	public function __construct() {
		add_action('admin_menu', array($this, 'add_admin_menu'));
		add_action('admin_init', array($this, 'register_settings'));
		add_action('admin_notices', array($this, 'display_rebuild_notice'));
		add_action('admin_post_trigger_vercel_rebuild', array($this, 'handle_rebuild_request'));
	}

	public function add_admin_menu() {
		add_options_page(
			'Vercel Rebuild Settings',
			'Vercel Rebuild',
			'manage_options',
			'vercel-rebuild',
			array($this, 'settings_page')
		);

		// Add rebuild button to admin bar
		add_action('admin_bar_menu', array($this, 'add_rebuild_button'), 100);
	}

	public function add_rebuild_button($admin_bar) {
		$admin_bar->add_menu(array(
			'id'    => 'vercel-rebuild',
			'title' => 'Rebuild Site',
			'href'  => wp_nonce_url(admin_url('admin-post.php?action=trigger_vercel_rebuild'), 'vercel_rebuild_nonce'),
			'meta'  => array(
				'title' => 'Trigger Vercel Rebuild',
			),
		));
	}

	public function register_settings() {
		register_setting('vercel_rebuild_options', $this->option_name);
	}

	public function settings_page() {
		?>
		<div class="wrap">
			<h1>Vercel Rebuild Settings</h1>
			<form method="post" action="options.php">
				<?php
				settings_fields('vercel_rebuild_options');
				do_settings_sections('vercel_rebuild_options');
				?>
				<table class="form-table">
					<tr>
						<th scope="row">Vercel Deploy Hook URL</th>
						<td>
							<input type="text"
							       name="<?php echo esc_attr($this->option_name); ?>"
							       value="<?php echo esc_attr(get_option($this->option_name)); ?>"
							       class="regular-text">
							<p class="description">
								Enter your Vercel deploy hook URL (found in your Vercel project settings under Git > Deploy Hooks)
							</p>
						</td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	public function handle_rebuild_request() {
		// Verify nonce
		if (!wp_verify_nonce($_GET['_wpnonce'], 'vercel_rebuild_nonce')) {
			wp_die('Invalid request');
		}

		// Check user capabilities
		if (!current_user_can('manage_options')) {
			wp_die('Unauthorized access');
		}

		$webhook_url = get_option($this->option_name);

		if (empty($webhook_url)) {
			wp_redirect(add_query_arg('rebuild', 'no-url', admin_url()));
			exit;
		}

		$response = wp_remote_post($webhook_url, array(
			'method' => 'POST',
			'timeout' => 5,
			'blocking' => true,
		));

		if (is_wp_error($response)) {
			wp_redirect(add_query_arg('rebuild', 'error', admin_url()));
			exit;
		}

		wp_redirect(add_query_arg('rebuild', 'success', admin_url()));
		exit;
	}

	public function display_rebuild_notice() {
		if (!isset($_GET['rebuild'])) {
			return;
		}

		$message = '';
		$class = '';

		switch ($_GET['rebuild']) {
			case 'success':
				$message = 'Vercel rebuild triggered successfully!';
				$class = 'notice-success';
				break;
			case 'error':
				$message = 'Error triggering Vercel rebuild. Please check your webhook URL.';
				$class = 'notice-error';
				break;
			case 'no-url':
				$message = 'Please configure your Vercel webhook URL in the settings.';
				$class = 'notice-warning';
				break;
		}

		if ($message) {
			printf('<div class="notice %s is-dismissible"><p>%s</p></div>', esc_attr($class), esc_html($message));
		}
	}
}

// Initialize the plugin
new VercelRebuildPlugin();

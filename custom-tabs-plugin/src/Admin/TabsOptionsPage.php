<?php

namespace CustomTabsPlugin\Admin;

class TabsOptionsPage {
	private const OPTION_KEY = 'custom_tabs_data';
	private const SETTINGS_GROUP = 'custom_tabs_group';

	public function register(): void {
		add_action( 'admin_menu', [ $this, 'add_menu_page' ] );
		add_action( 'admin_init', [ $this, 'register_settings' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	public function add_menu_page(): void {
		add_menu_page(
			'Custom Tabs',
			'Custom Tabs',
			'manage_options',
			'custom-tabs',
			[ $this, 'render_page' ],
			'dashicons-layout',
			30
		);
	}

	public function register_settings(): void {
		register_setting(
			self::SETTINGS_GROUP,
			self::OPTION_KEY,
			[
				'sanitize_callback' => [ $this, 'sanitize_data' ],
				'default'           => [ 'tabs' => [], 'trusted_logos' => [] ],
			]
		);
	}

	public function enqueue_assets( string $hook_suffix ): void {
		if ( 'toplevel_page_custom-tabs' !== $hook_suffix ) {
			return;
		}
		wp_enqueue_media();
		wp_enqueue_script( 'custom-tabs-admin', plugin_dir_url( __DIR__ ) . '../../assets/js/admin.js', [ 'jquery' ], '1.0.0', true );
	}

	public function render_page(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$data = get_option( self::OPTION_KEY, [ 'tabs' => [], 'trusted_logos' => [] ] );
		$tabs = $data['tabs'] ?? [];
		$trusted_logos = $data['trusted_logos'] ?? [];
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form method="post" action="options.php">
				<?php settings_fields( self::SETTINGS_GROUP ); ?>

				<h2><?php esc_html_e( 'Tabs', 'custom-tabs-plugin' ); ?></h2>
				<table class="form-table custom-tabs-repeater" id="tabs-repeater">
					<thead>
						<tr>
							<th><?php esc_html_e( 'Label', 'custom-tabs-plugin' ); ?></th>
							<th><?php esc_html_e( 'Quote', 'custom-tabs-plugin' ); ?></th>
							<th><?php esc_html_e( 'Author Name', 'custom-tabs-plugin' ); ?></th>
							<th><?php esc_html_e( 'Author Title', 'custom-tabs-plugin' ); ?></th>
							<th><?php esc_html_e( 'Stat Number', 'custom-tabs-plugin' ); ?></th>
							<th><?php esc_html_e( 'Stat Label', 'custom-tabs-plugin' ); ?></th>
							<th><?php esc_html_e( 'CTA Text', 'custom-tabs-plugin' ); ?></th>
							<th><?php esc_html_e( 'CTA Link', 'custom-tabs-plugin' ); ?></th>
							<th><?php esc_html_e( 'Action', 'custom-tabs-plugin' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if ( ! empty( $tabs ) ) : ?>
							<?php foreach ( $tabs as $index => $tab ) : ?>
								<?php $this->render_tab_row( $index, $tab ); ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
				<button type="button" class="button" id="add-tab-row"><?php esc_html_e( 'Add Tab', 'custom-tabs-plugin' ); ?></button>

				<h2><?php esc_html_e( 'Trusted By Logos', 'custom-tabs-plugin' ); ?></h2>
				<div id="trusted-logos-container" class="custom-trusted-logos">
					<?php foreach ( $trusted_logos as $index => $logo ) : ?>
						<?php $this->render_logo_row( $index, $logo ); ?>
					<?php endforeach; ?>
				</div>
				<button type="button" class="button" id="add-logo-row"><?php esc_html_e( 'Add Logo', 'custom-tabs-plugin' ); ?></button>

				<div style="margin-top: 20px;">
					<?php submit_button(); ?>
				</div>
			</form>
		</div>
		<script type="text/html" id="tmpl-tab-row">
			<?php $this->render_tab_row( '{{ index }}', [] ); ?>
		</script>
		<script type="text/html" id="tmpl-logo-row">
			<?php $this->render_logo_row( '{{ index }}', [] ); ?>
		</script>
		<?php
	}

	private function render_tab_row( $index, array $tab ): void {
		$tab = wp_parse_args(
			$tab,
			[
				'label'        => '',
				'quote_text'   => '',
				'author_name'  => '',
				'author_title' => '',
				'author_avatar' => '',
				'company_logo' => '',
				'bg_image'     => '',
				'stat_number'  => '',
				'stat_label'   => '',
				'cta_text'     => '',
				'cta_link'     => '',
			]
		);
		?>
		<tr class="custom-tabs-row" data-index="<?php echo esc_attr( $index ); ?>">
			<td><input type="text" name="custom_tabs_data[tabs][<?php echo esc_attr( $index ); ?>][label]" value="<?php echo esc_attr( $tab['label'] ); ?>" placeholder="e.g. Retail"></td>
			<td><textarea name="custom_tabs_data[tabs][<?php echo esc_attr( $index ); ?>][quote_text]" placeholder="Quote text" rows="3"><?php echo esc_textarea( $tab['quote_text'] ); ?></textarea></td>
			<td><input type="text" name="custom_tabs_data[tabs][<?php echo esc_attr( $index ); ?>][author_name]" value="<?php echo esc_attr( $tab['author_name'] ); ?>" placeholder="Author name"></td>
			<td><input type="text" name="custom_tabs_data[tabs][<?php echo esc_attr( $index ); ?>][author_title]" value="<?php echo esc_attr( $tab['author_title'] ); ?>" placeholder="Chief Officer"></td>
			<td><input type="text" name="custom_tabs_data[tabs][<?php echo esc_attr( $index ); ?>][stat_number]" value="<?php echo esc_attr( $tab['stat_number'] ); ?>" placeholder="e.g. 50%"></td>
			<td><input type="text" name="custom_tabs_data[tabs][<?php echo esc_attr( $index ); ?>][stat_label]" value="<?php echo esc_attr( $tab['stat_label'] ); ?>" placeholder="Reduction in costs"></td>
			<td><input type="text" name="custom_tabs_data[tabs][<?php echo esc_attr( $index ); ?>][cta_text]" value="<?php echo esc_attr( $tab['cta_text'] ); ?>" placeholder="Read case study"></td>
			<td><input type="url" name="custom_tabs_data[tabs][<?php echo esc_attr( $index ); ?>][cta_link]" value="<?php echo esc_attr( $tab['cta_link'] ); ?>" placeholder="https://..."></td>
			<td>
				<button type="button" class="button button-small remove-tab-row"><?php esc_html_e( 'Remove', 'custom-tabs-plugin' ); ?></button>
				<button type="button" class="button button-small upload-media" data-field="author_avatar"><?php esc_html_e( 'Avatar', 'custom-tabs-plugin' ); ?></button>
				<button type="button" class="button button-small upload-media" data-field="company_logo"><?php esc_html_e( 'Logo', 'custom-tabs-plugin' ); ?></button>
				<button type="button" class="button button-small upload-media" data-field="bg_image"><?php esc_html_e( 'BG', 'custom-tabs-plugin' ); ?></button>
			</td>
		</tr>
		<?php
	}

	private function render_logo_row( $index, array $logo ): void {
		$logo = wp_parse_args(
			$logo,
			[
				'url' => '',
				'alt' => '',
			]
		);
		?>
		<div class="custom-logo-row" data-index="<?php echo esc_attr( $index ); ?>">
			<input type="url" name="custom_tabs_data[trusted_logos][<?php echo esc_attr( $index ); ?>][url]" value="<?php echo esc_attr( $logo['url'] ); ?>" placeholder="Image URL">
			<input type="text" name="custom_tabs_data[trusted_logos][<?php echo esc_attr( $index ); ?>][alt]" value="<?php echo esc_attr( $logo['alt'] ); ?>" placeholder="Alt text">
			<button type="button" class="button button-small remove-logo-row"><?php esc_html_e( 'Remove', 'custom-tabs-plugin' ); ?></button>
			<button type="button" class="button button-small upload-logo-media"><?php esc_html_e( 'Upload', 'custom-tabs-plugin' ); ?></button>
		</div>
		<?php
	}

	public function sanitize_data( $input ): array {
		if ( ! is_array( $input ) ) {
			return [ 'tabs' => [], 'trusted_logos' => [] ];
		}

		$sanitized = [
			'tabs'           => [],
			'trusted_logos'  => [],
		];

		if ( isset( $input['tabs'] ) && is_array( $input['tabs'] ) ) {
			foreach ( $input['tabs'] as $index => $tab ) {
				if ( ! is_array( $tab ) ) {
					continue;
				}
				$sanitized['tabs'][ $index ] = [
					'label'          => sanitize_text_field( $tab['label'] ?? '' ),
					'quote_text'     => wp_kses_post( $tab['quote_text'] ?? '' ),
					'author_name'    => sanitize_text_field( $tab['author_name'] ?? '' ),
					'author_title'   => sanitize_text_field( $tab['author_title'] ?? '' ),
					'author_avatar'  => esc_url_raw( $tab['author_avatar'] ?? '' ),
					'company_logo'   => esc_url_raw( $tab['company_logo'] ?? '' ),
					'bg_image'       => esc_url_raw( $tab['bg_image'] ?? '' ),
					'stat_number'    => sanitize_text_field( $tab['stat_number'] ?? '' ),
					'stat_label'     => sanitize_text_field( $tab['stat_label'] ?? '' ),
					'cta_text'       => sanitize_text_field( $tab['cta_text'] ?? '' ),
					'cta_link'       => esc_url_raw( $tab['cta_link'] ?? '' ),
				];
			}
		}

		if ( isset( $input['trusted_logos'] ) && is_array( $input['trusted_logos'] ) ) {
			foreach ( $input['trusted_logos'] as $index => $logo ) {
				if ( ! is_array( $logo ) ) {
					continue;
				}
				$sanitized['trusted_logos'][ $index ] = [
					'url' => esc_url_raw( $logo['url'] ?? '' ),
					'alt' => sanitize_text_field( $logo['alt'] ?? '' ),
				];
			}
		}

		return $sanitized;
	}
}

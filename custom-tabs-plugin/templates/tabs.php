<?php
if ( ! defined( 'WPINC' ) ) {
	exit;
}
?>

<section class="custom-tabs-wrapper" aria-label="Case study industry">
	<!-- Tab navigation -->
	<ul class="tabs-nav" role="tablist">
		<?php foreach ( $tabs as $i => $tab ) : ?>
			<li role="presentation">
				<button
					role="tab"
					aria-selected="<?php echo ( 0 === $i ) ? 'true' : 'false'; ?>"
					aria-controls="tab-panel-<?php echo esc_attr( $i ); ?>"
					id="tab-<?php echo esc_attr( $i ); ?>"
					class="tabs-nav__button">
					<?php echo esc_html( $tab['label'] ); ?>
				</button>
			</li>
		<?php endforeach; ?>
	</ul>

	<!-- Tab panels -->
	<div class="tabs-content">
		<?php foreach ( $tabs as $i => $tab ) : ?>
			<div
				class="tab-panel"
				id="tab-panel-<?php echo esc_attr( $i ); ?>"
				role="tabpanel"
				aria-labelledby="tab-<?php echo esc_attr( $i ); ?>"
				<?php echo ( 0 !== $i ) ? 'hidden' : ''; ?>>

				<div class="tab-panel__grid">
					<!-- Quote card -->
					<div
						class="quote-card"
						style="--bg-image: url('<?php echo esc_url( $tab['bg_image'] ); ?>');">
						<span class="quote-card__mark">"</span>
						<p class="quote-card__text">
							<?php echo wp_kses_post( $tab['quote_text'] ); ?>
						</p>
						<div class="quote-card__author">
							<?php if ( ! empty( $tab['author_avatar'] ) ) : ?>
								<img
									src="<?php echo esc_url( $tab['author_avatar'] ); ?>"
									alt="<?php echo esc_attr( $tab['author_name'] ); ?>"
									class="quote-card__avatar"
									loading="lazy">
							<?php endif; ?>
							<div>
								<strong><?php echo esc_html( $tab['author_name'] ); ?></strong>
								<span><?php echo esc_html( $tab['author_title'] ); ?></span>
							</div>
						</div>
						<?php if ( ! empty( $tab['company_logo'] ) ) : ?>
							<img
								src="<?php echo esc_url( $tab['company_logo'] ); ?>"
								alt="Company logo"
								class="quote-card__logo"
								loading="lazy">
						<?php endif; ?>
					</div>

					<!-- Right column: stat + CTA -->
					<div class="tab-panel__right">
						<div class="stat-card">
							<span class="stat-card__number">
								<?php echo esc_html( $tab['stat_number'] ); ?>
							</span>
							<span class="stat-card__label">
								<?php echo esc_html( $tab['stat_label'] ); ?>
							</span>
						</div>
						<a href="<?php echo esc_url( $tab['cta_link'] ); ?>" class="cta-card">
							<span><?php echo esc_html( $tab['cta_text'] ); ?></span>
							<svg class="cta-card__arrow" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4 10h12M12 4l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</a>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<!-- Trusted by section -->
	<?php if ( ! empty( $trusted_logos ) ) : ?>
		<div class="trusted-by">
			<span class="trusted-by__label">TRUSTED BY</span>
			<div class="trusted-by__logos">
				<?php foreach ( $trusted_logos as $logo ) : ?>
					<?php if ( ! empty( $logo['url'] ) ) : ?>
						<img
							src="<?php echo esc_url( $logo['url'] ); ?>"
							alt="<?php echo esc_attr( $logo['alt'] ); ?>"
							class="trusted-by__logo"
							loading="lazy">
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
</section>

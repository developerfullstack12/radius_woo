<?php
$number_post = Medizin::setting( 'single_post_related_number' );
$results     = Medizin_Post::instance()->get_related_posts( array(
	'post_id'      => get_the_ID(),
	'number_posts' => $number_post,
) );

if ( $results !== false && $results->have_posts() ) : ?>
	<div
		class="related-posts medizin-blog medizin-animation-zoom-in medizin-blog-caption-style-01">
		<h3 class="related-title">
			<?php esc_html_e( 'Related Posts', 'medizin' ); ?>
		</h3>
		<div class="tm-swiper tm-slider"
		     data-lg-items="2"
		     data-lg-gutter="30"
		     data-sm-items="1"
		     data-nav="1"
		     data-auto-height="1"
		     data-slides-per-group="inherit"
		>
			<div class="swiper-inner">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php while ( $results->have_posts() ) : $results->the_post(); ?>
							<div class="swiper-slide">
								<div <?php post_class( 'related-post-item' ); ?>>

									<div class="post-wrapper medizin-box">

										<?php if ( has_post_thumbnail() ) { ?>
											<div class="post-feature post-thumbnail medizin-image">
												<a href="<?php the_permalink(); ?>">
													<?php Medizin_Image::the_post_thumbnail( array( 'size' => '480x325' ) ); ?>
												</a>
											</div>
										<?php } ?>

										<div class="post-caption">
											<h3 class="post-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>

											<div class="post-meta">
												<div class="inner">
													<?php Medizin_Post::instance()->meta_date_template(); ?>

													<?php Medizin_Post::instance()->meta_view_count_template(); ?>
												</div>
											</div>
										</div>

									</div>

								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif;
wp_reset_postdata();

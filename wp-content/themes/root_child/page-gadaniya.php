<?php
/*
Template Name: Гадания онлайн
*/

get_header();

$breadcrumbs_hide = 'checked' == get_post_meta( $post->ID, 'breadcrumbs_hide', true );
?>

	<div id="primary" class="content-area divination-content-area">
		<main id="main" class="site-main" itemscope itemtype="http://schema.org/Article">

            <?php if ( ! is_front_page() && ! $breadcrumbs_hide ) get_template_part( 'template-parts/boxes/breadcrumbs' ); ?>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'gadaniya-list' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( root_get_option( 'structure_page_comments' ) == 'yes' ) {
					if (comments_open() || get_comments_number()) :
						comments_template();
					endif;
				}

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
if ( root_get_option( 'structure_page_sidebar' ) != 'none' && 'checked' != get_post_meta( $post->ID, 'sidebar_hide', true ) ) {
//	get_sidebar();
}
get_footer();

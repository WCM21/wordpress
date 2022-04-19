<?php
/**
 * Template Name: Student Page
 * Template Post Type: wcm_students
 *
 * @package WCM21
 */

?>

<?php
get_header(); ?>
<style>
    body {
        background-color: #cdcdcd;
    }
</style>
<div class="">
	<?php ?>
            <article <?php post_class(); ?> id="titta_har-<?php the_ID(); ?>">
                <a href="<?php the_permalink(); ?>">
                    <h2><?php the_title(); ?></h2></a>
                <div id="our-post-thumbnail">
					<?php
					the_post_thumbnail( 'wcm-gallery' ); ?>
                </div>

            </article>
		<?php
	?>

    <!-- Här vill vi loopa igenom Posts där denna student är vald. -->
	<?php
	$studentPosts = new WP_Query( [ 'post_type' => 'post' ] ); ?>
    <ul>
		<?php
		if ( $studentPosts->have_posts() ) : ?>
			<?php
			while ( $studentPosts->have_posts() ) {
				$studentPosts->the_post();
				echo '<li>' . the_title() . '</li>';
			} ?>
		<?php
		endif; ?>
    </ul>
</div>

<?php wp_reset_postdata(); ?>

      <?php the_excerpt(); ?>
<?php
get_footer(); ?>

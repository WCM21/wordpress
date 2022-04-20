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
	<?php
	$studentId = get_the_ID(); ?>
    <article <?php
	post_class(); ?> id="titta_har-<?php
	the_ID(); ?>">
        <a href="<?php
		the_permalink(); ?>">
            <h2><?php
				the_title(); ?></h2></a>
        <?php get_template_part('template-parts/content', 'thumbnail' ); ?>
    </article>
	<?php
	?>

    <!-- Här vill vi loopa igenom Posts där denna student är vald. -->
    <div><?php
		$studentPosts = new WP_Query( [ 'post_type'           => 'post',
		                                'meta_key'            => 'student_author',
		                                'meta_value'          => $studentId,
		                                'ignore_sticky_posts' => 1,
		] ); ?>
        <ul>
			<?php
			if ( $studentPosts->have_posts() ) : ?>
                <h3><?php the_title(); ?>'s inlägg</h3>
				<?php
				while ( $studentPosts->have_posts() ) {
					$studentPosts->the_post();
					the_title( '<li>', '</li>' );
				} ?>
			<?php
			endif; ?>
			<?php wp_reset_postdata(); ?>
        </ul>
    </div>

    <div>
        <?php
            $taxonomyName = get_post_taxonomies()[0]; ?>
        <h3><?php _e('Classes', 'wcmtheme'); ?></h3>
        <?php the_terms( $studentId, $taxonomyName) ?>
    </div>
</div>

<?php
the_excerpt(); ?>
<?php
get_footer(); ?>

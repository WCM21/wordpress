
<footer>
    <div>
	<?php wp_nav_menu( [
		'theme_location' => 'footer',
		'container' => 'nav',
	] ); ?>
    </div>
    <div>
	    <?php wp_nav_menu( [
            'menu' => 'Students',
		    'container' => 'nav',
	    ] ); ?>
    </div>
</footer>
<?php wp_footer(); ?>

<?php
if (current_user_can('administrator')){
	global $wpdb;
	echo "<pre>";
	print_r($wpdb->num_queries);
	echo "</pre>";
}
?>
</body>
</html>

<?php get_header(); ?>
<?php the_post(); ?>

<article id="<?php echo $post->post_name; ?>">
	<section id="main">
		<div id="lower" class="container">
			<h1 class="page-title1 text-center"><span><?= sm_make_page_title(); ?></span></h1>
			<?php the_content(); ?>
			<?php 
				$args = [
					'post_type' => 'recruit',
					'posts_per_page' => -1,
				];
				$the_query = new WP_Query($args);
				if($the_query->have_posts()): while($the_query->have_posts()): $the_query->the_post();

			?>
			<div class="wrap1">
				<?php the_content(); ?>
			</div>
			<?php endwhile;endif;wp_reset_postdata(); ?>
					
		</div>
		<!-- /.container -->
	</section>
	<!-- /#main -->
</article>
<!-- /#<?php echo $post->post_name; ?> -->


<?php get_footer(); ?>


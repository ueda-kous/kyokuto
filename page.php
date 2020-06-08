<?php get_header(); ?>
<?php the_post(); ?>

<article id="<?php echo $post->post_name; ?>">
	<section id="main">
		<div id="lower" class="container">
			<h1 class="page-title1 text-center"><span><?= sm_make_page_title(); ?></span></h1>
			<?php the_content(); ?>
		</div>
		<!-- /.container -->
	</section>
	<!-- /#main -->
</article>
<!-- /#<?php echo $post->post_name; ?> -->

<?php get_footer(); ?>

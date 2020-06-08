<?php get_header(); ?>
<?php the_post(); ?>

<article id="compaign_<?php echo $post->ID; ?>">
	<section id="main">
		<div id="lower" class="container">
			<h1 class="page-title1 text-center"><span>キャンペーン<br><small>CAMPAIGN</small></span></h1>
			<?php the_content(); ?>
		</div>
		<!-- /.container -->
	</section>
	<!-- /#main -->
</article>
<!-- /#<?php echo $post->post_name; ?> -->

<?php get_footer(); ?>

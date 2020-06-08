<?php get_header(); ?>

<article id="news" class="archive">
	<section id="main">
		<div id="lower" class="container">
			<h1><?= sm_make_page_title(); ?></h1>

			<?php echo get_template_part( "parts", "archive" ); ?>

			

		</div>
		<!-- /.container -->
	</section>
	<!-- /#main -->

</article>
<!-- /#home -->

<?php get_footer(); ?>

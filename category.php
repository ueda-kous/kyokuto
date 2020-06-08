<?php get_header(); ?>

<article id="news" class="category">
	<section id="main">
		<div id="lower" class="container">
			<h1 class="page-title1 text-center"><span><?= sm_make_page_title(); ?></span></h1>

			<?php echo get_template_part( "parts", "archive" ); ?>

			

		</div>
		<!-- /.container -->
	</section>
	<!-- /#main -->

</article>
<!-- /#home -->

<?php get_footer(); ?>

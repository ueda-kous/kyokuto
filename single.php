<?php get_header(); ?>

<article id="news" class="single">
	<section id="main">
		<div id="lower" class="container">
			<h1 class="text-center page-title1"><span><?= sm_make_page_title(); ?></span></h1>

			<?php 
				if(have_posts()): while(have_posts()): the_post();
					if ( has_post_thumbnail() ) {
						$image = get_post_thumbnail_id();
					}


					if($image){
						$src = wp_get_attachment_image( $image, "medium_large", "", array("class"=>"pure-img center-block") );
						$class = "pure-u-lg-15-24";
					}else{
						$src = "";
						$class = "";
					}

			?>
				<section class="section01">
					<div class="pure-g">
						<?php 
							if($image){
								echo "<div class=\"pure-u-1 pure-u-lg-9-24 lazy\">{$src}</div>";
							}
						?>
						<div class="wrap01 pure-u-1 <?php echo $class ?> lazy">
							<p class="date"><?php the_time("Y.m.d"); ?></p>
							<h2><?php the_title(); ?></h2>
							<div class="inner01">
								<?php the_content(); ?>
							</div>
							<!-- /.inner01 -->
						</div>
					</div>
					<!-- /.pure-g -->
				</section>
				<!-- /.section01 -->

			<?php endwhile;endif; ?>

			<div class="wp-pagenavi var01 clearfix lazy">
				<div class="pull-left">
					<?php next_post_link('%link','<< %title'); ?>
				</div>
				<div class="pull-right">
					<?php previous_post_link('%link','%title >>'); ?>
				</div>
			</div>
			<!-- /.wrap02 -->

			

		</div>
		<!-- /.container -->
	</section>
	<!-- /#main -->

</article>
<!-- /#home -->

<?php get_footer(); ?>

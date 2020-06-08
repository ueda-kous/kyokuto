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

		<ul class="list1">
			<li class="columns">
				<time><?php the_time("Y.m.d"); ?></time>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</li>
		</ul>
	</section>
	<!-- /.section01 -->

<?php endwhile;endif; ?>

<div class="pagenavi text-center lazy">
	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
</div>
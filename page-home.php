<?php get_header(); ?>
<?php the_post(); ?>


<article id="home">
	<?php 

		if(wp_is_mobile()){
			$options = array(
				'taxonomy' => 'device',
				'field'    => 'name',
				'terms'    => 'モバイル',
			);
		}else{
			$options = array(
				'taxonomy' => 'device',
				'field'    => 'name',
				'terms'    => 'パソコン',
			);
		}

		$args = [
			'post_type'			=> 'top_slide',
			'posts_per_page'	=> -1,
			'tax_query' => array(
				$options
			),
		];
		$the_query = new WP_Query($args);
		// if($the_query->found_posts>0):
	?>
		<aside id="topSlide">
		</aside>
		<!-- /#topSlide -->
		<script>
			get_content(101);

			<?php 
				if(wp_is_mobile()){
					$device = '3';
				}else{
					$device = '2';
				}
			?>

			function get_content(id){
				console.log(id);
		        $.ajax({
		            url:'https://k-cleaning.jp/wp-json/wp/v2/top_slide/?_embed&_jsonp=getslide&posts_per_page=110&order=asc&orderby=menu_order&device=<?php echo $device; ?>',
		            dataType: 'jsonp',
		            jsonpCallback: 'getslide',

		        })
		        // Ajaxリクエストが成功した時発動
		        .done( (data) => {
		            for (var i = 0, max = data.length; i < max; i++) {
						post = data[i];
						img = post['acf']['スライド画像']['url'];
						link = post['acf']['リンク先url'];

						if(link!==void(0)){
							if(link.indexOf( 'https://k-cleaning.jp/service/')!==-1){
								link = link.replace('https://k-cleaning.jp/service/','');
								link = link.replace('/','');
								link = './service/detail?pid='+link;
							}else if(link.indexOf( 'https://k-cleaning.jp/campaign/')!==-1){
								link = link.replace('https://k-cleaning.jp/campaign/','');
								link = link.replace('/','');
								link = './campaign?pid='+link;
							}
							html = '<div class=\"wrap1\"><a href="'+link+'"><img src="'+img+'" alt="" class="pure-img center-block" /></a></div>';
						}else{
							html = '<div class=\"wrap1\"><img src="'+img+'" alt="" class="pure-img center-block" /></div>';
						}
						$('#topSlide').append(html);


					}
					$('#topSlide').slick({
				        infinite		: true,
				        autoplaySpeed	: 5000,
				        arrows			: false,
				        dots			: false,
				        pauseOnHover	: false,
				        autoplay 		: true,
				        variableWidth   : true,
				        pauseOnFocus	: false,
				        centerMode		: true
				    });
		        })
		        .fail( (data) => {
		        })
		        .always( (data) => {
		            // area.prop('disabled', false);
		        });
		    }
		</script>
	<section id="main">
		<?php the_content(); ?>
	</section>
	<!-- /#main -->
</article>
<!-- /#home -->

<?php get_footer(); ?>

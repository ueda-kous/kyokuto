<?php 
	if(!isset($_GET['pid'])){
		$location = home_url('service');
		wp_redirect($location);
		exit;
	}
?>

<?php get_header(); ?>
<?php the_post(); ?>

<article id="<?php echo $post->post_name; ?>">
	<section id="main">
		<div id="lower" class="container">
			<h1 class="page-title1 text-center"><span><?= sm_make_page_title(); ?></span></h1>
			<div id="stage"></div>
			<a href="<?php echo esc_url(home_url('service')); ?>" class="btn1 text-center">一覧に戻る</a>
		</div>
		<!-- /.container -->
	</section>
	<!-- /#main -->
</article>
<!-- /#<?php echo $post->post_name; ?> -->

<script>
	
	get_content(<?php echo htmlspecialchars($_GET['pid']); ?>);

	function get_content(id){
        $.ajax({
            url:'https://k-cleaning.jp/wp-json/wp/v2/service/'+id+'/?_embed&_jsonp=callback',
            dataType: 'jsonp',
            jsonpCallback: 'callback',
        })
        // Ajaxリクエストが成功した時発動
        .done( (data) => {
        	console.log(data.content.rendered);
        	$('#stage').append(data.content.rendered);
        })
        .fail( (data) => {
        })
        .always( (data) => {
        });
    }

</script>

<?php get_footer(); ?>


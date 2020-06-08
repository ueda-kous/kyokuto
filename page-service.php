<?php get_header(); ?>
<?php the_post(); ?>

<article id="<?php echo $post->post_name; ?>">
	<section id="main">
		<div id="lower" class="container">
			<h1 class="page-title1 text-center"><span><?= sm_make_page_title(); ?></span></h1>
			<div class="columns" id="stage"></div>
		</div>
		<!-- /.container -->
	</section>
	<!-- /#main -->
</article>
<!-- /#<?php echo $post->post_name; ?> -->

<script>

	get_content(101);

	function get_content(id){
        $.ajax({
            url:'https://k-cleaning.jp/wp-json/wp/v2/service/?_embed&_jsonp=callback&posts_per_page=-1',
            dataType: 'jsonp',
            jsonpCallback: 'callback',

        })
        // Ajaxリクエストが成功した時発動
        .done( (data) => {
            for (var i = 0, max = data.length; i < max; i++) {
				post = data[i];
				var title = post.title.rendered;
				var link = post.id;
				var text = post['acf']['一覧用テキスト'];
				var src = post._embedded['wp:featuredmedia'][0]['source_url'];
				html = '<div class="column1"><div class="wrap1"><img src="'+src+'" alt="" class="pure-img center-block" /><div class="inner1"><h2>'+title+'</h2><p>'+text+'</p><a href="./detail/?pid='+link+'" class="btn1 center-block">サービス詳細を見る</a></div></div></div>';
				$('#stage').append(html);

			}
        })
        .fail( (data) => {
        })
        .always( (data) => {
            // area.prop('disabled', false);
        });
    }

</script>

<?php get_footer(); ?>


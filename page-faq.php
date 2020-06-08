<?php get_header(); ?>
<?php the_post(); ?>

<article id="<?php echo $post->post_name; ?>">
	<section id="main">
		<div id="lower" class="container">
			<h1 class="page-title1 text-center"><span><?= sm_make_page_title(); ?></span></h1>
			<div id="stage" class="wrap1">
			
			</div>
		</div>
		<!-- /.container -->
	</section>
	<!-- /#main -->
</article>
<!-- /#<?php echo $post->post_name; ?> -->

<script>

	get_category();

	function get_category(){
        $.ajax({
            url:'https://k-cleaning.jp/wp-json/wp/v2/faqcategory/?_embed&_jsonp=callback&posts_per_page=100',
            dataType: 'jsonp',
            jsonpCallback: 'callback',

        })
        // Ajaxリクエストが成功した時発動
        .done( (data) => {
            for (var i = 0, max = data.length; i < max; i++) {
				category = data[i];
				html = '<h2>'+category.name+'</h2>';
				$('#stage').append(html);
				get_faq(category.id);

			}
        })
        .fail( (data) => {
        })
        .always( (data) => {
            // area.prop('disabled', false);
        });
    }

    function get_faq(cat){
        $.ajax({
            url:'https://k-cleaning.jp/wp-json/wp/v2/faq/?_embed&_jsonp=callback&posts_per_page=100&faqcategory='+cat,
            dataType: 'jsonp',
            jsonpCallback: 'callback',

        })
        // Ajaxリクエストが成功した時発動
        .done( (data) => {
        	html = '<dl class="list1">';
            for (var i = 0, max = data.length; i < max; i++) {
				post = data[i];
				var title = post.title.rendered;
				var text = post.content.rendered;
				html += '<dt>'+title+'</dt><dd>'+text+'</dd>';

			}
        	html += '</dl>';
			$('#stage').append(html);
        })
        .fail( (data) => {
        })
        .always( (data) => {
            // area.prop('disabled', false);
        });
    }

</script>

<?php get_footer(); ?>


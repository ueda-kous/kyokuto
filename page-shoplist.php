<?php get_header(); ?>
<?php the_post(); ?>

<article id="<?php echo $post->post_name; ?>">
	<section id="main">
		<div id="lower" class="container">
			<h1 class="page-title1 text-center"><span><?= sm_make_page_title(); ?></span></h1>
			<?php get_template_part( 'parts', 'home_store_search' ); ?>
			<div id="stage">
				<table>
					<thead>
						<tr>
							<th>ショップ名</th>
							<th>住所</th>
							<th>電話番号</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
		<!-- /.container -->
	</section>
	<!-- /#main -->
</article>
<!-- /#<?php echo $post->post_name; ?> -->

<script>
	<?php 
		$region = get_field('エリア');
		if(isset($_GET['region'])){
			$area = $_GET['region'];
		}else{
			$area = '';
		}
		if($region):
	?>
	get_area(<?php echo $region ?>,<?php echo htmlspecialchars($area); ?>);

	$('#search1').change(function(){
		var region = $(this).val();
		get_shop(region);
	});

	function get_area(id,select){
		console.log(select);
        $.ajax({
            url:'http://k-cleaning.l-biz.jp/wp-json/wp/v2/region?_embed&_jsonp=callback&per_page=100&parent='+id,
            dataType: 'jsonp',
            jsonpCallback: 'callback',

        })
        // Ajaxリクエストが成功した時発動
        .done( (data) => {
            for (var i = 0; i < data.length; i++) {
            	var post = data[i];
            	var title = post.name;
            	var id = post.id;
            	var html = '<option value="'+id+'">'+title+'</option>';
            	$('#search1').append(html);
            }
        	if(select!==void(0)){
        		region = select;
        	}else{
        		region = data[0].id;
        	}
        	$('#search1').val(region);

        	get_shop(region);
        })
        .fail( (data) => {
        })
        .always( (data) => {
            // area.prop('disabled', false);
        });
    }

    function get_shop(id){

    	$('#stage table tbody').html('');

        $.ajax({
            url:'http://k-cleaning.l-biz.jp/wp-json/wp/v2/shop?_embed&_jsonp=callback&per_page=100&region='+id,
            dataType: 'jsonp',
            jsonpCallback: 'callback',

        })
        // Ajaxリクエストが成功した時発動
        .done( (data) => {
            console.log(data);

            for (var i = 0; i < data.length; i++) {
            	var post = data[i];
            	var title = post.title.rendered;
            	var address = post.data['住所'];
            	var tel = post.data['電話番号'];
            	var html = '<tr><td>'+title+'</td><td>'+address+'</td><td>'+tel+'</td></tr>';
	            $('#stage table tbody').append(html);
            }

        })
        .fail( (data) => {
        })
        .always( (data) => {
            // area.prop('disabled', false);
        });
    }

	<?php endif; ?>

</script>

<?php get_footer(); ?>


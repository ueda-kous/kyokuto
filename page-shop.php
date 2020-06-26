<?php 
    
    if(isset($_GET['sid'])&&!empty($_GET['sid'])){
        $shop_id = $_GET['sid'];
    }else{
        $location = home_url('shop-list');
        wp_redirect( $location);
        exit;
    }
    
    
?>

<?php get_header(); ?>
<?php the_post(); ?>

<article id="<?php echo $post->post_name; ?>">
	<section id="main">
        <?php get_template_part( 'parts', 'home_store_search' ); ?>
		<div id="lower" class="container">

            <?php 
                $url = "https://k-cleaning.jp/wp-json/wp/v2/shop/{$shop_id}?orderby=id";
                $_data = file_get_contents($url);
                $data = json_decode($_data,true);

                if(isset($data['_links']['wp:featuredmedia'][0]['href'])){
                    $_tumbnail = file_get_contents($data['_links']['wp:featuredmedia'][0]['href'],true);
                    $tumbnail = json_decode($_tumbnail,true);
                }

                $shoptypes = get_shoptypes();
                $services = get_services();

            ?>

			<div id="stage">
                <div class="columns">
                    <?php if(isset($tumbnail['source_url'])&&!empty($tumbnail['source_url'])): ?>
                    <div class="column1">
                        <img src="<?php echo $tumbnail['source_url']; ?>" alt="" class="pure-img center-block">
                    </div>
                    <?php endif; ?>
                    <div class="column2">
                        <h2><?php echo $data['title']['rendered'] ?></h2>
                        <table>
                            <tr>
                                <th>店舗形態</th>
                                <td>
                                    <?php 
                                        foreach((array)$data['shoptype'] as $shoptype){
                                            echo $shoptypes[$shoptype];
                                            if($shoptype!==end($data['shoptype'])){
                                                echo " / ";
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>住所</th>
                                <td>
                                    <?php 
                                        if(isset($data['data']['住所'])){
                                            echo $data['data']['住所'];
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>電話番号</th>
                                <td>
                                    <?php 
                                        if(isset($data['data']['電話番号'])){
                                            echo "<a href=\"tel:{$data['data']['電話番号']}\">{$data['data']['電話番号']}</a>";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>キャッシュレス対応</th>
                                <td>
                                    <ul>
                                        <?php 
                                            foreach ($services as $key => $service) {
                                                if(in_array($key,$data['payment'])){
                                                    $class = 'on';
                                                }else{
                                                    $class = '';
                                                }
                                                echo "<li class=\"{$class}\">{$service}</li>";
                                            }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="columns">
                    <div class="column1">
                        <?php 
                            if(isset($data['data']['住所'])):
                        ?>
                            <iframe src="https://maps.google.co.jp/maps?output=embed&z=15&q=<?php echo $data['data']['住所']." きょくとう".$data['title']['rendered']; ?>"></iframe>                   
                        <?php endif; ?>
                    </div>
                    <div class="column2">
                        <dl>
                            <dt>取扱サービス</dt>
                            <dd>
                                <ul class="columns">
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop1.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                                オゾン＆アクアドライ
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop2.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                            花粉ガード加工
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop3.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                            絨毯
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop4.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                            有料しみぬき
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop5.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                            スニーカークリーニング
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop6.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                            着物
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop7.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                            防虫加工
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop8.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                            特殊クリーニング
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop9.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                            リフォーム
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop10.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                            撥水加工
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop11.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                            ブーツ
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop12.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                            かけつぎ
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop13.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                            折り目加工
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap1">
                                            <div class="inner1">
                                                <img src="https://k-cleaning.jp/wp-content/uploads/2020/06/ico_shop14.png" alt="" class="pure-img">
                                            </div>
                                            <div class="inner2">
                                            羽毛布団
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
			<a href="<?php echo esc_url(home_url('shop-list')); ?>" class="btn1 text-center">一覧に戻る</a>
		</div>
		<!-- /.container -->
	</section>
	<!-- /#main -->
</article>
<!-- /#<?php echo $post->post_name; ?> -->
<script>
    <?php 


        $page = get_page_by_path('shop-list');
		$region = get_field('エリア',$page->ID);
		if(isset($_GET['region'])){
			$area = $_GET['region'];
		}else{
			$area = '';
		}
		if($region):
	?>
	get_area(<?php echo $region ?>,<?php echo htmlspecialchars($area); ?>);

	function get_area(id,select){
		console.log(select);
        $.ajax({
            url:'https://k-cleaning.jp/wp-json/wp/v2/region?_embed&_jsonp=callback&per_page=100&parent='+id,
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

<?php 

function get_shoptypes(){
    $_shoptype = file_get_contents('https://k-cleaning.jp/wp-json/wp/v2/shoptype');
    $shoptype = json_decode($_shoptype,true);
    $return = [];
    foreach((array)$shoptype as $value){
        $return[$value['id']] = $value['name'];
    }
    return $return;
}
function get_services(){
    $_service = file_get_contents('https://k-cleaning.jp/wp-json/wp/v2/payment');
    $service = json_decode($_service,true);
    $return = [];
    foreach((array)$service as $value){
        $return[$value['id']] = $value['name'];
    }
    return $return;
}
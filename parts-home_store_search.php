<?php 
	$post_id = get_page_by_path('shop-list');
?>
<aside class="aside2" id="shopsearch" data-site="<?php the_field('エリア' ,$post_id->ID); ?>">
	<div class="container text-center">
	    <dl>
	        <dt>店舗検索</dt>
	        <dd class="text-center">
	            <p>お近くの店舗、お取扱サービスなどをご案内します。</p>
	            <form action="<?php echo esc_url(home_url("shop-list")); ?>" method="get">
	            	<ul class="list1">
	            		<li><select name="region" id="search1">
	            				<option value="">エリアを選んでください</option>
	            			</select></li>
	            	</ul>
	            	<input type="submit" value="検索">
	            </form>
	        </dd>
	    </dl>
	</div>
</aside>
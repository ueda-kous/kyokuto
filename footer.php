<aside id="footerMebu1">
	<div class="container">
		<ul class="list1 columns">
			<li><a href="<?php echo esc_url(home_url('staffblog')); ?>"><img src="/wp-content/uploads/2020/05/img_footer1.jpg" alt="" class="pure-img center-block"><span>店舗ブログ</span></a></li>
			<li><a href="<?php echo esc_url(home_url('faq')); ?>"><img src="/wp-content/uploads/2020/05/img_footer2.jpg" alt="" class="pure-img center-block"><span>よくある質問</span></a></li>
			<li><a href="https://k-cleaning.jp/" target="_blank"><img src="/wp-content/uploads/2020/05/img_footer3.jpg" alt="" class="pure-img center-block"><span>運営会社</span></a></li>
		</ul>
	</div>
	<!-- /.container -->
</aside>

<?php 
	$h1 = sm_get_h1_tag();
	$tel = sm_get_tel();
	$copyright = sm_get_copyright();
	$headerContact = sm_get_business_hours();
	$btnColor = sm_get_button_color();
	$btnText = sm_get_contact_text();
	$btnLink = sm_get_contact_link();
	if(empty($btnLink)){
		$btnLink = "contact";
	}
	if($btnColor){
		$btnStyle = "style=\"background-color:{$btnColor}\"";
	}else{
		$btnStyle = "";
	}
?>
<footer>
	<div id="footer">
		<div class="container">
			<div class="wrap1 pull-left">
				<dl>
					<dt>
						<?php 
							if ( function_exists( 'the_custom_logo' ) ) {
							    the_custom_logo();
							} 
						?>
					</dt>
					<dd><?php echo sm_get_contact(); ?></dd>
				</dl>
			</div>
			<!-- /.wrap1 pull-left -->
			<div class="wrap2 pull-right">
				<div class="inner1">
					<?php wp_nav_menu( array(
					  'theme_location'  => 'footer',
					)); ?>
				</div>
				<!-- <div class="inner2">
					<ul>
						<?php 
							if($tel) {
								echo "<li><small>TEL.</small><a href=\"tel:{$tel}\">{$tel}</a></li>";
							}
							if($headerContact){
								echo "<li>{$headerContact}</li>";
							}
						?>
					</ul>
					<a href="<?= esc_url(home_url($btnLink)); ?>" class="sm_btn1" <?php echo $btnStyle; ?>><?= $btnText ?></a>
				</div> -->
			</div>
			<!-- /.wrap2 pull-left -->
		</div>
		<!-- /.container -->
	</div>
	<div id="copyright" class="text-center"><?= $copyright; ?></div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

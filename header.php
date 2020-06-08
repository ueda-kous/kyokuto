<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title><?php bloginfo("title"); ?></title>
	<?php wp_head(); ?>

</head>
<body>
<?php 
	$h1 = get_bloginfo('description');
	$tel = sm_get_tel();
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
<header>
	<div id="header">
		<div class="container">
			<h1 class="pull-left"><?php 
				if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
				    the_custom_logo();
				}else{
					bloginfo('name');
				}

				 ?>
				<span><?php echo $h1; ?><br><strong><?php bloginfo('title'); ?></strong></span>	 	
			</h1>
			<!-- <div class="wrap1 pull-right text-right">
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
			</div> -->
			<!-- /.wrap1 pull-right -->
			<a class="menu-trigger" href="/">
				<span></span>
				<span></span>
				<span></span>
			</a>
			<!-- <a class="menu-tel" href="tel:<?= $tel ?>">
				<i class="fa fa-phone" aria-hidden="true"></i>
			</a> -->
		</div>
		<!-- /.container -->
	</div>
	<!-- /#header -->
	<div id="gNavi">
		<div class="container">
			<?php wp_nav_menu( array(
			  'theme_location'  => 'global',
			)); ?>
		</div>
		<!-- /.container -->
	</div>
	<?php if(!is_front_page()): ?>
		<div id="breadcrumbs">
			<div class="breadcrumbs container" typeof="BreadcrumbList" vocab="https://schema.org/">
			    <?php if(function_exists('bcn_display'))
			    {
			        bcn_display();
			    }?>
			</div>
		</div>
		<!-- /#breadcrumbs -->
	<?php endif; ?>
</header>
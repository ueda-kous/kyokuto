<?php 
/*
Template Name: ダミーページ用テンプレート
*/

the_post();

$url = home_url();

if(is_page()){
	$args = [
		"post_type"			=> 'page',
		"posts_per_page"	=> 1,
		"post_parent"		=> $post->ID,
	];
	$the_query = new WP_Query($args);
	if($the_query->found_posts>0){
		$the_query->the_post();
		$url = get_the_permalink();
	}
}

wp_redirect( $url, $status = 302 );
exit;

?>

<?php 
$args = [
    $posts_per_page => 1
];
$the_query = new WP_Query($args);
$html = '';
if($the_query->found_posts>0){
    $html .= '<aside class="aside1"><div class="container columns">';

    if($the_query->have_posts()): while($the_query->have_posts()): $the_query->the_post();
        $link = get_the_permalink();
        $title = get_the_title();
        $time = get_the_time('Y.m.d');
        $html .= '<dl class="columns">';
            $html .= '<dt>お知らせ</dt>';
            $html .= "<dd><time>{$time}</time><a href=\"{$link}\">{$title}</a></dd>";
        $html .= '</dl>';
        $html .= '<a href="category/news/" class="btn1">一覧を見る</a>';
?>
<!-- <a href="#" class="btn1">一覧を見る</a> -->
<?php
    endwhile;endif;wp_reset_postdata();
    $html .= '</div></aside>';
    
    echo $html;
}
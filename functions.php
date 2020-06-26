<?php

add_editor_style('editor-style.css');
add_theme_support('editor-styles');

/**
 * Proper way to enqueue scripts and styles
 */
function wpdocs_theme_scripts()
{
    wp_enqueue_style('style-base', get_stylesheet_uri());
    wp_enqueue_style('style-pure', get_template_directory_uri() . '/css/pure-min.css');
    wp_enqueue_style('style-font', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('style-common', get_template_directory_uri() . '/css/add/common.css');

    wp_enqueue_script('script-jquery', get_template_directory_uri() . '/js/jquery-1.12.0.min.js');
    wp_enqueue_script('script-common', get_template_directory_uri() . '/js/common.js');

    if (is_front_page()) {
        wp_enqueue_style('style-home', get_template_directory_uri() . '/css/add/home.css');
        wp_enqueue_style('style-slick', get_template_directory_uri() . '/js/slick/slick.css');
        wp_enqueue_style('style-slick-theme', get_template_directory_uri() . '/js/slick/slick-theme.css');
        wp_enqueue_script('script-jquery-migrate', get_template_directory_uri() . '/js/jquery-migrate-1.2.1.min.js');
        wp_enqueue_script('script-slick', get_template_directory_uri() . '/js/slick/slick.min.js');
        wp_enqueue_script('script-top', get_template_directory_uri() . '/js/top.js');
    }

    if (is_page() || is_single() || is_archive() || is_tax()) {
        wp_enqueue_style('style-page', get_template_directory_uri() . '/css/add/page.css');
    }

    if (is_page('faq')) {
        wp_enqueue_script('script-faq', get_template_directory_uri() . '/js/faq.js');
    }


    if (is_page("contact") || is_page("confirm") || is_page("thanks") || is_page("entry") || is_page("check") || is_page("submit")) {
        wp_enqueue_script(
            'script-jpostal',
            '//jpostal-1006.appspot.com/jquery.jpostal.js',
            array(),
            '',
            true
        );
        wp_enqueue_script('script-contact', get_template_directory_uri() . '/js/contact.js', array(), '', true);
    }

    if (is_front_page()) {
        wp_enqueue_script('script-shop-list', get_template_directory_uri() . '/js/shop-list.js');
    }

    if (!wp_is_mobile()) {
        wp_enqueue_style('style-pc', get_template_directory_uri() . '/css/add/pc.css');
    }
}
add_action('wp_enqueue_scripts', 'wpdocs_theme_scripts');


//wp_headに追加
function adds_head()
{
    echo "
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n
    <!--[if lte IE 8]>\n
        <link rel=\"stylesheet\" href=\"https://unpkg.com/purecss@1.0.0/build/grids-responsive-old-ie-min.css\">\n
    <![endif]-->\n
    <!--[if gt IE 8]><!-->\n
        <link rel=\"stylesheet\" href=\"https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css\">\n
    <!--<![endif]-->\n

";
}
add_action('wp_head', 'adds_head');


/******************************************
カスタム投稿追加
 *******************************************/
add_action('init', 'create_post_type');
function create_post_type()
{

    // register_post_type( 'works',
    //     array(
    //         'labels' => array(
    //           'name' => __( '施工実績' ),
    //           'singular_name' => __( '施工実績' )
    //         ),
    //         'public' => true,
    //         'has_archive' => true,
    //         'rewrite' => array('slug' => 'works')
    //       )
    //     );
    // register_taxonomy(
    //     'type', 
    //     'works', 
    //     array(
    //       'hierarchical' => true, 
    //       'update_count_callback' => '_update_post_term_count',
    //       'label' => '事例カテゴリー',
    //       'singular_label' => '事例カテゴリー',
    //       'public' => true,
    //       'show_ui' => true
    //     )
    // );

}



/******************************************
 クエリ操作
 *******************************************/

// function my_pre_get_posts( $query ) {
//     if(is_admin() || ! $query -> is_main_query()) return;
//     if($query -> is_post_type_archive("system-development")) {
//         $query->set('posts_per_page', -1);
//     }
// }
// add_filter('pre_get_posts', 'my_pre_get_posts');

/******************************************
ショートコード
 *******************************************/
function return_template_path($arg)
{
    $url = get_bloginfo("template_url");
    return $url;
}

add_shortcode('template_url', 'return_template_path');


/******************************************
authorリダイレクト禁止
 *******************************************/
function author_archive_redirect()
{
    if (is_author()) {
        wp_redirect(home_url(), 301);
        exit;
    }
}
add_action('template_redirect', 'author_archive_redirect');

function return_parts_template($arg)
{
    if (!is_admin()) {
        ob_start();
        $file = "{$arg['slug']}-{$arg['name']}.php";
        if (file_exists(__Dir__ . "/{$file}")) {
            get_template_part($arg['slug'], $arg['name']);
        }

        $temp = ob_get_contents();
        ob_end_clean();
        return $temp;
    }
}

add_shortcode('get_template_parts', 'return_parts_template');


function return_common_part($arg)
{
    if (!is_admin()) {

        $url = "https://k-cleaning.jp/wp-json/wp/v2/pages/{$arg['id']}";
        $json = file_get_contents($url);
        $arr = json_decode($json, true);
        return $arr['content']['rendered'];
    }
}

add_shortcode('get_common_part', 'return_common_part');

/******************************************
テーマサポート
 *******************************************/
function themename_custom_logo_setup()
{
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'themename_custom_logo_setup');



/******************************************
TinyMCEテーブル自動幅高さ解除
 *******************************************/
function customize_tinymce_settings($mceInit)
{
    $mceInit['table_resize_bars'] = false;
    return $mceInit;
}
add_filter('tiny_mce_before_init', 'customize_tinymce_settings', 0);


/******************************************
管理画面サイトバー調整
 *******************************************/
function remove_menus()
{
    global $menu;
    //unset($menu[2]);  // ダッシュボード
    //unset($menu[4]);  // メニューの線1
    //unset($menu[5]);  // 投稿
    //unset($menu[10]); // メディア
    //unset($menu[15]); // リンク
    //unset($menu[20]); // ページ
    unset($menu[25]); // コメント
    //unset($menu[59]); // メニューの線2
    //unset($menu[60]); // テーマ
    //unset($menu[65]); // プラグイン
    //unset($menu[70]); // プロフィール
    //unset($menu[75]); // ツール
    //unset($menu[80]); // 設定
    //unset($menu[90]); // メニューの線3
}
add_action('admin_menu', 'remove_menus');


/******************************************
テーマサポート
 *******************************************/

add_shortcode('children_page_list', 'return_child_page_links');

add_theme_support('post-thumbnails');
add_filter('comments_open', '__return_false');


/******************************************
外観メニューを編集者に付与
 *******************************************/

function add_theme_caps()
{
    $role = get_role('editor');
    $role->add_cap('edit_theme_options');
}
add_action('admin_init', 'add_theme_caps');


function my_canonical($canonical)
{
    if (is_front_page()) {
        $canonical = "https://k-cleaning.jp/";
    }
    if (is_page('detail') && isset($_GET['pid'])) {
        $canonical = "https://k-cleaning.jp/service/{$_GET['pid']}";
    }
    if (is_page('campaigns') && isset($_GET['pid'])) {
        $canonical = "https://k-cleaning.jp/campaign/{$_GET['pid']}";
    }
    return $canonical;
}
add_filter('aioseop_canonical_url', 'my_canonical');

add_filter( 'aioseop_title', 'aioseop_title_func' );

function aioseop_title_func( $title ) {
    
    if(!is_front_page()&&is_page()){
        global $post;
        if(!is_page('shop')){
            $title = $post->post_title."｜".$title;
        }elseif(isset($_GET['sid'])&&!empty($_GET['sid'])){
            $_shop = file_get_contents('https://k-cleaning.jp/wp-json/wp/v2/shop/'.$_GET['sid']);
            $shop = json_decode($_shop,true);
            $title = $shop['title']['rendered']."｜".$post->post_title."｜".$title;
        }
    }
    if(is_post_type_archive('staffblog')){
        $title = "スタッフブログ"."｜".get_bloginfo('description');
    }

    return $title;
}

/**
 * Add deploy hook endpoint
 */
add_action('wp_ajax_nopriv_update_theme', 'update_theme');
function update_theme()
{
    $git_root = dirname(__FILE__);
    exec("cd ${git_root} && git pull", $out);
    echo join("\n", $out);
}

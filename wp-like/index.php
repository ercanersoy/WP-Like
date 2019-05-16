<?php
/*
Plugin Name: WP Like
Description: Like plugin for WordPress
Author: Ercan ERSOY
Author URI: http://ercanersoy.net
Version: 0.1
License: LGPLv3
*/

$POSTS_LIKE = array();
$posts = get_posts(array('orderby' => 'ID'));

if (get_option('POSTS_LIKE') == NULL)
{
   foreach($posts as $p)
   {
      array_unshift($POSTS_LIKE[$p->ID], intval(0));
   }

   add_option('POSTS_LIKE', $POSTS_LIKE);
}
else
{
   $GLOBALS['POSTS_LIKE'] = get_option('POSTS_LIKE');
}

add_filter('the_content', 'wp_like_add_like_function');

function wp_like_add_like_function($content)
{
   $id = get_the_ID();
   $like = NULL;

   if($POSTS_LIKE[$id] == NULL)
   {
      $like = '0';
   }

   return '<p><button class="wp-like-button">LIKE (' . $like . ')</button></p><br />' . $content;
}

wp_register_script('like_button_script', plugins_url('./like_button.js', __FILE__), array('jquery'));
wp_enqueue_script('like_button_script');

?>

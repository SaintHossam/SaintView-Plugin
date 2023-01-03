<?php


/*********************** Add view counter to the content ***********************/

add_filter('the_content','num_views');
function num_views($content) {

    $post_id = get_the_ID();

	add_post_meta($post_id, 'num_views', '0', true);

	$views = get_views($post_id);

//	$count_posts_views = get_post_meta($post_id, 'posts_num_views', true);

	$update_posts_views = $views + 1;

	$word_views = get_option('saint_views_word');

	$icon = get_option('saint_views_icon');

	update_post_meta($post_id, 'num_views', $update_posts_views);

	$box_count = "<div class='box-count'> <i class='$icon pl-1'></i> $views  ". $word_views ." </div> ";



	$saint_viewing_position = get_option('viewing_place');
	if ($saint_viewing_position == 'saint_views_top') {

		$content = $box_count . $content;

	} elseif ($saint_viewing_position == 'saint_views_bottom') {

		$content =  $content . $box_count;

	} elseif ($saint_viewing_position == 'saint_views_both') {

		$content =  $box_count . $content . $box_count;

	} elseif ($saint_viewing_position == 'saint_views_contain') {

		$content = $content ;
	}

//	return $box_count . $content;

	return $content;

}


function get_views($post_id) {

	$count_posts_views = get_post_meta($post_id, 'num_views', true);

	return (int)$count_posts_views;
}



add_filter('the_title','title_count',10,2);
function title_count($title, $id)
{

	$post_type = get_post_type($id);

	$post_id = get_the_ID();

	if(!is_admin() && !is_single() && $post_type !== 'page' ) {

		$views = get_views($post_id);

	} else {

		$views = '';
	}

    return  $views . $title;

}



/*********************** Add view counter to dashboard ***********************/

//apply_filters( "manage_{$post_type}_posts_columns", string[] $post_columns)

add_filter('manage_post_posts_columns','main_counter_dashboard');
add_filter('manage_services_posts_columns','main_counter_dashboard');
add_filter('manage_media_posts_columns','main_counter_dashboard');
add_filter('manage_page_posts_columns','main_counter_dashboard');
function main_counter_dashboard($columns) {

	$columns ['num_views'] ='المشاهدات';
	$columns ['num_image'] ='الصور';

	return $columns;
}

//do_action( "manage_{$post->post_type}_posts_custom_column", string $column_name, int $post_id )


add_filter( 'manage_post_posts_custom_column', 'dashboard_func', 10, 2 );
add_filter( 'manage_services_posts_custom_column', 'dashboard_func', 10, 2 );
add_filter( 'manage_media_posts_custom_column', 'dashboard_func', 10, 2 );
add_filter( 'manage_page_posts_custom_column', 'dashboard_func', 10, 2 );
function dashboard_func($columns, $post_id) {

	if($columns == 'num_views') {

        echo "<span 
		style='color:#FFF;
	    background: #000;
	    display: inline-block; 
	    padding: 0 4px; 
	    border-radius: 3px; 
	    width: 30px;
	    height: 30px;
	    line-height: 30px;
	    text-align: center;'>".get_views($post_id)." </span>";

	} elseif ($columns == 'num_image') {
		if(has_post_thumbnail()) {
			echo get_the_post_thumbnail($post_id, [70,70]);
		} else {
			echo 'لا توجد صوره لهذا المحتوى';
		}

	}

}

<?php
/*
***************************************
* SUBJECT POST TYPE
***************************************
*/
function rsgsrf_get_subject_id(){
	global $wp_query;
	$subj_arr = [];
	$orig_query 				= $wp_query;
	$WP_Query 					= null;
	$rsgsrf_subj_content 		= array( 'post_type' => 'rsgsrf','order'=>'ASC','orderby'=>'title','posts_per_page'=> -1 );
    $rsgsrf_subj_content 		= new WP_Query($rsgsrf_subj_content);
    $wp_query 					= $rsgsrf_subj_content;

    if ( $rsgsrf_subj_content->have_posts() ) :
        while ( $rsgsrf_subj_content->have_posts() ) : $rsgsrf_subj_content->the_post();
        	$subj_arr[get_the_ID()] = get_the_title();
        endwhile;
    endif;

    $wp_query = NULL; $wp_query = $orig_query;
    return $subj_arr;
}

/*
***************************************
* SCHOOL LEVEL POST TYPE
***************************************
*/
function rsgsrf_get_lvl_id(){
	global $wp_query;
	$lvl_arr = [];
	$orig_query 				= $wp_query;
	$WP_Query 					= null;
	$rsgsrf_lvl_content 	= array( 'post_type' => 'rsgsrf_post_level','order'=>'asc','posts_per_page'=> -1 );
    $rsgsrf_lvl_content 	= new WP_Query($rsgsrf_lvl_content);
    $wp_query 					= $rsgsrf_lvl_content;

    if ( $rsgsrf_lvl_content->have_posts() ) :
        while ( $rsgsrf_lvl_content->have_posts() ) : $rsgsrf_lvl_content->the_post();
        	$lvl_arr[get_the_ID()] = get_the_title();
        endwhile;
    endif;

    $wp_query = NULL; $wp_query = $orig_query;
    return $lvl_arr;
}

/*
***************************************
* TUTOR TYPE POST TYPE
***************************************
*/
function rsgsrf_get_type_id(){
	global $wp_query;
	$type_arr = [];
	$orig_query 				= $wp_query;
	$WP_Query 					= null;
	$rsgsrf_type_content 		= array( 'post_type' => 'rsgsrf_post_type','order'=>'asc','posts_per_page'=> -1 );
    $rsgsrf_type_content 		= new WP_Query($rsgsrf_type_content);
    $wp_query 					= $rsgsrf_type_content;

    if ( $rsgsrf_type_content->have_posts() ) :
        while ( $rsgsrf_type_content->have_posts() ) : $rsgsrf_type_content->the_post();
        	$type_arr[get_the_ID()] = get_the_title();
        endwhile;
    endif;

    $wp_query = NULL; $wp_query = $orig_query;
    return $type_arr;
}

/*
***************************************
* SUBJECT TABLE POST TYPE
***************************************
*/
function rsgsrf_get_tables_id(){
	global $wp_query;
	$tbl_arr = [];
	$orig_query 				= $wp_query;
	$WP_Query 					= null;
	$rsgsrf_tbl_content 		= array( 'post_type' => 'rsgsrf_post_tables','order'=>'asc','posts_per_page'=> -1 );
    $rsgsrf_tbl_content 		= new WP_Query($rsgsrf_tbl_content);
    $wp_query 					= $rsgsrf_tbl_content;

    if ( $rsgsrf_tbl_content->have_posts() ) :
        while ( $rsgsrf_tbl_content->have_posts() ) : $rsgsrf_tbl_content->the_post();
        	$tbl_arr[get_the_ID()] = get_the_title();
        endwhile;
    endif;

    $wp_query = NULL; $wp_query = $orig_query;
    return $tbl_arr;
}

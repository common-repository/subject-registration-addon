<?php

add_action('wp_ajax_nopriv_rsgsrf_get_post_contents','rsgsrf_get_post_contents');
add_action('wp_ajax_rsgsrf_get_post_contents','rsgsrf_get_post_contents');
function rsgsrf_get_post_contents(){
    $post_IDS   = $_REQUEST['post_IDS'];
    $types_arr  = rsgsrf_get_type_id();
    $school_arr = rsgsrf_get_lvl_id();
    $table_arr  = rsgsrf_get_tables_id();
    

    if( count($table_arr) == 0 ){
        $result = $result.'<hr><div class="rsgsrf__contents_main">No Tables Added</div>';
    }else{
        $result     = '<div class="rynerg_rsgsrf"><div class="rsgsrf_admin">';
        foreach( $table_arr as $tbl_id=>$tbl_nem ){

            $result     = $result.'<div class="rsgsrf__contents_main"><p class="rsgsrf_reg_title" style="text-align:center;">'.$tbl_nem.'</p><br><hr>';
            foreach( $types_arr as $types_id=>$types_nem ){
                $tp                 = '';
                $other_price        = 0;

                foreach( $school_arr as $lvl_id=>$lvl_nem ){
                    $pri         =0;
                    $mp          = 'rsgsrf_meta_prices_'.$lvl_id.'_'.$types_id.'_'.$tbl_id;
                    $meta_prices = get_post_meta($post_IDS, $mp,true);

                    if( isset($meta_prices) || !empty($meta_prices) || $meta_prices!=null ){
                        $pri = $meta_prices;
                        if( $meta_prices==0 || $meta_prices==''){
                            $pri = '0';
                        }
                    }else{
                        $pri = '0';
                    }

                    $tp = $tp.'<span style="padding-left:10px;"><span style="font-weight:600;">&nbsp;'.$lvl_nem.':</span>&nbsp;$&emsp;<input type="number" type_id="'.$types_id.'" value="'.$pri.'" id_post="'.$post_IDS.'" lvl_id="'.$lvl_id.'" tbl_id="'.$tbl_id.'">/hr</span><br>';
                }

                $tp = $tp;
                if( count($school_arr) != 0 ){  
                    $result = $result. '<div class="rsgsrf__contents_main" data_id="'.$post_IDS.'"><div class="rsgsrf_reg_title">'.$types_nem.'</div><br>'.$tp.'&emsp;</div>';
                }else{
                    $result = $result. '<div class="rsgsrf__contents_main" data_id="'.$post_IDS.'"><div class="rsgsrf_reg_title">'.$types_nem.'</div><br>'.'&emsp;<span>Add school level</span></div>';
                }
            }

            $result = $result.'<br><hr></div>';
        }
        $result = $result.'</div></div>';
    }

    

    $result = json_encode($result); echo $result; die();
}

// SAVE POST CONTENT
add_action('wp_ajax_nopriv_rsgsrf_save_post_content','rsgsrf_save_post_content');
add_action('wp_ajax_rsgsrf_save_post_content','rsgsrf_save_post_content');
function rsgsrf_save_post_content(){
    $lvl_id     = $_REQUEST['lvl_id'];
    $id_post    = $_REQUEST['id_post'];
    $type_id    = $_REQUEST['type_id'];
    $tbl_id     = $_REQUEST['tbl_id'];
    $price_val  = $_REQUEST['price_val'];

    $meta_key = 'rsgsrf_meta_prices_'.$lvl_id.'_'.$type_id.'_'.$tbl_id;

    update_post_meta( (int)$id_post, $meta_key, $price_val);

    $result = get_post_meta((int)$id_post,$meta_key,true);
    $result = json_encode($result); echo $result; die();
}
<?php


add_action('wp_ajax_nopriv_rsgsrf_get_all_subjects_table','rsgsrf_get_all_subjects_table');
add_action('wp_ajax_rsgsrf_get_all_subjects_table','rsgsrf_get_all_subjects_table');
function rsgsrf_get_all_subjects_table(){
    $lvl_arr    = rsgsrf_get_lvl_id();
    $type_arr   = rsgsrf_get_type_id();
    $subj_arr   = rsgsrf_get_subject_id();
    $table_arr  = rsgsrf_get_tables_id();
    $tbl_str    = '';
    $result     = '<div class="rsgsrf_subj_display">';

    
    
    if( count($table_arr) != 0 ){
        
        foreach( $table_arr as $tbl_id=>$tbl_nem ){
            $cnt_type   = '';
            $tbl_str    =$tbl_str.'<div class=""><p class="rsgsrf_tbl_title">'.$tbl_nem.'</p>';

            $str = '<table><tbody><tr class="rsgsrf_tbl_head"><td><span class="rsgsrf_tbl_head">Subjects</span></td>';
            foreach( $type_arr as $type_id=>$type_nem ){
                $str = $str.'<td style="text-align:center;"><span class="rsgsrf_tbl_head">'.$type_nem.'</span></td>';
                $cnt_type = $cnt_type.'<td></td>';
            }
            $str = $str.'</tr>';
            $lvl_str = '';

            foreach( $lvl_arr as $lvl_id=>$lvl_nem ){
                $lvl_ctr_ctr = 'empty'; 
                $string_append = '';

                foreach( $subj_arr as $sub_id=>$sub_nem ){
                    $sub_price = '';
                    foreach( $type_arr as $type_id=>$type_nem ){
                        $sub_pri = get_post_meta($sub_id,'rsgsrf_meta_prices_'.$lvl_id.'_'.$type_id.'_'.$tbl_id,true);
                        if( isset($sub_pri) || !empty($sub_pri) || $sub_pri!=null || $sub_pri !='' || $sub_pri!=false ){
                            if( $sub_pri!=0 ){
                                $sub_pri = '<td style="text-align:center;">$'.$sub_pri.'/hr</td>';
                                $lvl_ctr_ctr = 'not_empty';
                            }else{ $sub_pri = '<td></td>'; }
                        }else{ $sub_pri = ''; }
                        $sub_price = $sub_price.$sub_pri;
                    }
                    if( $sub_price != '<td></td><td></td>' ){
                        $string_append = $string_append.'<tr class="rsgsrf_tbl_content"><td>&emsp;<a href="#" class="rsgsrf_client_add_subject" sub_id="'.$sub_id.'" lvl_id="'.$lvl_id.'" tbl_id="'.$tbl_id.'" >Add</a> &emsp;|&emsp;'.$sub_nem.'</td>';
                        $string_append = $string_append.$sub_price.'</tr>';
                    }
                }
                if( $lvl_ctr_ctr == 'not_empty' ){
                    $lvl_str = $lvl_str.'<tr class="rsgsrf_tbl_level_title"><td><b>&emsp;'.$lvl_nem.'</b></td>'.$cnt_type.'</tr>'.$string_append;
                }
            }

            $str = $str.$lvl_str.'<tbody></table>'; 
            

            $tbl_str = $tbl_str.$str.'</div>';
        }
    }


    // FOOTER PART
    $pri_holder = '<hr><div class="rsgsrf_price_holder rsgsrf_reg_title" style="pading:10px;" pinaka_total="0" initial_total="0">Total Price:&nbsp; $<strong>0.00</strong></div>';
    
    $result = $result.$tbl_str.$pri_holder.'</div>';

    $result = $result.'</div>'.rsgsrf_add_subject_modal();
    $wp_query = NULL; $wp_query = $orig_query;
    $result = json_encode($result); echo $result; die();
}

add_action('wp_ajax_nopriv_rsgsrf_get_added_subject_price','rsgsrf_get_added_subject_price');
add_action('wp_ajax_rsgsrf_get_added_subject_price','rsgsrf_get_added_subject_price');
function rsgsrf_get_added_subject_price(){
    $sub_id = (int)$_REQUEST['sub_id'];
    $lvl_id = (int)$_REQUEST['lvl_id'];
    $type_id = (int)$_REQUEST['type_id'];
    $tbl_id = (int)$_REQUEST['tbl_id'];

    $sub_pri = get_post_meta($sub_id,'rsgsrf_meta_prices_'.$lvl_id.'_'.$type_id.'_'.$tbl_id,true);
    if( $sub_pri==0 || $sub_pri=='' || empty($sub_pri) || !isset($sub_pri) ){
        $result['pri'] = '0';
    }else{
        $result['pri'] = $sub_pri;
    }
    $result['title'] = get_the_title($sub_id);
    $result['type'] = get_the_title($type_id);
    $result['tbl'] = get_the_title($tbl_id);
    $result['lvl'] = get_the_title($lvl_id);

    $result = json_encode($result); echo $result; die();
}
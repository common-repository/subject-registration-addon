<?php



// TUTORING TYPE PAGE CALLBACK
function rsgsrf_tables(){
    ?>
    <div class="rsgsrf_tables rynerg_rsgsrf">

    	<div class="rsgsrf_pre_loader"><div class="rsgsrf_loader"></div></div>
		<div class="rsgsrf_notif"></div>

        <div class="rsgsrf__title">
            <p class="rsgsrf_big_title">Tables</p>
        </div>
        <div class="rsgsrf__contents rsgsrf_admin">
        	<br>
            <div class="rsgsrf__contents_add" style=""><button class="rsgsrf_btn_submit">Add New</button></div>
            <br>
            <div class="rsgsrf__contents_table" style="background-color: #fff;">
                <?php echo rsgsrf_table_contents(); ?>
                <hr>
            </div>
        </div>
        <div class="rsgsrf__modal">
			<div class="rsgsrf_modal_content">
				<div class="rsgsrf_modal_title">Tables </div> <br>
				<div class="rsgsrf_modal_fields">
					<form class="rsgsrf_modal_add_subject_form" method="post">
						<div class="">
							<i class="rsgsrf_error">Nothing to save.</i>
							<input type='text' id="rsgsrf__modal_type" style="width: 100%; padding: 10px;" placeholder="Type Name">
						</div>
					</form>
				</div>
				<br>
				<div class="rsgsrf_modal_actions">
					<button type="button" class="rsgsrf_btn_submit save_btn_modal" style="display:none;"> ADD </button>
					<button type="button" class="rsgsrf_btn_submit edit_btn_modal" style="display:none;"> EDIT </button>
					<button type="button" class="rsgsrf_btn_submit cancel_btn_modal"> CANCEL </button>
				</div>
			</div>
        </div>
    </div>
    <?php
}



/*
* ADD TUTORING TYPE
*/
add_action('wp_ajax_nopriv_rsgsrf_table_add','rsgsrf_table_add');
add_action('wp_ajax_rsgsrf_table_add','rsgsrf_table_add');
function rsgsrf_table_add(){
	
	wp_insert_post(array(
        'post_author'   => 1,
        'post_title'    => $_REQUEST['type_val'],
        'post_status'   => 'publish', 
        'post_content'  => '',
        'post_type'     => 'rsgsrf_post_tables'
    ));
    
    // $result = rsgsrf_tutoring_type_contents().'<hr>';
    $result = json_encode($result); echo $result; die();
}
/*
* EDIT TUTORING TYPE
*/
add_action('wp_ajax_nopriv_rsgsrf_table_edit','rsgsrf_table_edit');
add_action('wp_ajax_rsgsrf_table_edit','rsgsrf_table_edit');
function rsgsrf_table_edit(){
	$type_id = (int)$_REQUEST['type_id'];
	wp_update_post(array( 'ID' => $type_id, 'post_title' => $_REQUEST['type_val'], 'post_type' => 'rsgsrf_post_tables' ));
	$result = json_encode($result); echo $result; die();
}

/*
* DELETE TUTORING TYPE
*/
add_action('wp_ajax_nopriv_rsgsrf_table_del','rsgsrf_table_del');
add_action('wp_ajax_rsgsrf_table_del','rsgsrf_table_del');
function rsgsrf_table_del(){
	$type_id = (int)$_REQUEST['type_id'];
	wp_delete_post($type_id,true);
	$result = json_encode($result); echo $result; die();
}

/*
* DISPLAY ALL TUTORING TYPE
*/
function rsgsrf_table_contents(){
    $tbl_arr = rsgsrf_get_tables_id();
    $result = '';

    if( count($tbl_arr) != 0 ){
        foreach( $tbl_arr as $t_id=>$t_nem ){
            $edit_btn = '<span class="rsgsrf__content_edit rsgsrf__content_option" data_id_id="'.$t_id.'"> Edit </span>';
            $del_btn = '<span class="rsgsrf__content_del rsgsrf__content_option" data_id_id="'.$t_id.'"> Delete </span>';
            $result = $result. '<hr><div class="rsgsrf__contents_main">'.$edit_btn.'&nbsp;|&nbsp;'.$del_btn.'&nbsp;&emsp;'.$t_nem.'</div>';
        }
    }else{
        $result = $result.'<hr><div class="rsgsrf__contents_main">No Tutoring Type added</div>';
    }

    return $result;
}

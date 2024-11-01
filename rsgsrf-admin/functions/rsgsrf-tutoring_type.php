<?php



// TUTORING TYPE PAGE CALLBACK
function rsgsrf_tutoring_type(){
    ?>
    <div class="rsgsrf_tutoring_type rynerg_rsgsrf">

    	<div class="rsgsrf_pre_loader"><div class="rsgsrf_loader"></div></div>
		<div class="rsgsrf_notif"></div>

        <div class="rsgsrf__title">
            <p class="rsgsrf_big_title">Tutoring Types</p>
        </div>
        <div class="rsgsrf__contents rsgsrf_admin">
        	<br>
            <div class="rsgsrf__contents_add" style=""><button class="rsgsrf_btn_submit">Add New</button></div>
            <br>
            <div class="rsgsrf__contents_table" style="background-color: #fff;">
                <?php echo rsgsrf_tutoring_type_contents(); ?>
                <hr>
            </div>
        </div>
        <div class="rsgsrf__modal">
			<div class="rsgsrf_modal_content">
				<div class="rsgsrf_modal_title">Tutoring Type </div> <br>
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
add_action('wp_ajax_nopriv_rsgsrf_tutoring_type_add','rsgsrf_tutoring_type_add');
add_action('wp_ajax_rsgsrf_tutoring_type_add','rsgsrf_tutoring_type_add');
function rsgsrf_tutoring_type_add(){
	
	wp_insert_post(array(
        'post_author'   => 1,
        'post_title'    => $_REQUEST['type_val'],
        'post_status'   => 'publish', 
        'post_content'  => '',
        'post_type'     => 'rsgsrf_post_type'
    ));
    
    // $result = rsgsrf_tutoring_type_contents().'<hr>';
    $result = json_encode($result); echo $result; die();
}
/*
* EDIT TUTORING TYPE
*/
add_action('wp_ajax_nopriv_rsgsrf_tutoring_type_edit','rsgsrf_tutoring_type_edit');
add_action('wp_ajax_rsgsrf_tutoring_type_edit','rsgsrf_tutoring_type_edit');
function rsgsrf_tutoring_type_edit(){
	$type_id = (int)$_REQUEST['type_id'];
	wp_update_post(array( 'ID' => $type_id, 'post_title' => $_REQUEST['type_val'], 'post_type' => 'rsgsrf_post_type' ));
	$result = json_encode($result); echo $result; die();
}

/*
* DELETE TUTORING TYPE
*/
add_action('wp_ajax_nopriv_rsgsrf_tutoring_type_del','rsgsrf_tutoring_type_del');
add_action('wp_ajax_rsgsrf_tutoring_type_del','rsgsrf_tutoring_type_del');
function rsgsrf_tutoring_type_del(){
	$type_id = (int)$_REQUEST['type_id'];
	wp_delete_post($type_id,true);
	$result = json_encode($result); echo $result; die();
}

/*
* DISPLAY ALL TUTORING TYPE
*/
function rsgsrf_tutoring_type_contents(){
    $type_arr = rsgsrf_get_type_id();
    $result = '';

    if( count($type_arr) != 0 ){
        foreach( $type_arr as $t_id=>$t_nem ){
            $edit_btn = '<span class="rsgsrf__content_edit rsgsrf__content_option" data_id_id="'.$t_id.'"> Edit </span>';
            $del_btn = '<span class="rsgsrf__content_del rsgsrf__content_option" data_id_id="'.$t_id.'"> Delete </span>';
            $result = $result. '<hr><div class="rsgsrf__contents_main">'.$edit_btn.'&nbsp;|&nbsp;'.$del_btn.'&nbsp;&emsp;'.$t_nem.'</div>';
        }
    }else{
        $result = $result.'<hr><div class="rsgsrf__contents_main">No Tutoring Type added</div>';
    }

    return $result;
}

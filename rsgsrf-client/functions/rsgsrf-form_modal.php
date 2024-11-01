<?php

function rsgsrf_add_subject_modal(){
    $arr    = rsgsrf_get_type_id();
    $type_str = '';
    if( count($arr) != 0 ){
        foreach( $arr as $type_id=>$type_nem ){
            $type_str = $type_str.'<span type_id="'.$type_id.'" data="'.$type_nem.'">'.$type_nem.'</span>';
        }
    }

    $str = '<div class="rsgsrf__modal">
            <div class="rsgsrf_modal_content">
                <div class="rsgsrf_pre_loader"><div class="rsgsrf_loader"></div></div>
                <div class="rsgsrf_notif"></div>

                <div class="rsgsrf_modal_title">Add Subject</div> <br>
                <div class="rsgsrf_modal_fields">
                    <form class="rsgsrf_modal_add_subject_form" method="post">
                        <div class="rsgsrf_select_type">
                            <i class="">Select Tutoring Type</i><br>
                            <input type="text" id="rsgsrf__modal_type" style="width: 100%; padding: 10px;" placeholder="Select">
                            <div class="rsgsrf_type__content">
                            '.$type_str.'
                            </div>
                        </div>
                        <br>
                        <div class="rsgsrf_add_hrs" style="display:none;">
                            <i class="">Select Number of Hours</i><br>
                            <input type="number" id="rsgsrf__modal_hrs" style="width: 100%; padding: 10px;" placeholder="Enter Hours">
                            <br> &emsp;<i class="rsgsrf_total_single">Subject Price:</i>
                        </div>
                        <br>
                        <div class="rsfsrf_ptice_pinakatotal" style="display:none;">
                            <p>Total Price:<strong></strong></p>
                        </div>
                    </form>
                </div>
                <br>
                <div class="rsgsrf_modal_actions">
                    <button type="button" class="rsgsrf_btn_submit save_btn_modal"> SAVE </button>
                    <button type="button" class="rsgsrf_btn_submit cancel_btn_modal"> CANCEL </button>
                </div>
            </div>
        </div>';
    return $str;
}
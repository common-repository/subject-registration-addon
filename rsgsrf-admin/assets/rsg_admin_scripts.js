
(function($) {

    if( $('body').hasClass('post-type-rsgsrf') ){
        console.log('post-type-rsgsrf');
        /*
        **********************************************
        * GLOBAL FUNCTIONS
        **********************************************
        */
        function rsgsrf_error_ajax(){
        	$('.rsgsrf_pre_loader').hide();
            $('.rsgsrf_notif').fadeIn(function(){
                $(this).text('Something Went wrong!').delay(1000).fadeOut();
                location.reload();
            });
        }

        /*
        **********************************************
        * TUTORING TYPE PAGE
        **********************************************
        */
        if( $('body').hasClass('rsgsrf_page_rsgsrf_tutoring_type') ){
        	// function rsgsrf_error_ajax(){
	        // 	$('.rsgsrf_pre_loader').hide();
         //        $('.rsgsrf_notif').fadeIn(function(){
         //            $(this).text('Something Went wrong!').delay(1000).fadeOut();
         //            location.reload();
         //        });
	        // }
        	function rsgsrf__modal_add_type_initialize(){
	        	$('.rsgsrf_error').hide();
	        	$('#rsgsrf__modal_type').val('');
	        }
	        $('.rsgsrf__contents_add button').click(function(){
	        	rsgsrf__modal_add_type_initialize();
	        	$('.save_btn_modal').show();
	        	$('.edit_btn_modal').hide();
	        	$('.rsgsrf__modal').fadeIn();
	        });
	        $('.rsgsrf__modal .cancel_btn_modal').click(function(){ 
	        	rsgsrf__modal_add_type_initialize(); 
	        	$('.rsgsrf__modal').fadeOut();
	        });

	        // SAVE TUTORING TYPE
	        $('.rsgsrf__modal .save_btn_modal').click(function(){
	        	type_val = $('#rsgsrf__modal_type').val();
	        	if( type_val == '' || type_val == null ){
	        		$('.rsgsrf_error').show().text('Nothing to save.');
	        		return false;
	        	}
	        	$('.rsgsrf__modal').fadeOut();
	        	$('.rsgsrf_pre_loader').show();
	        	jQuery.ajax({
	                type : "post",
	                dataType : "json",
	                url : myAjax.ajaxurl,
	                data : { action : "rsgsrf_tutoring_type_add", type_val : type_val },
	                success: function(res) {

	                    rsgsrf__modal_add_type_initialize();
	                    $('.rsgsrf__modal').fadeOut();

	                    // HIDE LOADER
	                    $('.rsgsrf_pre_loader').hide();
	                    $('.rsgsrf_notif').fadeIn(function(){
	                        $(this).text('Tutoring Type Added').delay(1000).fadeOut();
	                        location.reload().delay(1000);
	                    });
	                },error: function(){ rsgsrf_error_ajax(); }
	            });
	        });


	        // EDIT TUTORING TYPE
	        $('.rsgsrf__content_edit').click(function(){
	        	data_id_id = $(this).attr('data_id_id');
	        	rsgsrf__modal_add_type_initialize();
            	$('.rsgsrf__modal').fadeIn();

	        	$('.save_btn_modal').hide();
	        	$('.edit_btn_modal').show();

	        	$('.edit_btn_modal').click(function(){
	        		type_val = $('#rsgsrf__modal_type').val();
		        	if( type_val == '' || type_val == null ){
		        		$('.rsgsrf_error').show().text('Nothing to save.');
		        		return false;
		        	}
		        	$('.rsgsrf__modal').fadeOut();
		        	$('.rsgsrf_pre_loader').show();
	        		jQuery.ajax({
		                type : "post", dataType : "json", url : myAjax.ajaxurl,
		                data : { action : "rsgsrf_tutoring_type_edit", type_val : type_val, type_id:data_id_id },
		                success: function(res) {

		                	console.log(res);
		                    rsgsrf__modal_add_type_initialize();
		                    $('.rsgsrf__modal').fadeOut();

		                    // HIDE LOADER
		                    $('.rsgsrf_pre_loader').hide();
		                    $('.rsgsrf_notif').fadeIn(function(){
		                        $(this).text('Tutoring Type Updated').delay(1000).fadeOut();
		                        location.reload().delay(1000);
		                    });
		                }
		            });
	        	});
            });
	       
	        // DELETE TUTORING TYPE
	        $('.rsgsrf__content_del').click(function(){
	        	data_id_id = $(this).attr('data_id_id');
	        	$('.rsgsrf_pre_loader').show();
	        	jQuery.ajax({
	                type : "post", dataType : "json", url : myAjax.ajaxurl,
	                data : { action : "rsgsrf_tutoring_type_del", type_id:data_id_id },
	                success: function(res) {
	                    $('.rsgsrf_pre_loader').hide();
	                    $('.rsgsrf_notif').fadeIn(function(){
	                        $(this).text('Tutoring Type Deleted').delay(1000).fadeOut();
	                        location.reload().delay(1000);
	                    });
	                }
	            });
            });

        }
        

        /*
        **********************************************
        * SCHOOL LEVEL PAGE
        **********************************************
        */

        if( $('body').hasClass('rsgsrf_page_rsgsrf_school_level') ){
        	// function rsgsrf_error_ajax(){
	        // 	$('.rsgsrf_pre_loader').hide();
         //        $('.rsgsrf_notif').fadeIn(function(){
         //            $(this).text('Something Went wrong!').delay(1000).fadeOut();
         //            location.reload();
         //        });
	        // }
        	function rsgsrf__modal_add_lvl_initialize(){
	        	$('.rsgsrf_error').hide();
	        	$('#rsgsrf__modal_type').val('');
	        }
	        $('.rsgsrf__contents_add button').click(function(){
	        	rsgsrf__modal_add_lvl_initialize();
	        	$('.save_btn_modal').show();
	        	$('.edit_btn_modal').hide();
	        	$('.rsgsrf__modal').fadeIn();
	        });
	        $('.rsgsrf__modal .cancel_btn_modal').click(function(){ 
	        	rsgsrf__modal_add_lvl_initialize(); 
	        	$('.rsgsrf__modal').fadeOut();
	        });

	        // SAVE
	        $('.rsgsrf__modal .save_btn_modal').click(function(){
	        	type_val = $('#rsgsrf__modal_type').val();
	        	if( type_val == '' || type_val == null ){
	        		$('.rsgsrf_error').show().text('Nothing to save.');
	        		return false;
	        	}
	        	$('.rsgsrf__modal').fadeOut();
	        	$('.rsgsrf_pre_loader').show();
	        	jQuery.ajax({
	                type : "post",
	                dataType : "json",
	                url : myAjax.ajaxurl,
	                data : { action : "rsgsrf_school_lvl_add", type_val : type_val },
	                success: function(res) {
	                    rsgsrf__modal_add_lvl_initialize();
	                    $('.rsgsrf__modal').fadeOut();
	                    $('.rsgsrf_pre_loader').hide();
	                    $('.rsgsrf_notif').fadeIn(function(){
	                        $(this).text('School Level Added').delay(1000).fadeOut();
	                        location.reload().delay(1000);
	                    });
	                },error: function(){ rsgsrf_error_ajax(); }
	            });
	        });


	        // EDIT
	        $('.rsgsrf__content_edit').click(function(){
	        	data_id_id = $(this).attr('data_id_id');
	        	rsgsrf__modal_add_lvl_initialize();
            	$('.rsgsrf__modal').fadeIn();

	        	$('.save_btn_modal').hide();
	        	$('.edit_btn_modal').show();

	        	$('.edit_btn_modal').click(function(){
	        		type_val = $('#rsgsrf__modal_type').val();
		        	if( type_val == '' || type_val == null ){
		        		$('.rsgsrf_error').show().text('Nothing to save.');
		        		return false;
		        	}
		        	$('.rsgsrf__modal').fadeOut();
		        	$('.rsgsrf_pre_loader').show();
	        		jQuery.ajax({
		                type : "post", dataType : "json", url : myAjax.ajaxurl,
		                data : { action : "rsgsrf_school_lvl_edit", type_val : type_val, type_id:data_id_id },
		                success: function(res) {
		                    rsgsrf__modal_add_lvl_initialize();
		                    $('.rsgsrf__modal').fadeOut();
		                    $('.rsgsrf_pre_loader').hide();
		                    $('.rsgsrf_notif').fadeIn(function(){
		                        $(this).text('School Level Updated').delay(1000).fadeOut();
		                        location.reload().delay(1000);
		                    });
		                }
		            });
	        	});
            });
	       
	        // DELETE
	        $('.rsgsrf__content_del').click(function(){
	        	data_id_id = $(this).attr('data_id_id');
	        	$('.rsgsrf_pre_loader').show();
	        	jQuery.ajax({
	                type : "post", dataType : "json", url : myAjax.ajaxurl,
	                data : { action : "rsgsrf_school_lvl_del", type_id:data_id_id },
	                success: function(res) {
	                    $('.rsgsrf_pre_loader').hide();
	                    $('.rsgsrf_notif').fadeIn(function(){
	                        $(this).text('School Level Deleted').delay(1000).fadeOut();
	                        location.reload().delay(1000);
	                    });
	                }
	            });
            });

        }

        /*
        **********************************************
        * TABLES PAGE
        **********************************************
        */

        if( $('body').hasClass('rsgsrf_page_rsgsrf_tables') ){
        	
        	function rsgsrf__modal_add_tbl_initialize(){
	        	$('.rsgsrf_error').hide();
	        	$('#rsgsrf__modal_type').val('');
	        }
	        $('.rsgsrf__contents_add button').click(function(){
	        	rsgsrf__modal_add_tbl_initialize();
	        	$('.save_btn_modal').show();
	        	$('.edit_btn_modal').hide();
	        	$('.rsgsrf__modal').fadeIn();
	        });
	        $('.rsgsrf__modal .cancel_btn_modal').click(function(){ 
	        	rsgsrf__modal_add_tbl_initialize(); 
	        	$('.rsgsrf__modal').fadeOut();
	        });

	        // SAVE
	        $('.rsgsrf__modal .save_btn_modal').click(function(){
	        	type_val = $('#rsgsrf__modal_type').val();
	        	if( type_val == '' || type_val == null ){
	        		$('.rsgsrf_error').show().text('Nothing to save.');
	        		return false;
	        	}
	        	$('.rsgsrf__modal').fadeOut();
	        	$('.rsgsrf_pre_loader').show();
	        	jQuery.ajax({
	                type : "post",
	                dataType : "json",
	                url : myAjax.ajaxurl,
	                data : { action : "rsgsrf_table_add", type_val : type_val },
	                success: function(res) {
	                    rsgsrf__modal_add_tbl_initialize();
	                    $('.rsgsrf__modal').fadeOut();
	                    $('.rsgsrf_pre_loader').hide();
	                    $('.rsgsrf_notif').fadeIn(function(){
	                        $(this).text('Table Added').delay(1000).fadeOut();
	                        location.reload().delay(1000);
	                    });
	                },error: function(){ rsgsrf_error_ajax(); }
	            });
	        });


	        // EDIT
	        $('.rsgsrf__content_edit').click(function(){
	        	data_id_id = $(this).attr('data_id_id');
	        	rsgsrf__modal_add_tbl_initialize();
            	$('.rsgsrf__modal').fadeIn();

	        	$('.save_btn_modal').hide();
	        	$('.edit_btn_modal').show();

	        	$('.edit_btn_modal').click(function(){
	        		type_val = $('#rsgsrf__modal_type').val();
		        	if( type_val == '' || type_val == null ){
		        		$('.rsgsrf_error').show().text('Nothing to save.');
		        		return false;
		        	}
		        	$('.rsgsrf__modal').fadeOut();
		        	$('.rsgsrf_pre_loader').show();
	        		jQuery.ajax({
		                type : "post", dataType : "json", url : myAjax.ajaxurl,
		                data : { action : "rsgsrf_table_edit", type_val : type_val, type_id:data_id_id },
		                success: function(res) {
		                    rsgsrf__modal_add_tbl_initialize();
		                    $('.rsgsrf__modal').fadeOut();
		                    $('.rsgsrf_pre_loader').hide();
		                    $('.rsgsrf_notif').fadeIn(function(){
		                        $(this).text('Table Name Updated').delay(1000).fadeOut();
		                        location.reload().delay(1000);
		                    });
		                }
		            });
	        	});
            });
	       
	        // DELETE
	        $('.rsgsrf__content_del').click(function(){
	        	data_id_id = $(this).attr('data_id_id');
	        	$('.rsgsrf_pre_loader').show();
	        	jQuery.ajax({
	                type : "post", dataType : "json", url : myAjax.ajaxurl,
	                data : { action : "rsgsrf_table_del", type_id:data_id_id },
	                success: function(res) {
	                    $('.rsgsrf_pre_loader').hide();
	                    $('.rsgsrf_notif').fadeIn(function(){
	                        $(this).text('Table Deleted').delay(1000).fadeOut();
	                        location.reload().delay(1000);
	                    });
	                }
	            });
            });

        }


        /*
	    **********************************************
	    * SUBJECTS SINGLE POSTS
	    **********************************************
	    */
	    var rsgsrf_get_post_id        = window.location.search;
        rsgsrf_get_post_id            = new URLSearchParams(rsgsrf_get_post_id.substring(1));
        rsgsrf_get_post_id            = rsgsrf_get_post_id.get("post");

        // INSIDE POST TYPES  
        if(rsgsrf_get_post_id != null){
            
            $('.meta-box-sortables.ui-sortable').hide();
            $('#normal-sortables').hide();
            $('#poststuff #post-body #post-body-content').append('<div class="rsgsrf_contents_single" style="background:#fff; box-shadow:0px 1px 15px -3px #222;"></div>');
            jQuery.ajax({
	            type : "post", dataType : "json", url : myAjax.ajaxurl,
	            data : { action : "rsgsrf_get_post_contents", post_IDS:rsgsrf_get_post_id },
	            success: function(res) {
	            	
	            	$('.rsgsrf_contents_single').html(res);
	                // UPDATE ONE

	                	$('.rsgsrf__contents_main .rsgsrf__contents_main span input').keyup(function(){
		                	id_post = $(this).attr('id_post');
		                	type_id = $(this).attr('type_id');
		                	lvl_id = $(this).attr('lvl_id');
		                	tbl_id = $(this).attr('tbl_id');
	                		price_val = $(this).val();
	                		console.log('id_post:'+id_post+'->type_id:'+type_id+'->price_val:'+price_val+'->tbl_id:'+tbl_id);

	                		jQuery.ajax({
					            type : "post", dataType : "json", url : myAjax.ajaxurl,
					            data : { action : "rsgsrf_save_post_content", id_post:id_post,type_id:type_id,price_val:price_val,lvl_id:lvl_id,tbl_id:tbl_id },
					            success: function(res) {

					            	$('.rsgsrf_notif').fadeIn(function(){
				                        $(this).text('Price Updated').delay(1000).fadeOut();
				                    });
				                    console.log(res);
					            }
					        });

	                	});
	                
	            }
	        });
        }
	    
    }



    $(window).load(function(){
      
    });

}(jQuery));
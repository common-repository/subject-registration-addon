(function($) {

	if( $('body').find('.rsgsrf_reg_form').length !== 0 ){
		
		$('.rsgsrf_reg_form .rsgsrf_form_added_subjects table tbody tr td').append('<div class="rsgsrf_input_blocker">Click me to remove me.</div>');

		$('.rsgsrf_reg_form .rsgsrf_form_added_subjects > label').addClass('rsgsrf_reg_title').css('font-size','20px').css('font-weight','700');
		rsgsrf_recheck_subjects_added();
		function rsgsrf_recheck_subjects_added(){
			$('.rsgsrf_reg_form .rsgsrf_form_added_subjects').removeClass('something_happening');
        	if( $('.rsgsrf_reg_form .rsgsrf_form_added_subjects table tbody tr').length == 1 ){
        		if( $('.rsgsrf_form_added_subjects table tr:last-child input').val() == '' ){
        			$('.rsgsrf_reg_form .rsgsrf_form_added_subjects table tbody tr').css('visibility','hidden');
					$('.rsgsrf_reg_form .rsgsrf_form_added_subjects > label').text('No Subjects Added Yet').css('color','red');	
        		}else{
        			$('.rsgsrf_reg_form .rsgsrf_form_added_subjects > label').text('Subjects Added').css('color','#005ca0');
					$('.rsgsrf_reg_form .rsgsrf_form_added_subjects table tbody tr').css('visibility','visible');	
        		}
			}else{
				$('.rsgsrf_reg_form .rsgsrf_form_added_subjects > label').text('Subjects Added').css('color','#005ca0');
				$('.rsgsrf_reg_form .rsgsrf_form_added_subjects table tbody tr').css('visibility','visible');
			}
			$tr_ctr = 0;
			$('.rsgsrf_reg_form .rsgsrf_form_added_subjects table tbody tr').each(function(){
				$(this).attr('id','rem_id_'+$tr_ctr);

				if( $(this).find('td .rsgsrf_input_blocker').length == 0 ){
					$(this).find('td').append('<div class="rsgsrf_input_blocker" remove_id="'+$tr_ctr+'">Click me to remove me.</div>');
				}else{
					$(this).find('td .rsgsrf_input_blocker').attr('remove_id',$tr_ctr);
				}
				$tr_ctr++;
			});

        }
		// DISPLAY ALL SUBJECTS
		jQuery.ajax({
            type : "get", dataType : "json", url : myAjax.ajaxurl,
            data : { action : "rsgsrf_get_all_subjects_table"},
            success: function(res) {
            	if( $('.rsgsrf_form_type').find('.rsgsrf_subj_display').length === 0 ){
					$('.rsgsrf_form_subjects').append(res);
				}else{
					$('.rsgsrf_subj_display').remove();
					$('.rsgsrf_form_subjects').append(res);
				}

				// USER ADDS A SUBJECT - SHOWS MODAL
				$('.rsgsrf_client_add_subject').click(function(e){
		        	e.preventDefault();
		        	$('.rsgsrf__modal').fadeIn();
		        	$('.rsgsrf__modal input').val('');
		        	lvl_id = $(this).attr('lvl_id');
		        	tbl_id = $(this).attr('tbl_id');
		        	sub_id = $(this).attr('sub_id');
		        	$('.rsgsrf__modal').attr('lvl_id',lvl_id).attr('tbl_id',tbl_id).attr('sub_id',sub_id);
		        	$('.rsgsrf_add_hrs').slideUp();
		        	$('.rsfsrf_ptice_pinakatotal').hide().find('strong').text('');
		        	$('.rsgsrf__modal .save_btn_modal').show().attr('sub_title','').attr('sub_pri','');
		        });
		        // CANCEL ADD - REMOVES MODAL
		        $('.cancel_btn_modal').click(function(){
		        	$('.rsgsrf__modal').fadeOut();
		        	$('.rsgsrf__modal input').val('');
		        	$('.rsgsrf__modal').attr('lvl_id','').attr('tbl_id','').attr('sub_id','');
		        	$('.rsgsrf_add_hrs').slideUp();
		        	$('.rsfsrf_ptice_pinakatotal').hide().find('strong').text('');
		        	$('.rsgsrf__modal .save_btn_modal').show().attr('sub_title','').attr('sub_pri','');
		        });

		        // SELECTS TUTOR TYPE
		        $('.rsgsrf_select_type input#rsgsrf__modal_type').click(function(){
                	him = $(this);
                	him.attr('disabled','disable');
                	$('.rsgsrf_select_type .rsgsrf_type__content').slideDown();
                	$('.rsgsrf_select_type .rsgsrf_type__content span').click(function(){
                		type_id = $(this).attr('type_id');
                		him.val( $(this).attr('data') ).removeAttr('disabled').attr('type_id',type_id);
                		$('.rsgsrf_select_type .rsgsrf_type__content').slideUp();
                		$('.rsgsrf_pre_loader').show();
                		get_lvl_id = $('.rsgsrf__modal').attr('lvl_id');
                		get_tbl_id = $('.rsgsrf__modal').attr('tbl_id');
                		get_sub_id = $('.rsgsrf__modal').attr('sub_id');
                		

                		// DISPLAYS NUMBER OF HOURS
                		jQuery.ajax({
				            type : "post", dataType : "json", url : myAjax.ajaxurl,
				            data : { 
				            	action : "rsgsrf_get_added_subject_price",
				            	type_id : type_id,
				            	lvl_id : get_lvl_id,
				            	tbl_id : get_tbl_id,
				            	sub_id : get_sub_id
				            },
				            success: function(res) {
				            	
				            	
				            	if( res['pri'] == '0' ){
				            		$('.rsgsrf_total_single').text('Subject unavailable for this tutoring type.');	
				            		$('.rsfsrf_ptice_pinakatotal').show();
				            		$('.rsfsrf_ptice_pinakatotal p > strong').text('Subject unavailable for this tutoring type.');
				            		$('.rsgsrf__modal .save_btn_modal').hide();
				            	}else{
				            		$('.rsgsrf_add_hrs').slideDown();
				            		$('.rsgsrf_total_single').text('Subject Price: $'+res['pri']+'/hr');
				            		$('.rsgsrf_add_hrs input#rsgsrf__modal_hrs').attr('t_price',res['pri']).val('');
					            	$('.rsfsrf_ptice_pinakatotal p > strong').text('$'+parseFloat(res['pri']));
					            	$('.rsfsrf_ptice_pinakatotal').show();
					            	$('.rsgsrf__modal .save_btn_modal').show().attr('sub_title',res['title']).attr('sub_type',res['type']).attr('sub_tbl',res['tbl']).attr('sub_lvl',res['lvl']);
				            	}
				            	

				            	$('.rsgsrf_pre_loader').hide();
				            	
				            }
				        });
                	});
                });
                // ADD NUMBER OF HOURS
                $('.rsgsrf_add_hrs input#rsgsrf__modal_hrs').keyup(function(){
                	t_price 	= $(this).attr('t_price').replace(' ','');
                	price_na 	= $('.rsgsrf_reg_form .rsgsrf_price_holder').attr('pinaka_total');
                	price_i 	= $('.rsgsrf_reg_form .rsgsrf_price_holder').attr('initial_total');
                	chosen_hrs 	= $(this).val().replace(' ','');
                	total 		= parseFloat(t_price) * parseFloat(chosen_hrs);
                	if( chosen_hrs == 0 ){
                		$('.rsfsrf_ptice_pinakatotal p > strong').text('$0.00');
                	}else{
                		$('.rsfsrf_ptice_pinakatotal p > strong').text('$'+parseFloat(total));
                		price_na = parseFloat(price_na) + parseFloat(total);
                	}
                	$('.rsgsrf_reg_form .rsgsrf_price_holder').attr('initial_total',price_na);
                	$('.rsgsrf__modal .save_btn_modal').attr('sub_pri',total).attr('chosen_hrs',chosen_hrs);
                });
                // SAVE CHANGES
                $('.rsgsrf__modal .save_btn_modal').click(function(){
                	sub_name = $(this).attr('sub_title');
                	sub_pri  = $(this).attr('sub_pri');

                	sub_type = $(this).attr('sub_type');
                	sub_tbl  = $(this).attr('sub_tbl');
                	sub_lvl = $(this).attr('sub_lvl');
                	chosen_hrs = $(this).attr('chosen_hrs');

                	if( $('.rsgsrf_add_hrs input#rsgsrf__modal_hrs').val() == 0 ){
                		$('.rsgsrf_notif').fadeIn(function(){
	                        $(this).text('Please add hours to enrol').delay(1000).fadeOut();
	                    });
                		return false;
                	}

                	price_i 	= $('.rsgsrf_reg_form .rsgsrf_price_holder').attr('initial_total');
                	$('.rsgsrf_reg_form .rsgsrf_price_holder').attr('pinaka_total',price_i);
                	val = '$'+price_i;
                	$('.rsgsrf_form_price input').val(val);
                	$('.rsgsrf_reg_form .rsgsrf_price_holder strong').text(price_i);

                	$('.cancel_btn_modal').click();

                	in_val = sub_tbl+' || '+sub_name+' ('+sub_type+') || Hours:'+chosen_hrs+'hrs || Subject Total: $'+sub_pri;

                	$('.rsgsrf_reg_form .rsgsrf_form_added_subjects table tr:last-child td.gfield_list_cell input').val(in_val).attr('sub_pri',sub_pri).attr('value',in_val).attr('sub_nem',sub_name);
                	$('.rsgsrf_reg_form .rsgsrf_form_added_subjects').addClass('something_happening');
                	$('.rsgsrf_reg_form .rsgsrf_form_added_subjects table tr:last-child td.gfield_list_icons .add_list_item').click();
                	
                	rsgsrf_recheck_subjects_added();
                });
            }
        });
	
		$('.rsgsrf_reg_form .rsgsrf_input_blocker').click(function(){
			remove_id 	= $(this).attr('remove_id');
			tr_con 		= $('.rsgsrf_reg_form .rsgsrf_form_added_subjects table tbody tr#rem_id_'+remove_id);
			sub_pri 	= tr_con.find('input').attr('sub_pri');
			sub_pri 	= parseFloat(sub_pri);
			price_total = $('.rsgsrf_reg_form .rsgsrf_price_holder').attr('pinaka_total');
			price_total = parseFloat(price_total);
			price_total = price_total - sub_pri;

        	$('.rsgsrf_reg_form .rsgsrf_price_holder').attr('pinaka_total',price_total);
        	val = '$'+price_total;
        	$('.rsgsrf_reg_form .rsgsrf_price_holder strong').text(price_total);

			
			tr_con.find('.gfield_list_icons .delete_list_item').click();
			rsgsrf_recheck_subjects_added();

		});

	}
}(jQuery));
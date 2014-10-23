/*
 * @brief:	Enable Random, Custom radio button and include_num_size list when
 * 			include_num_checkbox is checked 
 * 			(enable include_num_custom_value list if custom radio is checked) 
 * 			and otherwise
 * @params:	incl_num_checkbox 	checkbox input object
 * @return:	none
 */
function incl_num_chbox_hdl(incl_num_checkbox){
	if (incl_num_checkbox.prop('checked') == true){
		$('[name="incl_num_type"]').attr("disabled", false);
		$('[name="incl_num_size"]').attr("disabled", false);
		if ($('[name="incl_num_type"]:checked').val() == "c"){
			$('[name="incl_num_cus_val"]').attr("disabled", false);
		} 				
	}
	else{
		$('[name="incl_num_type"]').attr("disabled", true);
		$('[name="incl_num_cus_val"]').attr("disabled", true);
		$('[name="incl_num_size"]').attr("disabled", true);		
		$('[name="incl_num_type"]').emtry()
		$('[name="incl_num_cus_val"]').empty();
		$('[name="incl_num_size"]').empty();	
	}
}
/*
 * @brief: Enable include_num_size list when custom radio is checked
 * @params: incl_cus_num_radio 	radio input object
 * @return:	none 
 */
function incl_num_type_hdl(incl_cus_num_radio){
	if (incl_cus_num_radio.prop('value') == "c"){
		$('[name="incl_num_cus_val"]').attr("disabled", false);
	}
	else{
		$('[name="incl_num_cus_val"]').attr("disabled", true);
	}
}
/*
 * @brief:	Enable Random, Custom radio button and include_ss_size list when
 * 			include_ss_checkbox is checked 
 * 			(enable include_ss_custom_value list if custom radio is checked) 
 * 			and otherwise
 * @params:	incl_ss_checkbox 	checkbox input object
 * @return:	none
 */
function incl_ss_chbox_hdl(incl_ss_checkbox){
	if (incl_ss_checkbox.prop('checked') == true){
		$('[name="incl_ss_type"]').attr("disabled", false);
		$('[name="incl_ss_size"]').attr("disabled", false);
		if ($('[name="incl_ss_type"]:checked').val() == "c"){
			$('[name="incl_ss_cus_val"]').attr("disabled", false);
		} 				
	}
	else{
		$('[name="incl_ss_type"]').attr("disabled", true);
		$('[name="incl_ss_cus_val"]').attr("disabled", true);
		$('[name="incl_ss_size"]').attr("disabled", true);		
	}	
}
/*
 * @brief: Enable include_ss_size list when custom radio is checked
 * @params: incl_cus_ss_radio 	radio input object
 * @return:	none 
 */
function incl_ss_type_hdl(incl_cus_ss_radio){
	if (incl_cus_ss_radio.prop('value') == "c"){
		$('[name="incl_ss_cus_val"]').attr("disabled", false);
	}
	else{
		$('[name="incl_ss_cus_val"]').attr("disabled", true);
	}
}
/*
 * 
 */
function gen_button_hdl(){
	var num_word = $('[name="num_word"]').val();
	var max_length = $('[name="max_length"]').val();
	var incl_num = $('[name="incl_num_check"]').prop("checked");
	var incl_num_type = $('[name="incl_num_type"]:checked').val();
	var incl_num_size = $('[name="incl_num_size"]').val();
	var incl_num_cus_val = $('[name="incl_num_cus_val"]').val();
	var incl_ss = $('[name="incl_ss_check"]').prop("checked");
	var incl_ss_type = $('[name="incl_ss_type"]:checked').val();
	var incl_ss_size = $('[name="incl_ss_size"]').val();
	var incl_ss_cus_val = $('[name="incl_ss_cus_val"]').val();
	var separation_type = $('[name="sepa_type"]:checked').val();
	var case_tfm_type = $('[name="case_tfm_type"]:checked').val();
	var _token = $('input[name=_token]').val();
	/* Refer from http://api.jquery.com/jquery.ajax/ */
	var request = $.ajax({
  		url: "pass-generator",
  		type: "POST",
  		data: { 
  			num_word: num_word,
  			max_length: max_length,
  			incl_num: incl_num,
  			incl_num_type: incl_num_type,
  			incl_num_size: incl_num_size,
  			incl_num_val : incl_num_cus_val,
  			incl_ss_val : incl_ss_cus_val,
  			incl_ss: incl_ss,
  			incl_ss_type: incl_ss_type,
  			incl_ss_size: incl_ss_size,
  			separation_type: separation_type,
  			case_tfm_type: case_tfm_type,
  			token: _token		 
  		},
  		dataType: "text"
	});
	request.done(function(msg) {
		var data = JSON.parse(msg);
		if (data['msg']) {
			$('#alert p').html(data['msg']);
			$('#alert').show();
			$("#pass_display").val('');
		} else {
  			$("#pass_display").val(data);
  		}
	});
	request.fail(function( jqXHR, textStatus ) {
		$('#alert p').html("Request failed: " + textStatus);
		$('#alert').show();
		$("#pass_display").val('');
	});
}

$('document').ready(function() {
	$('#incl_num_check').click(function(){
		incl_num_chbox_hdl($(this));
	});
	$('#incl_ss_check').click(function(){
		incl_ss_chbox_hdl($(this));
	});
	$('[name="incl_num_type"]').click(function(){
		incl_num_type_hdl($(this));
	});
	$('[name="incl_ss_type"]').click(function(){
		incl_ss_type_hdl($(this));
	});
	$('#btn-submit').click(function(){
		gen_button_hdl();
		return false;
	});
});
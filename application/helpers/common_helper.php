<?php

function get_purpose($listing) {
	
	if ($listing['property_type_purpose']) {
		$listing['property_type_purpose'] = explode(',', $listing['property_type_purpose']);
		foreach ($listing['property_type_purpose'] as $purpose) {
			$purpose = explode('=', $purpose);
			if ($listing['purpose'] == $purpose[0]) {
				$listing['purpose'] = $purpose[1];
			}
		}
	}
	return $listing['purpose'];
}

function property_title($property) {

	return $property['property_type_name'].' for '.get_purpose($property).' at '.$property['locality'].' in '.$property['location'];
}

function requirement_title($requirement, $more=false) {

	return 'Looking to '.get_purpose($requirement).' '.$requirement['property_type_article'].' '.$requirement['property_type_name'].($more ? ' in '.$requirement['location'].' ('.$requirement['localities'].')' : '');
}

function property_listing_id($id) {
	
	return 'ZMP'.$id;
}

function requirement_listing_id($id) {

	return 'ZMR'.$id;
}

function pretty_url($title, $id) {
	
	$ci = & get_instance();
	return $ci->encrypter->encode($id).'/'.url_title($title);
}

function generateRandomString($length) {

	$valueCheck = 99999999;            
	$length = ($length<0)?-$length:$length;
	$length = ($length==0)?rand(0,$valueCheck):$length;
	$length = ($length>$valueCheck)?rand(0,$valueCheck):$length;
	$randString = "";
	srand();
	$characters = "abcdefghijklmnopqrstuvwxyz1234567890";

	while (strlen($randString) < $length) {
		$randString .= substr($characters, rand() % (strlen($characters)),1 );
	}
    return $randString;
}

function log_action($action, $data='', $user_id='') {

	$ci = & get_instance();
	
	$user_id = $user_id ? $user_id : $ci->tank_auth->get_user_id();
	
	$array = array(
		'user_id'		=> 	$user_id,
		'time'			=> 	time(),
		'ip'			=> 	$ci->input->ip_address(),
		'user_agent'	=>	$ci->input->user_agent(),
		'action'		=> 	$action,
		'data'			=> 	$data,
	);
	$ci->log_model->create_log($array);
}

function filter_array($array, $index, $value) { 
	if (is_array($array) && count($array)>0)  { 
		foreach (array_keys($array) as $key) { 
			$temp[$key] = $array[$key][$index]; 

			if ($temp[$key] == $value) { 
				$newarray[$key] = $array[$key]; 
			} 
		} 
	} 
	return $newarray; 
} 

function form_field($type, $args=array()) {

	$output  = '';
	$output .= '<div class="rowElem'.(isset($args['class']) ? ' '.$args['class'] : '').' '.$type.'">';
	$output .= isset($args['label']) ? '<label>'.$args['label'].':'.(isset($args['req']) ? '<span class="req">*</span>' : '').'</label>' : '';
	$output .= '<div class="formRight'.($type=='date_range'||$type=='mobile' ? ' moreFields' : '').'">';
	
	switch($type) {
		case 'checkbox':		$output .= form_input_checkbox($args);
								break;
		case 'select':			$output .= form_select_dropdown($args);
								break;
		case 'select_other':	$output .= form_select_dropdown_other($args);
								break;								
		case 'password':		$output .= form_input_password($args);
								break;
		case 'file':			$output .= form_input_file($args);
								break;
		case 'textarea':		$output .= form_input_textarea($args);
								break;
		case 'radio_group':		$output .= form_radio_group($args);
								break;
		case 'checkbox_group':	$output .= form_checkbox_group($args);
								break;
		case 'mobile':			$output .= form_input_mobile($args);
								break;
		case 'city':			$output .= form_input_city($args);
								break;
		case 'date':			$output .= form_input_date($args);
								break;
		case 'date_range':		$output .= form_input_date_range($args);
								break;
		case 'number':			$output .= form_input_number($args);
								break;						
		default:				$output .= form_input_text($args);				
								break;
	}
	
	$output .= '</div><div class="fix"></div></div>'."\r\n";
	
	return $output;
}

function form_input_text($args=array()) {
		
	$input = array();
	$input['name'] = $args['name'];
	$input['id'] = (isset($args['input_id'])) ? $args['input_id'] : $args['name'];
	$input['value'] = isset($_REQUEST[$args['name']]) ? $_REQUEST[$args['name']] : (isset($args['value']) ? $args['value'] : '');
	if (isset($args['input_class'])) $input['class'] = $args['input_class'];
	if (isset($args['placeholder'])) $input['placeholder'] = $args['placeholder'];
	if (isset($args['data-holder'])) $input['data-holder'] = $args['data-holder'];
	if (isset($args['data-source'])) $input['data-source'] = $args['data-source'];
	if (isset($args['data-sink'])) $input['data-sink'] = $args['data-sink'];
	if (isset($args['maxlength'])) $input['maxlength'] = $args['maxlength'];
	if (isset($args['data-min'])) $input['data-min'] = $args['data-min'];
	if (isset($args['data-max'])) $input['data-max'] = $args['data-max'];
	if (isset($args['readonly']) && $args['readonly'] === TRUE) $input['readonly'] = 'readonly';
	if (isset($args['disabled']) && $args['disabled'] === TRUE) $input['disabled'] = 'disabled';
	
	return form_input($input);
}

function form_input_number($args=array()) {
		
	$input = array();
	$input['name'] = $args['name'];
	$input['id'] = (isset($args['input_id'])) ? $args['input_id'] : $args['name'];
	$input['value'] = isset($_REQUEST[$args['name']]) ? $_REQUEST[$args['name']] : (isset($args['value']) ? $args['value'] : '');
	if (isset($args['input_class'])) $input['class'] = $args['input_class'];
	if (isset($args['readonly']) && $args['readonly'] === TRUE) $input['readonly'] = 'readonly';
	if (isset($args['disabled']) && $args['disabled'] === TRUE) $input['disabled'] = 'disabled';
	$input['type'] = 'tel';
	
	return form_input($input);
}

function form_input_date($args=array()) {
		
	$input = array();
	$input['name'] = $args['name'];
	$input['id'] = (isset($args['input_id'])) ? $args['input_id'] : $args['name'];
	$input['value'] = isset($_REQUEST[$args['name']]) ? $_REQUEST[$args['name']] : (isset($args['value']) ? $args['value'] : '');
	$input['class'] = 'datepicker';
	
	return form_input($input);
}

function form_input_date_range($args=array()) {
		
	$output  = '<ul class="rowData"><li style="width:20%;">';
	
	$input = array();
//	$input['readonly'] = true;
	$input['maxlength'] = 7;
	$input['name'] = $args['name'].'_from';
	$input['id'] = $input['name'];
	$input['value'] = isset($_REQUEST[$input['name']]) ? $_REQUEST[$input['name']] : (isset($args['value']['from']) ? $args['value']['from'] : '');
	$input['class'] = 'datepicker_from';	
	$output .= form_input($input);
	$output .= '</li><li class="sep">-</li><li style="width:20%;">';
	
	$input['name'] = $args['name'].'_to';
	$input['id'] = $input['name'];
	$input['value'] = isset($_REQUEST[$input['name']]) ? $_REQUEST[$input['name']] : (isset($args['value']['to']) ? $args['value']['to'] : '');
	$input['class'] = 'datepicker_to';
	$output .= form_input($input);
	$output .= '</li></ul>';
	
	return $output;
}

function form_input_textarea($args=array()) {

	$input = array();
	$input['name'] = $args['name'];
	$input['id'] = (isset($args['input_id'])) ? $args['input_id'] : $args['name'];
	$input['value'] = isset($_REQUEST[$args['name']]) ? $_REQUEST[$args['name']] : (isset($args['value']) ? $args['value'] : '');
	$input['class'] = (isset($args['input_class'])) ? $args['input_class'] : 'auto';
	if (isset($args['placeholder'])) $input['placeholder'] = $args['placeholder'];
	if (isset($args['rows'])) $input['rows'] = $args['rows'];
	if (isset($args['cols'])) $input['cols'] = $args['cols'];
	
	return form_textarea($input);
}

function form_input_password($args=array()) {
		
	$input = array();
	$input['name'] = $args['name'];
	$input['id'] = (isset($args['input_id'])) ? $args['input_id'] : $args['name'];
	$input['value'] = isset($_REQUEST[$args['name']]) ? $_REQUEST[$args['name']] : (isset($args['value']) ? $args['value'] : '');
	if (isset($args['input_class'])) $input['class'] = $args['input_class'];
	if (isset($args['placeholder'])) $input['placeholder'] = $args['placeholder'];
	
	return form_password($input);
}

function form_input_captcha($args=array()) {
	
	$output  = img(base_url().'auth/new_captcha/'.md5(uniqid()));
	$output .= form_input_text($args);
	return $output;
}

function form_input_checkbox($args=array()) {

	$output = '';
	$input = array();
	$input['name'] = $args['name'];
	$input['id'] = (isset($args['input_id'])) ? $args['input_id'] : $args['name'];
	$input['value'] = $args['default'];
	$input['checked'] = isset($_REQUEST[$args['name']]) ? ($_REQUEST[$args['name']] == $args['default'] ? TRUE : FALSE) : (isset($args['value']) ? ($args['value'] == $args['default'] ? TRUE : FALSE) : '');

	$output .= form_checkbox($input);
	$output .= isset($args['label']) ? '<label for="'.$input['id'].'">'.$args['label'].(isset($args['req']) ? ' <span class="req">*</span>' : '').'</label>' : '';
	return $output;
}

function form_checkbox_group($args=array()) {

	$input = array();
	$input['name'] = $args['name'].'[]';
	
	$output = '';
	$i = 1;
	foreach ($args['options'] as $value) {
		$input['value'] = $value;
		$input['id'] = $args['name'].'_'.$i;
		$input['checked'] = isset($_REQUEST[$args['name']]) ? (in_array($value, $_REQUEST[$args['name']]) ? TRUE : FALSE) : (isset($args['value']) ? (in_array($value, $args['value']) ? TRUE : FALSE) : '');
		$output .= '<div class="checkbox">';
		$output .= form_checkbox($input);
		$output .= '<label for="'.$args['name'].'_'.$i.'">'.$value.'</label>';
		$output .= '</div>';
		$i++;
	}	

	return $output;
}

function form_select_dropdown($args=array()) {

	$value = isset($_REQUEST[$args['name']]) ? $_REQUEST[$args['name']] : (isset($args['value']) ? $args['value'] : '');
	$attributes = '';
	$input['id'] = (isset($args['input_id'])) ? $args['input_id'] : $args['name'];
	if (isset($args['input_class'])) $attributes .= ' class="'.$args['input_class'].'"';
	if (isset($args['onchange'])) $attributes .= ' onchange="'.$args['onchange'].'"';
	if (isset($args['style'])) $attributes .= ' style="'.$args['style'].'"';
	if (isset($args['readonly']) && $args['readonly'] === TRUE) $attributes .= ' disabled="disabled"';
	if (isset($args['first'])) $args['options'] = array('0'=>$args['first']) + $args['options'];

	return form_dropdown($args['name'], $args['options'], $value, $attributes);		
}

function form_select_dropdown_other($args=array()) {

	$output = '';
	$args['options'] = $args['options'] + array('-1'=>'Other');
	$args['input_class'] = $args['input_class'] ? $args['input_class'].' select_other' : null;
	$output .= form_select_dropdown($args);
	
	$args['name'] = $args['name'].'_other';
	$args['input_class'] = 'text_other';
	$output .= form_input_text($args);
	
	return $output;
}

function form_radio_group($args=array()) {

	$input = array();
	$input['name'] = $args['name'];
	
	$output = '';
	$i = 1;
	foreach ($args['options'] as $option=>$value) {
		$input['value'] = $option;
		$input['id'] = $input['name'].'_'.$i;
		if (isset($args['readonly']) && $args['readonly'] === TRUE) $input['disabled'] = 'disabled';
		$input['checked'] = (isset($_REQUEST[$args['name']])) ? ($option == $_REQUEST[$args['name']] ? TRUE : FALSE) : ((isset($args['value'])) ? ($option == $args['value'] ? TRUE : FALSE) : '');
		$output .= form_radio($input);
		$output .= '<label for="'.$input['name'].'_'.$i.'">'.$value.'</label>';
		$i++;
	}	

	return $output;
}

function form_input_file($args=array()) {
	
	return '<input type="file" class="fileInput" name="'.$args['name'].'" />';
}

function form_input_mobile($args=array()) {
		
	$cc_value = isset($_REQUEST[$args['cc_name']]) ? $_REQUEST[$args['cc_name']] : (isset($args['cc_value']) ? $args['cc_value'] : '');
	$value = isset($_REQUEST[$args['name']]) ? $_REQUEST[$args['name']] : (isset($args['value']) ? $args['value'] : '');
	
	$cc_input = array('name'=>$args['cc_name'], 'value'=>$cc_value, 'maxlength'=>3);
	$mobile_input = array('name'=>$args['name'], 'value'=>$value, 'maxlength'=>15);
	
	if (isset($args['readonly'])) {
		$cc_input['readonly'] = true;
		$mobile_input['readonly'] = true;
	}
	
	$output  = '<ul class="rowData"><li class="sep">+</li><li>';
	$output .= form_input($cc_input);
	$output .= '</li><li><li class="sep">-</li><li style="width:40%;">';
	$output .= form_input($mobile_input);
	$output .= '</li></ul>';
		
	return $output;
}

function form_input_city($args=array()) {
		
	$input = array();
	$input['name'] = $args['name'];
	if (isset($args['id'])) $input['id'] = $args['id'];
	$input['value'] = isset($_REQUEST[$args['name']]) ? $_REQUEST[$args['name']] : (isset($args['value']) ? $args['value'] : '');
	$input['class'] = 'city-selector'.(isset($args['input_class']) ? ' '.$args['input_class'] : '');
	if (isset($args['placeholder'])) $input['placeholder'] = $args['placeholder'];
	if (isset($args['readonly']) && $args['readonly'] === TRUE) $input['readonly'] = 'readonly';
	
	return form_input($input);
}


function submit_btn() {

	return '<div class="submitForm"><input type="submit" value="submit" name="submit" class="redBtn" /></div><div class="fix"></div>'."\r\n";
}
function edit_btn() {

	return '<div class="submitForm"><input type="submit" value="Update" name="update" class="redBtn" /></div><div class="fix"></div>'."\r\n";
}

function update_btn($url) {

	return anchor($url, img(array('src' => 'static/images/icons/dark/pencil.png', 'class' => 'mr10')), array('title' => 'Edit'));
}

function delete_btn($url) {

	return anchor($url, img(array('src' => 'static/images/icons/dark/trash.png', 'class' => 'mr10')), array('title' => 'Remove', 'onclick' => 'return confirm(\'Are you sure?\')'));
}

function add_btn($url)
{
	return anchor($url, img(array('src' => 'static/images/icons/dark/add.png', 'class' => 'mr10')), array('title' => 'Add question'));
}
function watch_btn($url)
{
	return anchor($url, img(array('src' => 'static/images/icons/dark/eye.png', 'class' => 'mr10')), array('title' => 'Watch questions'));
}

function undelete_btn($url) {

	return anchor($url, img(array('src' => 'static/images/icons/dark/check.png', 'class' => 'mr10')), array('title' => 'Undo Remove', 'onclick' => 'return confirm(\'Are you sure?\')'));
}

function maybe_unserialize( $original ) {

	if ( is_serialized( $original ) )
		return @unserialize( $original );
	return $original;
}

function is_serialized( $data, $strict = true ) {

	if ( ! is_string( $data ) )
		return false;
	$data = trim( $data );
 	if ( 'N;' == $data )
		return true;
	$length = strlen( $data );
	if ( $length < 4 )
		return false;
	if ( ':' !== $data[1] )
		return false;
	if ( $strict ) {
		$lastc = $data[ $length - 1 ];
		if ( ';' !== $lastc && '}' !== $lastc )
			return false;
	} else {
		$semicolon = strpos( $data, ';' );
		$brace     = strpos( $data, '}' );
		if ( false === $semicolon && false === $brace )
			return false;
		if ( false !== $semicolon && $semicolon < 3 )
			return false;
		if ( false !== $brace && $brace < 4 )
			return false;
	}
	$token = $data[0];
	switch ( $token ) {
		case 's' :
			if ( $strict ) {
				if ( '"' !== $data[ $length - 2 ] )
					return false;
			} elseif ( false === strpos( $data, '"' ) ) {
				return false;
			}
		case 'a' :
		case 'O' :
			return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
		case 'b' :
		case 'i' :
		case 'd' :
			$end = $strict ? '$' : '';
			return (bool) preg_match( "/^{$token}:[0-9.E-]+;$end/", $data );
	}
	return false;
}

function is_serialized_string( $data ) {

	if ( !is_string( $data ) )
		return false;
	$data = trim( $data );
	$length = strlen( $data );
	if ( $length < 4 )
		return false;
	elseif ( ':' !== $data[1] )
		return false;
	elseif ( ';' !== $data[$length-1] )
		return false;
	elseif ( $data[0] !== 's' )
		return false;
	elseif ( '"' !== $data[$length-2] )
		return false;
	else
		return true;
}

function maybe_serialize( $data ) {

	if ( is_array( $data ) || is_object( $data ) )
		return serialize( $data );

	if ( is_serialized( $data, false ) )
		return serialize( $data );

	return $data;
}

if ( ! function_exists('field_enums'))
{
    function field_enums($table = '', $field = '')
    {
        $enums = array();
        if ($table == '' || $field == '') return $enums;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value) {
            $enums[$value] = $value; 
        }
        return $enums;
    }  
}

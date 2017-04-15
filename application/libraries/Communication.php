<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//edit credentials
class Communication {

	function __construct() {
		$this->ci =& get_instance();
		
	}
	
	function send_email($type, $email, &$data) {
		
		$email = (ENVIRONMENT=='production') ? $email : 'shashank.d96@gmail.com';

		$data['site_name'] = $this->ci->config->item('website_name', 'tank_auth');
		
		$subject = sprintf($this->ci->lang->line('auth_subject_'.$type), $data['site_name']);
		$subject = $subject ? $subject : $data['subject'];
		
		$this->ci->load->library('email');
		$this->ci->email->from($this->ci->config->item('webmaster_email', 'tank_auth'), $data['site_name']);
		$this->ci->email->reply_to($this->ci->config->item('webmaster_email', 'tank_auth'), $data['site_name']);
		$this->ci->email->to($email);
		$this->ci->email->subject($subject);
		$this->ci->email->message($this->ci->load->view('email/'.$type, $data, TRUE));
		$this->ci->email->send();
	}
	
	function send_admin_email($type, &$data) {
		
		if (ENVIRONMENT=='production') {
			$email = 'shashank.d96@gmail.com';
			//$cc = 'deepshikha2349@gmail.com';
		} else {
			$email = 'shashank.d96@gmail.com';
		}

		$data['site_name'] = $this->ci->config->item('website_name', 'tank_auth');
		
		$subject = sprintf($this->ci->lang->line('auth_subject_'.$type), $data['site_name']);
		$subject = $subject ? $subject : $data['subject'];
		
		$this->ci->load->library('email');
		$this->ci->email->from($this->ci->config->item('webmaster_email', 'tank_auth'), $data['site_name']);
		$this->ci->email->reply_to($this->ci->config->item('webmaster_email', 'tank_auth'), $data['site_name']);
		$this->ci->email->to($email);
		if (isset($cc)) $this->ci->email->cc($cc);
		$this->ci->email->subject($subject);
		$this->ci->email->message($this->ci->load->view('email/'.$type, $data, TRUE));
		$this->ci->email->send();
	}
	
	function send_sms($msgtxt, $phone, $type='promotional', $data=array()) {
	
		$phone = (ENVIRONMENT=='production') ? $phone : '9955626469';
		$msgtxt = urlencode($msgtxt);

		if ($type == 'promotional') {
			$ch = curl_init();
			//$user = "sms_api_user";
			$receipientno = $phone;
			curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=TEST SMS&receipientno=$receipientno&msgtxt=$msgtxt&state=3");
			if(!$result = curl_exec($ch)) { 				
				log_action('SMS Delivery Error: '.curl_error($ch));
			}
			curl_close($ch);		
		}
		
		if ($msgtxt && $type == 'transactional') {
			
			if ($msgtxt=='validate') {
				$msgtxt = '';
			}
		
			$ch = curl_init();
			$user = 'user_id';
			$senderID = "IEEE"; 
			curl_setopt($ch, CURLOPT_URL, 'http://api.mVaayoo.com/mvaayooapi/MessageCompose');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'user='.$user.'&senderID='.$senderID.'&receipientno='.$phone.'&msgtxt='.$msgtxt);
			if(!$result = curl_exec($ch)) { 				
				log_action('SMS Delivery Error: '.curl_error($ch));
			}
			curl_close($ch);
		}
	}
}
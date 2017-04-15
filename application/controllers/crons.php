<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crons extends CI_Controller {

	var $data = array();

	function __construct() {
		parent::__construct();

	//	$this->load->library('Cron');
	}
	
	function index() {
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('auth/login/');
		}		
		if (!$this->tank_auth->is_admin()) {
			redirect('');
		}

	}
	
	function send_task_notifications() {
			echo "Edit: Controller Crons";
	}	
}

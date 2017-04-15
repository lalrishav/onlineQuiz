<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends CI_Controller {

	var $data = array();

	function __construct() {
		parent::__construct();

		$this->data['page_title'] = 'Notifications';
		$this->data['page'] = 'notifications';	
		
		$this->load->model('menu');		

		$this->data['message'] = $this->session->flashdata('message');
		$this->data['warning'] = $this->session->flashdata('warning');

		$this->data['user_id'] = $this->tank_auth->get_user_id();

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
	}
	
	function index() {
	
	//	$this->data['notifications'] = $this->notification_model->get(array('multiple'=>1, 'receiver_user_id'=>$this->data['user_id']));
	//	$this->notification_model->mark_all_as_read($this->data['user_id']);
	echo "Edit: Controller- Notifications/index";
		$this->load->view('template/header', $this->data);
		$this->load->view('notifications/index');
		$this->load->view('template/footer');		
	}
	
	function sent() {
	
		$this->data['page'] = 'messages';	
	//	$this->data['notifications'] = $this->notification_model->get(array('multiple'=>1, 'sender_user_id'=>$this->data['user_id']));
	echo "Edit: Controller- Notifications/sent";
		
		$this->load->view('template/header', $this->data);
		$this->load->view('notifications/sent');
		$this->load->view('template/footer');		
	}
}
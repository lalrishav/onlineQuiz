<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {

	var $data = array();

	function __construct() {
		parent::__construct();

		$this->data['page_title'] = 'Feedback';
		$this->data['page'] = 'Feedback';	
		
		$this->load->model('menu');		

		$this->data['message'] = $this->session->flashdata('message');
		$this->data['warning'] = $this->session->flashdata('warning');

		$this->data['user_id'] = $this->tank_auth->get_user_id();

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
	}
	function index()
	{
		$this->load->model('data_model');
		$this->data['rating']=$this->data_model->rating;
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->view('template/header', $this->data);
		$this->load->view('feedback',$this->data);
		$this->load->view('template/footer');	
	}
}
	?>
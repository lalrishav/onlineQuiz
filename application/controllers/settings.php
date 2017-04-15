<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->data['page'] = 'settings';	
		$this->data['page_title'] = 'Settings';
		
		$this->load->model('menu');		

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}		
		if (!$this->tank_auth->is_admin()) {
			redirect('');
		}
	}

	public function index()	{
		
		if (!$this->tank_auth->is_privileged('view_settings')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['message'] = $this->session->flashdata('message');
		
		$this->data['settings'] = $this->options->get_settings();

		$this->load->helper('form');
		
		echo "Edit: Controller-settings";
		die("Check settings:35");
		$this->load->view('template/header', $this->data);	
		$this->load->view('settings');
		$this->load->view('template/footer');		
	}
	
	public function update() {
		die("Check settings:42");
		$this->data_model->update_settings();
		redirect('settings', 'refresh');
	}
}


<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	var $data = array();
	
	function __construct() {
		parent::__construct();
		
		$this->data['page'] = 'account';	
		$this->data['page_title'] = 'My Account';
		
		$this->load->model('menu');		

		$this->data['message'] = $this->session->flashdata('message');
		$this->data['warning'] = $this->session->flashdata('warning');

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}		
		$this->data['user_id'] = $this->tank_auth->get_user_id();

		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	function index()	{
		
		$this->update();
	}
	
	function update() {
				
		$this->data['user'] = $this->user_model->get(array('id'=>$this->data['user_id']));

		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('mobile', 'Mobile No.', 'trim|required|xss_clean|numeric|exact_length[10]');
		
		if ($this->form_validation->run() === TRUE) {
			$data = array(
				'firstname'	=> $this->input->post('firstname'),
				'lastname'	=> $this->input->post('lastname'),
			);
			$profile = array(
				'mobile' => $this->input->post('mobile'),
			);			
			$meta = array();			
			$this->user_model->update_user($this->data['user_id'], $data, $profile, $meta);			
			$this->tank_auth->set_session($this->user_model->get(array('id'=>$this->data['user_id'], 'return'=>'object')));					
			$this->session->set_flashdata('message', 'Account updated.');	
		}
			
		$this->load->view('template/header', $this->data);	
		$this->load->view('account');
		$this->load->view('template/footer');
	}
		
	function change_password() {
				
		if($this->input->post('new_password')) {
			$this->form_validation->set_rules('old_password', 'old password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'new password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('confirm_new_password', 'confirm new password', 'trim|required|xss_clean|matches[new_password]');
				
			if ($this->form_validation->run() === TRUE) {		
				if ($this->tank_auth->change_password($this->form_validation->set_value('old_password'), $this->form_validation->set_value('new_password'))) {
					$this->session->set_flashdata('message', $this->lang->line('auth_message_password_changed'));
					$user = $this->user_model->get(array('id'=>$this->data['user_id']));
					$data = array(
								'user_id'		=> $this->data['user_id'],
								'name'			=> $user['firstname'],
								'email'			=> $user['email']
							);
				//	$this->communication->send_email('reset_password', $data['email'], $data);
					log_action('update_password');				
				} else {
					$this->session->set_flashdata('warning', 'Incorrect Password');
				}
			} else {
				$error = form_error('old_password', '', '') ? strip_tags(form_error('old_password')) : '';
				$error = form_error('new_password', '', '') ? strip_tags(form_error('new_password')) : $error;
				$error = form_error('confirm_new_password', '', '') ? strip_tags(form_error('confirm_new_password')) : $error;
				if ($error) $this->session->set_flashdata('warning', $error);				
			}
		}		
		redirect('account', 'refresh');	
	}
	
	function address() {
				
		$this->data['user'] = $this->user_model->get(array('id'=>$this->data['user_id']));
		if($this->input->post('address')) {
			$profile = array(
				'address' 	=> $this->input->post('address'),
				'city' 		=> $this->input->post('city'),
				'state' 	=> $this->input->post('state'),
				'pin' 		=> $this->input->post('pin'),
			);			
			$meta = array();			
			$this->user_model->update_user($this->data['user_id'], null, $profile, $meta);			
			$this->session->set_flashdata('message', 'Address updated.');	
		}			
		redirect('account', 'refresh');
	}	
	
}


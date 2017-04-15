<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller {

	var $data = array();

	function __construct() {
		parent::__construct();

		$this->data['page'] = 'groups';	
		
		$this->load->model('menu');		

		$this->data['message'] = $this->session->flashdata('message');
		$this->data['warning'] = $this->session->flashdata('warning');

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}		
		if (!$this->tank_auth->is_admin()) {
			redirect('');
		}
	}
	
	function index() {
	
		if (!$this->tank_auth->is_privileged('view_group')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'Groups';

		$this->data['message'] = $this->session->flashdata('message');
		$this->data['groups'] = $this->group_model->get(array('multiple' => 1));
	
		$this->load->view('template/header', $this->data);
		$this->load->view('groups/index');
		$this->load->view('template/footer');		
	}
	
	function create() {
		
		if (!$this->tank_auth->is_privileged('insert_group')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'Create Group';

		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('slug', 'slug', 'trim|required|callback_check_group');
		
		if ($this->form_validation->run() === FALSE) {	
			$this->load->view('template/header', $this->data);
			$this->load->view('groups/create');
			$this->load->view('template/footer');		
		} else {
			$this->group_model->create(array(
												'name'					=>	$this->input->post('name'), 
												'slug'					=>	$this->input->post('slug'), 
												'user_type'				=>	$this->input->post('user_type'), 
												'description'			=>	$this->input->post('description'), 
												'is_admin'				=>	(int) $this->input->post('is_admin'), 
												'allow_registration'	=>	(int) $this->input->post('allow_registration'), 
												'is_public'				=>	(int) $this->input->post('is_public'), 
												'level'					=>	(int) $this->input->post('level'), 
											));
			$this->session->set_flashdata('message', 'Group "'.$this->input->post('name').'" created.');
			redirect('groups', 'refresh');
		}
	}
	
	function update($id) {
	
		if (!$this->tank_auth->is_privileged('update_group')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'Update Group';

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('slug', 'slug', 'trim|required');
		
		if ($this->form_validation->run() === FALSE) {
			$this->data['group'] = $this->group_model->get(array('id'=>$id));
			$this->load->view('template/header', $this->data);
			$this->load->view('groups/update');
			$this->load->view('template/footer');		
		} else {
			$this->group_model->update($id, array(
													'name'					=>	$this->input->post('name'), 
													'slug'					=>	$this->input->post('slug'), 
													'user_type'				=>	$this->input->post('user_type'), 
													'description'			=>	$this->input->post('description'), 
													'is_admin'				=>	(int) $this->input->post('is_admin'), 
													'allow_registration'	=>	(int) $this->input->post('allow_registration'), 
													'is_public'				=>	(int) $this->input->post('is_public'), 
													'level'					=>	(int) $this->input->post('level'), 
												));
			$this->session->set_flashdata('message', 'Group "'.$this->input->post('name').'" updated.');
			redirect('groups', 'refresh');
		}	
	}
	
	function check_group($slug) {
		
		$result = $this->group_model->get(array('slug'=>$slug));
		if($result === FALSE) {
			return TRUE;
		} else {
			$this->form_validation->set_message('check_group', 'The slug should be unique');
			return FALSE;
		}
	}
	
	function delete($id) {
		
		if (!$this->tank_auth->is_privileged('delete_group')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$group = $this->group_model->get(array('id'=>$id));
		$this->group_model->delete($id);
		$this->session->set_flashdata('message', 'Group "'.$group['name'].'" deleted.');
		redirect('groups', 'refresh');		
	}

}
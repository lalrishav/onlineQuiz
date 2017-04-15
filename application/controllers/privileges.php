<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Privileges extends CI_Controller {

	var $data = array();

	function __construct() {
		parent::__construct();

		$this->data['page'] = 'privileges';	
	
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
	
		if (!$this->tank_auth->is_privileged('view_privilege')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'Privileges';

		$this->data['message'] = $this->session->flashdata('message');
		$this->data['privileges'] = $this->privilege_model->get(array('multiple' => 1));
	
		$this->load->view('template/header', $this->data);
		$this->load->view('privileges/index');
		$this->load->view('template/footer');		
	}
	
	function create() {
		
		if (!$this->tank_auth->is_privileged('insert_privilege')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'Create Privilege';

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('slug', 'slug', 'trim|required|callback_check_privilege');
		
		if ($this->form_validation->run() === FALSE) {	
			$this->load->view('template/header', $this->data);
			$this->load->view('privileges/create');
			$this->load->view('template/footer');		
		} else {
			$this->privilege_model->create(array(
												'name'			=>	$this->input->post('name'), 
												'slug'			=>	$this->input->post('slug'), 
												'description'	=>	$this->input->post('description'), 
											));
			$this->session->set_flashdata('message', 'Privilege "'.$this->input->post('name').'" created.');
			redirect('privileges', 'refresh');
		}
	}
	
	function update($id) {
	
		if (!$this->tank_auth->is_privileged('update_privilege')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'Update Privilege';

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('slug', 'slug', 'trim|required');
		
		if ($this->form_validation->run() === FALSE) {
			$this->data['privilege'] = $this->privilege_model->get(array('id'=>$id));
			$this->load->view('template/header', $this->data);
			$this->load->view('privileges/update');
			$this->load->view('template/footer');		
		} else {
			$this->privilege_model->update($id, array(
													'name'			=>	$this->input->post('name'), 
													'slug'			=>	$this->input->post('slug'), 
													'description'	=>	$this->input->post('description'), 
												));
			$this->session->set_flashdata('message', 'Privilege "'.$this->input->post('name').'" updated.');
			redirect('privileges', 'refresh');
		}	
	}
	
	function check_privilege($slug) {
		
		$result = $this->privilege_model->get(array('slug'=>$slug));
		if($result === FALSE) {
			return TRUE;
		} else {
			$this->form_validation->set_message('check_privilege', 'The slug should be unique');
			return FALSE;
		}
	}
	
	function delete($id) {
		
		if (!$this->tank_auth->is_privileged('delete_privilege')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$privilege = $this->privilege_model->get(array('id'=>$id));
		$this->privilege_model->delete($id);
		$this->session->set_flashdata('message', 'Privilege "'.$group['name'].'" deleted.');
		redirect('privileges', 'refresh');		
	}
	
	function manage($type, $id) {		
		
		$this->data['page_title'] = 'Manage Privileges';

		$this->load->helper('form');
		
		if (is_array($this->input->post('privilege'))) {
			$privileges = $this->input->post('privilege');
			$this->privilege_model->set_privileges($type, $id, $privileges);	
		}
		
		$this->data['type'] = $type; 
		$this->data['id'] = $id;
		
		if ($type == 'group') {
			$group = $this->group_model->get(array('id'=>$id));
			$this->data['for'] = '"'.$group['name'].'" Group';
		} elseif ($type == 'user') {
			$user = $this->user_model->get(array('id'=>$id));
			$this->data['for'] = $user['firstname'].' '.$user['lastname'];
		}
		
		$this->data['privileges'] = $this->privilege_model->get();
		$this->data['set_privileges'] = $this->privilege_model->get_privileges($type, $id);	

		$this->load->view('template/header', $this->data);
		$this->load->view('privileges/manage');
		$this->load->view('template/footer');
	}

}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	var $data = array();

	function __construct() {
		parent::__construct();

		$this->data['page'] = 'Users';	

		$this->load->model('menu');		
		
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['warning'] = $this->session->flashdata('warning');

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
	}
	
	function index() {
	
		if (!$this->tank_auth->is_privileged('view_user')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view this page.');
			redirect('');		
		}
		
		$func = $this->uri->segment(3, 'list');
		$this->data['group'] = $this->group_model->get(array('slug' => $this->uri->segment(2, 'manager')));
		
		switch ($func) {
			case 'create':
				$this->create();
				return;
			case 'view':
				$this->view($this->uri->segment(4, 0));
				return;		
			case 'update':
				$this->update($this->uri->segment(4, 0));
				return;
			case 'details':
				$this->details($this->uri->segment(4, 0));
				return;
			case 'delete';
				$this->delete($this->uri->segment(4, 0));
				return;
			case 'unban';
				$this->unban($this->uri->segment(4, 0));
				return;
			/*case 'performance';
				$this->performance($this->uri->segment(4, 0));
				return;
			case 'add_performance';
				$this->add_performance($this->uri->segment(4, 0));
				return;
			case 'send';
				$this->send();
				return;*/	
			case 'datalist';
				$this->datalist_ajax();
				return;
			case 'serach_org_id';
				$this->serach_org_id();
				return;
			default:
				$this->datalist($func);
				return;
		}
	}

	function datalist($status) {
		
		$this->data['page_title'] = 'Users - '.$this->data['group']['name'];
 		
		$data = array('multiple'=>1, 'group'=>$this->data['group']['slug']);
		switch ($status) {
			case 'banned':
					$data['banned'] = true;
					break;
			default:
					$data['activated'] = true;
					$data['banned'] = false;	
					break;
		}
		$this->data['users'] = $this->user_model->get($data);
		
		$this->load->view('template/header', $this->data);
		$this->load->view('users/index');
		$this->load->view('template/footer');	
	}
	
	function datalist_ajax() {
		
		$segment = $this->uri->segment(4, '');
		
		$data = array(
				'group' => $this->data['group']['slug'], 
				'update_user_privilege' => $this->tank_auth->is_privileged('update_user_privilege'), 
				'update_user' => $this->tank_auth->is_privileged('update_user'),
				'delete_user' => $this->tank_auth->is_privileged('delete_user'), 
			);
		
		switch ($segment) {
			case 'banned':
					$data['banned'] = true;
					break;
			case 'pending':
					$data['activated'] = false;
					$data['banned'] = false;
					break;
			default:
					$data['activated'] = true;
					$data['banned'] = false;	
					break;
		}
		
		$this->user_model->get_ajax($data);
	}
	
	function banned() {
		
		$this->data['page_title'] = 'Banned Users - '.$this->data['group']['name'];
 
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['users'] = $this->user_model->get(array('multiple' => 1,  'group' => $this->data['group']['slug'], 'banned' => true));
		
		$this->load->view('template/header', $this->data);
		$this->load->view('users/index');
		$this->load->view('template/footer');	
	}
	
	function pending() {
		
		$this->data['page_title'] = 'Pending Activations - '.$this->data['group']['name'];
 
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['users'] = $this->user_model->get(array('multiple' => 1,  'group' => $this->data['group']['slug'], 'activated' => false));
		
		$this->load->view('template/header', $this->data);
		$this->load->view('users/index');
		$this->load->view('template/footer');	
	}
	
	function create() {
		
		if (!$this->tank_auth->is_privileged('insert_user')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'Create '.$this->data['group']['name'];

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('firstname', 'first name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'last name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_check_user');

		if ($this->form_validation->run() === FALSE) {
			$this->data['meta'] = $this->options->get_meta($this->data['group']['slug']);
			
			$this->load->view('template/header', $this->data);
			$this->load->view('users/create');
			$this->load->view('template/footer');		
		} else {
			$profile = array(
				'mobile' => $this->input->post('mobile'),
			);
			$meta = $this->input->post('meta');
			$data = $this->tank_auth->create_user('', $this->input->post('firstname'), $this->input->post('lastname'), $this->input->post('email'), $this->input->post('password') ? $this->input->post('password') : generateRandomString(8), FALSE, $profile, $this->input->post('group'), $meta);						
			
			if (!is_null($data)) {
				$data['site_name'] = $this->config->item('website_name', 'tank_auth');	
			//	$this->communication->send_email('welcome', $data['email'], $data);
				$this->session->set_flashdata('message', 'User "'.$this->input->post('firstname').'" created.');
				//set flash data from profile creation
				
				$id = $data['user_id'];
				$user_type = $this->input->post('group');
			}
			redirect('users/'.$this->data['group']['slug'], 'refresh');
		}
	}

function view($id) {
	if (!$this->tank_auth->is_privileged('view_user')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'View Profile';

		$this->load->view('users/profile');

}

	function update($id) {
	
		if (!$this->tank_auth->is_privileged('update_user')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'Update '.$this->data['group']['name'].' Information';

		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('firstname', 'first name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'last name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		
		if ($this->form_validation->run() === FALSE) {
		
			$this->data['meta'] = $this->options->get_meta($this->data['group']['slug']);
			$this->data['user'] = $this->user_model->get(array('id'=>$id));
			$this->data['user_meta'] = $this->user_model->get_user_meta($id);
			$this->load->view('template/header', $this->data);
			$this->load->view('users/update');
			$this->load->view('template/footer');		
		} else {
			$data = array(
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),				
			);
			$profile = array(
				'mobile' => $this->input->post('mobile'),
			);
			$meta = $this->input->post('meta');
			$this->user_model->update_user($id, $data, $profile, $meta);
			$password = $this->input->post('password');
			if ($password) {
				$hasher = new PasswordHash($this->config->item('phpass_hash_strength', 'tank_auth'), $this->config->item('phpass_hash_portable', 'tank_auth'));
				$hashed_password = $hasher->HashPassword($password);
				$this->user_model->change_password($id, $hashed_password);
			}
			
			$this->session->set_flashdata('message', 'User "'.$this->input->post('firstname').'" updated.');
			redirect('users/'.$this->data['group']['slug'], 'refresh');
		}
	}
	/*
	function details($id) {
	
		if (!$this->tank_auth->is_privileged('update_user')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		$status= $this->user_model->get_user_details($id);//for insrt or updt chck
		$this->data['page_title'] = 'Update User Details';

		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('firstname', 'first name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'last name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		
		if ($this->form_validation->run() === FALSE) {
			$this->data['meta'] = $this->options->get_meta($this->data['group']['slug']);
			$this->data['user'] = $this->user_model->get_details(array('id'=>$id));
			$this->data['user_meta'] = $this->user_model->get_user_meta($id);
			$this->load->view('template/header', $this->data);
			$this->load->view('users/update_details');
			$this->load->view('template/footer');		
		} else {
			$details = array(
				'user_id'=>$id,
				'father_name' => $this->input->post('father_name'),
				'father_occupation' => $this->input->post('fo'),
				'category' => $this->input->post('cat'),
				'present_address' => $this->input->post('present_address'),
				'present_city' => $this->input->post('present_city'),
				'present_state' => $this->input->post('present_state'),
				'present_pin' => $this->input->post('pin'),				
				'permanent_address' => $this->input->post('permanent_address'),
				'permanent_city' => $this->input->post('permanent_city'),
				'permanent_state' => $this->input->post('permanent_state'),
				'permanent_pin' => $this->input->post('per_pin'),
			);
			if($status)
				$this->user_model->update_user_details($id, $details);
			else
				$this->user_model->insert_user_details($details);
				
			$this->session->set_flashdata('message', 'User "'.$this->input->post('firstname').'" updated.');
			redirect('users/'.$this->data['group']['slug'], 'refresh');
		}
	}
	*/
	
	private function check_username($username) {
		
		$result = $this->user_model->get(array('username'=>$username));
		if(is_null($result)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('check_username', 'The username should be unique');
			return FALSE;
		}
	}
	
		
	private function check_user($email) {
		
		$result = $this->user_model->get(array('email'=>$email));
		if(is_null($result)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('check_user', 'The email should be unique');
			return FALSE;
		}
	}
	
	/*function send() {
		
		if (!$this->tank_auth->is_privileged('update_user')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$medium = $this->uri->segment(4, 'email');
		$id = $this->uri->segment(5, 0);		
		$user = $this->user_model->get(array('id'=>$id));
		
		$this->data['page_title'] = 'Send '.($medium == 'sms' ? 'SMS' : 'Email'); 
		
		$this->data['medium'] = $medium;
		$this->data['to'] = ($medium == 'sms' ? $user['mobile'] : $user['email']);
		
		if (!$this->input->post('to')) {			
			if ($id) {		
				$this->load->helper('form');
				//	print_r($data);
				$this->load->view('template/header', $this->data);
				$this->load->view('users/send');
				$this->load->view('template/footer');
			} else {				
				$this->session->set_flashdata('warning', 'No user selected for sending notifications.');						
				redirect('users/'.$this->data['group']['slug']);
			}
		} else {					
			if ($medium == 'email') {
				$emails = $this->input->post('to');				
				$data['subject'] = $this->input->post('subject');
				$data['notification'] = $this->input->post('message');				
				
				echo "Enable send email in Controller users";
				//$this->communication->send_email('notification', $emails, $data);					
			}			
			if ($medium == 'sms') {
				$numbers = $this->input->post('to');				
				$message = $this->input->post('message');
				echo "Enable send sms in Controller users";
				//$this->communication->send_sms($message, $numbers);
			}		
			redirect('users/'.$this->data['group']['slug']);
		}
	}
	*/
	function delete($id) {
		
		if (!$this->tank_auth->is_privileged('delete_user')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$user = $this->user_model->get(array('id'=>$id));
		$this->user_model->ban_user($id);
		$this->session->set_flashdata('message', 'User "'.$user['firstname'].'" deleted.');
		redirect('users/'.$this->data['group']['slug'], 'refresh');		
	}
	
	function unban($id) {
		
		if (!$this->tank_auth->is_privileged('delete_user')) {
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->user_model->unban_user($id);
		$user = $this->user_model->get(array('id'=>$id));
		$this->session->set_flashdata('message', 'User "'.$user['firstname'].'" unbanned.');
		redirect('users/'.$this->data['group']['slug'], 'refresh');		
	}
	
	/*
	function performance($id) {
		
		$this->load->model('user_performance_model');
		$this->data['page_title'] = 'Performance';
		$this->data['user_id'] = $id;
		$this->data['performance'] = $this->user_performance_model->get(array('user_id'=>$id, 'multiple'=>1));

		$this->load->view('template/header', $this->data);
		$this->load->view('users/performance');
		$this->load->view('template/footer');
	}
	
	function add_performance($id) {
		
		$this->load->model('user_performance_model');
		$this->data['page_title'] = 'Add Comment';

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->data['user'] = $this->user_model->get(array('id'=>$id));
		$this->form_validation->set_rules('comments', 'comments', 'trim|required');
		
		if ($this->form_validation->run() === FALSE) {	
			$this->load->view('template/header', $this->data);
			$this->load->view('users/add_performance');
			$this->load->view('template/footer');		
		} else {
			$this->user_performance_model->create(array(
												'user_id'				=>	$id, 
												'comments'				=>	$this->input->post('comments'), 
												'time'					=>	time(), 
												'by'					=>	$this->tank_auth->get_user_id(), 
											));
			$this->session->set_flashdata('message', 'Comment added.');
			redirect('users/'.$this->data['group']['slug'].'/performance/'.$id, 'refresh');
		}
	}*/
	
}
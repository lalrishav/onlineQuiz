<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	var $data = array();

	function __construct() {
		parent::__construct();

		$this->data['page'] = 'profile';	

		$this->load->model('menu');		
		
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['warning'] = $this->session->flashdata('warning');

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
	}
	
	function index() {
	//change privilige to view profile
		$func = $this->uri->segment(2, 'view');
		switch ($func) {
			case 'view':
				$this->view($this->uri->segment(3, $this->tank_auth->get_user_id()));
				return;		
			case 'update':
				$this->update($this->uri->segment(3, 0));
				return;
			default:
				$this->view($this->uri->segment(2, $this->tank_auth->get_user_id()));
				return;
		}
	}

	function update()
	{
				
		$this->data['page_title'] = 'Update Profile';
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('profile_model');
		$this->data['courses'] = $this->data_model->courses;
		$this->data['batches'] = $this->data_model->batches;
		$this->data['branches'] = $this->data_model->branches;

		
		
		//to edit form validation, check config/form_validation.php
		if ($this->form_validation->run('edit_profile') === FALSE)
		{
			$this->data['profile'] = $this->profile_model->get_profile_by_id($this->tank_auth->get_user_id());
			$this->load->view('template/header', $this->data);
			$this->load->view('profile/update');		//form in profile update
			$this->load->view('template/footer');		
		}
		else
		{
			$id = $this->tank_auth->get_user_id();
			$form = $this->input->post(NULL, TRUE);
			foreach($form as $key=>$value)
			{
				if(!isset($value) || $value == "")
					$form[$key]=NULL;
			}
			$profile=array(
							'middlename'	=>	$form['middlename'], 
							'dob'		=>	$form['dob'],
							'mobile'	=>	$form['mobile'],
							'dob'	=>	$form['dob'],
							'sex'		=>	$form['sex'], 
							'roll1'		=>	$form['roll1'], 
							'roll2'		=>	$form['roll2'], 
							'roll3'		=>	$form['roll3'], 
							'branch'	=>	$form['branch'], 
							//'address1'	=>	$form['address1'], 
							//'address2'	=>	 $form['address2'], 
							//'city'		=>	$form['city'], 
							//'state'		=>	$form['state'], 
							//'country'	=>	$form['country'],
							//'zipcode'	=>	$form['zipcode'], 
							//'nationality'	=>	$form['nationality'], 
							//'language_preferred'=>	$form['language_preferred'], 
							//'profile_pic'	=>	$form['profile_pic'], 
							//'company_mail'	=>	$form['company_mail'], 
							'lastmodified'	=>	date('Y-m-d H:i:s')
						);
			//facebook link should be clean
			$data = $this->profile_model->update_profile($id, $profile);		
			if (!is_null($data)) {
				$this->session->set_flashdata('message', 'User " '.$this->tank_auth->get_fullname().' " Profile updated.');
			}
			redirect('/profile/', 'refresh');
		}
	}
	
	function view($user_id) {
			if($this->tank_auth->is_admin() || ($user_id == $this->tank_auth->get_user_id()))
			{
				$this->load->model('profile_model');
			
				$this->data['page_title'] = 'View Profile';
				
				$this->profile = $this->profile_model->get_profile_by_id($user_id);
				$this->load->view('template/header', $this->data);
				$this->load->view('profile/view', array('profile' => $this->profile));
				$this->load->view('template/footer');

			}
			else
			{
				$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
				redirect('profile/view/'.$this->tank_auth->get_user_id(), 'refresh');
			}
	}
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Aboutus extends CI_Controller {

	var $data = array();

	function __construct() {
		parent::__construct();

		$this->data['page_title'] = 'About Us';
		$this->data['page'] = 'About Us';	
		
		$this->load->model('menu');		

		$this->data['message'] = $this->session->flashdata('message');
		$this->data['warning'] = $this->session->flashdata('warning');

		$this->data['user_id'] = $this->tank_auth->get_user_id();

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
	}
	
	function index() {
	
		$this->load->view('template/header', $this->data);
		$this->load->view('aboutus');
		$this->load->view('template/footer');		
	}
	function ieee_demo()
	{
		$this->load->database();
		//$this->db->from('users');
		/*$this->db->select('firstname,id');
		$get=$this->db->get('users');
		echo "<pre>";
        $res=$get->result();
        echo $res[3]->firstname.$res[3]->id;
        $this->db->insert('users',$res);*/
        $this->db->select('*');
        $this->db->from('user_profiles');
        $this->db->join('users', 'id = user_id');
 
        $get = $this->db->get();
        echo "<pre>";
       $res=$get->result();
       print_r($res);

        ;
        for($i=0;$i<126;$i++)
        {
        	$array=array('email'=>$res[$i]->email);
        	$this->db->where('user_id',$res[$i]->user_id);
        	$this->db->update('user_profiles',$array);
        }


	}
	
}
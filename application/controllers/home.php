<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	var $data = array();

	function __construct() {
		parent::__construct();
        $this->load->helper(array('form', 'url'));
		$this->data['page'] = 'dashboard';	
		$this->data['page_title'] = 'Dashboard';
		
		$this->load->model('menu');				

		if (!$this->tank_auth->is_logged_in()) {
			redirect('auth/login');
		}

	}
	
	function index() {
         
		$this->load->model('getfeedback');
		$this->data['feedback']=$this->getfeedback->extract_feedback();
		  	//$ip= $_SERVER['SERVER_ADDR'];
           
		  
		  

		$this->data['message'] = $this->session->flashdata('message');
		$this->data['message2'] = $this->session->flashdata('message2');

		$this->load->model('paper_model');
		$this->data['submit8'] = $this->paper_model->get_submit(13);
		$this->data['paper8'] = $this->paper_model->get_paper(13);

		$this->data['submit6'] = $this->paper_model->get_submit(11);
		$this->data['paper6'] = $this->paper_model->get_paper(11);
		
		$this->data['submit7'] = $this->paper_model->get_submit(12);
		$this->data['paper7'] = $this->paper_model->get_paper(12);
		
		$this->data['submit4'] = $this->paper_model->get_submit(9);
		$this->data['paper4'] = $this->paper_model->get_paper(9);
		
		$this->data['submit5'] = $this->paper_model->get_submit(10);
		$this->data['paper5'] = $this->paper_model->get_paper(10);


		
		$this->load->view('template/header', $this->data);
		$this->load->view('home',$this->data);
		//$this->load->view('template/footer');		
	}
	
	function feedback()
	{
		$this->load->database();
		$feedback=$_REQUEST['feedback'];
		$user_id=$this->tank_auth->get_user_id();
		$rating=$_REQUEST['rating'];
		$data = array('message' =>$feedback,'user_id' =>$user_id,'rating'=>$rating);
		
		$this->load->model('feedback');
		$this->feedback->insert($data);
		$this->session->set_flashdata('message', 'Thanks for your Feedback');
		redirect('');
		//echo $this->tank_auth->get_user_id();
		// if(!$this->tank_auth->is_admin())
		 	//echo $_REQUEST['firstname'];
	}
	function create_paper()
	{
		$this->load->database();

		/*$config['upload_path'] = './static/images/questions/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			
		}
*/
		$name=$this->input->post('name');
		$subject=$this->input->post('subject');
		$time=$this->input->post('time');
		$start_time=date($this->input->post('start_time'));
		$end_time=date($this->input->post('end_time'));
		$created_by=$this->input->post('created_by');
		//$tot_question=$this->input->post('q_numbr');
		$data = array('name' => $name,'subject'=>$subject,'time'=>$time,'start_time'=>$start_time,'end_time'=>$end_time,'created_by'=>$created_by );
		$this->load->model('create_model');
		$this->create_model->insert($data);
		$this->session->set_flashdata('message', 'Paper have been created now create the question paper');
       
        
        //echo $tot_question;
		redirect("");

	}
	function edit_paper()
	{
		
		$this->load->database();
		$question=$this->input->post('question');
		$option1=$this->input->post('option1');
		$option2=$this->input->post('option2');
		$option3=$this->input->post('option3');
		$option4=$this->input->post('option4');
		$answer=$this->input->post('answer');
		$marks=$this->input->post('marks');
	
        $chk_img=$_FILES['image_url']['error'];
         $op1=$_FILES['op1_url']['error'];
          $op2=$_FILES['op2_url']['error'];
           $op3=$_FILES['op3_url']['error'];
            $op4=$_FILES['op4_url']['error'];
        	
		$data = array('question' =>$question,'option1'=>$option1,'option2'=>$option2,'option3'=>$option3,'option4'=>$option4,'answer'=>$answer,'marks'=>$marks );
		$this->load->model('create_model');
		$this->create_model->insert_q($data);
		$pid=$this->input->get('pid');
		$qid=$this->create_model->insert_paper_question($this->input->get('pid'),$chk_img,$op1,$op2,$op3,$op4);
		$this->create_model->insert_img($qid,$chk_img,$pid);
		$this->create_model->op1_img($qid,$op1_img,$pid);
		$this->create_model->op2_img($qid,$op2_img,$pid);
		$this->create_model->op3_img($qid,$op3_img,$pid);
		$this->create_model->op4_img($qid,$op4_img,$pid);
        
		$this->session->set_flashdata('message', 'Your Previous question is successfully added.');
		$ip=$_SERVER['HTTP_REFERER'];
		redirect("$ip");
		
		
	}
	
	public function update_paper()
	{
		$name=$this->input->post('name');
		$subject=$this->input->post('subject');
		$time=$this->input->post('time');
		$start_time=date($this->input->post('start_time'));
		$end_time=date($this->input->post('end_time'));
		$created_by=$this->input->post('created_by');
		//$tot_question=$this->input->post('q_numbr');
		$data = array('name' => $name,'subject'=>$subject,'time'=>$time,'start_time'=>$start_time,'end_time'=>$end_time,'created_by'=>$created_by );
		$this->db->where('pid', $_GET['pid']);
		$this->db->update('papers', $data);
		$this->session->set_flashdata('message', 'Paper have been updated successfully');
       
        
        //echo $tot_question;
		redirect("");
	}
	public function update_question()
	{
        $this->load->database();
		$question=$this->input->post('question');
		$option1=$this->input->post('option1');
		$option2=$this->input->post('option2');
		$option3=$this->input->post('option3');
		$option4=$this->input->post('option4');
		$answer=$this->input->post('answer');
		$marks=$this->input->post('marks');
        	
		$data = array('question' =>$question,'option1'=>$option1,'option2'=>$option2,'option3'=>$option3,'option4'=>$option4,'answer'=>$answer,'marks'=>$marks );
		$this->db->where('qid', $_GET['qid']);
		$this->db->update('questions', $data);
		$this->session->set_flashdata('message', 'Question have been updated successfully');
		redirect("");
		
	}
	

}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Papers extends CI_Controller {

	var $data = array();

	function __construct() {
		parent::__construct();

		$this->data['page'] = 'Papers';	
		
		$this->load->model('menu');		
		$this->load->model('paper_model');

		$this->data['message'] = $this->session->flashdata('message');
		$this->data['message2'] = $this->session->flashdata('message2');
		$this->data['warning'] = $this->session->flashdata('warning');

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
	/*	if($this->tank_auth->get_group()['slug'] == 'student')
		{
			$this->load->model('student_model');
		} */
	}
//STUDENTS PRIORITY	
	function index()
	{
		//edit permission
		if (!$this->tank_auth->is_privileged('view_paper'))
		{
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'Papers';
        
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['papers'] = $this->paper_model->get_list(array());
		$this->data['scores'] = $this->paper_model->get_scores_by_user_id($this->tank_auth->get_user_id());
	
		$this->load->view('template/header', $this->data);
		$this->load->view('papers/index', $this->data);
		$this->load->view('template/footer');		
	}
	
	
//SECURE SQL CONNECTION
	function view($id)
	{
		if (!$this->tank_auth->is_privileged('view_paper'))
		{
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'Question Paper';

		$this->data['message'] = $this->session->flashdata('message');
		$paper = $this->paper_model->get_paper($id, array('flag'=> 1));
		if(!isset($paper['name']))
		{
			$this->session->set_flashdata('message', 'Invalid Paper ID.');
			redirect('papers');
		}
		
		
		if((strtotime("now") >= strtotime($paper['start_time'])) && (strtotime("now") <= strtotime($paper['end_time'])))
		{
			if($this->paper_model->has_submitted($id, $this->tank_auth->get_user_id()))
			{	
				$this->session->set_flashdata('message', 'You have already submitted the paper.');
				redirect('papers');
			}
			
			$this->paper = $this->paper_model->get_fullpaper($id, array('flag'=> 1));
			$this->data['paper'] = $this->paper['paper'];
			$this->data['questions'] = $this->paper['questions'];
			//remove answers if argument says so
			//$this->load->view('papers/view3', $this->data);
			$this->load->view('papers/view4', $this->data);
			
			//$this->load->view('template/header', $this->data);
			//$this->load->view('papers/view2', $this->paper);
			//$this->load->view('template/footer');		
		}
		else
		{
			if(strtotime("now") <= strtotime($paper['start_time']))
			{
				$this->load->view('template/header', $this->data);
				$this->load->view('papers/notStarted', array('paper'=> $paper));
				$this->load->view('template/footer');				
			}
			else
			{
				
				//do not show solutions immediately
				if(strtotime('now') <= (strtotime($paper['end_time']) + (60*10)))
				{
					$this->load->view('template/header', $this->data);
					$this->load->view('papers/solutions/wait', array('paper'=> $paper));
					$this->load->view('template/footer');
				}
				else
				{
					$this->paper = $this->paper_model->get_fullpaper($id, array('flag'=> 1));
			
					$this->data['paper'] = $this->paper['paper'];
					$this->data['questions'] = $this->paper['questions'];
					$this->data['id']=$id;
					$this->load->view('template/header', $this->data);
					$this->load->view('papers/solutions/soln', array($this->data));
					$this->load->view('template/footer');
				}
			}
		}
	}
	function view_paper($id)
	{
		           $this->paper = $this->paper_model->get_fullpaper($id, array('flag'=> 1));
			
					$this->data['paper'] = $this->paper['paper'];
					$this->data['questions'] = $this->paper['questions'];
					$this->data['id']=$id;
					$this->load->view('template/header', $this->data);
					$this->load->view('papers/solutions/soln', array($this->data));
					$this->load->view('template/footer');
	}
		
//BYPASSED PAPER for admin
	function viewadmin($id)
	{
		if(!$this->tank_auth->is_admin())
		{
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');	
		}
		if (!$this->tank_auth->is_privileged('view_paper'))
		{
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'Question Paper';

		$this->data['message'] = $this->session->flashdata('message');
		$paper = $this->paper_model->get_paper($id, array('flag'=> 1));
		if(!isset($paper['name']))
		{
			$this->session->set_flashdata('message', 'Invalid Paper ID.');
			redirect('papers');
		}
		
		
		if(true )
		{
			if(false && $this->paper_model->has_submitted($id, $this->tank_auth->get_user_id()))
			{	
				$this->session->set_flashdata('message', 'You have already submitted the paper.');
				redirect('papers');
			}
			
			$this->paper = $this->paper_model->get_fullpaper($id, array('flag'=> 1));
			$this->data['paper'] = $this->paper['paper'];
			$this->data['questions'] = $this->paper['questions'];
			//remove answers if argument says so
			//$this->load->view('papers/view3', $this->data);
			$this->load->view('papers/view4admin', $this->data);
			
			//$this->load->view('template/header', $this->data);
			//$this->load->view('papers/view2', $this->paper);
			//$this->load->view('template/footer');		
		}
		else
		{
			if(strtotime("now") <= strtotime($paper['start_time']))
			{
				$this->load->view('template/header', $this->data);
				$this->load->view('papers/notStarted', array('paper'=> $paper));
				$this->load->view('template/footer');				
			}
			else
			{
				
				//do not show solutions immediately
				if(strtotime('now') <= (strtotime($paper['end_time']) + (60*10)))
				{
					$this->load->view('template/header', $this->data);
					$this->load->view('papers/solutions/wait', array('paper'=> $paper));
					$this->load->view('template/footer');
				}
				else
				{
					$this->paper = $this->paper_model->get_fullpaper($id, array('flag'=> 1));
			
					$this->data['paper'] = $this->paper['paper'];
					$this->data['questions'] = $this->paper['questions'];
					
					$this->load->view('template/header', $this->data);
					$this->load->view('papers/solutions/'.$id, array($this->data));
					$this->load->view('template/footer');
				}
			}
		}
	}
	
	
	function submit($id)
	{
		/* Expecting
		Post-> ['paperid']
		retrieve qids of the paper
		// log answer data (submit_log)
		//get submit_id and insert answers
		check each qid in post ['qid'] = answer and log
		redirect to submission page
		*/
		
		if(!$this->tank_auth->is_privileged('give_test'))
		{
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		//resubmission check
		if($this->paper_model->has_submitted($id, $this->tank_auth->get_user_id()))
		{
			$this->session->set_flashdata('message', 'You have already submitted the paper.');
			redirect('');
		}		
		
		$this->data['page_title'] = 'Paper Submission';

		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('pid', 'pid', 'trim|required');
		
		if ($this->form_validation->run() === FALSE)
		{
		//store a fake submit
		
			$this->session->set_flashdata('message', 'Error submitting paper. Invalid Paper ID.');
			redirect('papers', 'refresh');
		/*		
			$this->load->view('template/header', $this->data);
			$this->load->view('papers/view/', $this->data);
			$this->load->view('template/footer');		
		*/
		} 
		else
		{
			//each question as qu<qid>
			$args = $this->input->post(NULL, TRUE);
			$pid = $args['pid'];
			$paper = $this->paper_model->get_paper($pid, array('flag'=> 1));
			if(!$paper)
			{
				$this->session->set_flashdata('message', 'Invalid Paper ID.');
				redirect('papers');
			}
			if((strtotime("now") >= strtotime($paper['start_time'])) && (strtotime("now") <= (strtotime($paper['end_time']) + (10*60))))
			{
				$answers = array();
				foreach($args as $k=>$v)
				{
					if(substr($k, 0, 2) == "qu")
					{
						if($v == "1" || $v == "2" || $v == "3" || $v == "4")
						{
							$qu = substr($k, 2);
							$answers[] = array('qid' => $qu, 'ans' => $v);
						}
					}
				}
				//print_r($answers);
				
				if(strtotime("now") >= (strtotime($paper['end_time']) + (5*60)))
				{
					$this->paper_model->submit_answers($pid, $answers, 2);
					$this->session->set_flashdata('message', 'Paper submitted successfully. SUBMISSION TIME LIMIT exceeded, your marks will not be considered. Contact Admin for approval.');
				}
				else
				{
					$this->paper_model->submit_answers($pid, $answers, 1);
					$this->session->set_flashdata('message2', 'Paper submitted successfully.');
				}				
				
				if($this->paper_model->has_submitted_feedback($this->tank_auth->get_user_id()) == 0)
				{
					redirect('papers/feedback');
				}
				else
				{
					redirect('papers', 'refresh');
				}
                
			}
			else
			{
				$this->session->set_flashdata('message', 'Cannot submit paper. Paper already ended');
				redirect('papers', 'refresh');
			}
		}
	}
	
	function calculatemarks($pid)
	{
		
		$this->paper_model->calculate_score($pid);
		$ranks = $this->paper_model->calculate_rank($pid);
		$this->paper_model->calculate_rank_batch($pid);
		print_r($ranks);
		die("Calculated");
	}
	
	function feedback()
	{
		
		$this->data['page_title'] = 'Feedback Submission';

		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('message', 'message', 'xss_clean|trim|required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->data['ratings']= array('1'=> 'Poor', '2'=>'Average', '3'=>'Good', '4'=>'Very Good', '5'=>'Excellent');
			$this->load->view('template/header', $this->data);
			$this->load->view('papers/feedback');
			$this->load->view('template/footer');
		}
		else
		{
			$args = $this->input->post(NULL, TRUE);
			$this->paper_model->submit_feedback($args);
			
			$this->session->set_flashdata('message2', 'Feedback Recorded. Thank You!');
			redirect('');
		}
	}
	
	//create later
	/*private function create() {
		
		if (!$this->tank_auth->is_privileged('create_paper'))
		{
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'Create Paper';

		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		//if(isset($_FILE['logo']))
		//{
			//$logo_file = $this->organisation_model->upload_logo();
	//	}
		
		if ($this->form_validation->run() === FALSE || $logo_file === FALSE) {	
			$this->load->view('template/header', $this->data);
			$this->load->view('papers/create');
			$this->load->view('template/footer');		
		} 
		else
		{
			$args = $this->input->post(NULL, TRUE);
			//$args['image_urls'] = $logo_file['file_name'];
			
			$paper['name'] = $args['paperName'];
			$paper['subject'] = $args['paperSubject'];
			$paper['time'] = $args['paperTime'];
			$paper['start_time'] = $args['paperStartTime'];
			$paper['end_time'] = $args['paperEndTime'];
			$paper['created_by'] = $this->tank_auth->get_fullname();
			$paper['flag'] = $args['paperFlag'];
			
			$data['paper'] = $paper;
			$data['questions'] = $args['question'];
			//check display of questions
			print_r($data);
			
			//$this->paper_model->create($paper);
			//$this->session->set_flashdata('message', 'Paper "'.$this->input->post('name').'" created.');
			//redirect('papers', 'refresh');
		}
	}*/
	public function create()
	{
		if (!$this->tank_auth->is_privileged('create_paper'))
		{
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		$this->load->database();
		$this->db->where('pid',$_GET['pid']);
		$this->db->from('papers');
        $get=$this->db->get();
        $this->data['value']=$get->result();
		$this->load->helper('form');
		$this->load->view('template/header', $this->data);
		$this->load->view('create',$this->data);
		$this->load->view('template/footer');

	}
	public function edit_paper()
	{
		//$ip=$_SERVER['SERVER_PORT'];
		//$add1="http://$ip:8080/tesla/papers/create";
		//$add2="http://localhost:8080/tesla/papers/questions";
       // if(!$_SERVER['HTTP_REFERER']==$add1||!$_SERVER['HTTP_REFERER']==$add)
        //{
            //  $this->session->set_flashdata('message', '');
			//redirect('');
       // }
		if (!$this->tank_auth->is_privileged('create_paper'))
		{
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		     $this->load->database();
		     $pid=$this->input->get('pid');
		     $data['pid']=$pid;
		     $this->load->model('data_model');
		     $data['answer']=$this->data_model->answer;
		     $data['qid']=$_GET['qid'];
		     $this->load->model('extract');
		     $data['info']=$this->extract->paper_info($pid);
		     $data['q_info']=$this->extract->question_info($_GET['qid']);
		     $data['flag']=$_GET['flag'];
		     $this->load->helper('form');
		     $this->load->view('template/header', $data);
		     $this->load->view('edit_paper',$data);
		     $this->load->view('template/footer');
	    
	}
	public function update_paper()
	{
		if (!$this->tank_auth->is_privileged('create_paper'))
		{
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		     $this->load->database();
		     $pid=$this->input->get('pid');
		     $data['pid']=$pid;
		     $this->load->model('data_model');
		     $data['answer']=$this->data_model->answer;
		     $data['qid']=$_GET['qid'];
		     $this->db->where('qid',$_GET['qid']);
		     $this->db->from('questions');
		     $get=$this->db->get();
		     $data['res']=$get->result;
		     $this->load->model('extract');
		     $data['info']=$this->extract->paper_info($pid);
		     $data['flag']=1;
		     $this->load->helper('form');
		     $this->load->view('template/header', $data);
		     $this->load->view('edit_paper',$data);
		     $this->load->view('template/footer');
	}
	public function delete_paper()
	{
		if (!$this->tank_auth->is_privileged('create_paper'))
		{
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		$this->load->database();
		$this->db->from('papers');
		$this->db->where('pid',$_GET['pid']);
		$get=($this->db->get());
		$res=$get->result();
		$data = array('flag' =>0, );
		$this->db->where('pid',$_GET['pid']);
		$this->db->update('papers', $data);
		$this->session->set_flashdata('message', 'Paper Successfully deleted');
		redirect('/papers');
	}
	/*
	function update($id) {
	
		if (!$this->tank_auth->is_privileged('create_organisation'))
		{
			$this->session->set_flashdata('message', 'You do not have sufficient privileges to view the last page.');
			redirect('');		
		}
		
		$this->data['page_title'] = 'Update Organisation';

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'trim|required');
		
		if ($this->form_validation->run() === FALSE) {
			$this->data['organisation'] = $this->organisation_model->get(array('id'=>$id));
			$this->load->view('template/header', $this->data);
			$this->load->view('organisations/update');
			$this->load->view('template/footer');		
		} else {
			$this->organisation_model->update($id, $this->input->post());
			//remove ID from post data
			$this->session->set_flashdata('message', 'Organisation "'.$this->input->post('name').'" updated.');
			redirect('organisations', 'refresh');
		}	
	}
	*/
	function test22()
	{
			$this->paper = $this->paper_model->get_fullpaper(5, array('flag'=> 1));
			
			$this->data['paper'] = $this->paper['paper'];
			$this->data['questions'] = $this->paper['questions'];
			
			$this->load->view('template/header', $this->data);
			$this->load->view('papers/solutions/50', array($this->data));
			$this->load->view('template/footer');
	}
}	
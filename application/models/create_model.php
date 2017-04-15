<?php

Class Create_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function insert($data)
	{
		$this->db->insert('papers', $data);
	}
	public function insert_q($data)
	{
		$this->db->insert('questions',$data);
		
		//$data2 = array('pid' =>$pid ,'qid'=>$qid,'flag'=>1 );
		//$this->db->insert('paper_questions',$data2);
	}
	public function insert_paper_question($pid)
	{
         
		 $this->db->select_max('qid');
		 $get=$this->db->get('questions');
		 $qid=$get->result();
		 $data = array('pid' =>$pid ,'qid'=>$qid[0]->qid,'flag'=>1 );
		 $this->db->insert('paper_questions',$data);
		 return $qid[0]->qid;
	}
public function insert_img($qid,$chk_img,$pid)
{
	
		 
		 	
		 	
		 	
		 	 $config1['upload_path']          = './static/images/questions/';
             $config1['allowed_types']        = 'gif|jpg|png';
             $config1['max_size']             = 100;
             $config1['max_width']            = 1024;
             $config1['max_height']           = 768;
             $config1['file_name']            = $pid."_".$qid.".png";
             if($_FILES['image_url']['error']!=4){;
             $this->load->library('upload', $config1);
              $this->upload->initialize($config1);

              $this->upload->do_upload('image_url');
              $img = array('image_url' =>$pid."_".$qid.".png");
		 	$this->db->where('qid', $qid);
		 	$this->db->update('questions',$img);}
}

public function op1_img($qid,$op1,$pid){
		 
		 	
		 	
		 	 $config2['upload_path']          = './static/images/option1/';
             $config2['allowed_types']        = 'gif|jpg|png';
             $config2['max_size']             = 100;
             $config2['max_width']            = 1024;
             $config2['max_height']           = 768;
             $config2['file_name']            = $pid."_".$qid.".png";
             if($_FILES['op1_url']['error']!=4){;
             $this->load->library('upload', $config2);
              $this->upload->initialize($config2);
              $this->upload->do_upload('op1_url');
		$img1 = array('op1_url' =>$pid."_".$qid.".png");
		 	$this->db->where('qid', $qid);
		 	$this->db->update('questions',$img1);}
	}

public function op2_img($qid,$op2,$pid)
{
	
		 
		
		 	
		 	 $config3['upload_path']          = './static/images/option2/';
             $config3['allowed_types']        = 'gif|jpg|png';
             $config3['max_size']             = 100;
             $config3['max_width']            = 1024;
             $config3['max_height']           = 768;
             $config3['file_name']            = $pid."_".$qid.".png";
            if($_FILES['op2_url']['error']!=4){
             $this->load->library('upload', $config3);
              $this->upload->initialize($config3);
              $this->upload->do_upload('op2_url');
              $img2 = array('op2_url' =>$pid."_".$qid.".png");
		 	  $this->db->where('qid', $qid);
		 	  $this->db->update('questions',$img2);}
		 
}

public function op3_img($qid,$op3,$pid)
{
		
		 	
		 	
		 	 $config4['upload_path']          = './static/images/option3/';
             $config4['allowed_types']        = 'gif|jpg|png';
             $config4['max_size']             = 100;
             $config4['max_width']            = 1024;
             $config4['max_height']           = 768;
             $config4['file_name']            = $pid."_".$qid.".png";
             if($_FILES['op3_url']['error']!=4){
             $this->load->library('upload', $config4);
              $this->upload->initialize($config4);
              $this->upload->do_upload('op3_url');
		 $img3 = array('op3_url' =>$pid."_".$qid.".png");
		 	$this->db->where('qid', $qid);
		 	$this->db->update('questions',$img3);}
}
public function op4_img($qid,$op4,$pid)
{

		 
		 
		 	 $config5['upload_path']          = './static/images/option4/';
             $config5['allowed_types']        = 'gif|jpg|png';
             $config5['max_size']             = 100;
             $config5['max_width']            = 1024;
             $config5['max_height']           = 768;
             $config5['file_name']            = $pid."_".$qid.".png";
             if($_FILES['op4_url']['error']!=4){;
             $this->load->library('upload', $config5);
              $this->upload->initialize($config5);
              $this->upload->do_upload('op4_url');
		 	
		 	$img4= array('op4_url' =>$pid."_".$qid.".png");
		 	$this->db->where('qid', $qid);
		 	$this->db->update('questions',$img4);}
	}
		


	
	
}
?>
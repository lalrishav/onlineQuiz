<?php
class Extract extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	 function paper_info($pid)
	{
         $this->db->from('papers');
         $this->db->where('pid',$pid);
        $get=$this->db->get();
        return $get->result();
	}
	function question_info($qid)
	{
		$this->db->from('questions');
		$this->db->where('qid',$qid);
		$get=$this->db->get();
		return $get->result();
	}
}
?>
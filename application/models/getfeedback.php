<?php
Class getfeedback extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	public function extract_feedback()
	{
		$this->load->database();
		$this->db->from('feedback');
		$this->db->order_by('id', "desc");
		$query=$this->db->get();
		return $query->result();
	}

}
?>
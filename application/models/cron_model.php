<?php

Class Cron_model extends CI_Model {

	public function __construct() {
		parent::__construct();

	}
	
	public function get($args=array()) {
		
		$this->db->from('cron c');
		if (isset($args['id'])) $this->db->where('c.id', $args['id']);
		if (isset($args['job'])) $this->db->where('c.job', $args['job']);
		$this->db->order_by('start', 'desc');
		if (isset($args['limit'])) $this->db->limit($args['limit']);
		
		$query = $this->db->get();
		if ($query->num_rows() > 1 || isset($args['multiple'])) {
			return $query->result_array();		
		} elseif ($query->num_rows() == 1) {
			return $query->row_array();
		} else {
			return FALSE;
		}	
	}
	
	function create($data) {
		
		$this->db->insert('cron', $data);	
		return $this->db->insert_id();
	}
	
	function update($id, $data) {
		
		$this->db->where('id', $id);
		$this->db->update('cron', $data);	
		return;
	}
	
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_Performance_model extends CI_Model {

	function __construct() {
		parent::__construct();
		
	}
	
	function get($args=array()) {
	
		$this->db->select('up.*, u2.firstname as by_firstname, u2.lastname as by_lastname');
		$this->db->from('user_performance up');
		$this->db->join('users u2', 'up.by = u2.id', 'left');
		if (isset($args['id'])) $this->db->where('up.id', $args['id']);
		if (isset($args['user_id'])) $this->db->where('up.user_id', $args['user_id']);
		$this->db->where('up.flag', 1);
		if(isset($args['limit'])) $this->db->limit($args['limit']);
		
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
		
		$this->db->insert('user_performance', $data);	
		return;
	}
	
	function update($id, $data) {
		
		$this->db->where('id', $id);
		$this->db->update('user_performance', $data);	
		return;
	}

}
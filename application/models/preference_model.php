<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Preference_model extends CI_Model {

	function __construct() {
		parent::__construct();
		
	}
	
	function get($args=array()) {
	
		$this->db->from('preferences');
		if (isset($args['id'])) $this->db->where('id', $args['id']);
		if (isset($args['key'])) $this->db->where('key', $args['key']);
		$this->db->where('flag', 1);
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
	
	function get_list($args=array()) {
	
		$args['key'] = isset($args['key']) ? $args['key'] : '';
		
		$this->db->from('preferences');
		$this->db->where('flag', 1);
		$query = $this->db->get();
		$list = array();
		foreach ($query->result() as $row) {
			if ($args['key'] == 'key')
				$list[$row->key] = $row->name;
			else
				$list[$row->id] = $row->name;
		}
		return $list;
	}
	
	function create($data) {
		
		$this->db->insert('preferences', $data);	
		return;
	}
	
	function update($id, $data) {
		
		$this->db->where('id', $id);
		$this->db->update('preferences', $data);	
		return;
	}
	
	function delete($id) {
		
		$this->db->set('flag', 0);
		$this->db->where('id', $id);
		$this->db->update('preferences');	
		return;
	}
	
	function set_user_preferences($user_id, $data) {
		
		$user = $this->user_model->get(array('id'=>$user_id));		
		$preferences = $this->options->get_preferences($user['group_slug']);
		
		$user_preferences = array();
		foreach ($data AS $key=>$val) {
			if ($preferences[$key]['default'] != $val) {
				$user_preferences[$preferences[$key]['key']] = $val;
			}
		}
		
		$this->db->from('user_preferences');	
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		if ($query->num_rows()) {
			$this->db->where('user_id', $user_id);
			$this->db->update('user_preferences', array('preferences' => serialize($user_preferences)));
		} else {
			$this->db->insert('user_preferences', array('user_id' => $user_id, 'preferences' => serialize($user_preferences)));
		}
		
		return;
	}
}
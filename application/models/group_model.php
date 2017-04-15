<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Group_model extends CI_Model {

	function __construct() {
		parent::__construct();
		
	}
	
	function get($args=array()) {
	
		$this->db->select('g.id AS id, g.name AS name, g.slug AS slug, g.description AS description, g.is_admin AS is_admin, g.allow_registration AS allow_registration, g.level AS level, g.is_public AS is_public');
		$this->db->from('groups g');
		if (isset($args['id'])) $this->db->where('g.id', $args['id']);
		if (isset($args['slug'])) $this->db->where('g.slug', $args['slug']);
		if (isset($args['is_admin'])) $this->db->where('g.is_admin', $args['is_admin'] ? 1 : 0);
		if (isset($args['allow_registration'])) $this->db->where('g.allow_registration', $args['allow_registration'] ? 1 : 0);
		if (isset($args['is_public'])) $this->db->where('g.is_public', $args['is_public'] ? 1 : 0);
		if (isset($args['level'])) $this->db->where('g.level <=', $args['level']);
		$this->db->where('g.flag', 1);
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
	
		//$args['key'] = isset($args['key']) ? $args['key'] : '';

		$this->db->from('groups');
		if (isset($args['level'])) $this->db->where('level <=', $args['level']);
		if (isset($args['is_admin'])) $this->db->where('is_admin', $args['is_admin'] ? 1 : 0);
		if (isset($args['allow_registration'])) $this->db->where('allow_registration', $args['allow_registration'] ? 1 : 0);
		if (isset($args['is_public'])) $this->db->where('is_public', $args['is_public'] ? 1 : 0);
		$this->db->where('flag', 1);
		$query = $this->db->get();
		$list = array();
		foreach ($query->result() as $row) {
			if ($args['key'] == 'slug')
				$list[$row->slug] = $row->name;
			else
				$list[$row->id] = $row->name;
		}
		return $list;
	}
	
	function create($data) {
		
		$this->db->insert('groups', $data);	
		return;
	}
	
	function update($id, $data) {
		
		$this->db->where('id', $id);
		$this->db->update('groups', $data);	
		return;
	}
		
	function delete($id) {
		
		$this->db->set('flag', 0);
		$this->db->where('id', $id);
		$this->db->update('groups');
		return;
	}
}
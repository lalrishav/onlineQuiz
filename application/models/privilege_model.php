<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Privilege_model extends CI_Model {

	function __construct() {
		parent::__construct();
		
	}
	
	function get($args=array()) {
	
		$this->db->select('p.id AS id, p.name AS name, p.slug AS slug, p.description AS description');
		$this->db->from('privileges p');
		if (isset($args['id'])) $this->db->where('p.id', $args['id']);
		if (isset($args['slug'])) $this->db->where('p.slug', $args['slug']);
		$this->db->where('p.flag', 1);
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
		
		$this->db->insert('privileges', $data);
		return;
	}
	
	function update($id, $data) {
		
		$this->db->where('id', $id);
		$this->db->update('privileges', $data);	
		return;
	}
	
	function delete($id) {
		
		$this->db->set('flag', 0);
		$this->db->where('id', $id);
		$this->db->update('privileges');	
		return;
	}
	
	function get_privileges($type='group', $id) {
		
		if ($type == 'user') {
			$user_id = $id;
			$user = $this->user_model->get(array('id'=>$id));
			if ($user) {
				$id = $user['group_id'];
			}
		}
		
		$this->db->select('p.id AS id, p.slug AS slug');
		$this->db->from('privileges p, privileges_groups z');
		$this->db->where('p.id = z.privilege_id');
		$this->db->where('z.group_id', $id);
		$this->db->where('p.flag', 1);
		
		$privileges = array();
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$privileges[$row->id] = $row->slug;
		}
		
		
		if ($type == 'user') {
			$this->db->select('p.id AS id, p.slug AS slug, z.flag AS flag');
			$this->db->from('privileges p, privileges_users z');
			$this->db->where('p.id = z.privilege_id');
			$this->db->where('z.user_id', $user_id);
			$this->db->where('p.flag', 1);
			
			$extra_privileges = $blocked_privileges = array();
			$query = $this->db->get();
			foreach ($query->result() as $row) {
				if ($row->flag == 0)
					$blocked_privileges[$row->id] = $row->slug;
				if ($row->flag == 1)
					$extra_privileges[$row->id] = $row->slug;
			}
			$privileges = array_diff_assoc($privileges, $blocked_privileges);
			$privileges = $privileges + $extra_privileges;
			$privileges = array_unique($privileges);
		}

		return $privileges;
	}
	
	function set_privileges($type='group', $id, $data) {
		
		if ($type == 'user') {
			$this->db->delete('privileges_users', array('user_id' => $id));		
		}
		$old_privileges = $this->privilege_model->get_privileges($type, $id);
		
		$new_privileges = array();
		foreach ($data as $privilege_id => $val) {
			$new_privileges[] = $privilege_id;			
		}			
			
		if ($type == 'group') {			
			foreach ($old_privileges as $privilege_id => $privilege) {
				if (!in_array($privilege_id, $new_privileges)) {
					$this->db->delete('privileges_groups', array('privilege_id' => $privilege_id, 'group_id' => $id)); 
				}			
			}			
			foreach ($new_privileges as $privilege) {
				if (!array_key_exists($privilege, $old_privileges)) {
					$this->db->insert('privileges_groups', array('privilege_id' => $privilege, 'group_id' => $id));
				}
			}			
		} elseif ($type == 'user') {		
			foreach ($old_privileges as $privilege_id => $privilege) {
				if (!in_array($privilege_id, $new_privileges)) {
					$this->db->insert('privileges_users', array('privilege_id' => $privilege_id, 'user_id' => $id, 'flag' => 0));
				}
			}
			foreach ($new_privileges as $privilege) {
				if (!array_key_exists($privilege, $old_privileges)) {
					$this->db->insert('privileges_users', array('privilege_id' => $privilege, 'user_id' => $id, 'flag' => 1));
				}
			}
		}
	
		return;
	}
	
}
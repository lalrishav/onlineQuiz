<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model {
	private $table_name			= 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles

	function __construct() {
		parent::__construct();

	}
	
	function get($args=array()) {
	
		if (!isset($args['banned'])) $args['banned'] = 0;
	
		$this->db->select('u.id AS id, u.firstname AS firstname, u.lastname AS lastname, u.username AS username, u.email AS email, u.activated AS activated, u.last_login AS last_login, u.created AS created, u.modified AS modified, 
		g.name AS group_name, g.slug AS group_slug, 
		up.dob AS dob, up.sex AS sex, up.mobile AS mobile, up.roll1 AS roll1, up.roll2 AS roll2, up.roll3 AS roll3, up.branch AS branch,
		up.linkedin AS linkedin, up.facebook AS facebook');
		$this->db->from('users u');
		$this->db->join('groups g', 'g.id = u.group_id', 'left');
		$this->db->join('user_profiles up', 'up.user_id = u.id', 'left');
		if (isset($args['id'])) $this->db->where('u.id', $args['id']);
		if (isset($args['sex'])) $this->db->where('up.sex', $args['sex']);
		if (isset($args['roll1'])) $this->db->where('up.roll1', $args['roll1']);
		if (isset($args['roll2'])) $this->db->where('up.roll2', $args['roll2']);
		if (isset($args['roll3'])) $this->db->where('up.roll3', $args['roll3']);
		if (isset($args['branch'])) $this->db->where('up.branch', $args['branch']);
		if (isset($args['username'])) $this->db->where('LOWER(u.username)', strtolower($args['username']));
		/*if (isset($args['city'])) $this->db->like('LOWER(up.city)', strtolower($args['city']));
		if (isset($args['state'])) $this->db->like('LOWER(up.state)', strtolower($args['state']));
		if (isset($args['country'])) $this->db->like('LOWER(up.country)', strtolower($args['country']));*/
		if (isset($args['email'])) $this->db->where('LOWER(u.email)', strtolower($args['email']));
		if (isset($args['login'])) {
			$this->db->where('LOWER(u.username)', strtolower($args['login']));
			$this->db->or_where('LOWER(u.email)', strtolower($args['login']));
		}
		if (isset($args['group'])) {
			$this->db->where('u.group_id', $args['group']);
			$this->db->or_where('LOWER(g.slug)', strtolower($args['group']));
		}
		if (isset($args['banned']) && !isset($args['show_all'])) $this->db->where('u.banned', $args['banned'] ? 1 : 0);
		if (isset($args['activated']) && !isset($args['show_all'])) $this->db->where('u.activated', $args['activated'] ? 1 : 0);
		if (isset($args['limit'])) $this->db->limit($args['limit']);
		
		$query = $this->db->get();
		if ($query->num_rows() > 1 || isset($args['multiple'])) {
			return $query->result_array();		
		} elseif ($query->num_rows() == 1) {
			if (isset($args['return']) && $args['return'] = 'object')
				return $query->row();
			else
				return $query->row_array();
		}	
		return NULL;
	}
	
	function get_list($args=array()) {
	//make use of this function
	
		$this->db->select('u.id AS id, u.firstname AS firstname, u.lastname AS lastname');
		$this->db->from('users u');
		$this->db->join('groups g', 'g.id = u.group_id', 'left');
		if (isset($args['group'])) {
			$this->db->where('u.group_id', $args['group']);
			$this->db->or_where('LOWER(g.slug)', strtolower($args['group']));
		}
		if (isset($args['user_type'])) $this->db->where('LOWER(g.user_type)', strtolower($args['user_type']));
		$this->db->where('u.banned', 0);
		
		$query = $this->db->get();
		$result = $query->result_array();	
		$list = array();
		foreach ($result as $row) {
			$list[$row['id']] = $row['firstname'].' '.$row['lastname'];
		}		
		return $list;
	}
	
	function get_profile_by_id($user_id, $activated=1) {
		return $this->profile_model->get(array('id'=>$user_id, 'activated'=>$activated, 'return'=>'object'));
	}
	function get_profile_by_login($login) {
		return $this->profile_model->get(array('login'=>$login, 'return'=>'object'));
	}
	
	function get_profile_by_username($username) {
		return $this->profile_model->get(array('username'=>$username, 'return'=>'object'));
	}

	function get_profile_by_email($email) {	 
		return $this->profile_model->get(array('email'=>$email, 'return'=>'object'));
	}
	
	function detail_allowed($user_id)
	{
		$this->db->from($this->table_name);
		$this->db->where('user_id', $user_id);
		if($this->db->count_all_results() >= 1)
			return true;
		else
			return false;
			
	}
	function update_profile($user_id, $profile=array()) {	
		$this->db->where('user_id', $user_id);
		unset($profile['user_id']);
		return $this->db->update($this->profile_table_name, $profile);
	}
	
	private function delete_profile($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->profile_table_name);
	// NEED better way to delete the profile.
	}	
}

/* End of file profile_model.php */
/* Location: ./application/models/profile.php */
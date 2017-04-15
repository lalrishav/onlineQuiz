<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	private $table_name			= 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles

	function __construct() {
		parent::__construct();

		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->profile_table_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->profile_table_name;
	}
	
	function get($args=array()) {
	
		if (!isset($args['banned'])) $args['banned'] = 0;
	
		$this->db->select('u.id AS id, u.firstname AS firstname, u.lastname AS lastname, u.username AS username, u.email AS email, u.activated AS activated, u.last_login AS last_login, u.created AS created, u.modified AS modified, u.password AS password, u.banned AS banned, u.ban_reason AS ban_reason, u.new_email_key AS new_email_key, g.id AS group_id, g.slug AS group_slug, up.mobile AS mobile, up.address1 AS address, up.city AS city, up.state AS state, up.zipcode AS pin');
		$this->db->from('users u');
		$this->db->join('groups g', 'g.id = u.group_id', 'left');
		$this->db->join('user_profiles up', 'up.user_id = u.id', 'left');
		if (isset($args['id'])) $this->db->where('u.id', $args['id']);
		if (isset($args['username'])) $this->db->where('LOWER(u.username)', strtolower($args['username']));
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
	
	
		$this->db->select('u.id AS id, u.firstname AS firstname, u.lastname AS lastname');
		$this->db->from('users u');
		$this->db->join('groups g', 'g.id = u.group_id', 'left');
		if (isset($args['group'])) {
			$this->db->where('u.group_id', $args['group']);
			$this->db->or_where('LOWER(g.slug)', strtolower($args['group']));
		}
		$this->db->where('u.banned', 0);
		
		$query = $this->db->get();
		$result = $query->result_array();	
		$list = array();
		foreach ($result as $row) {
			$list[$row['id']] = $row['firstname'].' '.$row['lastname'];
		}		
		return $list;
	}
	
	public function get_ajax($data) {
	
		$qColumns = array('u.id AS id', 'u.firstname AS firstname', 'u.lastname AS lastname', 'u.username AS username', 'u.email AS email', 'u.activated AS activated', 'u.last_login AS last_login', 'u.created AS created', 'u.modified AS modified', 'u.banned AS banned', 'g.id AS group_id', 'g.slug AS group_slug', 'up.mobile AS mobile');
		$sColumns = array('u.id', 'u.firstname', 'u.lastname', 'u.username', 'u.email', 'u.activated', 'u.last_login', 'u.created', 'u.modified', 'u.banned', 'g.id', 'g.slug', 'up.mobile');
		
		$sIndexColumn = "u.id";
		
		$sTable  = " users u LEFT JOIN groups g ON g.id = u.group_id, user_profiles up";
		$sWhere2 = " up.user_id = u.id ";
		
		if (isset($data['group'])) $sWhere2 .= " AND g.slug ='".$data['group']."' ";		
		if (isset($data['banned']) && !isset($data['show_all'])) $sWhere2 .= " AND u.banned = ".($data['banned'] ? 1 : 0);
		if (isset($data['activated']) && !isset($data['show_all'])) $sWhere2 .= " AND u.activated = ".($data['activated'] ? 1 : 0);
		
		$sOrder = "ORDER BY u.id DESC";

		$sLimit = "";
		if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
			$sLimit = "LIMIT ".intval($_GET['iDisplayStart']).", ".intval($_GET['iDisplayLength']);
		}
		
		if (isset($_GET['iSortCol_0'])) {
			$sOrder = "ORDER BY  ";
			for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
				if ($_GET['bSortable_'.intval($_GET['iSortCol_'.$i])] == "true") {
					$sOrder .= $sColumns[intval($_GET['iSortCol_'.$i])]." ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
				}
			}
			
			$sOrder = substr_replace($sOrder, "", -2);
			if ($sOrder == "ORDER BY") {
				$sOrder = "";
			}
		}
		
		$sWhere = "";
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
			$sWhere = "WHERE (";
			for ($i = 0; $i < count($sColumns); $i++) {
				$sWhere .= $sColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch'])."%' OR ";
			}
			$sWhere = substr_replace($sWhere, "", -3);
			$sWhere .= ')';
		}
		
		for ($i = 0; $i < count($sColumns); $i++) {
			if (isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '') {
				if ($sWhere == "") {
					$sWhere = "WHERE ";
				} else {
					$sWhere .= " AND ";
				}
				$sWhere .= $sColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		
		if ($sWhere) {
			$sWhere3 = " AND ".$sWhere2;
		} else {
			$sWhere3 = " WHERE ".$sWhere2;
		}
		
		$query = $this->db->query("SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $qColumns))." FROM $sTable $sWhere $sWhere3 $sOrder $sLimit");
		
		$queryFilterTotal = $this->db->query("SELECT FOUND_ROWS() AS total");
		$resultFilterTotal = $queryFilterTotal->row_array();
		$iFilteredTotal = $resultFilterTotal['total'];
		
		$queryTotal = $this->db->query("SELECT COUNT(".$sIndexColumn.") AS count FROM $sTable WHERE $sWhere2");
		$resultTotal = $queryTotal->row_array();
		$iTotal = $resultTotal['count'];
		
		$output = array(
			"sEcho" => isset($_GET['sEcho']) ? intval($_GET['sEcho']) : 0,
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);
		
		foreach ($query->result_array() as $user) {
			$row = array();
			$row[] = $user['firstname'].' '.$user['lastname'];
			$row[] = $user['email'];
			
			$action	 = '';
		//	$action .= $data['update_user_privilege'] ? anchor('privileges/manage/user/'.$user['id'], 'Privileges') : '';
			$action .= $data['update_user'] ? update_btn('users/'.$data['group'].'/update/'.$user['id']) : '';
			if ($user['banned'] == '1') {
				$action .= $data['delete_user'] ? undelete_btn('users/'.$data['group'].'/unban/'.$user['id']) : '';
			} else {
				$action .= $data['delete_user'] ? delete_btn('users/'.$data['group'].'/delete/'.$user['id']) : '';
			}
			$row[] = $action;
			$output['aaData'][] = $row;
		}
		
		echo json_encode($output);		
	}
	
	function search_users ($args=array()) {
		
		foreach ($args as $key=>$arg) $args[$key] = ($arg == '-') ? '' : $arg;
		
		$sql_name = array();
		if (isset($args['name']) && $args['name']) {
			if ($args['name'] != 'all') {
				$name = explode('-', $args['name']);
				$name = array_filter($name, 'strlen');
				array_walk($name, create_function('&$val', '$val = trim($val);')); 
				array_walk($name, create_function('&$val', '$val = strtolower($val);')); 
				
				foreach ($name as $str) {
					$sql_name[] = '(LOWER(u.firstname) LIKE "%'.$str.'%" OR LOWER(u.lastname) LIKE "%'.$str.'%")';
				}
			}
		}
		
		$sql  = 'SELECT SQL_CALC_FOUND_ROWS ';
		$sql .= 'u.id AS id, u.firstname AS firstname, u.lastname AS lastname, u.group_id AS group_id, ';
		//$sql .= 'up.address AS location, up.position AS position, up.thumbnail AS thumbnail, ';
		//$sql .= 'um_batch.value AS batch, c.name AS course ';
		if (count($sql_name)) {
			$relevance = array();
			foreach ($sql_name as $str) {
				$relevance[] = '(CASE WHEN '.$str.' THEN 1 ELSE 0 END)';
			}
			$sql .= ', ('.implode(' + ', $relevance).') AS relevance ';
		}
		$sql .= 'FROM ';
		$sql .= 'users u, user_profiles up';
		$sql .= 'WHERE ';
		$sql .= 'u.id = up.user_id ';
		$sql .= 'AND u.banned = 0 AND u.activated = 1 ';
		if (count($sql_name)) {
			$where_name = array();
			foreach ($sql_name as $str) {
				$where_name[] = $str;
			}
			$sql .= 'AND ('.implode(' OR ', $where_name).') ';
		}
		$sql .= 'ORDER BY ';
		if (count($sql_name)) {
			$sql .= 'relevance DESC, ';
		}
		$sql .= 'u.last_login DESC ';
		if (isset($args['limit']) && $args['limit']) $sql .= 'LIMIT '.((isset($args['offset']) && $args['offset']) ? (int) $args['offset'] : 0).', '.$args['limit'].' ';
		
				
		$query = $this->db->query($sql);
		$result = $query->result_array();
		
		$queryTotal = $this->db->query("SELECT FOUND_ROWS() AS total");
		$resultTotal = $queryTotal->row_array();
		$total = $resultTotal['total'];
		
		$result = array('total'=>$total, 'data'=>$result);		
		return $result;	
	}

	function get_user_by_id($user_id, $activated) {
		
		return $this->user_model->get(array('id'=>$user_id, 'activated'=>$activated, 'return'=>'object'));
	}

	function get_user_by_login($login) {
		
		return $this->user_model->get(array('login'=>$login, 'return'=>'object'));
	}

	function get_user_by_username($username) {
		
		return $this->user_model->get(array('username'=>$username, 'return'=>'object'));
	}

	function get_user_by_email($email) {
		 
		return $this->user_model->get(array('email'=>$email, 'return'=>'object'));
	}

	function is_username_available($username) {
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(username)=', strtolower($username));

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 0;
	}

	function is_email_available($email) {
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(email)=', strtolower($email));
		$this->db->or_where('LOWER(new_email)=', strtolower($email));

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 0;
	}

	function create_user($data, $activated = TRUE, $profile, $meta) {
		$data['created'] = date('Y-m-d H:i:s');
		$data['activated'] = $activated ? 1 : 0;

		if ($this->db->insert($this->table_name, $data)) {
			$user_id = $this->db->insert_id();
			$this->create_profile($user_id, $profile);
			$this->update_user_meta($user_id, $meta);
			return array('user_id' => $user_id);
		}
		return NULL;
	}
	
	function update_user($user_id, $data, $profile, $meta) {
		
		if (!is_null($data)) {
			$this->db->where('id', $user_id);
			$this->db->update($this->table_name, $data);
		}
		$this->update_profile($user_id, $profile);
		$this->update_user_meta($user_id, $meta);
	}
	
	/*function insert_user_details($details) {
		$this->db->insert('user_details', $details);
		return;
	}
	*/
	function activate_user($user_id, $activation_key, $activate_by_email) {
		$this->db->select('1', FALSE);
		$this->db->where('id', $user_id);
		if ($activate_by_email) {
			$this->db->where('new_email_key', $activation_key);
		} else {
			$this->db->where('new_password_key', $activation_key);
		}
		$this->db->where('activated', 0);
		$query = $this->db->get($this->table_name);

		if ($query->num_rows() == 1) {

			$this->db->set('activated', 1);
			$this->db->set('new_email_key', NULL);
			$this->db->where('id', $user_id);
			$this->db->update($this->table_name);

			return TRUE;
		}
		return FALSE;
	}

	function purge_na($expire_period = 172800) {
		$this->db->where('activated', 0);
		$this->db->where('UNIX_TIMESTAMP(created) <', time() - $expire_period);
		$this->db->delete($this->table_name);
	}

	function delete_user($user_id) {
		$this->db->where('id', $user_id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) {
			$this->delete_profile($user_id);
			return TRUE;
		}
		return FALSE;
	}

	function set_password_key($user_id, $new_pass_key) {
		$this->db->set('new_password_key', $new_pass_key);
		$this->db->set('new_password_requested', date('Y-m-d H:i:s'));
		$this->db->where('id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	function can_reset_password($user_id, $new_pass_key, $expire_period = 900) {
		$this->db->select('1', FALSE);
		$this->db->where('id', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >', time() - $expire_period);

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 1;
	}

	function reset_password($user_id, $new_pass, $new_pass_key, $expire_period = 900) {
		$this->db->set('password', $new_pass);
		$this->db->set('new_password_key', NULL);
		$this->db->set('new_password_requested', NULL);
		$this->db->where('id', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >=', time() - $expire_period);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	function change_password($user_id, $new_pass) {
		$this->db->set('password', $new_pass);
		$this->db->where('id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	function set_new_email($user_id, $new_email, $new_email_key, $activated) {
		$this->db->set($activated ? 'new_email' : 'email', $new_email);
		$this->db->set('new_email_key', $new_email_key);
		$this->db->where('id', $user_id);
		$this->db->where('activated', $activated ? 1 : 0);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	function activate_new_email($user_id, $new_email_key) {
		$this->db->set('email', 'new_email', FALSE);
		$this->db->set('new_email', NULL);
		$this->db->set('new_email_key', NULL);
		$this->db->where('id', $user_id);
		$this->db->where('new_email_key', $new_email_key);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	function update_login_info($user_id, $record_ip, $record_time) {
		$this->db->set('new_password_key', NULL);
		$this->db->set('new_password_requested', NULL);

		if ($record_ip)		$this->db->set('last_ip', $this->input->ip_address());
		if ($record_time)	$this->db->set('last_login', date('Y-m-d H:i:s'));

		$this->db->where('id', $user_id);
		$this->db->update($this->table_name);
	}

	function ban_user($user_id, $reason = NULL)	{
		$this->db->where('id', $user_id);
		$this->db->update($this->table_name, array(
			'banned'		=> 1,
			'ban_reason'	=> $reason,
		));
	}

	function unban_user($user_id) {
		$this->db->where('id', $user_id);
		$this->db->update($this->table_name, array(
			'banned'		=> 0,
			'ban_reason'	=> NULL,
		));
	}
	
	private function create_profile($user_id, $profile=array()) {
		$profile['user_id'] = $user_id;
		return $this->db->insert($this->profile_table_name, $profile);
	}
	
	private function update_profile($user_id, $profile=array()) {	
		$this->db->where('user_id', $user_id);
		return $this->db->update($this->profile_table_name, $profile);
	}
	
	function update_details($user_id, $details=array()) {	
		$this->db->where('user_id', $user_id);
		return $this->db->update('user_details', $details);
	}
	
	function get_user_meta($user_id) {
		
		$this->db->select('um.id AS id, um.meta_id AS meta_id, um.value AS value, m.key AS meta_key, m.name AS meta_name');
		$this->db->from('user_meta um, meta m');
		$this->db->where('um.meta_id = m.id');
		$this->db->where('um.user_id', $user_id);
		$query = $this->db->get();
		$meta = array();
		if ($query->num_rows()) {
			foreach ($query->result_array() as $row) {
				$meta[$row['meta_key']] = $row;
			}
			return $meta;
		} else {
			return FALSE;
		}
	}
	
	private function update_user_meta($user_id, $meta=array()) {
	
		if(isset($meta) && is_array($meta)) {
			foreach ($meta as $meta_id => $value) {
				$this->db->from('user_meta');
				$this->db->where('user_id', $user_id);
				$this->db->where('meta_id', $meta_id);
				$query = $this->db->get();
				if ($query->num_rows() == 1) {
					$data = array(
						'value' => $value,
					);	
					$this->db->where('user_id', $user_id);
					$this->db->where('meta_id', $meta_id);
					$this->db->update('user_meta', $data);	
				} else {	
					$data = array(
						'user_id' => $user_id,
						'meta_id' => $meta_id,
						'value' => $value,
					);	
					$this->db->insert('user_meta', $data);	
				}
			}
		}
		return;
	}

	private function delete_profile($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->profile_table_name);
	}
	
	function get_user_preferences($user_id) {
		
		$user = $this->user_model->get(array('id'=>$user_id));		
		$preferences = $this->options->get_preferences($user['group_slug']);
		
		$this->db->from('user_preferences');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		
		$user_preferences = array();
		if ($query->num_rows()) {
			$row = $query->row_array();
			$user_preferences = unserialize($row['preferences']);
		}	
		
		foreach ($preferences as $id=>$preference) {
			if (!isset($user_preferences[$preference['key']])) {
				$user_preferences[$preference['key']] = $preference['default'];
			}
		}
		
		return $user_preferences;		
	}
	
	function get_fullname($user_id)
	{	
		$user = $this->user_model->get(array('id'=>$user_id, 'return'=>'object'));
		return $user->firstname." ".$user->lastname;
	}
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */
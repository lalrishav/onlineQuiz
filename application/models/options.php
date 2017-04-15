<?php

Class Options extends CI_Model {

	public $settings = array();
	
	public function __construct() {
		parent::__construct();

		$query = $this->db->query('SELECT * FROM settings');
		foreach ($query->result_array() as $row) {
			$this->settings[$row['slug']] = $row['value'];
		}
		
	}
	
	public function get_settings() {
		
		$this->db->from('settings');		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function update_settings() {
		
		$this->db->from('settings');		
		$query = $this->db->get();
		$result = $query->result_array();
		
		foreach ($result as $row) { 
			$data = array(
				'value' => $this->input->post($row['name']),
			);		
			$this->db->where('slug', $row['slug']);
			$this->db->update('settings', $data);
		}		
		return;
	}
	
	public function get_meta($group = '') {
		
		if ($group) {
			$group = $this->group_model->get(array('slug' => $group));
			$group = $group['id'];
		}
		
		$this->db->from('meta');
		$this->db->where('flag', 1);
		$query = $this->db->get();
		$list = array();
		if ($group) {
			foreach ($query->result_array() as $row) {
				if (in_array($group, unserialize($row['groups']))) {
					$list[] = $row;
				}
			}
			return $list;
		} else {
			return $query->result_array();
		}
	}
	
	public function get_preferences($group = '') {
		
		if ($group) {
			$group = $this->group_model->get(array('slug' => $group));
			$group = $group['id'];
		}
		
		$this->db->from('preferences');
		$this->db->where('flag', 1);
		$query = $this->db->get();
		$list = array();
		foreach ($query->result_array() as $row) {
			if ($group) {
				if (in_array($group, unserialize($row['groups']))) {
					$list[$row['id']] = $row;
				}
			} else {
				$list[$row['id']] = $row;
			}
		}
		
		foreach ($list as $key=>$row) {
			$options_list = explode("\n", $row['options']);
			$options = array();
			foreach ($options_list as $option) {
				$option = explode(":", $option);
				$options[$option[0]] = $option[1];
			}
			$list[$key]['options'] = $options;
		}
	//	print_r($list);
		return $list;
	}

}
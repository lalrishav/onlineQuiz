<?php

Class Log_model extends CI_Model {

	public function __construct() {
		parent::__construct();

	}
	
	public function get($args=array()) {
		
		$this->db->select('p.*, u.firstname, u.lastname');
		$this->db->from('logs p');
		$this->db->join('users u', 'p.user_id = u.id', 'left');
		if (isset($args['id'])) $this->db->where('p.id', $args['id']);
		if (isset($args['action'])) $this->db->where('p.action', $args['action']);
		$this->db->order_by('time', 'desc');
		
		$query = $this->db->get();
		if ($query->num_rows() > 1 || isset($args['multiple'])) {
			return $query->result_array();		
		} elseif ($query->num_rows() == 1) {
			return $query->row_array();
		} else {
			return FALSE;
		}	
	}
	
	public function get_ajax() {

		$qColumns = array('l.id', 'l.time AS time', 'l.user_id AS user_id', 'u.firstname AS firstname', 'u.lastname AS lastname', 'l.action AS action', 'l.data AS data', 'l.ip AS ip', 'l.user_agent AS user_agent', 'u.group_id AS group_id');
		$sColumns = array('l.id', 'l.time', 'l.user_id', 'u.firstname', 'u.lastname', 'l.action', 'l.data', 'l.ip', 'l.user_agent', 'u.group_id');
		
		$sIndexColumn = "l.id";
		
		$sTable  = " logs l, users u ";
		$sWhere2 = " l.user_id = u.id ";
		
		$sLimit = "";
		if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
			$sLimit = "LIMIT ".intval($_GET['iDisplayStart']).", ".intval($_GET['iDisplayLength']);
		}
		
		$sOrder = "";
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
		} else {
			$sOrder = "ORDER BY time desc";
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
		
		foreach ($query->result_array() as $log) {
			$row = array();
			$row[] = date("Y-m-d H:i:s", $log['time']);
			$row[] = $log['firstname'].' '.$log['lastname'].' (#'.$log['user_id'].')';
			$row[] = '<span title="'.$log['user_agent'].'">'.$log['ip'].'</span>';
			$row[] = $log['action'];
			
			$output['aaData'][] = $row;
		}
		
		echo json_encode($output);		
	}
	
	public function create_log($data) {
			
		return $this->db->insert('logs', $data);
	}
	
}

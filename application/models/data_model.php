<?php

Class Data_model extends CI_Model {

	public $groups = array();
	public $states = array();
	public $communication = array();
	public $user_types =array();

	public function __construct() {
		parent::__construct();
		
		$groups = $this->group_model->get(array('multiple'=>true));
		if ($groups) {
			foreach ($groups as $group) {
				$this->groups[$group['id']] = $group;
				$this->groups[$group['slug']] = $group;
			}
		}
		
		$this->states = array(
								'AP' => 'Andhra Pradesh', 
								'AN' => 'Andaman and Nicobar Islands',
								'AR' => 'Arunachal Pradesh', 
								'AS' => 'Assam', 
								'BR' => 'Bihar', 
								'CH' => 'Chandigarh',
								'CT' => 'Chhattisgarh', 
								'DL' => 'Delhi',
								'GA' => 'Goa', 
								'GJ' => 'Gujarat', 
								'HR' => 'Haryana', 
								'HP' => 'Himachal Pradesh', 
								'JK' => 'J &amp; K', 
								'JH' => 'Jharkhand', 
								'KA' => 'Karnataka', 
								'KL' => 'Kerala', 
								'MP' => 'Madhya Pradesh', 
								'MH' => 'Maharashtra', 
								'MN' => 'Manipur', 
								'ML' => 'Meghalaya', 
								'MZ' => 'Mizoram', 
								'NL' => 'Nagaland', 
								'OR' => 'Orissa', 
								'PB' => 'Punjab', 
								'RJ' => 'Rajasthan', 
								'SK' => 'Sikkim', 
								'TN' => 'Tamil Nadu', 
								'TR' => 'Tripura', 
								'UP' => 'Uttar Pradesh', 
								'UT' => 'Uttarakhand', 
								'WB' => 'West Bengal',
								'DN' => 'Dadra and Nagar Haveli',
								'DD' => 'Daman and Diu',
								'LD' => 'Lakshadweep',
								'PY' => 'Puducherry',
							);
		$this->user_types = array(
								'student'	=>	'Student'
							);
		
		$this->courses = array(
								'BE' => 'BE',
								'MCA' => 'MCA',
								'IPH' => 'IPH',
								'IMH' => 'IMH',
								'ICH' => 'ICH'
							);
		$this->answer = array(
								'1'=>'1',
								'2'=>'2',
								'3'=>'3',
								'4'=>'4'
							);
		$this->rating=array(
			            'NULL'=>'Rate Us',
                        '1'=>'1',
                        '2'=>'2',
                        '3'=>'3',
                        '4'=>'4',
                        '5'=>'5',
                        '6'=>'6',
                        '7'=>'7',
                        '8'=>'8',
                        '9'=>'9',
                        '10'=>'10'
			);
		$this->batches = array(
								'2k16' => '2k16',
								'2k15' => '2k15',
								'2k14' => '2k14',
								'2k13' => '2k13',
								'2k12' => '2k12',
								'2k11' => '2k11',
								'2k10' => '2k10'
							);
		$this->branches = array(
								'ECE' => 'ECE',
								'CSE' => 'CSE',
								'IT' => 'IT',
								'EEE' => 'EEE',
								'Other' => 'Other'
							);
		
		// APPEND DATA MODEL HERE
	}	
	
	function get_form_fields_list() {
		
		$list = array();
		foreach ($this->form_fields as $key=>$field) {
			$list[$key] = $field['name'];
		}
		return $list;
	}
	
	function get_form_fields_json() {
		
		$list = array();
		foreach ($this->form_fields as $key=>$field) {
			$list[] = array('key'=>$key) + $field;
		}
		return json_encode($list);
	}
}
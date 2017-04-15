<?php

Class Menu extends CI_Model {

	public $pages = array();
	
	public function __construct() {
		parent::__construct();
		
		$this->pages['dashboard'] = array(
							'name'  		=> 'Dashboard',
							'link' 			=> 'home',
							'class' 		=> 'dash',
							'privilege' 	=> 'admin',
						);
		$this->pages['users'] = array(
							'name'			=> 'Users',
							'link' 			=> 'users',
							'class' 		=> 'login',
							'privilege' 	=> 'user',
						);
		$groups = $this->group_model->get_list(array('key'=>'slug', 'level'=>$this->tank_auth->get_group('level')));
		foreach ($groups as $key=>$name) {
			$this->pages['users']['sub'][$key] = array(
						'name' => $name,
						'link' => $key,
					);
		}
		$this->pages['groups'] = array(
							'name' 			=> 'Groups',
							'link' 			=> 'groups',
							'class' 		=> 'contacts',
							'privilege' 	=> 'create_paper',
						);
		$this->pages['privileges'] = array(
							'name' 			=> 'Privileges',
							'link' 			=> 'privileges',
							'class' 		=> 'typo',
							'privilege' 	=> 'create_paper',
						);
		$this->pages['papers'] = array(
							'name' 			=> 'Papers',
							'link' 			=> 'papers',
							'class' 		=> 'typo',
							'privilege' 	=> 'user',
						);
		/*$this->pages['solutions'] = array(
							'name' 			=> 'Solutions',
							'link' 			=> 'papers',
							'class' 		=> 'typo',
							'privilege' 	=> 'user',
						);
						*/
		$this->pages['aboutus'] = array(
							'name' 			=> 'About Us',
							'link' 			=> 'aboutus',
							'class' 		=> 'typo',
							'privilege' 	=> 'user',
						);
		
		/*$this->pages['notifications'] = array(
							'name' 			=> 'Notifications',
							'link' 			=> 'notifications',
							'class' 		=> 'typo',
							'privilege' 	=> 'notification',
						);	*/
	}
		
}
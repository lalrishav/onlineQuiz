<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cron {

	function __construct() {
		$this->ci =& get_instance();
		
		$this->ci->load->model('cron_model');
	}

	function start($args=array()) {
		
		$data = array(
						'job'		=>	$args['job'],
						'start'		=>	time(),
					);
		
		$id = $this->ci->cron_model->create($data);
		return $id;
	}
	
	function end($args=array()) {
		
		$data = array(
						'end'		=>	time(),
					);
		
		$this->ci->cron_model->update($args['id'], $data);
	}
	
	function last($args=array()) {
		
		$cron = $this->ci->cron_model->get(array('job'=>$args['job'], 'limit'=>1));
		if ($cron === FALSE) {
			$cron = array();
			$cron['start'] = 0;
			$cron['end'] = 0;
		}
		
		return $cron;
	}
	
}
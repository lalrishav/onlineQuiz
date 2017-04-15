<?
class Extract extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	 function paper_info($pid)
	{
       $this->db->from('papers');
        $get=$this->db->get();
        return $get->result();
	}
}
?>
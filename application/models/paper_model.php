<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
flag : 
0- deleted
1- inactive
2- active
*/
class Paper_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function get_list($args=array())
	{
		$paper =  array();
		$this->db->select('*');
		$this->db->from('papers');
		if (isset($args['pid'])) $this->db->where('pid', $args['pid']);
		if (isset($args['flag']))
			$this->db->where('flag', $args['flag']);
		else
			$this->db->where('flag !=', 0);
		if (isset($args['subject'])) $this->db->like('subject', $args['subject']);
		//add more for filtering
		
		$query = $this->db->get();
		if ($query->num_rows() >= 1)
		{
			return $query->result_array();		
		}
		else
		{
			return FALSE;
		}		
	}
	
	function get_paper($id, $args=array()) 
	{
		$this->db->select('*');
		$this->db->from('papers');
		$this->db->where('pid', $id);
		
		$this->db->where('flag >= ', 0);
		//if (isset($args['flag']))
		//	$this->db->where('flag', $args['flag']);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	function get_submit($pid, $args=array())
	{
		$this->db->select('s.user_id AS user_id, s.score AS score, s.rank AS rank, s.rank_batch AS rank_batch,u.firstname AS firstname, u.lastname AS lastname, u.email AS email');
		$this->db->from('submit_log s');
		$this->db->join('users u', 'u.id = s.user_id', 'left');
		
		
		$this->db->where('s.pid', $pid);
		
		$this->db->where('s.flag', 1);
		$this->db->order_by('s.rank', 'asc');
		//if (isset($args['flag']))
		//	$this->db->where('flag', $args['flag']);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_fullpaper($id, $args=array()) 
	{
	//disable view if time not started
		$data = array();
		$this->db->select('*');
		$this->db->from('papers');
		$this->db->where('pid', $id);
	
		$this->db->where('flag >= ', 1);
		$query = $this->db->get();
		$data['paper'] = $query->row_array();
		$data['questions'] = array();
		$pid = $data['paper']['pid'];
		//get questions flush query
		$qids = $this->get_qids($pid);
		foreach($qids as $row)
		{
			$data['questions'][$row['qid']] = array();
			$this->db->from('questions');
			$this->db->where('qid', $row['qid']);
			//$this->db->where('flag', 1);
			$query = $this->db->get();
			$data['questions'][$row['qid']] = $query->row_array();
		}
		return $data;
	}
	
	private function get_qids($pid)
	{
		$this->db->select('*');
		$this->db->from('paper_questions');
		$this->db->where('pid', $pid);
		$this->db->where('flag', 1);
		//flag redundancy check
		$query = $this->db->get();
		$qids = $query->result_array();
		return $qids;
	}	
	
	function create_paper($data)
	{
	//data['paper']
	//data['questions']
	//transaction start
	//check questions
	//REMOVE ID and STAMPS
		$pid = $this->db->insert('papers', $data['paper']);	
		foreach($data['questions'] as $q)
		{
			$this->db->insert('questions', $q);
			$qid = $this->insert_id();
			$this->db->insert('paper_questions', array('pid'=> $pid, 'qid'=> $qid, 'flag'=> 1));
		}
		//foreach question add, update paper_questions also.
		return;
	//transaction end
	}
	
	function update_paper($id, $data) //to update paper details only
	{
		$this->db->where('pid', $id);
		$this->db->update('papers', $data);	
		return;
	}
	
	function update_question($id, $data)
	{
		$this->db->where('qid', $id);
		$this->db->update('questions', $data);
		return;
	}
	
	function delete_paper($id)
	{
		$this->db->set('flag', 0);
		$this->db->where('id', $id);
		return $this->db->update('papers');
		//delete questions if required
	}
	
	//function get_answers()
	
	function submit_answers($pid, $answers, $flag=1)
	{		
		//if submission already exists flag 0 it
		
		//end check
		$submit_log = array(
							'user_id'	=> $this->tank_auth->get_user_id(),
							'pid'		=> $pid,
							'attempted'	=> count($answers),
							'flag'		=> $flag
							);
		$this->db->insert('submit_log', $submit_log);
		$submit_id = $this->db->insert_id();
		//$answers is array of answers with qid and ans in each
		//$ans has 'qid' and 'ans'
		//check blank answer submission
		foreach($answers as $ans)
		{
			$ans['submit_id'] = $submit_id;
			$this->db->insert('user_answer', $ans);
		}
		return;
	}
	
	function has_submitted($pid, $user_id)
	{
		$this->db->select('id');
		$this->db->from('submit_log');
		$this->db->where('pid', $pid);
		$this->db->where('user_id', $user_id);
		$this->db->where('flag >=', 1);
		$query = $this->db->get();
		return $query->row();
	}
	
	function submit_feedback($args)
	{
		return $this->db->insert('feedback', array('user_id'=> $this->tank_auth->get_user_id(), 'message'=>$args['message'], 'rating'=>$args['rating'], 'flag'=>1));
	}
	function has_submitted_feedback($user_id)
	{
		$this->db->select('id');
		$this->db->from('feedback');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return count($query->row());
	}
	
	function calculate_score($pid)
	{
		//get qids (answers and marks along)
		//foreach submission id retrieve answers sumitted
			//for each answer submitted, check from original qids answers
		//
		$qids = $this->get_qids($pid);
		$questions = array();
		foreach($qids as $q)
		{
			$questions[$q['qid']] = array();
			$this->db->select('qid, answer, marks');
			$this->db->from('questions');
			$this->db->where('qid', $q['qid']);
			//$this->db->where('flag', 1);
			$query = $this->db->get();
			$questions[$q['qid']] = $query->row_array();
		}
		//questions fetched with answers and marks
		
		$this->db->select('id');
		$this->db->from('submit_log');
		$this->db->where('pid', $pid);
		$this->db->where('flag', 1);
		$query = $this->db->get();
		$submit_ids = $query->result_array();
		//submit ids fetched
		//print_r($submit_ids);
		foreach($submit_ids as $sid)
		{
			//SID is the key :*
			$this->db->select('qid, ans');
			$this->db->from('user_answer');
			$this->db->where('submit_id', $sid['id']);
			$query = $this->db->get();
			$answers = $query->result_array();
			//retrieve answers against SID
			$marks = 0;
			foreach($answers as $answer)
			{

				if($answer['ans'] == $questions[$answer['qid']]['answer'])
				{
					$marks = $marks + $questions[$answer['qid']]['marks'];
				}
				else
				{
					if($questions[$answer['qid']]['answer'] != 0)
						$marks = $marks - 1;
				}
			}
			//$marks obtained
			
			$this->db->set('score', $marks);
			$this->db->where('id', $sid['id']);
			$this->db->update('submit_log');
			//update submit_log with marks
		}		
	}
	
	function calculate_rank($pid)
	{
		$this->db->select('*');
		$this->db->from('submit_log');
		$this->db->where('pid', $pid);
		$this->db->where('flag', 1);
		$this->db->order_by('score', 'desc');
		$this->db->order_by('submit_time', 'asc');
		$this->db->order_by('attempted', 'asc');
		$query = $this->db->get();
		$ranks = $query->result_array();
		$i = 1;
		foreach($ranks as $rank)
		{
			$rank['rank'] = $i;
			$i++;
		
			$this->db->set('rank', $rank['rank']);
			$this->db->where('id', $rank['id']);
			$this->db->update('submit_log');
			//update submit_log with marks
		}	
		
		
		return $ranks;
	}
	
	function calculate_rank_batch($pid)
	{
		$this->db->select('s.id AS id, s.user_id AS user_id, s.rank AS rank, up.roll3 AS batch');
		//$this->db->select('*');
		$this->db->from('submit_log s');
		$this->db->join('user_profiles up', 'up.user_id = s.user_id', 'left');
		$this->db->where('s.pid', $pid);
		$this->db->where('s.flag', 1);
		$this->db->order_by('up.roll3', 'desc');
		$this->db->order_by('s.rank', 'asc');
		$query = $this->db->get();
		$batch_ranks = $query->result_array();
		foreach($batch_ranks as $rank)
		{
			if(!isset($rank['batch'])) continue;
			if(!isset($batch[$rank['batch']]))
				$batch[$rank['batch']] = 1;
			
			$rank['rank_batch'] = $batch[$rank['batch']];
			$batch[$rank['batch']]++;
		
			$this->db->set('rank_batch', $rank['rank_batch']);
			$this->db->where('id', $rank['id']);
			$this->db->update('submit_log');
			//update submit_log with marks
		}
		
		return $batch_ranks;
	}
	
	function get_scores_by_user_id($user_id)
	{
		$this->db->select('pid, score');
		$this->db->from('submit_log');
		$this->db->where('user_id', $user_id);
		$this->db->where('flag', 1);
		$query = $this->db->get();
		$scores = $query->result_array();
		$ans = array();
		foreach($scores as $score)
		{
			$ans[$score['pid']] = $score['score'];
		}
		return $ans;
	}
	
	function update_answer($userid, $pid, $answers)
	{
		//each ans should have id
		foreach($answers as $ans)
		{
			$ans['pid'] = $pid;
			$ans['userid'] = $userid;
			$this->db->where('id', $ans['id']);
			$this->db->update('user_answer', $ans);
		}
		return;	
	}
}
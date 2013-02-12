<?php

class Hl_tasks_model extends CI_Model
{

  function __construct ()
  {
	parent::__construct();
  }

  function add_hl_task ($data)
  {
	$logged_in_uid = $this->engineinit->_get_session_uid();

	if (DBTYPE == 'db')
	{
	  $insert_new = $this->db->insert('data_hl_tasks', $data);
	  $last_id = $this->db->insert_id();
	  // array for log inserting.
	  $new_log_data = array(
		  'uid' => $logged_in_uid,
		  'item_id' => $last_id,
		  'item_type' => 'hl_task',
		  'item_title' => $data['name'],
		  'addedtime' => time()
	  );

	  if ($insert_new)
	  {
		// adding to log table - timeline
		$insert_new_log = $this->db->insert('data_timeline', $new_log_data);
	  }

	  if ($insert_new && $insert_new_log)
	  {
		return TRUE;
	  }
	  else
	  {
		return FALSE;
	  }
	}
  }

  function hltasks_count_by_estid_phase ($estid, $phase)
  {
	if (DBTYPE == 'db')
	{
	  $this->db->where('estid', $estid);
	  $this->db->where('phase', $phase);
	  $this->db->from('data_hl_tasks');
	  return $this->db->count_all_results();
	}
  }

  function get_hltasks_by_estid_phase ($estid, $phase)
  {
	if (DBTYPE == 'db')
	{
	  $this->db->where('estid', $estid);
	  $this->db->where('phase', $phase);
	  $this->db->from('data_hl_tasks');
	  $query = $this->db->get();
	  if ($query->num_rows >= 1)
	  {
		return $query->result_array();
	  }
	}
  }

  function get_hltasks_by_estid ($estid)
  {
	if (DBTYPE == 'db')
	{
	  $this->db->where('estid', $estid);
	  $this->db->from('data_hl_tasks');
	  $query = $this->db->get();
	  if ($query->num_rows >= 1)
	  {
		return $query->result_array();
	  }
	}
  }

}
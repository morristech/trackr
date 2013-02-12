<?php

class Estimations_model extends CI_Model
{

  function __construct ()
  {
	parent::__construct();
  }

  function estimations_count_by_pid ($pid)
  {
	if (DBTYPE == 'db')
	{
	  $this->db->where('pid', $pid);
	  $this->db->from('data_estimations');
	  return $this->db->count_all_results();
	}
  }

  function add_estimation ($data)
  {
	$logged_in_uid = $this->engineinit->_get_session_uid();

	if (DBTYPE == 'db')
	{
	  $insert_new = $this->db->insert('data_estimations', $data);
	  $last_id = $this->db->insert_id();
	  // array for log inserting.
	  $new_log_data = array(
		  'uid' => $logged_in_uid,
		  'item_id' => $last_id,
		  'item_type' => 'estimation',
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

  function get_estimations ($limit, $start, $pid)
  {
	if (DBTYPE == 'db')
	{
	  $this->db->select("data_estimations.estid, data_estimations.name, data_estimations.duration, data_estimations.resources, data_estimations.created_date, data_estimations.hours, data_estimations.cost, data_estimations.status_active, data_projects.name as project_name, data_projects.pid as project_id");
	  $this->db->from('data_projects');
	  $this->db->join('data_estimations', 'data_projects.pid = data_estimations.pid');
	  $this->db->where('data_estimations.deleted', 0);
	  $this->db->where('data_estimations.pid', $pid);
	  $this->db->order_by("data_estimations.created_date", "desc");
	  $this->db->limit($limit, $start);
	  $query = $this->db->get();
	  if ($query->num_rows >= 1)
	  {
		return $query->result_array();
	  }
	}
  }

  function estimation_by_estid ($estid)
  {
	if (DBTYPE == 'db')
	{
	  $this->db->select("data_estimations.estid, data_estimations.name, data_estimations.duration, data_estimations.resources, data_estimations.created_date, data_estimations.hours, data_estimations.cost, data_estimations.status_active, data_projects.name as project_name, data_projects.pid as project_id");
	  $this->db->from('data_projects');
	  $this->db->join('data_estimations', 'data_projects.pid = data_estimations.pid');
	  $this->db->where('data_estimations.deleted', 0);
	  $this->db->where('data_estimations.estid', $estid);
	  $query = $this->db->get();
	  if ($query->num_rows >= 1)
	  {
		return $query->row_array();
	  }
	}
  }

  function update_estimation ($data)
  {
	if (DBTYPE == 'db')
	{
	  $this->db->where('estid', $data['estid']);
	  return $this->db->update('data_estimations', $data);
	}
  }

}
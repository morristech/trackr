<?php

class Companies_model extends CI_Model
{

  function __construct ()
  {
	parent::__construct();
  }

  function get_companies ($limit, $start)
  {
	if (DBTYPE == 'db')
	{
	  $this->db->select("*");
	  $this->db->from('data_companies');
	  $this->db->where('deleted', 0);
	  $this->db->order_by("created_date", "desc");
	  $this->db->limit($limit, $start);
	  $query = $this->db->get();
	  if ($query->num_rows >= 1)
	  {
		return $query->result_array();
	  }
	}
  }

  function companies_count ()
  {
	if (DBTYPE == 'db')
	{
	  $this->db->from('data_companies');
	  return $this->db->count_all_results();
	}
  }

  function add_company ($data)
  {
	$logged_in_uid = $this->engineinit->_get_session_uid();

	if (DBTYPE == 'db')
	{
	  $insert_new = $this->db->insert('data_companies', $data);
	  $last_id = $this->db->insert_id();
	  // array for log inserting.
	  $new_log_data = array(
		  'uid' => $logged_in_uid,
		  'item_id' => $last_id,
		  'item_type' => 'company',
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

  function update_company ($data)
  {
	if (DBTYPE == 'db')
	{
	  $this->db->where('cid', $data['cid']);
	  return $this->db->update('data_companies', $data);
	}
  }

  function get_company_by_name ($name)
  {
	if (DBTYPE == 'db')
	{
	  $this->db->select("*");
	  $this->db->from('data_companies');
	  $this->db->where('name', $name);
	  $query = $this->db->get();
	  if ($query->num_rows >= 1)
	  {
		return $query->row_array();
	  }
	  else
	  {
		return FALSE;
	  }
	}
  }

  function get_company_by_id ($id)
  {
	if (DBTYPE == 'db')
	{
	  $this->db->select("*");
	  $this->db->from('data_companies');
	  $this->db->where('cid', $id);
	  $query = $this->db->get();
	  if ($query->num_rows >= 1)
	  {
		return $query->row_array();
	  }
	  else
	  {
		return FALSE;
	  }
	}
  }

}
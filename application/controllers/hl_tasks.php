<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Hl_tasks extends CI_Controller
{

  function __construct ()
  {
	global $data;
	parent::__construct();
	$data = $this->engineinit->boot_engine();
	$this->load->model('hl_tasks_model');
	$data['fullname'] = $this->engineinit->_get_session_fullname();
	// @todo need to check if user is already login into the system.
	$this->engineinit->_is_not_logged_in_redirect('/login');
	//$this->output->enable_profiler(TRUE);
  }

  // AJAX save high level task
  function ajax_savehltask ()
  {
	if (IS_AJAX)
	{ // if request is AJAX
	  if ($this->input->post())
	  {
		parse_str($this->input->post('data'), $searcharray);

		$db_insert['estid'] = $searcharray['estid'];
		$db_insert['phase'] = $searcharray['phase'];

		// count all high level tasks in estimation by phases.
		$hl_tasks_count = $this->hl_tasks_model->hltasks_count_by_estid_phase($db_insert['estid'], $db_insert['phase']);

		$db_insert['wbscode'] = $db_insert['phase'] . '-' . ($hl_tasks_count + 1);
		$db_insert['name'] = $searcharray['name'];
		$db_insert['description'] = $searcharray['description'];
		$db_insert['detail'] = $searcharray['detail'];
		$db_insert['notes'] = $searcharray['notes'];
		$db_insert['hours'] = $searcharray['hours'];
		$db_insert['rate'] = $searcharray['rate'];
		$db_insert['cost'] = ($searcharray['rate'] * $searcharray['hours']);

		$db_insert['status_active'] = 1;
		$db_insert['deleted'] = 0;
		$db_insert['created_date'] = time();

		$update = $this->hl_tasks_model->add_hl_task($db_insert);
		if ($update)
		{
		  echo 'Added';
		}
		else
		{
		  echo 'Error';
		}
	  }
	}
  }

}

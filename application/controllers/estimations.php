<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Estimations extends CI_Controller
{

  function __construct ()
  {
	global $data;
	parent::__construct();
	$data = $this->engineinit->boot_engine();
	$this->load->model('estimations_model');
	$data['fullname'] = $this->engineinit->_get_session_fullname();
	// @todo need to check if user is already login into the system.
	$this->engineinit->_is_not_logged_in_redirect('/login');
	//$this->output->enable_profiler(TRUE);
  }

  function add ()
  {
	global $data;

	$this->load->model('projects_model');
	$data['pid'] = $pid = $this->uri->segment(3);
	$project = $this->projects_model->get_project_by_id($pid);

	if ($this->input->post())
	{
	  $this->load->library('form_validation');
	  $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[255]');

	  if ($this->form_validation->run() == TRUE)
	  {
		// insert into db
		$db_insert['pid'] = $this->input->post('pid');
		$db_insert['name'] = $this->input->post('name');
		$db_insert['resources'] = $this->input->post('resources');
		$db_insert['status_active'] = 1;
		$db_insert['created_date'] = time();
		$db_insert['updated_date'] = '';

		$insert = $this->estimations_model->add_estimation($db_insert);
		if ($insert)
		{
		  $this->session->set_flashdata('success', 'New estimation added.');
		  redirect('projects/info/' . $this->input->post('pid'));
		}
	  }
	}

	if (is_array($project))
	{
	  // count all estimation based on project.
	  $estimation_count = $this->estimations_model->estimations_count_by_pid($pid);
	  if ($estimation_count == 0)
	  {
		$data['estimation_name'] = $project['name'] . ' - Estimation Rev 1';
	  }
	  else
	  {
		$data['estimation_name'] = $project['name'] . ' - Estimation Rev ' . ($estimation_count + 1);
	  }
	}
	else
	{
	  show_404();
	}

	$data['main_content'] = 'estimations/form.view.php';
	$this->load->view('template.view.php', $data);
  }

  function info ()
  {
	global $data;
	$this->load->helper('currency');
	$this->load->model('hl_tasks_model');

	$data['estid'] = $estid = $this->uri->segment(3);
	$data['estimation'] = $this->estimations_model->estimation_by_estid($estid);

	$data['ig'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'ig');
	$data['pp'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'pp');
	$data['dw'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'dw');
	$data['api'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'api');
	$data['iosiphone'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'iosiphone');
	$data['iosipad'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'iosipad');
	$data['iosuniversal'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'iosuniversal');
	$data['android'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'android');
	$data['androidtab'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'androidtab');
	$data['bb'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'bb');
	$data['cms'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'cms');

	//$data['main_content'] = 'estimations/info.view.php';
	//$this->load->view('template.view.php', $data);
//header("Content-Type: application/xml; charset=UTF-8");
//header("Expires: 0");
//header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
//header("Content-disposition: attachment; filename=\"mydocument_name.doc\"");
//$output =  $this->load->view('estimations/wordtemplate.php', $data);

	$data['main_content'] = 'estimations/info.view.php';
	$this->load->view('template.view.php', $data);
  }

  function export ()
  {
	global $data;
	$this->load->helper('currency');
	$this->load->model('hl_tasks_model');

	$data['estid'] = $estid = $this->uri->segment(3);
	$data['estimation'] = $this->estimations_model->estimation_by_estid($estid);

	$data['ig'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'ig');
	$data['pp'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'pp');
	$data['dw'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'dw');
	$data['api'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'api');
	$data['iosiphone'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'iosiphone');
	$data['iosipad'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'iosipad');
	$data['iosuniversal'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'iosuniversal');
	$data['android'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'android');
	$data['androidtab'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'androidtab');
	$data['bb'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'bb');
	$data['cms'] = $this->hl_tasks_model->get_hltasks_by_estid_phase($estid, 'cms');


	header("Content-Type: application/xml; charset=UTF-8");
	header("Expires: 0");
	header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
	header("Content-disposition: attachment; filename=\"mydocument_name.doc\"");
	$output = $this->load->view('estimations/wordtemplate.php', $data);

	//$data['main_content'] = 'estimations/info.view.php';
	//$this->load->view('template.view.php', $data);
  }

  function process_estimation ()
  {
	global $data;
	$datapass['estid'] = $estid = $this->uri->segment(3);
	$this->load->model('hl_tasks_model');

	$estimation_info = $this->estimations_model->estimation_by_estid($estid);

	$hl_tasks = $this->hl_tasks_model->get_hltasks_by_estid($estid);

	$hours = 0;
	$cost = 0;
	foreach ($hl_tasks as $task)
	{
	  // calculate everything and combine them.
	  $hours = $task['hours'] + $hours;
	  $cost = $task['cost'] + $cost;
	}
	$days = round($hours / 8);

	$datapass['duration'] = round($days / 5);
	$datapass['hours'] = $hours;
	$datapass['cost'] = $cost;

	// Update estimate.
	$db_update = $this->estimations_model->update_estimation($datapass);

	if ($db_update)
	{
	  redirect('projects/info/' . $estimation_info['project_id']);
	}
  }

}

<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Projects extends CI_Controller
{

  function __construct ()
  {
	global $data;
	parent::__construct();
	$data = $this->engineinit->boot_engine();
	$this->load->model('projects_model');
	$data['fullname'] = $this->engineinit->_get_session_fullname();
	$data['logged_in_user_id'] = $this->engineinit->_get_session_uid();
	// @todo need to check if user is already login into the system.
	$this->engineinit->_is_not_logged_in_redirect('/login');
	//$this->output->enable_profiler(TRUE);
  }

  function index ()
  {
	global $data;
	$this->load->library('pagination');
	$config['base_url'] = config_item('base_url') . 'projects/';
	$config['total_rows'] = $this->projects_model->projects_count();
	$config['per_page'] = '20';
	$config['uri_segment'] = 2;
	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
	// style config
	$config['first_tag_open'] = '<li>';
	$config['first_tag_close'] = '</li>';
	$config['last_tag_open'] = '<li>';
	$config['last_tag_close'] = '</li>';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active"><a>';
	$config['cur_tag_close'] = '</a></li>';
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';
	$config['anchor_class'] = '';
	$this->pagination->initialize($config);
	$data['recent_items'] = $this->projects_model->get_projects($config['per_page'], $page);

	$data['p_links'] = $this->pagination->create_links();

	$data['main_content'] = 'projects/home.view.php';
	$this->load->view('template.view.php', $data);
  }

  function add ()
  {
	global $data;
	$this->load->helper('inflector');
	$this->load->model('companies_model');

	$data['companies'] = $this->companies_model->get_companies(10000, 0);

	if ($this->input->post())
	{
	  $this->load->library('form_validation');
	  $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[100]|callback__name_check');

	  $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[3]');

	  if ($this->form_validation->run() == TRUE)
	  {
		// insert into db
		$db_insert['assigned_cid'] = $this->input->post('assigned_cid');
		$db_insert['provided_cid'] = $this->input->post('provided_cid');
		$db_insert['name'] = $this->input->post('name');
		$db_insert['description'] = $this->input->post('description');
		$db_insert['status_active'] = 1;
		$db_insert['created_date'] = time();
		$db_insert['updated_date'] = '';

		$insert = $this->projects_model->add_project($db_insert);
		if ($insert)
		{
		  $this->session->set_flashdata('success', 'New project added.');
		  redirect('projects/');
		}
	  }
	}

	$data['main_content'] = 'projects/form.view.php';
	$this->load->view('template.view.php', $data);
  }

  function info ()
  {
	global $data;
	$data['pid'] = $pid = $this->uri->segment(3);
	$data['project'] = $this->projects_model->get_project_by_id($pid);
	
        $this->load->helper('date');
        $this->load->helper('currency');
        
        $this->load->model('jobs_model');
        $data['jobs'] = $this->jobs_model->get_jobs ($pid);
        
        $data['dateformat'] = "%d-%m-%Y %h:%i %a";
        
	$data['main_content'] = 'projects/info.view.php';
	$this->load->view('template.view.php', $data);
  }

  function permissions ()
  {
	global $data;
	$data['pid'] = $pid = $this->uri->segment(3);
	$data['project'] = $this->projects_model->get_project_by_id($pid);

	// check if user have permissions.
	$data['user_permissions'] = unserialize($data['project']['user_permissions']);

	// get all users from system with their company associations.
	$this->load->model('users_model');
	$data['users'] = $this->users_model->get_users(10000, 0);

	if ($this->input->post())
	{
		$db_update['user_permissions'] = serialize($this->input->post('user_permissions'));
		$db_update['pid'] = $this->input->post('pid');
		$update = $this->projects_model->update_project($db_update);
		if ($update)
		{
		  $this->session->set_flashdata('success', 'Permissions saved.');
		  redirect('projects/');
		}
	}

	$data['main_content'] = 'projects/permissions.view.php';
	$this->load->view('template.view.php', $data);
  }

  function _name_check ($name)
  {
	$project = $this->projects_model->get_project_by_name($name);
	if (is_array($project))
	{
	  $this->form_validation->set_message('_name_check', 'Already have project with same name.');
	  return FALSE;
	}
	else
	{
	  return TRUE;
	}
  }

  // AJAX Search Process For Movies
  function ajax_status ()
  {
	if (IS_AJAX)
	{ // if request is AJAX
	  if ($this->input->post())
	  {

		$db_update['pid'] = $this->input->post('id');
		$db_update['status_active'] = $this->input->post('status_active');
		$db_update['updated_date'] = time();

		$update = $this->projects_model->update_project($db_update);
		if ($update)
		{
		  echo 'Updated';
		}
		else
		{
		  echo 'Error';
		}
	  }
	}
  }

  // AJAX Search Process For Movies
  function ajax_delete ()
  {
	if (IS_AJAX)
	{ // if request is AJAX
	  if ($this->input->post())
	  {
		$db_update['pid'] = $this->input->post('id');
		$db_update['status_active'] = 0;
		$db_update['deleted'] = 1;
		$db_update['updated_date'] = time();

		$update = $this->projects_model->update_project($db_update);
		if ($update)
		{
		  echo 'Deleted';
		}
		else
		{
		  echo 'Error';
		}
	  }
	}
  }

}

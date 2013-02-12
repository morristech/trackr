<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Users extends CI_Controller
{

  function __construct ()
  {
	global $data;
	parent::__construct();
	$data = $this->engineinit->boot_engine();
	$this->load->model('users_model');
	$data['fullname'] = $this->engineinit->_get_session_fullname();
	// @todo need to check if user is already login into the system.
	$this->engineinit->_is_not_logged_in_redirect('/login');
	//$this->output->enable_profiler(TRUE);
  }

  function index ()
  {
	global $data;
	$this->load->library('pagination');
	$config['base_url'] = config_item('base_url') . 'users/';
	$config['total_rows'] = $this->users_model->users_count();
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
	$data['recent_items'] = $this->users_model->get_users($config['per_page'], $page);

	$data['p_links'] = $this->pagination->create_links();

	$data['main_content'] = 'users/home.view.php';
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
	  $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[100]');

	  $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]|max_length[100]');

	  $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback__email_check');

	  $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[100]');

	  if ($this->form_validation->run() == TRUE)
	  {

		// insert into db
		$db_insert['cid'] = $this->input->post('cid');
		$db_insert['first_name'] = $this->input->post('first_name');
		$db_insert['last_name'] = $this->input->post('last_name');
		$db_insert['email'] = $this->input->post('email');
		$db_insert['password'] = md5($this->input->post('password'));
		$db_insert['status_active'] = 1;
		$db_insert['created_date'] = time();
		$db_insert['updated_date'] = '';

		$insert = $this->users_model->add_user($db_insert);
		if ($insert)
		{
		  $this->session->set_flashdata('success', 'New user added.');
		  redirect('users/');
		}
	  }
	}

	$data['main_content'] = 'users/form.view.php';
	$this->load->view('template.view.php', $data);
  }

  function info ()
  {
	global $data;
	$uid = $this->uri->segment(3);
	$data['user'] = $this->users_model->get_user_by_id($uid);

	$data['main_content'] = 'users/info.view.php';
	$this->load->view('template.view.php', $data);
  }

  function _email_check ($email)
  {

	$user = $this->users_model->get_user_by_email($email);
	if (is_array($user))
	{
	  $this->form_validation->set_message('_email_check', 'Already have user with same email.');
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

		$db_update['uid'] = $this->input->post('id');
		$db_update['status_active'] = $this->input->post('status_active');
		$db_update['updated_date'] = time();

		$update = $this->users_model->update_user($db_update);
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
		$db_update['uid'] = $this->input->post('id');
		$db_update['status_active'] = 0;
		$db_update['deleted'] = 1;
		$db_update['updated_date'] = time();

		$update = $this->users_model->update_user($db_update);
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

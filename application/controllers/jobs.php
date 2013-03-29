<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jobs extends CI_Controller
{

    function __construct ()
    {
        global $data;
        parent::__construct();
        $data = $this->engineinit->boot_engine();
        $this->load->model('projects_model');
        $data['fullname'] = $this->engineinit->_get_session_fullname();
        // @todo need to check if user is already login into the system.
        $this->engineinit->_is_not_logged_in_redirect('/login');
        //$this->output->enable_profiler(TRUE);
    }

    function add ()
    {
        global $data;
        $this->load->helper('inflector');

        $data['pid'] = $this->uri->segment(4);

        if ($this->input->post())
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|max_length[100]|callback__title_check');

            $this->form_validation->set_rules('receivable_rate', 'Receivable Rate', 'trim|required|decimal');
            $this->form_validation->set_rules('receivable_hours', 'Receivable Hours', 'trim|required|numeric');
            $this->form_validation->set_rules('payable_rate', 'Payable Rate', 'trim|required|decimal');
            $this->form_validation->set_rules('payable_hours', 'Payable Hours', 'trim|required|numeric');

            if ($this->form_validation->run() == TRUE)
            {
                // insert into db
                $db_insert['cid'] = $this->input->post('cid');
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

        $data['main_content'] = 'jobs/form.view.php';
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
        $data['jobs'] = $this->jobs_model->get_jobs($pid);

        $data['dateformat'] = "%d-%m-%Y %h:%i %a";

        $data['main_content'] = 'projects/info.view.php';
        $this->load->view('template.view.php', $data);
    }

    function _title_check ($name)
    {
        $job = $this->jobs_model->get_job_by_title($name);
        if (is_array($job))
        {
            $this->form_validation->set_message('_title_check', 'Already have job with same title.');
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

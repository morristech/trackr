<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct ()
    {
        global $data;
        parent::__construct();
        $data = $this->engineinit->boot_engine();
        $this->load->model('users_model');
    }

    // login page - form
    function index ()
    {
        global $data;
        $user_session = array();
        
        // @todo need to check if user is already login into the system.
        $this->engineinit->_is_logged_in_redirect('/home');

        if ($this->input->post())
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            // if form validation passed

            if ($this->form_validation->run())
            {
                $query = $this->users_model->validate_login();

                if ($query)
                {
                    $user_session['email'] = $query['email'];
                    $user_session['uid'] = $query['uid'];
                    $user_session['fullname'] = $query['first_name'] . ' '. $query['last_name'];
                    $user_session['cid'] = $query['cid'];
                    $user_session['user_is_logged_in'] = 1;
                    $this->session->set_userdata($user_session);
                    $this->users_model->set_last_login_timestamp_by_uid($user_session['uid']);
                    redirect('home/');
                }
                // if query retruned NULL
                else
                {
                    $this->session->set_flashdata('login_message', 'Opps! wrong email or password or account is disabled.');
                    redirect('login'); // due to flash data.
                }
            }
        }
        $data['main_content'] = 'login/login.view.php';
        $this->load->view('template_fullbody.view.php', $data);
    }

    // logout process - controlled from routes.
    function logout ()
    {
        $uid = $this->engineinit->_get_session_uid();
        $this->users_model->set_last_login_timestamp_by_uid($uid);
        $logout_session_data = array('email' => '', 'uid' => '', 'is_logged_in' => '0', 'cid' => '');
        $this->session->unset_userdata($logout_session_data);
        $this->session->sess_destroy();
        // redirect if logout is sucessfull.
        redirect('/login');
    }

}
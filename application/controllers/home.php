<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        global $data;
        parent::__construct();
        $data = $this->engineinit->boot_engine();
        $data['fullname'] = $this->engineinit->_get_session_fullname();
        // @todo need to check if user is already login into the system.
        $this->engineinit->_is_not_logged_in_redirect('/login');
        //$this->output->enable_profiler(TRUE);
    }

    function index()
    {
        global $data;
        $this->load->helper('date');
        $this->load->model('timeline_model');
        $this->load->library('pagination');
        $config['base_url'] = config_item('base_url') . 'home/';
        $config['total_rows'] = $this->timeline_model->timeline_count();
        $config['per_page'] = '50';
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
        $data['recent_items'] = $this->timeline_model->recent_timeline($config['per_page'], $page);
        
        $data['p_links'] = $this->pagination->create_links();

        $data['main_content'] = 'home/home.view.php';
        $this->load->view('template.view.php', $data);
    }

}

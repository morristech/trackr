<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Companies extends CI_Controller
{

    function __construct ()
    {
        global $data;
        parent::__construct();
        $data = $this->engineinit->boot_engine();
        $this->load->model('companies_model');
        $data['fullname'] = $this->engineinit->_get_session_fullname();
        // if user is already login into the system, if not then redirect to login
        $this->engineinit->_is_not_logged_in_redirect('/login');
        // if user is not admin then show the 401 error.
        $this->engineinit->_is_not_admin();
        //$this->output->enable_profiler(TRUE);
    }

    function index ()
    {
        global $data;
        $this->load->helper('date');
        $this->load->library('pagination');
        $config['base_url'] = config_item('base_url') . 'companies/';
        $config['total_rows'] = $this->companies_model->companies_count();
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
        $data['recent_items'] = $this->companies_model->get_companies($config['per_page'], $page);

        $data['p_links'] = $this->pagination->create_links();

        $data['main_content'] = 'companies/home.view.php';
        $this->load->view('template.view.php', $data);
    }

    function add ()
    {
        global $data;
        $this->load->helper('inflector');

        if ($this->input->post())
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Company Name', 'trim|required|min_length[3]|max_length[100]|callback__name_check');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[10]|max_length[255]');

            if ($this->form_validation->run() == TRUE)
            {
                if (isset($_FILES['logo']))
                {

                    // Image for iPhone 2x uploading.
                    $config_logo_orignal['upload_path'] = config_item('image_path_company');
                    $config_logo_orignal['allowed_types'] = 'jpg|gif|png';
                    $config_logo_orignal['max_size'] = '100000';
                    $config_logo_orignal['max_width'] = '10000';
                    $config_logo_orignal['max_height'] = '10000';
                    // @todo need to fix file_name parameter for 1.7.2.patch1 from CI core.
                    $config_logo_orignal['file_name'] = camelize($this->input->post('name')) . '';
                    $config_logo_orignal['overwrite'] = TRUE;

                    $this->load->library('upload');
                    $this->upload->initialize($config_logo_orignal);
                    if ($this->upload->do_upload('logo') == FALSE)
                    {
                        $this->session->set_flashdata('error', 'Opps! Some error while adding logo.');
                    }
                    else
                    {
                        $this->load->library('image_lib');
                        $upload_data = $this->upload->data();

                        // Generate iPhone 1x image.
                        $config_logo_resize['image_library'] = 'gd2';
                        $config_logo_resize['source_image'] = '' . $config_logo_orignal['upload_path'] . $config_logo_orignal['file_name'] . $upload_data['file_ext'];
                        $config_logo_resize['maintain_ratio'] = TRUE;
                        $config_logo_resize['width'] = '120';
                        $config_logo_resize['height'] = '120';
                        $config_logo_resize['create_thumb'] = TRUE;

                        $this->image_lib->initialize($config_logo_resize);
                        $this->image_lib->resize();

                        if (!$this->image_lib->resize())
                        {
                            $data['resize_error'] = $this->image_lib->display_errors();
                        }
                        else
                        {
                            // image file name
                            $db_insert['logo_path'] = camelize($this->input->post('name')) . '' . $upload_data['file_ext'];
                            $db_insert['thumb_path'] = camelize($this->input->post('name')) . '_thumb' . $upload_data['file_ext'];
                        }
                    }
                }

                // insert into db
                $db_insert['name'] = $this->input->post('name');
                $db_insert['address'] = $this->input->post('address');
                $db_insert['status_active'] = 1;
                $db_insert['created_date'] = time();
                $db_insert['updated_date'] = '';

                $insert = $this->companies_model->add_company($db_insert);
                if ($insert)
                {
                    $this->session->set_flashdata('success', 'New company added.');
                    redirect('companies/');
                }
            }
        }

        $data['main_content'] = 'companies/form.view.php';
        $this->load->view('template.view.php', $data);
    }

    function info ()
    {
        global $data;
        $cid = $this->uri->segment(3);
        $data['company'] = $this->companies_model->get_company_by_id($cid);

        $data['main_content'] = 'companies/info.view.php';
        $this->load->view('template.view.php', $data);
    }

    function _name_check ($name)
    {

        $company = $this->companies_model->get_company_by_name($name);
        if (is_array($company))
        {
            $this->form_validation->set_message('_name_check', 'Already have company with same name.');
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

                $db_update['cid'] = $this->input->post('id');
                $db_update['status_active'] = $this->input->post('status_active');
                $db_update['updated_date'] = time();

                $update = $this->companies_model->update_company($db_update);
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
                $db_update['cid'] = $this->input->post('id');
                $db_update['status_active'] = 0;
                $db_update['deleted'] = 1;
                $db_update['updated_date'] = time();

                $update = $this->companies_model->update_company($db_update);
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

<?php

class Jobs_model extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    function get_jobs ($pid)
    {
        if (DBTYPE == 'db')
        {
            $this->db->select("data_jobs.*");
            $this->db->from('data_jobs');
            $this->db->join('data_projects', 'data_projects.pid = data_jobs.pid');
            $this->db->where('data_jobs.deleted', 0);
            $this->db->where('data_projects.pid', $pid);
            $this->db->order_by("data_jobs.created_date", "desc");
            $query = $this->db->get();
            if ($query->num_rows >= 1)
            {
                return $query->result_array();
            }
        }
    }

    function projects_count ()
    {
        if (DBTYPE == 'db')
        {
            $this->db->from('data_projects');
            return $this->db->count_all_results();
        }
    }

    function add_project ($data)
    {
        $logged_in_uid = $this->engineinit->_get_session_uid();

        if (DBTYPE == 'db')
        {
            $insert_new = $this->db->insert('data_projects', $data);
            $last_id = $this->db->insert_id();
            // array for log inserting.
            $new_log_data = array(
                'uid' => $logged_in_uid,
                'item_id' => $last_id,
                'item_type' => 'project',
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

    function update_project ($data)
    {
        if (DBTYPE == 'db')
        {
            $this->db->where('pid', $data['pid']);
            return $this->db->update('data_projects', $data);
        }
    }

    function get_project_by_id ($pid)
    {

        if (DBTYPE == 'db')
        {
            $this->db->select("data_projects.pid, data_projects.name, data_projects.description, data_projects.status_active, data_companies.name as company_name, data_companies.cid as company_id, data_projects.created_date as created_date");
            $this->db->from('data_projects');
            $this->db->join('data_companies', 'data_companies.cid = data_projects.cid');
            $this->db->where('data_projects.deleted', 0);
            $this->db->where('data_projects.pid', $pid);
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

    function get_job_by_title ($name)
    {
        if (DBTYPE == 'db')
        {
            $this->db->select("*");
            $this->db->from('data_jobs');
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

}
<?php

class Users_model extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    // validate user login information.
    function validate_login ()
    {
        if (DBTYPE == 'db')
        {
            $this->db->where('email', $this->input->post('email'));
            $this->db->where('password', md5($this->input->post('password')));
            $query = $this->db->select('*');
            $query = $this->db->get('data_users');
            return $query->row_array();
        }
    }

    // get last login timestamp.
    function set_last_login_timestamp_by_uid ($uid)
    {
        if (DBTYPE == 'db')
        {
            $data = array(
                'last_login_on' => time()
            );
            $this->db->where('uid', $uid);
            $update = $this->db->update('data_users', $data);
            return $update;
        }
        if (DBTYPE == 'mongo_db')
        {
            $this->mongo_db->where('uid', $uid);
            $this->mongo_db->set(array('last_login_on' => time()));
            $update = $this->mongo_db->update('data_users');
            return $update;
        }
    }

    // get user based on offset and limit.
    function get_users ($limit, $start)
    {
        if (DBTYPE == 'db')
        {
            $this->db->select("data_users.uid, data_users.first_name, data_users.last_name, data_users.email, data_users.status_active, data_companies.name as company_name, data_companies.cid as company_id");
            $this->db->from('data_users');
            $this->db->join('data_companies', 'data_companies.cid = data_users.cid');
            $this->db->where('data_users.deleted', 0);
            $this->db->order_by("data_users.created_date", "desc");
            $this->db->limit($limit, $start);
            $query = $this->db->get();
            if ($query->num_rows >= 1)
            {
                return $query->result_array();
            }
        }
    }

    // count all users in the system.
    function users_count ()
    {
        if (DBTYPE == 'db')
        {
            $this->db->from('data_users');
            return $this->db->count_all_results();
        }
    }

    // new user to the system
    function add_user ($data)
    {
        $logged_in_uid = $this->engineinit->_get_session_uid();

        if (DBTYPE == 'db')
        {
            $insert_new = $this->db->insert('data_users', $data);
            $last_id = $this->db->insert_id();
            // array for log inserting.
            $new_log_data = array(
                'uid' => $logged_in_uid,
                'item_id' => $last_id,
                'item_type' => 'user',
                'item_title' => $data['first_name'] . ' ' . $data['last_name'],
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

    // update user based on given array.
    function update_user ($data)
    {
        if (DBTYPE == 'db')
        {
            $this->db->where('uid', $data['uid']);
            return $this->db->update('data_users', $data);
        }
    }

    // get user detail from given user ID (uid)
    function get_user_by_id ($id)
    {
        if (DBTYPE == 'db')
        {
            $this->db->select("*");
            $this->db->from('data_users');
            $this->db->where('uid', $id);
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

    // get user detail from given email address.
    function get_user_by_email ($email)
    {
        if (DBTYPE == 'db')
        {
            $this->db->select("*");
            $this->db->from('data_users');
            $this->db->where('email', $email);
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
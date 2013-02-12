<?php

class Timeline_model extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    function recent_timeline ($limit, $start)
    {
        if (DBTYPE == 'db')
        {
            $this->db->select("*");
            $this->db->from('data_timeline');
            $this->db->order_by("addedtime", "desc");
            $this->db->limit($limit, $start);
            $query = $this->db->get();
            if ($query->num_rows >= 1)
            {
                return $query->result_array();
            }
        }
    }

    function timeline_count ()
    {
        if (DBTYPE == 'db')
        {
            $this->db->from('data_timeline');
            return $this->db->count_all_results();
        }
    }

}
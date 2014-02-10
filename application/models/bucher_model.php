<?php

class bucher_model extends CI_Model{
    
    function get_num_rows(){
       $q= $this->db->get('bucher');
    
       return $q->num_rows();
    }

    function search($sort_by, $sort_order, $per_pahe, $offset){
    
        $this->db->order_by($sort_by, $sort_order);
        $q= $this->db->get('bucher', $per_pahe, $offset);
        
        return $q->result();
    }
    
    
    }
<?php

class user extends CI_Model {

    
    function getall() {
      
        $q = $this->db->get('uers');

        if ($q->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

}

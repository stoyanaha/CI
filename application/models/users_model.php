<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model {

    function validate_login() {

        $username = $this->input->post('username');
        $password = sha1($this->input->post('password'));

        $this->db->where('name', $username);
        $this->db->where('password', $password);
        $q = $this->db->get('uers');

        if ($q->num_rows() == 1) {
            return true;
        } else {
            //
        }
    }

    function check_username() {
        $username = $this->input->post('username');

        $this->db->select('name');
        $this->db->where('name', $username);
        $q = $this->db->get('uers');

        if ($q->num_rows() != 0) {
            return FALSE;
        } else {
            return true;
        }
    }

    function check_email() {
        $email = $this->input->post('email');

        $this->db->select('email');
        $this->db->where('email', $email);
        $q = $this->db->get('uers');

        if ($q->num_rows() != 0) {
            return FALSE;
        } else {
            return true;
        }
    }

    function insert_user($activation_code) {
        $user_data = array(
          'name' => $this->imput->post('username'),
          'password' => sha1($this->imput->post('password')),
          'email' => $this->imput->post('email'),
          'activation_code' => $activation_code
        );

        $q = $this->db->insert('uers', $user_data);
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function activate_account($username, $activation_code) {
        $this->db->select('name, activation_code');
        $this->db->where('name', $username);
        $this->db->where('activation_code', $activation_code);
        $q = $this->db->get('uers');

        if ($q->num_rows == 1) {
            $update_date = array(
              'activation_code' => '',
              'active' => 1
            );


            $update_where = array(
              'activation_code' => $activation_code,
              'name' => $username
            );


            $this->db->update('uers', $update_date, $update_where);
            if ($this->db->affected_rows() == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    function is_active() {
        $username = $this->imput->post('username');
        $this->db->select('active, activation_code');
        $this->db->where('name', $username);
        $q = $this->db->get('uers');


        //VAJNO KAK SE PRISVOJAVAT VARIABLEN OT DB OBEKT!
        if ($q->num_rows() == 1) {
            $row = $q->row();

            //kogato vse oste ne e aktiviran 
            if ($row->active == 0 && $row->activation_code != '') {

                $this->session->set_flashdata('errmsg', 'Der Akaunt wunrde noch nicht aktiviert');
                return false;
            } elseif ($row->active == 0 && $row->activation_code == '') {
                $this->session->set_flashdata('errmsg', 'Der Akaunt wunrde vom Systemadministrator geblockt');
                return false;
            } else {
                return true;
            }
        }
    }

}

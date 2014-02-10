<?php

Class members extends CI_Controller {

    function __construct() {
        parent::__construct();
    $this->is_logged();
        
    }
    
            function index() {
        $this->home();
    }

    function home() {
        $data['kkk'] = 'members/members_area';
        $this->load->view('include/template', $data);
    }

    function is_logged() {
        $is_logged = $this->session->userdata('is_logged');
        if (!isset($is_logged) || $is_logged != true) {
            echo 'restricted area! <a href="login"> log in </a>';
            die();
        } else {
            //
        }
    }

}

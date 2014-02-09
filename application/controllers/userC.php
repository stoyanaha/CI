<?php

class user extends CI_Controller{
    function index(){
        $this->load->model['userM'];
        $data['rows'] = $this->userM->getall();
        
    }
}

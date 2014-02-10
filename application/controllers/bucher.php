<?php

Class Bucher extends CI_Controller {

    function display($sort_by = 'Buchtitel', $sort_order = 'asc') {

        $this->load->model('bucher_model');
        $total_rows = $this->bucher_model->get_num_rows();


        $this->load->library('pagination');

        // base_url() e mnogo vajno!!!
        $config['base_url'] = base_url() . '/bucher/display/' . $sort_by . '/' . $sort_order . '/page/';
        $config['total_rows'] = $total_rows;
        $config['per_pahe'] = 10;
        $config['uri_segment'] = 6;
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;

        $data['rows'] = $this->bucher_model->search($sort_by, $sort_order, $config['per_pahe'], 
                $this->uri->segment($config['uri_segment']));
        $this->load->view('bucher_view', $data);
    }

}

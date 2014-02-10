<?php

class login extends CI_Controller {

    function index() {
        $this->do_login();
    }

    function do_login() {
        $data['kkk'] = 'login/login_form';
        $this->load->view('include/template', $data);
    }

    function validate() {
        $this->load->library('form_validation');

        $val = $this->form_validation->set_rules('username', 'Име', 'trim|required|min_length[3]');
        $val = $this->form_validation->set_rules('password', 'Парола', 'trim|required|min_length[4]');


        if ($this->form_validation->run()) {

            $this->load->model('users_model');
            if ($this->users_model->validate_login()) {
                $data = array(
                  'is_logged' => true,
                  'username' => $this->input->post('username')
                );

                $this->session->set_userdata($data);
                redirect('members', refresh);
            } else {
                $this->session->set_flashdata('errmsg', 'falscher Namer oder Passwort');
                redirect('login/index', 'refresh');
            }
        } else {
            $this->index();
        }
    }

    function register() {
        $data['kkk'] = 'login/register_form';
        $this->load->view('include/template', $data);
    }

    function vaidate_register() {
        $this->load->library('form_validation');
        $val = $this->form_validation;

        $val->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('password', 'Confirm Password', 'trim|required|min_length[5]|max_length[20]|matches[password');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|trim|required|min_length[5]|max_length[20]|');

        // opredelq formata na Fehlermeldungen
        $val->set_error_delimiters('<p class="validation_err">', '</p>');

        if ($val->run()) {
            $this->load->model('users_model');
            if ($this->users_model->check_username()) {
                if ($this->users_model->check_email()) {
                    $activation_code = $this->gen_pass(32);
                    //za test  echo $activation_code;
                    if ($this->send_email($activation_code)) {
                        if ($this->users_model->insert_user($activation_code)) {
                            
                        } else {
                            echo 'err DB Insern bei neu user Eintrag';
                        }
                    } else {
                        echo 'Die aktivierungsmail konnte nicht versendet werden';
                    }
                } else {
                    echo 'Die E-Mail ist bereits verwendet';
                }
            } else {
                echo 'Benutzername bereits verwendet';
            }
        } else {
            $this->register();
        }
    }

    function gen_pass($len) {
        $zufall = '123456789abcederkdskKDIIDNWDGKKqwröadkkjgjvmaccaa';
        $str = '';

        for ($i = 0; $i < $len; $i++) {
            $str.=substr($zufall, mt_rand(0, strlen($zufall) - 1), 1);
        }
        return $str;
    }

    function activate() {
        $username = $this->uri->segment(3);
        $activation_code = $this->uri->segment(4);

        if ($username != NULL && $activation_code != NULL) {
            $this->load->model('users_model');
            if($this->users_model->activate_account($username,$activation_code)) {
                echo 'Account activated <a href="'.site_url('login').'"> LOGIN </a>';
            }
            
            else{
                echo'falaschen aktivierungcode';
            }
        }
    }

    function send_email($activation_code) {
        $code = $activation_code;
        $username = $this->input->post('username');
        $email_to = $this->input->post('email');

        $config = array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.gmail.com',
          'smtp_port' => 465,
          'smtp_user' => 'stoyan.aha@gmail.com',
          'smtp__pass' => 'qaywsx123'
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('codeigniter@stc-it.de', 'stooooyan');
        $this->email->to($email_to);
        $this->email->subject('Activate me');
        $message = 'jetzt konnen sich aktivieren . click on:' . site_url('login/activate') . '/' . $username . '/' . $code . '';
        $this->email->message($message);
        if ($this->email->send()) {
            echo 'Die Emial wurde versenden! check your email';
        } else {
            show_error($this->email->print_debugger());
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_customer');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        dt_set_time_zone();
    }

    //show customer dashboard if authenticated
    public function index() {
        if (!$this->session->userdata('ADMIN_ID')) {
            redirect('admin/login');
        } else {
            redirect('admin/dashboard');
        }
    }

    //cutomer login
    public function login() {
        $next = $this->input->get('next');
        if (!$this->session->userdata('ADMIN_ID')) {
            $data['title'] = dt_translate('login');
            $data['next'] = $next;
            $this->load->view('admin/login', $data);
        } else {
            redirect('admin/dashboard');
        }
    }

    //check authentication of cutomer when login
    public function login_action() {

        $username = $this->db->escape($this->input->post("username", true));
        $next = $this->input->post("next", true);
        $password = $this->input->post("password", true);
        $this->form_validation->set_rules('username', '', 'trim|required');
        $this->form_validation->set_rules('password', '', 'trim|required');
        $this->form_validation->set_message('required', dt_translate('required_message'));
        if ($this->form_validation->run() == false) {
            $this->login();
        } else {
            $users = $this->model_customer->authenticate($username, $password);
            
            //Check for login
            if ($users['errorCode'] == 0) {
                $this->session->set_flashdata('msg', $users['errorMessage']);
                $this->session->set_flashdata('msg_class', 'failure');
                $this->login();
            } else {
                $this->session->set_flashdata('msg', dt_translate('login_success'));
                $this->session->set_flashdata('msg_class', 'success');

                if (isset($next) && $next != "") {
                    redirect(base_url($next));
                } else {
                    redirect(base_url('admin/landing'));
                }
            }
        }
    }

    //customer forgot password 
    public function forgot_password() {
        if (!$this->session->userdata('ADMIN_ID')) {
            $company_data = $this->model_customer->getData("app_site_setting", "*");
            $data['title'] = dt_translate('forgot_password');
            $data['company_data'] = $company_data[0];
            $this->load->view('admin/forgot_password', $data);
        } else {
            redirect(base_url("admin/dashboard"));
        }
    }

    //authenticate email of customer and send mail
    public function forgot_password_action() {

        $this->form_validation->set_rules('email', '', 'trim|required');
        $this->form_validation->set_message('required', dt_translate('required_message'));
        if ($this->form_validation->run() == false) {
            $this->forgot_password();
        } else {
            $email = $this->input->post("email", true);
            $rply = $this->model_customer->check_username($email);
            $this->load->helper('string');
            if ($rply['errorCode'] == 1) {

                $define_param['to_name'] = ($rply['Firstname']) . " " . ($rply['Lastname']);
                $define_param['to_email'] = $rply['Email'];
                $userid = $rply['ID'];
                $hidenuseremail = $rply['Email'];
                $hidenusername = ($rply['Firstname']) . " " . ($rply['Lastname']);
                //Encryprt data
                $encid = $this->general->encryptData($userid);
                $encemail = $this->general->encryptData($hidenuseremail);
                $url = base_url("admin/reset-password/" . $encid . "/" . $encemail);

                $update['reset_password_check'] = 0;
                $update['reset_password_requested_on'] = date("Y-m-d H:i:S");
                $result = $this->model_customer->update("app_admin", $update, "id='" . $userid . "'");

                //Send email
                $subject = dt_translate('reset_password');
                $define_param['to_name'] = $hidenusername;
                $define_param['to_email'] = $hidenuseremail;

                $parameter['URL'] = $url;
                $html = $this->load->view("email_template/forgot_password", $parameter, true);
                $this->sendmail->send($define_param, $subject, $html);

                $this->session->set_flashdata('msg', $rply['errorMessage']);
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/login');
            } else {
                $this->session->set_flashdata('msg', $rply['errorMessage']);
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('admin/forgot-password');
            }
        }

    }

    //show cutomer reset password form
    public function reset_password() {
        $id_ency = $this->uri->segment(3);
        $email_ency = $this->uri->segment(4);

        $id = (int) $this->general->decryptData($id_ency);
        $email = $this->general->decryptData($email_ency);
        $customer_data = $this->model_customer->getData("app_admin", "*", "id='" . $id . "' AND email='" . $email . "'");

        if (count($customer_data) > 0) {
            $add_min = date("Y-m-d H:i:s", strtotime($customer_data[0]['reset_password_requested_on'] . "+1 hour"));
            if ($add_min > date("Y-m-d H:i:s")) {
                if ($customer_data[0]['reset_password_check'] != 1) {
                    $content_data['title'] = dt_translate('reset_password');
                    $content_data['id'] = $id;
                    $this->load->view('admin/reset_password', $content_data);
                } else {
                    $this->session->set_flashdata('failure', dt_translate('reset_failure'));
                    redirect('admin/forgot-password');
                }
            } else {
                $this->session->set_flashdata('failure', dt_translate('reset_failure'));
                redirect('admin/forgot-password');
            }
        } else {
            $this->session->set_flashdata('failure', dt_translate('invalid_request'));
            redirect('admin/forgot-password');
        }
    }

    //reset password
    public function reset_password_action() {
        $password = $this->input->post('password');
        $id = $this->input->post('id');

        $this->form_validation->set_rules('password', '', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', '', 'trim|required|matches[password]');
        $this->form_validation->set_message('required', dt_translate('required_message'));
        if ($this->form_validation->run() == false) {
            $content_data['id'] = $id;
            $this->load->view('admin/reset_password', $content_data);
        } else {
            $update['reset_password_check'] = 1;
            $update['reset_password_requested_on'] = "0000-00-00 00:00:00";
            $update['password'] = md5($password);
            $this->model_customer->update("app_admin", $update, "id='" . $id . "'");
            $this->session->set_flashdata('msg', dt_translate('reset_success'));
            $this->session->set_flashdata('msg_class', 'success');
            redirect('admin/login');
        }
    }


    //cutomer logout
    public function logout() {
        $this->session->unset_userdata('ADMIN_ID');
        $this->session->unset_userdata('DefaultPassword');
        $this->session->set_flashdata('msg', dt_translate('logout_success'));
        $this->session->set_flashdata('msg_class', 'success');
        redirect(base_url('admin/login'));
    }
    public function upload_summernote_image() {

        if(isset($_FILES['file']['size']) && $_FILES['file']['size']<=1048576){
            if ($_FILES['file']['name']) {
                $name = time();
                $ext = explode('.', $_FILES['file']['name']);
                $filename = $name . '.' . $ext[1];

                $destination = FCPATH . '/assets/uploads/' . $filename; //change this directory
                $location = $_FILES["file"]["tmp_name"];
                move_uploaded_file($location, $destination);
                echo base_url('assets/uploads/') . $filename; //change this URL
            }
        }
    }

    //show landing page after login
    public function landing() 
    {
        $this->load->view('admin/landing');
    }

}

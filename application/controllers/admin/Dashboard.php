<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_customer');
    }

    //show customer dashboard if authenticated
    public function index() {
        $data['title'] = dt_translate('dashboard');
        $order = "title  ASC";
        $condition_str="status='A'";
        $admin_id = $this->session->userdata("ADMIN_ID");
        
        $app_donation = $this->model_customer->getData("app_donation", "COUNT('id') as total_donator,SUM(amount) as total_donation");
        $app_expense = $this->model_customer->getData("app_expense", "SUM(amount) as total_expense");
    
        $app_contact_us = $this->model_customer->getData("app_contact_us", "count(id) as total_contact_request");

        $total_donator=0;
        $total_donation=0;
        $total_expense=0;
        $total_contact_request=0;



       if(isset($app_donation) && count($app_donation)>0){
           $total_donator=$app_donation[0]['total_donator'];
           $total_donation=$app_donation[0]['total_donation'];
       }

        if(isset($app_expense) && count($app_expense)>0){
            $total_expense=$app_expense[0]['total_expense'];
        }

        


        $data['total_donator']=$total_donator;
        $data['total_donation']=$total_donation;
        $data['total_expense']=$total_expense;
        

        //Check Mandatory data for System
        $data['total_donation_category']=$this->db->select('count(id) as total_donation_category')->from('app_donation_category')->get()->row_array();
        $data['payment']= $this->db->select('id')->where("stripe='Y' OR paypal='Y' OR razorpay='Y'")->get('app_payment_setting')->result_array();


        $this->load->view('admin/dashboard', $data);
    }

    //show customer profile
    public function profile() {
        $data['title'] = dt_translate('customer_profile');
        $this->authenticate->check();
        $id = (int) $this->session->userdata('ADMIN_ID');
        if ($id > 0) {
            $customer_data = $this->model_customer->getData("app_admin", "*", "id=" . $id);
            if (isset($customer_data) && count($customer_data) > 0 && !empty($customer_data)) {
                $data['title'] = dt_translate('profile');
                $data['customer_data'] = $customer_data[0];
                $this->load->view('admin/profile', $data);
            } else {
                $this->session->set_flashdata('msg', dt_translate('invalid_request'));
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('admin/dashboard');
            }
        } else {
            $this->session->set_flashdata('msg', dt_translate('invalid_request'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('admin/dashboard');
        }
    }

    //update profile
    public function profile_save() {
        $user_id = (int) $this->session->userdata('ADMIN_ID');
        $this->authenticate->check();

        $this->form_validation->set_rules('first_name', '', 'trim|required');
        $this->form_validation->set_rules('last_name', '', 'trim|required');
        $this->form_validation->set_rules('email', '', 'trim|is_unique[app_admin.email.id.' . $user_id . ']');
        $this->form_validation->set_rules('phone', '', 'trim|is_unique[app_admin.phone.id.' . $user_id . ']');
        $this->form_validation->set_message('required', dt_translate('required_message'));
        $this->form_validation->set_error_delimiters('<div class = "error"> ', '</div>');
        if ($this->form_validation->run() == false) {
            $this->profile();
        } else {
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'updated_on' => date("Y-m-d H:i:s")
            );
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['name'] != '') {
                $uploadPath = uploads_path;
                $tmp_name = $_FILES["profile_image"]["tmp_name"];
                $temp = explode(".", $_FILES["profile_image"]["name"]);
                $newfilename = (uniqid()) . '.' . end($temp);
                move_uploaded_file($tmp_name, "$uploadPath/$newfilename");
                $data['profile_image'] = $newfilename;
            }

            $result = $this->model_customer->update("app_admin", $data, "id='" . $user_id . "'");
            $this->session->set_flashdata('msg', dt_translate('profile_success'));
            $this->session->set_flashdata('msg_class', "success");
            redirect('admin/profile');
        }
    }

    public function report() {
        $data['title'] = dt_translate('admin');
        $this->load->view('admin/report/index', $data);
    }

    public function lang(){
        $langs=$this->input->get('language');
        if(isset($langs) && $langs!=""){
            $this->session->unset_userdata('language');
            $this->session->set_userdata("language",$langs);
        }
        redirect('admin/dashboard');
    }

    //show customer change password form
    public function update_password() {
        $this->authenticate->check();
        $data['title'] = dt_translate('change_password');
        $this->load->view('admin/change_password', $data);
    }

    //change password
    public function update_password_action() {
        $user_id = (int) $this->session->userdata('ADMIN_ID');
        $this->authenticate->check();

        $this->form_validation->set_rules('password', '', 'trim|required');
        $this->form_validation->set_rules('confirm_password', '', 'trim|required');
        $this->form_validation->set_message('required', dt_translate('required_message'));
        if ($this->form_validation->run() == false) {
            $this->update_password();
        } else {
            $password = $this->input->post('old_password');
            $new_password = $this->input->post('password');
            $id = (int) $this->session->userdata("ADMIN_ID");
            $get_result = $this->model_customer->getData("app_admin", "*", "id='" . $id . "'");
            if (count($get_result) > 0) {

                $update['default_password_changed'] = 1;
                $update['password'] = md5($new_password);
                $this->model_customer->update("app_admin", $update, "id='" . $id . "'");
                $this->session->set_userdata("DefaultPassword", 1);

                $this->session->set_flashdata('msg', dt_translate('reset_success'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/change-password');
            } else {
                $this->session->set_flashdata('msg', dt_translate('invalid_request'));
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('admin/login');
            }
        }
    }
}

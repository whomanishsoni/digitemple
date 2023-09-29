<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Donator extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_admin');
        $this->authenticate->check_admin();
        $this->lang->load('basic', dt_get_Langauge());
    }

    //show deparment list
    public function index() {
        $data['title'] = dt_translate('manage') . " " . dt_translate('donator');
        $order = "created_on DESC";
        $donator = $this->model_admin->getData("app_admin", "*", "type='C'", "", $order);
        $data['donator_data'] = $donator;
        $this->load->view('admin/donator/index', $data);
    }

    public function add_donator() {
        $data['title'] = dt_translate('add') . " " . dt_translate('donator');
        $this->load->view('admin/donator/add_update', $data);
    }

    public function update_donator($id) {

        $id = (int) $id;

        if ($id > 0) {

            $donator_data = $this->model_admin->getData('app_admin', '*', "id='$id' AND type='C'");
            if (isset($donator_data) && count($donator_data) > 0) {
                $data['donator_data'] = $donator_data[0];
                $data['title'] = dt_translate('update') . " " . dt_translate('donator');
                $this->load->view('admin/donator/add_update', $data);
            } else {
                $this->session->set_flashdata('msg', dt_translate('invalid_request'));
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('admin/donator');
            }
        } else {
            redirect('admin/donator');
        }
    }

    public function save_donator() {
        $admin_id = $this->session->userdata("ADMIN_ID");
        $id = (int) $this->input->post('id', TRUE);
        $this->form_validation->set_rules('email', dt_translate('email'), 'trim|required|is_unique[app_admin.email.id.' . $id . ']');
        $this->form_validation->set_rules('first_name', dt_translate('email'), 'trim|required');
        $this->form_validation->set_rules('last_name', dt_translate('email'), 'trim|required');
        $this->form_validation->set_rules('email', dt_translate('email'), 'trim|required');

        $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
        if ($this->form_validation->run() == FALSE) {
            $this->add_donator();
        } else {
            $this->load->helper('string');
            $password= random_string('alnum',8);

            $data = array(
                'first_name' => $this->input->post('first_name', TRUE),
                'last_name' => $this->input->post('last_name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'phone' => $this->input->post('phone', TRUE),
                'status' => $this->input->post("status", TRUE),
                'type' => 'C'
            );
            if ($id > 0) {
                $this->model_admin->update('app_admin', $data, "id = '$id'");
                $this->session->set_flashdata("msg", dt_translate('record_update'));
                $this->session->set_flashdata("msg_class", "success");
                redirect('admin/donator');
            } else {
                $data['password']=$password;
                $data['created_on'] = date('Y-m-d H:i:s');
                $this->model_admin->insert('app_admin', $data);


                //Send Email
                $data['password'] = md5($password);
                $data['type'] = "S";
                $data['created_by'] = $admin_id;
                $data['created_on'] = date("Y-m-d H:i:s");

                $name = (trim($this->input->post('first_name'))) . " " . (trim($this->input->post('last_name')));
                $hidenuseremail = $this->input->post('email');

                $subject = dt_translate('donator') . " | " . dt_translate('account_registration');
                $define_param['to_name'] = $name;
                $define_param['to_email'] = $hidenuseremail;

                $parameter['NAME'] = $name;
                $parameter['LOGIN_URL'] = base_url('login');
                $parameter['EMAIL'] = $hidenuseremail;
                $parameter['PASSWORD'] = $password;

                $html = $this->load->view("email_template/registration_admin", $parameter, true);
                $send = $this->sendmail->send($define_param, $subject, $html);

                $this->session->set_flashdata("msg", dt_translate('record_insert'));
                $this->session->set_flashdata("msg_class", "success");
                redirect('admin/donator');
            }
        }
    }

    //delete donator
    public function delete_donator($id) {
        $id = (int) $id;
        if ($id > 0) {
            $app_donation = $this->model_admin->getData("app_donation", "*", "donator_id=".$id);
            $app_cause_donation = $this->model_admin->getData("app_cause_donation", "*", "donator_id=".$id);

            if(count($app_donation)>0 || count($app_cause_donation)>0){
                $this->session->set_flashdata('msg', dt_translate('delete_already_used'));
                $this->session->set_flashdata('msg_class', 'failure');
            }else{
                $this->model_admin->delete('app_admin', 'id=' . $id.' AND type="C"');
                $this->session->set_flashdata('msg', dt_translate('record_delete'));
                $this->session->set_flashdata('msg_class', 'success');
            }

        } else {
            echo FALSE;
        }
    }

    public function donator_donation($id){
        $this->load->model('model_customer');

        $id=(int)$id;

        $data['title'] = dt_translate('donator') . " " . dt_translate('donation');

        $dep_join = array(
            array(
                'table' => 'app_donation_category',
                'condition' => 'app_donation_category.id=app_donation.category_id',
                'jointype' => 'inner'
            ),
            array(
                'table' => 'app_accounts',
                'condition' => 'app_accounts.id=app_donation.account_id',
                'jointype' => 'left'
            ),
            array(
                'table' => 'app_admin',
                'condition' => 'app_admin.id=app_donation.created_by',
                'jointype' => 'left'
            )
        );
        $orders = "app_donation.id DESC";
        $condition="donator_id=".$id;

        //$admin = $this->model_customer->getData("app_donation", "app_donation.*,app_donation_category.title", $condition, $dep_join, $orders);
        $admin = $this->model_customer->getData("app_donation", "app_donation.*,app_donation_category.title,concat(app_admin.first_name,' ',app_admin.last_name) as collected_by,app_accounts.name as account_name", $condition, $dep_join, $orders);
        
        $data['donation_data'] = $admin;

        $data['app_cause_donation'] = $this->model_customer->getData("app_cause_donation", "*",$condition,"","id desc");


        $this->load->view('admin/donator/donator_donation', $data);
    }

}

?>

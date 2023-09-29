<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Donation_category extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_admin');
        $this->authenticate->check_admin();
        $this->lang->load('basic', dt_get_Langauge());
    }

    //show deparment list
    public function index() {
        $data['title'] = dt_translate('manage') . " " . dt_translate('department');
        $order = "created_on DESC";
        $department = $this->model_admin->getData("app_donation_category", "*", "", "", $order);
        $data['department_data'] = $department;
        $this->load->view('admin/donation_category/index', $data);
    }

    public function add_department() {
        $data['title'] = dt_translate('add') . " " . dt_translate('department');
        $this->load->view('admin/donation_category/add_update', $data);
    }

    public function update_department($id) {

        $id = (int) $id;
        if ($id > 0) {

            $department_data = $this->model_admin->getData('app_donation_category', '*', "id='$id'");
            if (isset($department_data) && count($department_data) > 0) {
                $data['department_data'] = $department_data[0];
                $data['title'] = dt_translate('update') . " " . dt_translate('department');
                $this->load->view('admin/donation_category/add_update', $data);
            } else {
                $this->session->set_flashdata('msg', dt_translate('invalid_request'));
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('admin/donation_category');
            }
        } else {
            redirect('admin/donation_category');
        }
    }

    public function save_department() {

        $id = (int) $this->input->post('id', TRUE);
        $this->form_validation->set_rules('title', dt_translate('title'), 'trim|required|is_unique[app_donation_category.title.id.' . $id . ']');
        $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
        if ($this->form_validation->run() == FALSE) {
            $this->add_department();
        } else {

            $data = array(
                'title' => $this->input->post('title', TRUE),
                'status' => $this->input->post("status", TRUE)
            );
            if ($id > 0) {
                $this->model_admin->update('app_donation_category', $data, "id = '$id'");
                $this->session->set_flashdata("msg", dt_translate('record_update'));
                $this->session->set_flashdata("msg_class", "success");
                redirect('admin/donation_category');
            } else {
                $data['created_on'] = date('Y-m-d H:i:s');
                $this->model_admin->insert('app_donation_category', $data);
                $this->session->set_flashdata("msg", dt_translate('record_update'));
                $this->session->set_flashdata("msg_class", "success");
                redirect('admin/donation_category');
            }
        }
    }

    //delete department
    public function delete_department($id) {
        $id = (int) $id;
        if ($id > 0) {
            $app_donation = $this->model_admin->getData("app_donation", "*", "category_id=".$id);
            if(count($app_donation)>0){
                $this->session->set_flashdata('msg', dt_translate('delete_already_used'));
                $this->session->set_flashdata('msg_class', 'failure');
            }else{
                $this->model_admin->delete('app_donation_category', 'id=' . $id);
                $this->session->set_flashdata('msg', dt_translate('record_delete'));
                $this->session->set_flashdata('msg_class', 'success');
            }

        } else {
            echo FALSE;
        }
    }

}

?>
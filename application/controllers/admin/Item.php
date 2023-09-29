<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_customer');
        $this->authenticate->check_admin();
        $item_donation=is_module_enabled('item');
        if($item_donation==false){
            redirect('admin/dashboard');
        }
    }

    //show deparment list
    public function index() {
        $data['title'] = dt_translate('manage') . " " . dt_translate('item');
        $order = "created_on DESC";
        $item = $this->model_customer->getData("app_items", "*", "", "", $order);
        $data['item_data'] = $item;
        $this->load->view('admin/item/index', $data);
    }

    public function add_item() {
        $data['title'] = dt_translate('add') . " " . dt_translate('item');
        $this->load->view('admin/item/add_update', $data);
    }

    public function update_item($id) {

        $id = (int) $id;
        if ($id > 0) {
            $item_data = $this->model_customer->getData('app_items', '*', "id='$id'");
            if (isset($item_data) && count($item_data) > 0) {
                $data['item_data'] = $item_data[0];
                $data['title'] = dt_translate('update') . " " . dt_translate('item');
                $this->load->view('admin/item/add_update', $data);
            } else {
                $this->session->set_flashdata('msg', dt_translate('invalid_request'));
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('admin/item');
            }
        } else {
            redirect('admin/item');
        }
    }

    public function save_item() {

        $id = (int) $this->input->post('id', TRUE);
        $this->form_validation->set_rules('title', dt_translate('title'), 'trim|required|is_unique[app_items.title.id.' . $id . ']');
        $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
        if ($this->form_validation->run() == FALSE) {
            $this->add_item();
        } else {

            $data = array(
                'title' => $this->input->post('title', TRUE),
                'status' => $this->input->post("status", TRUE)
            );
            if ($id > 0) {
                $this->model_customer->update('app_items', $data, "id = '$id'");
                $this->session->set_flashdata("msg", dt_translate('record_update'));
                $this->session->set_flashdata("msg_class", "success");
                redirect('admin/items');
            } else {
                $data['created_on'] = date('Y-m-d H:i:s');
                $this->model_customer->insert('app_items', $data);
                $this->session->set_flashdata("msg", dt_translate('record_update'));
                $this->session->set_flashdata("msg_class", "success");
                redirect('admin/items');
            }
        }
    }

    //delete item
    public function delete_item($id) {
        $id = (int) $id;
        if ($id > 0) {

            $app_item_donation = $this->model_customer->getData("app_item_donation", "*", "item_id=".$id);
            if(count($app_item_donation)>0){
                $this->session->set_flashdata('msg', dt_translate('delete_already_used'));
                $this->session->set_flashdata('msg_class', 'failure');
            }else{
                $this->model_customer->delete('app_items', 'id=' . $id);
                $this->session->set_flashdata('msg', dt_translate('record_delete'));
                $this->session->set_flashdata('msg_class', 'success');
            }

        } else {
            echo FALSE;
        }
    }



}
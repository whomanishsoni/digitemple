<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Currency extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_admin');
        $this->authenticate->check_admin();
        $this->lang->load('basic', dt_get_Langauge());
    }

    //show deparment list
    public function index() {
        $data['title'] = dt_translate('manage') . " " . dt_translate('currency');
        $currency = $this->model_admin->getData("app_currency", "*");
        $data['currency_data'] = $currency;
        $this->load->view('admin/currency/index', $data);
    }

    public function add_currency() {
        $data['title'] = dt_translate('add') . " " . dt_translate('currency');
        $this->load->view('admin/currency/add_update', $data);
    }

    public function update_currency($id) {

        $id = (int) $id;
        if ($id > 0) {

            $currency_data = $this->model_admin->getData('app_currency', '*', "id='$id'");
            if (isset($currency_data) && count($currency_data) > 0) {
                $data['currency_data'] = $currency_data[0];
                $data['title'] = dt_translate('update') . " " . dt_translate('currency');
                $this->load->view('admin/currency/add_update', $data);
            } else {
                $this->session->set_flashdata('msg', dt_translate('invalid_request'));
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('admin/currency');
            }
        } else {
            redirect('admin/currency');
        }
    }

    public function save_currency() {

        $currency_id = (int) $this->input->post('id', true);
        $this->form_validation->set_rules('title', 'Title', 'trim|required|is_unique[app_currency.title.id.' . $currency_id . ']');
        $this->form_validation->set_rules('code', 'Code', 'trim|required|is_unique[app_currency.code.id.' . $currency_id . ']');
        $this->form_validation->set_rules('currency_code', 'Currency Code', 'trim|required');

        $this->form_validation->set_message('required', dt_translate('required_message'));
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == false) {
            if ($currency_id > 0) {
                $this->update_currency($currency_id);
            } else {
                $this->add_currency();
            }
        } else {
            $data['title'] = $this->input->post('title', true);
            $data['code'] = $this->input->post('code', true);
            $data['display_status'] ='A';
            $data['stripe_supported'] ='Y';
            $data['paypal_supported'] ='Y';
            $data['currency_code'] = $this->input->post('currency_code', true);

            if ($currency_id > 0) {
                if($currency_id>1){
                    $id = $this->model_admin->update('app_currency', $data, "id=$currency_id");
                    $this->session->set_flashdata('msg',dt_translate('record_update'));
                    $this->session->set_flashdata('msg_class', 'success');
                }else{
                    $this->session->set_flashdata('msg',"You are not allowed to update default currency.");
                    $this->session->set_flashdata('msg_class', 'info');
                    redirect('admin/currency', 'redirect');
                }
            } else {
                $id = $this->model_admin->insert('app_currency', $data);
                $this->session->set_flashdata('msg',dt_translate('record_insert'));
                $this->session->set_flashdata('msg_class', 'success');
            }
            redirect('admin/currency', 'redirect');
        }
    }

    //delete currency
    public function delete_currency($id) {
        $id = (int) $id;
        if ($id > 1) {
            $app_currency = $this->model_admin->getData("app_site_setting", "*", "currency_id=".$id);
            if(count($app_currency)>0){
                $this->session->set_flashdata('msg', dt_translate('delete_already_used'));
                $this->session->set_flashdata('msg_class', 'failure');
            }else{
                $this->model_admin->delete('app_currency', 'id=' . $id);
                $this->session->set_flashdata('msg', dt_translate('record_delete'));
                $this->session->set_flashdata('msg_class', 'success');
            }
        } else {
            $this->session->set_flashdata('msg', dt_translate('delete_already_used'));
            $this->session->set_flashdata('msg_class', 'failure');
            echo FALSE;
        }
    }

}

?>
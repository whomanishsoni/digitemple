<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class item_donation extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_customer');
        $item_donation=is_module_enabled('item');
        if($item_donation==false){
            redirect('admin/dashboard');
        }
    }


    //show admin list
    public function index() {
        $admin_id = $this->session->userdata("ADMIN_ID");
        $data['title'] = dt_translate('manage') . " " . dt_translate('item'). " " . dt_translate('donation');
        $order = "app_item_donation.created_on  DESC";

        $dep_join = array(
            array(
                'table' => 'app_items',
                'condition' => 'app_items.id=app_item_donation.item_id',
                'jointype' => 'inner'
            )
        );

        $condition="";
        if($this->session->userdata("TYPE")=="A"){
            $condition.="";
        }else{
            $condition.="created_by=".$admin_id;
        }
        $admin = $this->model_customer->getData("app_item_donation", "app_item_donation.*,app_items.title",$condition, $dep_join, $order);

        $orderi = "title  ASC";
        $data['app_item'] = $this->model_customer->getData("app_items", "*", "status='A'", "", $orderi);

        $data['item_donation_data'] = $admin;
        $this->load->view('admin/item_donation/index', $data);
    }

    //show add admin form
    public function add_item_donation() {

        $data['title'] = dt_translate('add') . " " . dt_translate('item'). " " . dt_translate('donation');
        $order = "title  ASC";
        $data['app_item'] = $this->model_customer->getData("app_items", "*", "status='A'", "", $order);
        $this->load->view('admin/item_donation/add_update', $data);
    }

    //show edit admin form
    public function update_item_donation($id) {
        $id = (int) $id;
        $app_item_donation = $this->model_customer->getData("app_item_donation", "*", "id='$id'");

        if (isset($app_item_donation) && count($app_item_donation)>0) {

            $order = "title  ASC";
            $data['app_item'] = $this->model_customer->getData("app_items", "*", "status='A'", "", $order);

            $data['item_donation_data'] = $app_item_donation[0];
            $data['title'] = dt_translate('update') . " " . dt_translate('item'). " " . dt_translate('donation');
            $this->load->view('admin/item_donation/add_update', $data);
        } else {
            $this->session->set_flashdata('msg', dt_translate('invalid_request'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('admin/item-donation');
        }
    }


    //add/edit an admin
    public function save_item_donation() {
        $admin_id = $this->session->userdata("ADMIN_ID");
        $Save_type=$this->input->post('Save', true);
        $id = (int) $this->input->post('id', true);
        $this->form_validation->set_rules('first_name', dt_translate('first_name'), 'trim|required');
        $this->form_validation->set_rules('last_name', dt_translate('last_name'), 'trim|required');
        $this->form_validation->set_rules('city', dt_translate('city'), 'trim|required');
        $this->form_validation->set_rules('qty', dt_translate('qty'), 'trim|required');
        $this->form_validation->set_rules('item_id', dt_translate('item'), 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            if ($id > 0) {
                $this->update_item_donation();
            } else {
                $this->add_item_donation();
            }
        } else {
            $data['first_name'] = $this->input->post('first_name', true);
            $data['last_name'] = $this->input->post('last_name', true);
            $data['city'] = $this->input->post('city', true);
            $data['phone'] = $this->input->post('phone', true);
            $data['qty'] = $this->input->post('qty', true);
            $data['email'] = $this->input->post('email', true);
            $data['item_id'] = $this->input->post('item_id', true);
            $data['status'] = $this->input->post('status', true);

            if ($id > 0) {

                $this->model_customer->update('app_item_donation', $data, "id=" . $id);
                $this->session->set_flashdata('msg', dt_translate('record_update'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/item-donation', 'redirect');
            } else {

                $data['created_by'] = $admin_id;
                $data['created_on'] = date("Y-m-d H:i:s");

                $last_id=$this->model_customer->insert('app_item_donation', $data);

                $this->session->set_flashdata('msg', dt_translate('record_insert'));
                $this->session->set_flashdata('msg_class', 'success');

                if($Save_type=="Print"){
                    $this->session->set_flashdata('last_donation',$last_id);
                }
                redirect('admin/item-donation', 'redirect');

            }
        }
    }

    //delete an admin
    public function delete_item_donation($id) {
        $id = (int) $id;
        if ($id > 0) {
            $this->model_customer->delete('app_item_donation', 'id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
            echo true;
        } else {
            echo FALSE;
        }
    }

    public function item_donation_export(){
        $admin_id = $this->session->userdata("ADMIN_ID");
        $order = "app_item_donation.created_on  DESC";

        $dep_join = array(
            array(
                'table' => 'app_items',
                'condition' => 'app_items.id=app_item_donation.item_id',
                'jointype' => 'inner'
            )
        );

        $condition="";
        if($this->session->userdata("TYPE")=="A"){
            $condition.="";
        }else{
            $condition.="created_by=".$admin_id;
        }
        $app_donation = $this->model_customer->getData("app_item_donation", "app_item_donation.*,app_items.title",$condition, $dep_join, $order);
        if(isset($app_donation) && count($app_donation)){
            $filename="item_donation_".date('Y_m_d').".csv";
            $delimiter = ",";

            //create a file pointer
            $f = fopen('php://memory', 'w');

            //set column headers

            $fields = array(
                '#',
                dt_translate('first_name'),
                dt_translate('last_name'),
                dt_translate('email'),
                dt_translate('phone'),
                dt_translate('city'),
                dt_translate('qty'),
                dt_translate('item'),
            );

            fputcsv($f, $fields, $delimiter);

            //output each row of the data, format line as csv and write to file pointer
            foreach ($app_donation as $donation){

                $lineData = array(
                    $donation['id'],
                    $donation['first_name'],
                    $donation['last_name'],
                    $donation['email'],
                    $donation['phone'],
                    $donation['city'],
                    $donation['qty'],
                    $donation['title'],
                );

                fputcsv($f, $lineData, $delimiter);
            }

            //move back to beginning of file
            fseek($f, 0);

            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');

            //output all remaining data on a file pointer
            fpassthru($f);
        }else{
            redirect('admin/item-donation');
        }
    }
}

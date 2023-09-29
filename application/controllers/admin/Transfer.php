<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transfer extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_admin');
        $this->load->model('model_customer');
        $this->authenticate->check_admin();

    }

    //show admin list
    public function index() {
        $data['title'] = dt_translate('manage') . " " . dt_translate('transfer');
       
        $order = "app_transfer.id DESC";
        $dep_join = array(
            array(
                'table' => 'app_admin',
                'condition' => 'app_admin.id=app_transfer.created_by',
                'jointype' => 'left'
            )
        );
        $transfers = $this->model_customer->getData("app_transfer", "app_transfer.*,concat(app_admin.first_name,' ',app_admin.last_name) as created_by_name", '', $dep_join, $order);
        $data['transfers'] = $transfers;
        $accounts = $this->model_admin->getData("app_accounts","*","","","name asc");
        foreach($accounts as $account) {
            $data['accounts'][$account['id']] = $account;
        }
        
        
        $this->load->view('admin/transfer/index', $data);
    }

    //show add admin form
    public function add_transfer() {
        $data['title'] = dt_translate('add') . " " . dt_translate('admin');
        $accounts = $this->model_admin->getData("app_accounts","*");
        foreach($accounts as $account) {
            $account['balance'] = account_balance($account['id']);
            $data['accounts'][] = $account;
        }
        $this->load->view('admin/transfer/add_update', $data);
    }

    //show edit account form
    public function update_transfer($id) {
        $id = (int) $id;
        $transfer = $this->model_admin->getData("app_transfer", "*", "id='$id'");
        if (empty($transfer)) {
            $this->session->set_flashdata('msg', dt_translate('invalid_request'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('admin/transfer');
        }
        
        if (isset($transfer[0]) && !empty($transfer[0])) {
            $data['transfer_data'] = $transfer[0];
            $data['title'] = dt_translate('update') . " " . dt_translate('transfer');
            $accounts = $this->model_admin->getData("app_accounts","*");
            foreach($accounts as $account) {
                $account['balance'] = account_balance($account['id']);
                $data['accounts'][] = $account;
            }
            $this->load->view('admin/transfer/add_update', $data);
        } else {
            redirect('admin/transfer');
        }
    }

    //add/edit an account
    public function save_transfer() {
        
        $admin_id = $this->session->userdata("ADMIN_ID");

        $id = (int) $this->input->post('id', true);
        
        $this->form_validation->set_rules('from_account', dt_translate('from_account'), 'trim|required');
        $this->form_validation->set_rules('to_account', dt_translate('to_account'), 'trim|required');
        $this->form_validation->set_rules('amount', dt_translate('amount'), 'trim|required');
        $this->form_validation->set_rules('date', dt_translate('date'), 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            if ($id > 0) {
                $this->update_transfer(0);
            } else {
                $this->add_transfer();
            }
        } else {
            
            $data['from_account'] = $this->input->post('from_account', true);
            $data['to_account'] = $this->input->post('to_account', true);
            $data['amount'] = $this->input->post('amount', true);
            $data['date'] = $this->input->post('date',true);
            if ($id > 0) {
                $data['updated_on'] = date("Y-m-d H:i:s");
                $this->model_admin->update('app_transfer', $data, "id=" . $id);
                
                //update txn data
                $transfer_data = $this->db->query("select * from app_transfer where id='$id'")->row_array();
                $txn_id = $transfer_data['txn_id'];
               
                $this->model_admin->delete('app_transactions', "txn_id='$txn_id'");
                
                $txn_data['account_id'] = $data['from_account'];
                $txn_data['txn_id'] = $txn_id;
                $txn_data['type'] = "transfer";
                $txn_data['amount'] = -$data['amount'];
                $this->model_admin->insert('app_transactions', $txn_data);
                
                $txn_data['account_id'] = $data['to_account'];
                $txn_data['txn_id'] = $txn_id;
                $txn_data['type'] = "transfer";
                $txn_data['amount'] = $data['amount'];
                $this->model_admin->insert('app_transactions', $txn_data);
                
                
                $this->session->set_flashdata('msg', dt_translate('record_update'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/transfer', 'redirect');
            } else {
                $txn_id = uniqid($admin_id."_");

                $txn_data['account_id'] = $data['from_account'];
                $txn_data['txn_id'] = $txn_id;
                $txn_data['type'] = "transfer";
                $txn_data['amount'] = -$data['amount'];
                $this->model_admin->insert('app_transactions', $txn_data);
                
                $txn_data['account_id'] = $data['to_account'];
                $txn_data['txn_id'] = $txn_id;
                $txn_data['type'] = "transfer";
                $txn_data['amount'] = $data['amount'];
                $this->model_admin->insert('app_transactions', $txn_data);
                
                
                $data['created_by'] = $admin_id;
                $data['created_on'] = date("Y-m-d H:i:s");
                $data['txn_id'] = $txn_id;
                $this->model_admin->insert('app_transfer', $data);
                redirect('admin/transfer', 'redirect');
            }
        }
    }

    //delete an admin
    public function delete_transfer($id) {
        $id = (int) $id;
        if ($id > 0) {
            $transfer_data = $this->db->query("select * from app_transfer where id='$id'")->row_array();
            $txn_id = $transfer_data['txn_id'];
            $this->model_admin->delete('app_transactions', "txn_id='$txn_id'");
            $this->model_admin->delete('app_transfer', 'id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
            echo true;
        } else {
            echo FALSE;
        }
    }

}

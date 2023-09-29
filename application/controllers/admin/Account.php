<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_admin');
        $this->authenticate->check_admin();

    }

    //show admin list
    public function index() {
        $data['title'] = dt_translate('manage') . " " . dt_translate('account');
        $order = "id ASC";
        $admin = $this->model_admin->getData("app_accounts", "*", "", "", $order);
        $data['admin_data'] = $admin;
        $this->load->view('admin/account/index', $data);
    }

    //show add admin form
    public function add_account() {
        $data['title'] = dt_translate('add') . " " . dt_translate('admin');
        $this->load->view('admin/account/add_update', $data);
    }

    //show edit account form
    public function update_account($id) {
        $id = (int) $id;
        $account = $this->model_admin->getData("app_accounts", "*", "id='$id'");
        if (empty($account)) {
            $this->session->set_flashdata('msg', dt_translate('invalid_request'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('admin/account');
        }

        if (isset($account[0]) && !empty($account[0])) {
            $data['account_data'] = $account[0];
            $data['title'] = dt_translate('update') . " " . dt_translate('admin');
            $this->load->view('admin/account/add_update', $data);
        } else {
            redirect('admin/account');
        }
    }

    //add/edit an account
    public function save_account() {
        
        $admin_id = $this->session->userdata("ADMIN_ID");

        $id = (int) $this->input->post('id', true);
        
        $this->form_validation->set_rules('name', dt_translate('name'), 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            if ($id > 0) {
                $this->update_account(0);
            } else {
                $this->add_account();
            }
        } else {
            
            $data['name'] = $this->input->post('name', true);
            $data['is_active'] = $this->input->post('status', true);
            if ($id > 0) {
                $data['updated_on'] = date("Y-m-d H:i:s");
                $this->model_admin->update('app_accounts', $data, "id=" . $id);

                $this->session->set_flashdata('msg', dt_translate('record_update'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/account', 'redirect');
            } else {
                $data['created_by'] = $admin_id;
                $data['created_on'] = date("Y-m-d H:i:s");

                $name = trim($this->input->post('name'));
                $this->model_admin->insert('app_accounts', $data);


                redirect('admin/account', 'redirect');
            }
        }
    }

    //delete an admin
    public function delete_account($id) {
        $id = (int) $id;
        if ($id > 0) {
            $this->model_admin->delete('app_accounts', 'id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
            echo true;
        } else {
            echo FALSE;
        }
    }

	public function getAccountData()
	{
        $table = $this->table = 'app_accounts';
        $column_order = $this->column_order = array(null, 'name');
        $column_search = $this->column_search = array('name',); 
        $order = $this->order = array('id' => 'asc'); 
		$list = $this->model_admin->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customers) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $customers->name;
            $row[] = account_balance($customers->id);
            $row[] = "<a href='".base_url()."/admin/update-account/".$customers->id."' class='btn btn-primary btn-sm'>Update</a>
            <a href='javascript:void(0)' data-action='delete-account' data-toggle='modal' onclick='DeleteConfirm(this)' data-target='#delete-record' data-id='".$customers->id."'  class='btn btn-danger btn-sm'>Delete</a> 
            ";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_admin->count_all(),
			"recordsFiltered" => $this->model_admin->count_filtered(),
			"data" => $data,
		);

		echo json_encode($output);
	}

}

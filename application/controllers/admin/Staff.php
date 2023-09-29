<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_admin');
        $this->authenticate->check_admin();

        $item_donation=is_module_enabled('staff');
        if($item_donation==false){
            redirect('admin/dashboard');
        }
    }

    //show admin list
    public function index() {
        $data['title'] = dt_translate('manage') . " " . dt_translate('staff');
        $order = "amount DESC";
        $total_donate = " (select sum(amount) from app_donation where donator_id=app_admin.id ) as total_donate ";
        $year_donate = " (select sum(amount) from app_donation where donator_id=app_admin.id and YEAR(created_on)=".date('Y')." ) as year_donate ";
        $admin = $this->model_admin->getData("app_admin", "*,$total_donate,$year_donate", "", "", $order);
        $data['admin_data'] = $admin;
        //get total amount to be paid by all members
        $total_amount = $this->db->query("select sum(amount) as amount from app_admin")->row_array();
        $data['total_amount'] = $total_amount['amount'];
        
        //get total paid amount from all members
        $paid_amount = $this->db->query("select sum(d.amount) as amount from app_donation d INNER JOIN app_admin a ON a.id=d.donator_id where d.donator_id!=0")->row_array();
        $data['total_paid'] = $paid_amount['amount'];

        //total staff
        $total_staff = $this->db->query("select count(*) as total_staff from app_admin")->row_array();
        $data['total_staff'] = $total_staff['total_staff'];
        $this->load->view('admin/staff/index', $data);
    }

    //show add admin form
    public function add_staff() {
        $data['title'] = dt_translate('add') . " " . dt_translate('admin');
        $this->load->view('admin/staff/add_update', $data);
    }

    //show edit admin form
    public function update_staff($id) {
        $id = (int) $id;
        $admin = $this->model_admin->getData("app_admin", "*", "id='$id'");
        if (empty($admin)) {
            $this->session->set_flashdata('msg', dt_translate('invalid_request'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('admin/staff');
        }

        if (isset($admin[0]) && !empty($admin[0])) {
            $data['customer_data'] = $admin[0];
            $data['title'] = dt_translate('update') . " " . dt_translate('admin');
            $this->load->view('admin/staff/add_update', $data);
        } else {
            redirect('admin/staff');
        }
    }

    //add/edit an admin
    public function save_staff() {
        $admin_id = $this->session->userdata("ADMIN_ID");

        $id = (int) $this->input->post('id', true);
        
        $this->form_validation->set_rules('first_name', dt_translate('first_name'), 'trim|required');
        $this->form_validation->set_rules('last_name', dt_translate('last_name'), 'trim|required');
        //$this->form_validation->set_rules('email', dt_translate('email'), 'trim|required|is_unique[app_admin.email.id.' . $id . ']');
        $this->form_validation->set_rules('phone', dt_translate('phone'), 'trim|required|min_length[10]|max_length[10]|is_unique[app_admin.phone.id.' . $id . ']');
        $this->form_validation->set_rules('city', dt_translate('city'), 'trim|required');
        $this->form_validation->set_rules('amount', dt_translate('amount'), 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            if ($id > 0) {
                $this->update_staff(0);
            } else {
                $this->add_staff();
            }
        } else {
                
            $data['first_name'] = $this->input->post('first_name', true);
            $data['last_name'] = $this->input->post('last_name', true);
            //$data['email'] = $this->input->post('email', true);
            $data['phone'] = $this->input->post('phone', true);
            $data['status'] = $this->input->post('status', true);
            $data['amount'] = $this->input->post('amount',true);
            $data['city'] = $this->input->post('city',true);
            $data['type'] = $this->input->post('type',true);
            if ($id > 0) {
                $data['updated_on'] = date("Y-m-d H:i:s");
                $this->model_admin->update('app_admin', $data, "id=" . $id);

                $this->session->set_flashdata('msg', dt_translate('record_update'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/staff', 'redirect');
            } else {
                $this->load->helper('string');
                $password = random_string('alnum', 8);

                $data['password'] = md5($password);
                //$data['type'] = "S";
                $data['created_by'] = $admin_id;
                $data['created_on'] = date("Y-m-d H:i:s");

                $name = (trim($this->input->post('first_name'))) . " " . (trim($this->input->post('last_name')));
                $hidenuseremail = $this->input->post('email');
                $this->model_admin->insert('app_admin', $data);
				$this->session->set_flashdata('msg', dt_translate('record_update')." Password is $password");
                $this->session->set_flashdata('msg_class', 'success');

                // Email sent = false
                /*
                $subject = dt_translate('staff') . " | " . dt_translate('account_registration');
                $define_param['to_name'] = $name;
                $define_param['to_email'] = $hidenuseremail;

                $parameter['NAME'] = $name;
                $parameter['LOGIN_URL'] = base_url('login');
                $parameter['EMAIL'] = $hidenuseremail;
                $parameter['PASSWORD'] = $password;

                $html = $this->load->view("email_template/registration_admin", $parameter, true);
                $send = $this->sendmail->send($define_param, $subject, $html);

                $this->session->set_flashdata('msg', dt_translate('record_insert'));
                $this->session->set_flashdata('msg_class', 'success');
                */

                redirect('admin/staff', 'redirect');
            }
        }
    }

    //delete an admin
    public function delete_staff($id) {
        $id = (int) $id;
        if ($id > 0) {
            $this->model_admin->delete('app_admin', 'id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
            echo true;
        } else {
            echo FALSE;
        }
    }

    public function getStaffData()
	{
        $table = $this->table = 'app_admin';
        $order = "amount DESC";

        if(!empty($_POST['order'][0]['column'])) {
            $col = $_POST['order'][0]['column'];
            $order_by = $_POST['columns'][$col]['name'];
            if($order_by == 'name') {
                $order_by = "CONCAT(app_admin.first_name, ' ', app_admin.last_name)";
            } 
            $order_dir = $_POST['order'][0]['dir'];
            $order = "$order_by $order_dir";     
        }

        $condition = "";
        $searchParams = [
            'name' => 'CONCAT(app_admin.first_name, " ", app_admin.last_name)',
            'phone' => 'app_admin.phone',
            'city' => 'app_admin.city',
            'amount' => 'app_admin.amount',
        ];
        
        foreach ($searchParams as $param => $column) {
            if (!empty($_POST[$param])) {
                $searchValue = $_POST[$param];
                if (!empty($condition)) {
                    $condition .= " AND ";
                }
                $condition .= "$column LIKE '%" . $searchValue . "%'";
            }
        }

        if (!empty($_POST['search']['value'])) {
            $search = $_POST['search']['value'];
        
            $searchFields = [
                'name' => 'CONCAT(app_admin.first_name, " ", app_admin.last_name)',
                'phone' => 'app_admin.phone',
                'city' => 'app_admin.city',
                'amount' => 'app_admin.amount',         
            ];
        
            $conditions = [];
        
            foreach ($searchFields as $field) {
                
                $conditions[] = $field . " LIKE '%" . $search . "%'";
            }
        
            $condition = '(' . implode(' OR ', $conditions) . ')';
        }

        $all_count = $this->model_admin->getData("app_admin", "*,$total_donate,$year_donate", $condition, "", $order);

        $totalFilteredAmount = 0;

        foreach ($all_count as $donation) {

            $amount = $donation['amount'];
    
            $totalFilteredAmount += $amount;
        }

        $total_donate = " (select sum(amount) from app_donation where donator_id=app_admin.id ) as total_donate ";
        $year_donate = " (select sum(amount) from app_donation where donator_id=app_admin.id and YEAR(created_on)=".date('Y')." ) as year_donate ";
        $limit = $_POST['length'].",".$_POST['start'];
        $list = $this->model_admin->getData("app_admin", "*,$total_donate,$year_donate", $condition, "", $order, '', '', $limit);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customers) {
			$no++;
			$row = array();
            $due_amount = dt_price_format($customers['amount'] - $customers['total_donate']);
			$row[] = $no;
            $row[] = escape_data($customers['first_name'] . " " . $customers['last_name']);
            $row[] = "<a href='tel:'>".escape_data($customers['phone'])."</a>";
                    
            $row[] = escape_data($customers['city']);
            $row[] = dt_get_status_badge($customers['status']);
            $row[] = dt_price_format($customers['amount']);
            $row[] = dt_price_format($customers['total_donate']);
            $row[] = dt_price_format($customers['year_donate']);
            $row[] = "<span style='font-weight:bold;color:red'>$due_amount</span>";
            if ($customers['id'] != 1) {
                $row[] .= "
                <a href='".base_url()."admin/add-donation?id=".$customers['id']."' class='btn btn-success btn-sm'>Add Donation</a>
                <a href='".base_url()."/admin/donator-donation/".$customers['id']."' class='btn btn-info btn-sm'>Donation</a> 
                <a href='".base_url()."/admin/update-staff/".$customers['id']."' class='btn btn-primary btn-sm'>Update</a>
                <a href='javascript:void(0)' data-action='delete-staff' data-toggle='modal' onclick='DeleteConfirm(this)' data-target='#delete-record' data-id='".$customers->id."'  class='btn btn-danger btn-sm'>Delete</a>";
            } else {
                $row[] .= "
                <a href='".base_url()."admin/add-donation?id=".$customers['id']."' class='btn btn-success btn-sm'>Add Donation</a>
                <a href='".base_url()."/admin/donator-donation/".$customers['id']."' class='btn btn-info btn-sm'>Donation</a> ";
            }

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_admin->count_all(),
			"recordsFiltered" => count($all_count),
			"data" => $data,
            'totalFilteredAmount' => $totalFilteredAmount
		);

		echo json_encode($output);
	}

}

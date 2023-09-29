<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Donation extends MY_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_customer');
        $this->load->model('model_admin');
    }


    //show admin list
    public function index() {
        $admin_id = $this->session->userdata("ADMIN_ID");
        $selected_department=(int)$this->session->userdata('selected_department');
        $data['title'] = dt_translate('manage') . " " . dt_translate('donation');
        $order = "app_donation.date DESC";

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
        $condition="";
        /*
        if($this->session->userdata("TYPE")=="A"){
            $condition.="";
        }else{
            $condition.="created_by=".$admin_id;
        }
        */

        $admin = $this->model_customer->getData("app_donation", "app_donation.*,app_donation_category.title,concat(app_admin.first_name,' ',app_admin.last_name) as collected_by,app_accounts.name as account_name", $condition, $dep_join, $order);
        $orders = "title  ASC";
        $data['app_donation_category'] = $this->model_customer->getData("app_donation_category", "*", "status='A'", "", $orders);
        $data['donation_data'] = $admin;
        $this->load->view('admin/donation/index', $data);
    }

    //show add admin form
    public function add_donation() {
        $user_id = $this->input->get('id');
        $data['donation_data'] = [];
        if($user_id) {
            $user = $this->model_admin->getAdminDetail($user_id);
            if(!empty($user)) {
                $user = $user[0];
                $data['donation_data'] = ['first_name'  => $user['first_name'],
                                           'last_name'  => $user['last_name'],
                                           'phone'      => $user['phone'],
                                           'city'       => $user['city'],
                                           'user_id'   => $user['id'],
                                            ];
            }
        }
        $data['title'] = dt_translate('add') . " " . dt_translate('donation');
        $order = "title  ASC";
        $data['app_donation_category'] = $this->model_customer->getData("app_donation_category", "*", "status='A'", "", $order);
        $data['accounts'] = $this->model_customer->getData("app_accounts", "*", "is_active='1'", "", 'name asc');
        $this->load->view('admin/donation/add_update', $data);
    }

    //show edit admin form
    public function update_donation($id) {
        $id = (int) $id;
        $admin = $this->model_customer->getData("app_donation", "*", "id='$id'");
        if (empty($admin)) {
            $this->session->set_flashdata('msg', dt_translate('invalid_request'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('donation');
        }

        if (isset($admin[0]) && !empty($admin[0])) {

            $order = "title  ASC";
            $data['app_donation_category'] = $this->model_customer->getData("app_donation_category", "*", "status='A'", "", $order);
            $data['accounts'] = $this->model_customer->getData("app_accounts","*",'is_active=1','','name asc');    
            $data['donation_data'] = $admin[0];
            $data['title'] = dt_translate('update') . " " . dt_translate('donation');
            $this->load->view('admin/donation/add_update', $data);
        } else {
            redirect('admin/donation');
        }
    }

    //add/edit an admin
    public function save_donation() {
        $admin_id = $this->session->userdata("ADMIN_ID");

        $id = (int) $this->input->post('id', true);
        $this->form_validation->set_rules('first_name', dt_translate('first_name'), 'trim|required');
        $this->form_validation->set_rules('last_name', dt_translate('last_name'), 'trim|required');
        $this->form_validation->set_rules('city', dt_translate('city'), 'trim|required');
        $this->form_validation->set_rules('phone', dt_translate('phone'), 'trim');
        $this->form_validation->set_rules('amount', dt_translate('last_name'), 'trim|required');
        $this->form_validation->set_rules('category_id', dt_translate('department'), 'trim|required');
        $this->form_validation->set_rules('account_id', dt_translate('account'), 'trim|required');
        $this->form_validation->set_rules('type', dt_translate('type'), 'trim|required');
        $this->form_validation->set_rules('date', dt_translate('date'), 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            if ($id > 0) {
                $this->update_donation();
            } else {
                $this->add_donation();
            }
        } else {
            $data['first_name'] = $this->input->post('first_name', true);
            $data['last_name'] = $this->input->post('last_name', true);
            $data['city'] = $this->input->post('city', true);
            //$data['email'] = $this->input->post('email', true);
            $data['phone'] = $this->input->post('phone', true);
            $data['amount'] = $this->input->post('amount', true);
            $data['category_id'] = $this->input->post('category_id', true);
            $data['account_id'] = $this->input->post('account_id', true);
            $data['type'] = $this->input->post('type', true);
            $data['cheque_no'] = $this->input->post('cheque_no', true);
            $data['date'] = $this->input->post('date',true);
            $data['details'] = $this->input->post('details',true);
            $data['ref_no'] = $this->input->post('ref_no',true);

            if ($id > 0) {
                $this->model_customer->update('app_donation', $data, "id=" . $id);
                
                $donation = $this->db->query("select * from app_donation where id='$id'")->row_array();
                
                $txn_id = $donation['txn_id'];
                $txn_data['account_id'] = $data['account_id'];
                $txn_data['amount'] = $data['amount'];
                $this->model_customer->update('app_transactions', $txn_data, "txn_id='$txn_id'" );
                    
                $this->session->set_flashdata('msg', dt_translate('record_update'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/donation', 'redirect');
            } else {
                $data['donator_id'] = $this->input->post('donator_id');
                $data['created_by'] = $admin_id;
                $data['created_on'] = date("Y-m-d H:i:s");

                //txn data
                $txn_id = uniqid($admin_id."_");
                $data['txn_id'] = $txn_id;
                $this->model_customer->insert('app_donation', $data);                

                $txn_data['account_id'] = $data['account_id'];
                $txn_data['txn_id'] = $txn_id;
                $txn_data['type'] = "donation";
                $txn_data['amount'] = $data['amount'];
                $this->model_admin->insert('app_transactions', $txn_data);


                $this->session->set_flashdata('msg', dt_translate('record_insert'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/donation', 'redirect');
            }
        }
    }

    //delete an admin
    public function delete_donation($id) {
        $id = (int) $id;
        if ($id > 0) {
            $donation_data = $this->db->query("select * from app_donation where id='$id'")->row_array();
            $txn_id = $donation_data['txn_id'];
            $this->model_admin->delete('app_transactions', "txn_id='$txn_id'");

            $this->model_customer->delete('app_donation', 'id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
            echo true;
        } else {
            echo FALSE;
        }
    }

    public function donation_receipt($id){

        $dep_join = array(
            array(
                'table' => 'app_donation_category',
                'condition' => 'app_donation_category.id=app_donation.category_id',
                'jointype' => 'inner'
            ),
            array(
                'table' => 'app_admin',
                'condition' => 'app_admin.id=app_donation.created_by',
                'jointype' => 'inner'
            )
        );

        $app_donation = $this->model_customer->getData("app_donation", "app_donation.*,app_donation_category.title,app_admin.first_name as created_first_name,app_admin.last_name as created_last_name", "app_donation.id=".$id, $dep_join);

        if(isset($app_donation) && count($app_donation)>0){
            $app_donation_rec=$app_donation[0];

            $data['donation_data']=$app_donation_rec;
            $this->load->view('admin/receipt/donation', $data);
        }else{
            redirect('admin/donation');
        }
    }

    public function donation_export(){

        $admin_id = $this->session->userdata("ADMIN_ID");
        $order = "app_donation.created_on DESC";

        $dep_join = array(
            array(
                'table' => 'app_donation_category',
                'condition' => 'app_donation_category.id=app_donation.category_id',
                'jointype' => 'inner'
            )
        );
        $condition="";
        if($this->session->userdata("TYPE")=="A"){
            $condition.="";
        }else{
            $condition.="created_by=".$admin_id;
        }

        $app_donation = $this->model_customer->getData("app_donation", "app_donation.*,app_donation_category.title", $condition, $dep_join, $order);

        if(isset($app_donation) && count($app_donation)){
            $filename="donation_".date('Y_m_d').".csv";
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
                dt_translate('amount'),
                dt_translate('payment_by'),
                dt_translate('cheque'),
                dt_translate('department'),
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
                    number_format($donation['amount'],2),
                    $donation['type'],
                    $donation['cheque_no'],
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
            redirect('admin/donation');
        }
    }

    public function getDonationCategoryData()
	{
        $table = $this->table = 'app_donation_category';
        $column_order = $this->column_order = array(null, 'title');
        $column_search = $this->column_search = array('title'); 
        $order = $this->order = array('id' => 'asc'); 
		$list = $this->model_admin->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customers) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $customers->title;
            $row[] = dt_get_status_badge($customers->status);
            $row[] = category_donation($customers->id);
            $row[] = "<a href='".base_url()."/admin/update-donation-category/".$customers->id."' class='btn btn-primary btn-sm'>Update</a>
            <a href='javascript:void(0)' data-action='delete-donation-category' data-toggle='modal' onclick='DeleteConfirm(this)' data-target='#delete-record' data-id='".$customers->id."'  class='btn btn-danger btn-sm'>Delete</a> 
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

    public function getDonationData()
	{
        $table = $this->table = 'app_donation';
        $order = "app_donation.date DESC";
        
        if(!empty($_POST['order'][0]['column'])) {
            $col = $_POST['order'][0]['column'];
            $order_by = $_POST['columns'][$col]['name'];
            if($order_by == 'name') {
                $order_by = "CONCAT(app_donation.first_name, ' ', app_donation.last_name)";
            } 
            if($order_by == 'collected_by') {
                $order_by = "CONCAT(app_admin.first_name, ' ', app_admin.last_name)";
            } 
            $order_dir = $_POST['order'][0]['dir'];
            $order = "$order_by $order_dir";     
        }
        
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

        $condition = "";

        $searchParams = [
            'ref_no' => 'app_donation.ref_no',
            'name' => 'CONCAT(app_donation.first_name, " ", app_donation.last_name)',
            'phone' => 'app_donation.phone',
            'city' => 'app_donation.city',
            'category' => 'app_donation_category.title',
            'payment' => 'app_accounts.name',
            'collection' => 'CONCAT(app_admin.first_name, " ", app_admin.last_name)',
            'amount' => 'app_donation.amount',
            'date' => 'DATE_FORMAT(app_donation.date, "%d-%m-%Y")',
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
                'app_donation.ref_no',
                'CONCAT(app_donation.first_name, " ", app_donation.last_name)',
                'app_donation.email',
                'app_donation.phone',
                'app_donation.city',
                'app_donation_category.title',
                'app_accounts.name',
                'app_donation.amount',
                'DATE_FORMAT(app_donation.date, "%d-%m-%Y")', 
                'app_donation.details',
            ];
        
            $conditions = [];
        
            foreach ($searchFields as $field) {
                
                $conditions[] = $field . " LIKE '%" . $search . "%'";
            }
        
            $condition = '(' . implode(' OR ', $conditions) . ')';
        }

        $all_count = $this->model_customer->getData("app_donation", "app_donation.*,app_donation_category.title,concat(app_admin.first_name,' ',app_admin.last_name) as collected_by,app_accounts.name as account_name", $condition, $dep_join);

        $totalFilteredAmount = 0;

        foreach ($all_count as $donation) {

            $amount = $donation['amount'];
    
            $totalFilteredAmount += $amount;
        }
        
        $limit = $_POST['length'].",".$_POST['start'];
        $list = $this->model_customer->getData("app_donation", "app_donation.*,app_donation_category.title,concat(app_admin.first_name,' ',app_admin.last_name) as collected_by,app_accounts.name as account_name", $condition, $dep_join, $order, '', '', $limit);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customers) {
			$no++;
			$row = array();
            $payment_type="<span class='badge badge-info'>".$customers['account_name']." - ".$customers['type']."</span>";
			$row[] = $no;
			$row[] = $customers['ref_no'];
            $row[] = escape_data($customers['first_name'] . " " . $customers['last_name']) . "<br>" .
                    "<small class='badge badge-default'>". escape_data($customers['email']) . "</small>";
            $row[] = escape_data($customers['phone']);
            $row[] = escape_data($customers['city']);
            $row[] = escape_data($customers['title']);
            $row[] = $payment_type;
            $row[] = $customers["collected_by"];
            $row[] = dt_price_format($customers['amount']);
            $row[] = get_formated_date($customers['date'],"N");
            $row[] = $customers['details'];
            $row[] = "<a href='".base_url()."/admin/update-donation/".$customers['id']."' class='btn btn-primary btn-sm'>Update</a>
            <a href='javascript:void(0)' data-action='delete-donation' data-toggle='modal' onclick='DeleteConfirm(this)' data-target='#delete-record' data-id='".$customers['id']."'  class='btn btn-danger btn-sm'>Delete</a> 
            ";
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



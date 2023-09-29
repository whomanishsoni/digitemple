<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expense extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_admin');
        $this->load->model('model_customer');
        $this->lang->load('basic', dt_get_Langauge());
        $item_donation=is_module_enabled('expense');
        if($item_donation==false){
            redirect('admin/dashboard');
        }
    }

    //show deparment list
    public function index() {
        $admin_id = $this->session->userdata("ADMIN_ID");
        $data['title'] = dt_translate('manage') . " " . dt_translate('expense');
        $order = "app_expense.expense_date DESC";


        $exp_join = array(
            array(
                'table' => 'app_expense_category',
                'condition' => 'app_expense_category.id=app_expense.category_id',
                'jointype' => 'inner'
            ),
            array(
                'table' => 'app_admin',
                'condition' => 'app_admin.id=app_expense.created_by',
                'jointype' => 'left'
            ),
            array(
                'table' => 'app_accounts',
                'condition' => 'app_accounts.id=app_expense.account_id',
                'jointype' => 'left'
            )
        );

        $condition="";
        if($this->session->userdata("TYPE")!="A"){
            //$condition.=" app_expense.created_by=".$admin_id;
        }

        $expense = $this->model_admin->getData("app_expense", "app_expense.*,app_expense_category.title as category_title,concat(app_admin.first_name,' ',app_admin.last_name) as created_by_name,app_accounts.name as account_name",$condition, $exp_join, $order);

        $data['expense_data'] = $expense;
        $this->load->view('admin/expense/index', $data);
    }

    public function add_expense() {
        $data['app_expense_category'] = $this->model_admin->getData('app_expense_category', '*', "status='A'");
        $data['accounts'] = $this->model_admin->getData('app_accounts', '*', "is_active='1'");
        $data['title'] = dt_translate('add') . " " . dt_translate('expense');
        $this->load->view('admin/expense/add_update', $data);
    }

    public function update_expense($id) {

        $id = (int) $id;
        if ($id > 0) {
            $data['app_expense_category'] = $this->model_admin->getData('app_expense_category', '*', "status='A'");
            $data['accounts'] = $this->model_admin->getData('app_accounts', '*', "is_active='1'");
            $expense_data = $this->model_admin->getData('app_expense', '*', "id='$id'");
            if (isset($expense_data) && count($expense_data) > 0) {
                $data['expense_data'] = $expense_data[0];
                $data['title'] = dt_translate('update') . " " . dt_translate('expense');
                $this->load->view('admin/expense/add_update', $data);
            } else {
                $this->session->set_flashdata('msg', dt_translate('invalid_request'));
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('admin/expense');
            }
        } else {
            redirect('admin/expense');
        }
    }

    public function save_expense() {
        $admin_id = $this->session->userdata("ADMIN_ID");
        $id = (int) $this->input->post('id', TRUE);

        $this->form_validation->set_rules('party_name', dt_translate('party_name'), 'trim|required');
        $this->form_validation->set_rules('party_phone', dt_translate('party_phone'), 'trim|required');
        $this->form_validation->set_rules('ref_no', dt_translate('ref_no'), 'trim');
        $this->form_validation->set_rules('amount', dt_translate('amount'), 'trim|required');
        $this->form_validation->set_rules('details', dt_translate('details'), 'trim|required');
        $this->form_validation->set_rules('category_id', dt_translate('expense_category'), 'trim|required');
        $this->form_validation->set_rules('account_id', dt_translate('account'), 'trim|required');
        $this->form_validation->set_rules('expense_date', dt_translate('date'), 'trim|required');
        $this->form_validation->set_rules('image', '', 'callback_check_image');
        $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
        if ($this->form_validation->run() == FALSE) {
            $this->add_expense();
        } else {

            $data = array(
                'party_name' => $this->input->post('party_name', TRUE),
                'party_phone' => $this->input->post('party_phone', TRUE),
                'ref_no' => $this->input->post('ref_no', TRUE),
                'amount' => $this->input->post('amount', TRUE),
                'details' => $this->input->post("details", TRUE),
                'category_id'=>$this->input->post("category_id", TRUE),
                'account_id'=>$this->input->post("account_id", TRUE),
                'expense_date'=>$this->input->post("expense_date", TRUE),
                'created_by'=>$admin_id,
            );

            if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {


                $uploadPath = dirname(BASEPATH) . "/" . uploads_path."/expense";
                $logo_tmp_name = $_FILES["image"]["tmp_name"];
                $logo_temp = explode(".", $_FILES["image"]["name"]);
                $logo_name = uniqid();
                $new_logo_name = $logo_name . '.' . end($logo_temp);
                move_uploaded_file($logo_tmp_name, "$uploadPath/$new_logo_name");
                $data['image'] = $new_logo_name;

                /*
                $old_logo_image=$this->input->post('old_logo_image');
                if(isset($old_logo_image) && $old_logo_image!=""){
                    if (file_exists(FCPATH.uploads_path."/".$old_logo_image)){
                        @unlink(FCPATH.uploads_path."/".$old_logo_image);
                    }
                }
                */
            }


            if ($id > 0) {
                $this->model_admin->update('app_expense', $data, "id = '$id'");
                
                $expense = $this->db->query("select * from app_expense where id='$id'")->row_array();
                $txn_id = $expense['txn_id'];
                $txn_data['account_id'] = $data['account_id'];
                $txn_data['amount'] = -$data['amount'];
                
                $this->model_customer->update('app_transactions', $txn_data, "txn_id='$txn_id'" );
                
                $this->session->set_flashdata("msg", dt_translate('record_update'));
                $this->session->set_flashdata("msg_class", "success");
                redirect('admin/expense');
            } else {
                $data['created_on'] = date('Y-m-d H:i:s');

                //txn data
                $txn_id = uniqid($admin_id."_");
                $data['txn_id'] = $txn_id;
                $this->model_admin->insert('app_expense', $data);
                
                $txn_data['account_id'] = $data['account_id'];
                $txn_data['txn_id'] = $txn_id;
                $txn_data['type'] = "expense";
                $txn_data['amount'] = -$data['amount'];
                $this->model_admin->insert('app_transactions', $txn_data);
                
                $this->session->set_flashdata("msg", dt_translate('record_update'));
                $this->session->set_flashdata("msg_class", "success");
                redirect('admin/expense');
            }
        }
    }

    //delete expense
    public function delete_expense($id) {
        $id = (int) $id;
        if ($id > 0) {
            $data = $this->db->query("select * from app_expense where id='$id'")->row_array();
            $txn_id = $data['txn_id'];
            $this->model_admin->delete('app_transactions', "txn_id='$txn_id'");
            
            $this->model_admin->delete('app_expense', 'id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
        } else {
            echo FALSE;
        }
    }

    //show deparment list
    public function expense_category() {
        $data['title'] = dt_translate('manage') . " " . dt_translate('expense');
        $order = "created_on DESC";
        $app_expense_category = $this->model_admin->getData("app_expense_category", "*", "", "", $order);
        $data['app_expense_category'] = $app_expense_category;
        $this->load->view('admin/expense_category/index', $data);
    }

    public function add_expense_category() {
        $data['title'] = dt_translate('add') . " " . dt_translate('expense');
        $this->load->view('admin/expense_category/add_update', $data);
    }

    public function update_expense_category($id) {

        $id = (int) $id;
        if ($id > 0) {

            $expense_data = $this->model_admin->getData('app_expense_category', '*', "id='$id'");
            if (isset($expense_data) && count($expense_data) > 0) {
                $data['expense_category_data'] = $expense_data[0];
                $data['title'] = dt_translate('update') . " " . dt_translate('expense');
                $this->load->view('admin/expense_category/add_update', $data);
            } else {
                $this->session->set_flashdata('msg', dt_translate('invalid_request'));
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('admin/expense-category');
            }
        } else {
            redirect('admin/expense-category');
        }
    }

    public function save_expense_category() {

        $id = (int) $this->input->post('id', TRUE);
        $this->form_validation->set_rules('title', dt_translate('title'), 'trim|required|is_unique[app_expense_category.title.id.' . $id . ']');
        $this->form_validation->set_rules('status', dt_translate('status'), 'trim|required');
        $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");
        if ($this->form_validation->run() == FALSE) {
            if($id>0){
                $this->update_expense_category($id);
            }else{
                $this->add_expense_category();
            }

        } else {

            $data = array(
                'title' => $this->input->post('title', TRUE),
                'status' => $this->input->post("status", TRUE)
            );
            if ($id > 0) {
                $this->model_admin->update('app_expense_category', $data, "id = '$id'");
                $this->session->set_flashdata("msg", dt_translate('record_update'));
                $this->session->set_flashdata("msg_class", "success");
                redirect('admin/expense-category');
            } else {
                $data['created_on'] = date('Y-m-d H:i:s');
                $this->model_admin->insert('app_expense_category', $data);
                $this->session->set_flashdata("msg", dt_translate('record_update'));
                $this->session->set_flashdata("msg_class", "success");
                redirect('admin/expense-category');
            }
        }
    }

    //delete expense
    public function delete_expense_category($id) {
        $id = (int) $id;
        if ($id > 0) {
            $app_expense = $this->model_admin->getData('app_expense', 'id', "category_id='$id'");
            if(count($app_expense)>0){
                $this->session->set_flashdata('msg', dt_translate('delete_already_used'));
                $this->session->set_flashdata('msg_class', 'failure');
            }else{
                $this->model_admin->delete('app_expense_category', 'id=' . $id);
                $this->session->set_flashdata('msg', dt_translate('record_delete'));
                $this->session->set_flashdata('msg_class', 'success');
            }
        } else {
            echo FALSE;
        }
    }


    public function expense_export(){
        $admin_id = $this->session->userdata("ADMIN_ID");
        $order = "app_expense.created_on DESC";
        $exp_join = array(
            array(
                'table' => 'app_expense_category',
                'condition' => 'app_expense_category.id=app_expense.category_id',
                'jointype' => 'inner'
            )
        );

        $condition="";
        if($this->session->userdata("TYPE")!="A"){
            $condition.=" app_expense.created_by=".$admin_id;
        }

        $expense = $this->model_admin->getData("app_expense", "app_expense.*,app_expense_category.title as category_title",$condition, $exp_join, $order);

        if(isset($expense) && count($expense)){
            $filename="expense_".date('Y_m_d').".csv";
            $delimiter = ",";

            //create a file pointer
            $f = fopen('php://memory', 'w');

            //set column headers

            $fields = array(
                '#',
                dt_translate('expense_category'),
                dt_translate('amount'),
                dt_translate('details'),
                dt_translate('date')
            );

            fputcsv($f, $fields, $delimiter);

            //output each row of the data, format line as csv and write to file pointer
            foreach ($expense as $expense_data){

                $lineData = array(
                    $expense_data['id'],
                    $expense_data['category_title'],
                    number_format($expense_data['amount'],2),
                    $expense_data['details'],
                    get_formated_date($expense_data['expense_date'],"N")
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
            redirect('admin/expense');
        }
    }

    public function check_image()
    {
        if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != "") {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $valid_extension_arr = array('jpg', 'png', 'jpeg', 'gif');
            if (!in_array(strtolower($ext), $valid_extension_arr)) {
                $this->form_validation->set_message('check_image', dt_translate('valid_image'));
                return FALSE;
            } 
        }
    }

    public function getExpenseCategoryData()
	{
        $table = $this->table = 'app_expense_category';
        $column_order = $this->column_order = array(null, 'title');
        $column_search = $this->column_search = array('title'); 
        
		$list = $this->model_admin->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customers) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $customers->title;
            $row[] = dt_get_status_badge($customers->status);
            $row[] = "<a href='".base_url()."/admin/update-expense-category/".$customers->id."' class='btn btn-primary btn-sm'>Update</a>
            <a href='javascript:void(0)' data-action='delete-expense-category' data-toggle='modal' onclick='DeleteConfirm(this)' data-target='#delete-record' data-id='".$customers->id."'  class='btn btn-danger btn-sm'>Delete</a> 
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

    public function getExpenseData()
	{
        $table = $this->table = 'app_expense';
        $order = "app_expense.expense_date DESC";

        if(!empty($_POST['order'][0]['column'])) {
            $col = $_POST['order'][0]['column'];
            $order_by = $_POST['columns'][$col]['name'];
            if($order_by == 'name') {
                $order_by = "CONCAT(app_admin.first_name, ' ', app_admin.last_name)";
            } 
            $order_dir = $_POST['order'][0]['dir'];
            $order = "$order_by $order_dir";     
        }

        $exp_join = array(
            array(
                'table' => 'app_expense_category',
                'condition' => 'app_expense_category.id=app_expense.category_id',
                'jointype' => 'inner'
            ),
            array(
                'table' => 'app_admin',
                'condition' => 'app_admin.id=app_expense.created_by',
                'jointype' => 'left'
            ),
            array(
                'table' => 'app_accounts',
                'condition' => 'app_accounts.id=app_expense.account_id',
                'jointype' => 'left'
            )
        );

        $condition = "";

        $searchParams = [
            'date' => 'DATE_FORMAT(app_donation.date, "%d-%m-%Y")',
            'name' => 'app_expense.party_name',
            'phone' => 'app_expense.party_phone',
            'ref_no' => 'app_expense.ref_no',
            'create' => 'CONCAT(app_admin.first_name, " ", app_admin.last_name)',
            'expense' => 'app_expense_category.title',
            'account' => 'app_accounts.name',
            'amount' => 'app_expense.amount',
            'details' => 'app_expense.details',
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
                'DATE_FORMAT(app_expense.expense_date, "%d-%m-%Y")', 
                'app_expense.party_name',
                'app_expense.party_phone',
                'app_expense.ref_no',
                'CONCAT(app_admin.first_name, " ", app_admin.last_name)',
                'app_expense_category.title',
                'app_accounts.name',
                'app_expense.amount',
                'app_expense.details',
            ];
        
            $conditions = [];
        
            foreach ($searchFields as $field) {
                
                $conditions[] = $field . " LIKE '%" . $search . "%'";
            }
        
            $condition = '(' . implode(' OR ', $conditions) . ')';
        }

        $all_count = $this->model_admin->getData("app_expense", "app_expense.*,app_expense_category.title as category_title,concat(app_admin.first_name,' ',app_admin.last_name) as created_by_name,app_accounts.name as account_name",$condition, $exp_join);

        $totalFilteredAmount = 0;

        foreach ($all_count as $donation) {

            $amount = $donation['amount'];
    
            $totalFilteredAmount += $amount;
        }

        $limit = $_POST['length'].",".$_POST['start'];
        $list = $this->model_admin->getData("app_expense", "app_expense.*,app_expense_category.title as category_title,concat(app_admin.first_name,' ',app_admin.last_name) as created_by_name,app_accounts.name as account_name",$condition, $exp_join, $order, '', '', $limit);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customers) {
			$no++;
			$row = array();
			$row[] = $no;
            $row[] = get_formated_date($customers['expense_date'],"N");
			$row[] = $customers['party_name'];
            $row[] = $customers['party_phone'];
            $row[] = $customers['ref_no'];
            $row[] = $customers['created_by_name'];
            $row[] = "<small class='badge badge-info'>". escape_data($customers['category_title']) . "</small>";
            $row[] = $customers['account_name'];
            $row[] = dt_price_format($customers['amount']);
            $row[] = nl2br($customers['details']);

            // if (!empty($customers['image']) && file_exists($root_dir . $customers['image'])) {     
                $row[] = "";
            // }

            

            $row[] = "<a href='".base_url()."/admin/update-expense/".$customers['id']."' class='btn btn-primary btn-sm'>Update</a>
            <a href='javascript:void(0)' data-action='delete-expense' data-toggle='modal' onclick='DeleteConfirm(this)' data-target='#delete-record' data-id='".$customers['id']."'  class='btn btn-danger btn-sm'>Delete</a> 
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

?>
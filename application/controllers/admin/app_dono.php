
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

$condition = "";
if (!empty($_POST['search']['value']))
{
    $search = $_POST['search']['value'];
    if (!empty($condition)) {
        $condition .= " OR ";
    }
        $condition .= "(app_donation.ref_no LIKE '%" . $search . "%'
                    OR 
                    app_donation.first_name LIKE '%" . $search . "%'
                    OR 
                    app_donation.last_name LIKE '%" . $search . "%'
                    OR 
                    app_donation.email LIKE '%" . $search . "%'
                    OR 
                    app_donation.phone LIKE '%" . $search . "%'
                    OR 
                    app_donation.city LIKE '%" . $search . "%'
                    OR 
                    app_donation_category.title LIKE '%" . $search . "%'
                    OR 
                    app_accounts.name LIKE '%" . $search . "%'
                    OR 
                    app_admin.first_name LIKE '%" . $search . "%'
                    OR 
                    app_admin.last_name LIKE '%" . $search . "%'
                    OR 
                    app_donation.amount LIKE '%" . $search . "%'
                    OR 
                    app_donation.date LIKE '%" . $search . "%'
                    )";
}

$orderby = "";

if (!empty($_POST['order']['0']['column']) && !empty($_POST['order']['0']['dir'])) {
    $orderby .= array('ref_no');
}

$limit = $_POST['length'].",".$_POST['start'];

$list = $this->model_customer->getData("app_donation", "app_donation.*,app_donation_category.title,concat(app_admin.first_name,' ',app_admin.last_name) as collected_by,app_accounts.name as account_name", $condition, $dep_join, $order, '', '', $limit);















$table = $this->table = 'app_donation';
        $column_order = $this->column_order = array(null, 'ref_no');
        $column_search = $this->column_search = array('ref_no'); 
        $order = $this->order = array('id' => 'asc'); 
		$list = $this->model_admin->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customers) {
			$no++;
			$row = array();
            $payment_type="<span class='badge badge-info'>".$customers['account_name']." - ".$customers['type']."</span>";
			$row[] = $no;
			$row[] = $customers->ref_no;
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
			"recordsFiltered" => $this->model_admin->count_filtered(),
			"data" => $data,
		);

		echo json_encode($output);
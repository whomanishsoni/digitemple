<?php

class Model_admin extends CI_Model {

    private $primary_key;
    private $main_table;
    public $errorCode;
    public $errorMessage;


    // var $table = 'app_accounts';
	// var $column_order = array(null, 'Name'); //set column field database for datatable orderable
	// var $column_search = array('Name'); //set column field database for datatable searchable 
	// var $order = array('id' => 'asc'); // default order 

    public function __construct() {
        parent::__construct();
        $this->main_table = "app_admin";
        $this->primary_key = "id";
        $this->load->database();
    }

    public function authenticate($username, $password) {
        $ext = 'password = "' . md5($password) . '" AND  email = ' . $username . ' AND status="A" AND type="A"';
        $this->db->select('*');
        $this->db->from($this->main_table);
        $this->db->where($ext);
        $result = $this->db->get();
        $record = $result->result_array();
        if (is_array($record) && count($record) > 0) {
            $this->session->set_userdata("ADMIN_ID", $record[0]["id"]);
            $this->session->set_userdata("Type_Admin", $record[0]["type"]);
            $this->session->set_userdata("DefaultPassword", $record[0]["default_password_changed"]);
            $this->errorCode = 1;
        } else {
            $this->errorCode = 0;
            $this->errorMessage = dt_translate('login_failure');
        }
        $error['errorCode'] = $this->errorCode;
        $error['errorMessage'] = $this->errorMessage;
        return $error;
    }

    function insert($tbl = '', $data = array()) {
        if ($tbl == '') {
            $tbl = $this->main_table;
        }

        $this->db->insert($tbl, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function getAdminDetail($id) {
        $this->db->select('*');
        $this->db->where('ID', $id);
        $array = $this->db->get($this->main_table)->result_array();
        return $array;
    }

    function update($tbl = '', $data = array(), $where = '') {
        if ($tbl == '') {
            $tbl = $this->main_table;
        }
        $this->db->where($where, false, false);
        $res = $this->db->update($tbl, $data);
        $rs = $this->db->affected_rows();
        return $rs;
    }

    function getData($tbl = '', $fields, $condition = '', $join_ary = array(), $orderby = '', $groupby = '', $having = '', $climit = '', $paging_array = array(), $reply_msgs = '', $like = array()) {

        if ($fields == '') {
            $fields = "*";
        }
        $this->db->select($fields, false);
        if (is_array($join_ary) && count($join_ary) > 0) {
            foreach ($join_ary as $ky => $vl) {
                $this->db->join($vl['table'], $vl['condition'], $vl['jointype']);
            }
        }
        if (trim($condition) != '') {
            $this->db->where($condition, false, false);
        }
        if (trim($groupby) != '') {
            $this->db->group_by($groupby);
        }
        if (trim($having) != '') {
            $this->db->having($having, false);
        }
        if ($orderby != '' && is_array($paging_array) && count($paging_array) == "0") {
            $this->db->order_by($orderby, false);
        }
        if (trim($climit) != '') {
            if(strpos($climit, ",") !== FALSE) {
                $limit_arr = explode(",", $climit);
                $this->db->limit($limit_arr[0], $limit_arr[1]);
            } else {
                $this->db->limit($climit);
            }
            
        }
        if ($tbl != '') {
            $this->db->from($tbl);
        } else {
            $this->db->from($this->main_table);
        }

        //         echo $this->db->get_compiled_select();
        // exit();
        $list_data = $this->db->get()->result_array();
        return $list_data;
    }

    function delete($tbl = '', $where = '') {
        if ($tbl == '') {
            $tbl = $this->main_table;
        }
        $this->db->where($where);
        $this->db->delete($tbl);
        return 'deleted';
    }


    function query($sql, $type = "") {

        $data = $this->db->query($sql);
        if ($type == '')
            $data = $data->result_array();
        return $data;
    }

    function getRecordData($tbl = '', $id = '', $field = '') {
        $this->db->select('*');
        $this->db->from($tbl);
        if ($id != '') {
            $this->db->where($field, $id);
        }
        $data = $this->db->get()->result_array();
        return $data;
    }

    function getExportData($tbl, $fields, $join_ary, $cond) {
        $this->db->select($fields, false);
        $this->db->from($tbl);
        if (is_array($join_ary) && count($join_ary) > 0) {
            foreach ($join_ary as $ky => $vl) {
                $this->db->join($vl['tbl'], $vl['cond'], $vl['type']);
            }
        }
        $this->db->where($cond);
        $data = $this->db->get()->result_array();
        return $data;
    }

    function getCountry($fields, $condition) {
        $this->db->select($fields);
        $this->db->where($condition);
        $this->db->from("country");
        $this->db->stop_cache();
        $list_data = $this->db->get()->result_array();
        $this->db->flush_cache();

        return $list_data;
    }


    function check_username($username) {
        $this->db->where('email', $username);
        $this->db->from($this->main_table);
        $list_data = $this->db->get()->row_array();
        if (is_array($list_data) && count($list_data) > 0) {
            $this->errorCode = 1;
            $this->errorMessage = dt_translate('forgot_success');
        } else {
            $this->errorCode = 0;
            $this->errorMessage = dt_translate('forgot_failure');
        }
        $error['id'] = $list_data['id'];
        $error['first_name'] = $list_data['first_name'];
        $error['last_name'] = $list_data['last_name'];
        $error['email'] = $list_data['email'];
        $error['errorCode'] = $this->errorCode;
        $error['errorMessage'] = $this->errorMessage;
        return $error;
    }

    function EditAdmin($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->main_table, $data);
    }


    // the SQL queries needed for an server-side processing requested
    public function _get_datatables_query()
	{
		
		//add custom filter here
		// if($this->input->post('country'))
		// {
		// 	$this->db->where('country', $this->input->post('country'));
		// }
		// if($this->input->post('Name'))
		// {
		// 	$this->db->like('Name', $this->input->post('Name'));
		// }
		// if($this->input->post('Balance'))
		// {
		// 	$this->db->like('Balance', $this->input->post('Balance'));
		// }
		// if($this->input->post('address'))
		// {
		// 	$this->db->like('address', $this->input->post('address'));
		// }

		$this->db->from($this->table);
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

    //Fetch members data from the database
	public function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

    //Count records based on the filter params
	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

    //Count all records
	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

}

?>
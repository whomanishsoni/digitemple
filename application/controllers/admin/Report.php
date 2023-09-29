<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends MY_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->authenticate->check_admin();
        $this->load->model('model_customer');
        $item_donation=is_module_enabled('report');
        if($item_donation==false){
            redirect('admin/dashboard');
        }
    }

    //show customer dashboard if authenticated
    public function index() {
        $data['title'] = dt_translate('donation')." ".dt_translate('report');;

        //Get From date
        $from_date=$this->input->get('from_date');
        $to_date=$this->input->get('to_date');
        $Save=$this->input->get('Save');
        $type=$this->input->get('type');

        if(isset($Save) && $Save=='Save'){
            if(isset($from_date) && $from_date!="" && isset($to_date) && $to_date!=""){
                $condition="DATE(app_donation.created_on) BETWEEN '".$from_date."' AND '".$to_date."'";
            }else if (isset($from_date) && $from_date!=""){
                $condition="DATE(app_donation.created_on)>='".$from_date."'";
            }else if(isset($to_date) && $to_date!=""){
                $condition="DATE(app_donation.created_on)>='".$to_date."'";
            }


            if(isset($type) && $type!=""){
                $condition.=" AND app_donation.type='".$type."'";
            }
            $order = "app_donation.created_on ASC";

            $dep_join = array(
                array(
                    'table' => 'app_donation_category',
                    'condition' => 'app_donation_category.id=app_donation.category_id',
                    'jointype' => 'inner'
                )
            );

            $data['donation_data'] = $this->model_customer->getData("app_donation", "app_donation.*,app_donation_category.title", $condition, $dep_join, $order);
        }else{
            $data['donation_data']=array();
        }

        $this->load->view('admin/report/index', $data);
    }

    public function expense() {
        $data['title'] = dt_translate('coin')." ".dt_translate('report');

        //Get From date
        $from_date=$this->input->get('from_date');
        $to_date=$this->input->get('to_date');
        $Save=$this->input->get('Save');
        $category=$this->input->get('category');

        $order = "app_expense.expense_date ASC";

        if(isset($Save) && $Save=='Save'){
            $condition="";
            if(isset($from_date) && $from_date!="" && isset($to_date) && $to_date!=""){
                $condition="DATE(app_expense.expense_date) BETWEEN '".$from_date."' AND '".$to_date."'";
            }else if (isset($from_date) && $from_date!=""){
                $condition="DATE(app_expense.expense_date)>='".$from_date."'";
            }else if(isset($to_date) && $to_date!=""){
                $condition="DATE(app_expense.expense_date)>='".$to_date."'";
            }

            if(isset($category) && $category!=""){
                $condition.=" AND app_expense.category_id=".$category;
            }

            $exp_join = array(
                array(
                    'table' => 'app_expense_category',
                    'condition' => 'app_expense_category.id=app_expense.category_id',
                    'jointype' => 'inner'
                )
            );
            $data['expense_data'] = $this->model_customer->getData("app_expense", "app_expense.*,app_expense_category.title as category_title",$condition, $exp_join, $order);
        }else{
            $data['expense_data']=array();
        }
        $data['app_expense_category'] = $this->model_customer->getData('app_expense_category', '*', "status='A'");
        $this->load->view('admin/report/expense', $data);
    }

    public function donation_print(){

        //Get From date
        $from_date=$this->input->get('from_date');
        $to_date=$this->input->get('to_date');
        $Save=$this->input->get('Save');
        $type=$this->input->get('type');

        if(isset($Save) && $Save=='Save'){
            if(isset($from_date) && $from_date!="" && isset($to_date) && $to_date!=""){
                $condition="DATE(app_donation.created_on) BETWEEN '".$from_date."' AND '".$to_date."'";
            }else if (isset($from_date) && $from_date!=""){
                $condition="DATE(app_donation.created_on)>='".$from_date."'";
            }else if(isset($to_date) && $to_date!=""){
                $condition="DATE(app_donation.created_on)>='".$to_date."'";
            }


            if(isset($type) && $type!=""){
                $condition.=" AND app_donation.type='".$type."'";
            }
            $order = "app_donation.created_on ASC";

            $dep_join = array(
                array(
                    'table' => 'app_donation_category',
                    'condition' => 'app_donation_category.id=app_donation.category_id',
                    'jointype' => 'inner'
                )
            );

            $data['donation_data'] = $this->model_customer->getData("app_donation", "app_donation.*,app_donation_category.title", $condition, $dep_join, $order);
        }else{
            $data['donation_data']=array();
        }
        $data['start_date']=get_formated_date($from_date,'N');
        $data['to_date']=get_formated_date($to_date,'N');

        $this->load->view('admin/print/donation', $data);
    }

    public function expense_print(){
        $data['title'] = dt_translate('coin')." ".dt_translate('report');

        //Get From date
        $from_date=$this->input->get('from_date');
        $to_date=$this->input->get('to_date');
        $Save=$this->input->get('Save');
        $type=$this->input->get('item');

        $order = "app_expense.expense_date ASC";

        if(isset($Save) && $Save=='Save'){
            $condition="";
            if(isset($from_date) && $from_date!="" && isset($to_date) && $to_date!=""){
                $condition="DATE(app_expense.expense_date) BETWEEN '".$from_date."' AND '".$to_date."'";
            }else if (isset($from_date) && $from_date!=""){
                $condition="DATE(app_expense.expense_date)>='".$from_date."'";
            }else if(isset($to_date) && $to_date!=""){
                $condition="DATE(app_expense.expense_date)>='".$to_date."'";
            }

            $exp_join = array(
                array(
                    'table' => 'app_expense_category',
                    'condition' => 'app_expense_category.id=app_expense.category_id',
                    'jointype' => 'inner'
                )
            );
            $data['donation']=$this->db->query("select sum(amount) as total_donation FROM app_donation WHERE 1 ")->row_array('total_donation')['total_donation'];
            $data['expense_data'] = $this->model_customer->getData("app_expense", "app_expense.*,app_expense_category.title as category_title",$condition, $exp_join, $order);
        }else{
            $data['expense_data']=array();
        }

        $data['start_date']=get_formated_date($from_date,'N');
        $data['to_date']=get_formated_date($to_date,'N');

        $this->load->view('admin/print/expense', $data);
    }
}

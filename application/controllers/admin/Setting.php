<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting extends MY_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->authenticate->check_admin();
        $this->load->model('model_sitesetting');
    }

    //show site setting form
    public function index() {
        $data['title'] = dt_translate('manage') . " " . dt_translate('site_setting');
        $company_data = $this->model_sitesetting->get();

        $language_data = $this->model_sitesetting->getData('app_language', '*', 'status ="A"');
        $app_currency = $this->model_sitesetting->getData('app_currency', '*');

        $data['company_data'] = $company_data[0];
        $data['language_data'] = $language_data;
        $data['app_currency']=$app_currency;

        $this->load->view('admin/setting/site', $data);
    }

    //add/edit site setting
    public function save_sitesetting() {

        $id = $this->input->post('id', true);
        $this->form_validation->set_rules('company_logo', '', 'callback_check_logo_size');
        $this->form_validation->set_rules('company_name', '', 'required');
        $this->form_validation->set_rules('company_email1', '', 'required');

        $this->form_validation->set_message('required', dt_translate('required_message'));
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $data['company_name'] = $this->input->post('company_name', true);
            $data['company_address'] = $this->input->post('company_address1', true);
            $data['company_phone'] = $this->input->post('company_phone1', true);
            $data['company_email'] = $this->input->post('company_email1', true);
            $data['language'] = $this->input->post('language', true);
            $data['time_format'] = $this->input->post('time_format', true);
            $data['time_zone'] = $this->input->post('time_zone', true);

            $data['fb_link'] = $this->input->post('fb_link', true);
            $data['twitter_link'] = $this->input->post('twitter_link', true);
            $data['insta_link'] = $this->input->post('insta_link', true);
            $data['linkdin_link'] = $this->input->post('linkdin_link', true);
            $data['trust_registration_no'] = $this->input->post('reg_no', true);

            $data['currency_id'] = $this->input->post('currency_id', true);
            $data['currency_position'] = $this->input->post('currency_position', true);

            $this->session->unset_userdata('language');
            $this->session->set_userdata("language",$this->input->post('language', true));

            if (isset($_FILES['fevicon_icon']) && $_FILES['fevicon_icon']['name'] != '') {
                $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
                $fevicon_tmp_name = $_FILES["fevicon_icon"]["tmp_name"];
                $fevicon_temp = explode(".", $_FILES["fevicon_icon"]["name"]);
                $fevicon_name = uniqid();
                $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
                move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
                $data['fevicon_icon'] = $new_fevicon_name;

                $old_favicon_image=$this->input->post('old_favicon_image');
                if(isset($old_favicon_image) && $old_favicon_image!=""){
                    if (file_exists(FCPATH.uploads_path."/".$old_favicon_image)){
                        @unlink(FCPATH.uploads_path."/".$old_favicon_image);
                    }
                }

            }

            if (isset($_FILES['company_logo']) && $_FILES['company_logo']['name'] != '') {


                $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
                $logo_tmp_name = $_FILES["company_logo"]["tmp_name"];
                $logo_temp = explode(".", $_FILES["company_logo"]["name"]);
                $logo_name = uniqid();
                $new_logo_name = $logo_name . '.' . end($logo_temp);
                move_uploaded_file($logo_tmp_name, "$uploadPath/$new_logo_name");
                $data['company_logo'] = $new_logo_name;

                $old_logo_image=$this->input->post('old_logo_image');
                if(isset($old_logo_image) && $old_logo_image!=""){
                    if (file_exists(FCPATH.uploads_path."/".$old_logo_image)){
                        @unlink(FCPATH.uploads_path."/".$old_logo_image);
                    }
                }
            }

            $this->model_sitesetting->edit(1, $data);
            $this->session->set_flashdata('msg', dt_translate('site_setting_update'));
            $this->session->set_flashdata('msg_class', "success");
            redirect('admin/setting', 'redirect');
        }
    }

    //show email form
    public function seo() {
        $data['title'] = dt_translate('seo');

        $data['seo_keyword'] = $this->model_sitesetting->getData('app_content', '*', 'title ="seo_keyword"')[0];
        $data['google_analytics'] = $this->model_sitesetting->getData('app_content', '*', 'title ="google_analytics"')[0];
        $data['seo_description'] = $this->model_sitesetting->getData('app_content', '*', 'title ="seo_description"')[0];

        $this->load->view('admin/setting/seo', $data);
    }

    public function save_seo(){
        $this->load->model('model_customer');

        $seo_keyword['details']=($this->input->post('seo_keyword', true));
        $this->model_customer->update('app_content', $seo_keyword, "title='seo_keyword'");

        $seo_description['details']=($this->input->post('seo_description', true));
        $this->model_customer->update('app_content', $seo_description, "title='seo_description'");

        $google_analytics['details']=($this->input->post('google_analytics', false));
        $this->model_customer->update('app_content', $google_analytics, "title='google_analytics'");

        $this->session->set_flashdata('msg', dt_translate('record_update'));
        $this->session->set_flashdata('msg_class', 'success');
        redirect('admin/seo');
    }

    //show email form
    public function email_setting() {
        $company_data = $this->model_sitesetting->get_email();
        $data['title'] = dt_translate('email') . " " . dt_translate('details');
        $data['email_data'] = $company_data;
        $this->load->view('admin/setting/email', $data);
    }

    //add/edit email data
    public function save_email_setting() {
        $mail_type = $this->input->post('mail_type');

        if ($mail_type == 'S') {
            $this->form_validation->set_rules('smtp_host', '', 'trim|required');
            $this->form_validation->set_rules('smtp_username', '', 'trim|required');
            $this->form_validation->set_rules('smtp_password', '', 'trim|required');
            $this->form_validation->set_rules('smtp_port', '', 'trim|required');
            $this->form_validation->set_rules('smtp_secure', '', 'trim|required');
            $this->form_validation->set_rules('email_from_smtp', 'From email', 'trim|required|valid_email');
        } else {
            $this->form_validation->set_rules('email_from', 'From email', 'trim|required|valid_email');
        }

        $this->form_validation->set_message('required', dt_translate('required_message'));
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == false) {
            $this->email_setting();
        } else {

            $data['mail_type'] = $this->input->post('mail_type', true);
            $data['smtp_host'] = $this->input->post('smtp_host', true);
            $data['smtp_password'] = $this->input->post('smtp_password', true);
            $data['smtp_username'] = $this->input->post('smtp_username', true);
            $data['smtp_port'] = $this->input->post('smtp_port', true);
            $data['smtp_secure'] = $this->input->post('smtp_secure', true);

            if ($mail_type == 'S') {
                $data['email_from'] = $this->input->post('email_from_smtp', true);
            } else {
                $data['email_from'] = $this->input->post('email_from', true);
            }
            $this->model_sitesetting->edit_email(1, $data);
            $this->session->set_flashdata('msg', dt_translate('smtp_update'));
            $this->session->set_flashdata('msg_class', "success");
            redirect('admin/email-setting');
        }
    }

    //show payment setting form
    public function payment_setting() {
        $data['title'] = dt_translate('payment_setting');
        $payment_data = $this->model_sitesetting->getData('app_payment_setting', '*');
        $data['payment_data'] = isset($payment_data[0]) ? $payment_data[0] : '';
        $this->load->view('admin/setting/payment', $data);
    }

    public function currency_setting() {
        $data['title'] = dt_translate('currency') . " " . dt_translate('setting');
        $c_data = $this->model_sitesetting->getData('app_site_setting', 'currency_id,currency_position')[0];
        $app_currency = $this->model_sitesetting->getData('app_currency', '*', 'display_status="A"');

        $data['app_currency'] = isset($app_currency) ? $app_currency : array();
        $data['currency_data'] = $c_data;
        $this->load->view('admin/admin/setting/currency-setting', $data);
    }

    public function save_curenncy_setting() {
        $data['currency_id'] = $this->input->post('currency_id', true);
        $data['currency_position'] = $this->input->post('currency_position', true);
        $this->model_sitesetting->edit_data('app_site_setting', 1, $data);

        $this->db->query('UPDATE app_currency SET status="I" WHERE 1');
        $this->db->query('UPDATE app_currency SET status="A" WHERE id=' . $this->input->post('currency_id', true));

        $this->session->set_flashdata('msg', "Currency has been updated.");
        $this->session->set_flashdata('msg_class', "success");
        redirect('admin/currency-setting');
    }

    //save payment setting
    public function save_payment_setting() {
        $id = (int) $this->input->post('id');
        $this->form_validation->set_rules('stripe', '', 'required');
        $this->form_validation->set_rules('paypal', '', 'required');

        if ($this->input->post('stripe') == 'Y') {
            $this->form_validation->set_rules('stripe_secret', '', 'required');
            $this->form_validation->set_rules('stripe_publish', '', 'required');
        }

        if ($this->input->post('razorpay') == 'Y') {
            $this->form_validation->set_rules('razorpay_merchant_key_id', '', 'required');
            $this->form_validation->set_rules('razorpay_merchant_key_secret', '', 'required');
        }

        if ($this->input->post('paypal') == 'Y') {
            $this->form_validation->set_rules('paypal_merchant_email', '', 'required');
        }

        $this->form_validation->set_message('required', dt_translate('required_message'));
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == false) {
            $this->payment_setting();
        } else {



            $data['paypal'] = $this->input->post('paypal', true);
            $data['paypal_sendbox_live'] = $this->input->post('paypal_sendbox_live', true);
            $data['paypal_merchant_email'] = $this->input->post('paypal_merchant_email', true);

            $data['stripe'] = $this->input->post('stripe', true);
            $data['stripe_secret'] = $this->input->post('stripe_secret', true);
            $data['stripe_publish'] = $this->input->post('stripe_publish', true);

            $data['razorpay'] = $this->input->post('razorpay', true);
            $data['razorpay_merchant_key_id'] = $this->input->post('razorpay_merchant_key_id', true);
            $data['razorpay_merchant_key_secret'] = $this->input->post('razorpay_merchant_key_secret', true);

            if ($id > 0) {
                $this->model_sitesetting->edit_data('app_payment_setting', $id, $data);
            } else {
                $data['created_on'] = date('Y-m-d H:i:s');
                $this->model_sitesetting->insert_data('app_payment_setting', $data);
            }
            $this->session->set_flashdata('msg', dt_translate('payment_setting_update'));
            $this->session->set_flashdata('msg_class', "success");
            redirect('admin/payment-setting');
        }
    }

    public function check_logo_size() {
        if (isset($_FILES['banner_img']['tmp_name']) && $_FILES['banner_img']['tmp_name'] != "") {
            $ext = pathinfo($_FILES['banner_img']['name'], PATHINFO_EXTENSION);
            $valid_extension_arr = array('jpg', 'png', 'jpeg', 'gif');
            if (!in_array(strtolower($ext), $valid_extension_arr)) {
                $this->form_validation->set_message('check_logo_size', dt_translate('valid_image'));
                return FALSE;
            } else {
                $data = getimagesize($_FILES['banner_img']['tmp_name']);
                $width = isset($data[0]) ? (int) $data[0] : 0;
                $height = isset($data[1]) ? (int) $data[1] : 0;
                if ($width >= 241 && $height >= 61) {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('check_logo_size', dt_translate('valid_logo'));
                    return FALSE;
                }
            }
        }
    }

    public function themes(){
        $data['title'] = dt_translate('payment_setting');
        $payment_data = $this->model_sitesetting->getData('app_payment_setting', '*');
        $data['payment_data'] = isset($payment_data[0]) ? $payment_data[0] : '';
        $this->load->view('admin/setting/payment', $data);
    }

    public function module(){
        $data['title'] = dt_translate('module');
        $data['app_module_setting']= $this->model_sitesetting->getData('app_module_setting', '*');
        $this->load->view('admin/setting/module', $data);
    }
    public function save_module(){
        $this->load->model('model_customer');

       $module_name=$this->input->post('module_name[]');
       $status=$this->input->post('status[]');

       if(isset($module_name) && count($module_name)>0){
           foreach ($module_name as $key=>$module){
               $data['is_enable']=$status[$key];
               $where="module='".$module."'";
               $this->model_customer->update('app_module_setting', $data, $where);
           }
       }
        $this->session->set_flashdata('msg', dt_translate('record_update'));
        $this->session->set_flashdata('msg_class', 'success');
        redirect('admin/module-setting', 'redirect');
    }

    //Save Comment Box Project ID
    public function comment(){
        $data['title'] = "Comment";
        $data['comment_project_id'] = $this->model_sitesetting->getData('app_content', '*', 'title="comment_project_id"')[0];
        $this->load->view('admin/setting/comment', $data);
    }

    public function save_comment(){
        $this->load->model('model_customer');

        $seo_keyword['details']=($this->input->post('comment_project_id', true));
        $this->model_customer->update('app_content', $seo_keyword, "title='comment_project_id'");

        $this->session->set_flashdata('msg', dt_translate('record_update'));
        $this->session->set_flashdata('msg_class', 'success');
        redirect('admin/comment', 'redirect');
    }

}

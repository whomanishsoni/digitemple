<?php
require "vendor/autoload.php";
use Razorpay\Api\Api;
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Front extends CI_Controller {

    public $theme;

    public function __construct() {
        parent::__construct();
        $this->load->model('model_customer');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        dt_set_time_zone();
        dt_run_default_query();
        $this->theme="theme1";
    }

    public function index(){
        redirect('admin/login');
        $this->session->unset_userdata('app_donation_id');
		//Set Language For Website
        $dt_app_site_setting=dt_app_site_setting();
		$language=trim($dt_app_site_setting['language']);	
		$this->session->set_userdata("language",$language);
		$language_session = $this->session->userdata('language');

        $data['title'] = dt_translate('home');
        $data['home_content_title'] = $this->model_customer->getData('app_content', '*', 'title ="home_content_title"')[0];
        $data['home_content_description'] = $this->model_customer->getData('app_content', '*', 'title ="home_content_description"')[0];
        $this->load->view('front/'.$this->theme.'/index', $data);
    }
    public function privacy_policy(){
        $data['title'] = dt_translate('privacy_policy');
        $data['privacy']=dt_get_cms_page_status('privacy');

        $this->load->view('front/'.$this->theme.'/privacy_policy', $data);
    }

    public function terms_and_conditions(){
        $data['title'] = dt_translate('terms_and_conditions');
        $data['terms']=dt_get_cms_page_status('terms');
        $this->load->view('front/'.$this->theme.'/terms_and_conditions', $data);
    }

    public function about_us(){
        $data['title'] = dt_translate('about_us');
        $this->load->view('front/'.$this->theme.'/about_us', $data);
    }

    public function team(){
        $data['title'] = dt_translate('team');
        $this->load->view('front/'.$this->theme.'/team', $data);
    }

    public function contact_us(){
        $data['title'] = dt_translate('contact_us');
        $this->load->view('front/'.$this->theme.'/contact_us', $data);
    }

    public function volunteer(){
        $data['title'] = dt_translate('volunteer');
        $this->load->view('front/'.$this->theme.'/volunteer', $data);
    }

    public function gallery(){
        $data['title'] = dt_translate('gallery');
        $this->load->view('front/'.$this->theme.'/gallery', $data);
    }

    public function causes(){
        $data['title'] = dt_translate('causes');
        $this->load->view('front/'.$this->theme.'/causes', $data);
    }

    public function cause_details($id){

        $data['title'] = dt_translate('causes')." ".dt_translate('details');
        $id=(int)$id;
        $app_causes= $this->model_customer->getData('app_causes', '*', 'id='.$id);
        if(count($app_causes)==0){
            redirect('causes');
        }

        $data['app_causes']=$app_causes[0];
        $this->load->view('front/'.$this->theme.'/causes_details', $data);
    }

    public function projects(){
        $data['title'] = dt_translate('projects');
        $data['app_projects']= $this->model_customer->getData('app_projects', '*','status="A"');
        $this->load->view('front/'.$this->theme.'/projects', $data);
    }

    public function project_details($id){
        $data['title'] = dt_translate('project')." ".dt_translate('details');
        $id=(int)$id;

        $app_project= $this->model_customer->getData('app_projects', '*', 'id='.$id.' AND status="A"');
        if(count($app_project)==0){
            redirect('projects');
        }

        $data['app_project']=$app_project[0];
        $data['recent_projects']=$this->model_customer->getData('app_projects', '*', 'id!='.$id.' AND status="A"');

        $this->load->view('front/'.$this->theme.'/project_details', $data);
    }

    public function events(){
        $data['title'] = dt_translate('events');
        $data['app_events']= $this->model_customer->getData('app_events', '*','status="A"');
        $this->load->view('front/'.$this->theme.'/events', $data);
    }

    public function event_details($id){

        $data['title'] = dt_translate('event')." ".dt_translate('details');
        $id=(int)$id;

        $app_event= $this->model_customer->getData('app_events', '*', 'event_id='.$id.' AND status="A"');
        if(count($app_event)==0){
            redirect('events');
        }

        $data['app_event']=$app_event[0];
        $data['recent_event']=$this->model_customer->getData('app_events', '*', 'event_id!='.$id.' AND status="A"');

        $this->load->view('front/'.$this->theme.'/event_details', $data);
    }

    public function news(){
        $data['title'] = dt_translate('news');
        $this->load->view('front/'.$this->theme.'/news', $data);
    }

    public function news_details($id){
        $data['title'] = dt_translate('news')." ".dt_translate('details');

        $id=(int)$id;
        $app_news= $this->model_customer->getData('app_news', '*', 'id='.$id);
        if(count($app_news)==0){
            redirect('news');
        }

        $data['app_news']=$app_news[0];
        $data['recent_news']=$this->model_customer->getData('app_news', '*', 'id!='.$id.' AND status="A"');
        $this->load->view('front/'.$this->theme.'/news_details', $data);
    }

    public function donate(){
        unset_donation_session();
        unset_cause_session();

        $data['title'] = dt_translate('home');
        $orders = "title  ASC";
        $data['app_donation_category'] = $this->model_customer->getData("app_donation_category", "*", "status='A'", "", $orders);

        $this->load->view('front/'.$this->theme.'/donation', $data);
    }

    public function save_contact_us(){
        $name=$this->input->post('name');
        $email=$this->input->post('email');
        $subject=$this->input->post('subject');
        $message=$this->input->post('message');

        $this->form_validation->set_rules('name', dt_translate('name'), 'trim|required');
        $this->form_validation->set_rules('email', dt_translate('email'), 'trim|required');
        $this->form_validation->set_rules('subject', dt_translate('subject'), 'trim|required');
        $this->form_validation->set_rules('message', dt_translate('message'), 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            $this->contact_us();
        }else{
            $data['email'] = $this->input->post('email', true);
            $data['subject'] = $this->input->post('subject', true);
            $data['message'] = $this->input->post('message', true);
            $data['name'] = $this->input->post('name', true);
            $data['created_date'] =date("Y-m-d H:i:s");
            $this->model_customer->insert('app_contact_us', $data);

            $this->session->set_flashdata('msg', dt_translate('contact_request_success'));
            $this->session->set_flashdata('msg_class', 'success');

            redirect('contact-us#success');
        }
    }

    /*Donation Action Method*/
    public function donate_action() {

        $first_name=$this->input->post('first_name',true);
        $last_name=$this->input->post('last_name',true);
        $email=$this->input->post('email',true);
        $phone=$this->input->post('phone',true);
        $amount=$this->input->post('amount',true);
        $city=$this->input->post('city',true);
        $payment_by=$this->input->post('payment_by');
        $category_id=$this->input->post("category_id");

        $get_current_currency=dt_get_current_currency();


    if(isset($payment_by) && in_array($payment_by,array("P","S","R"))){
        if($payment_by=="S"){
            include APPPATH . 'third_party/init.php';

            if ($this->input->post('stripeToken')) {
                try {
                    //\Stripe\Stripe::setVerifySslCerts(false);
                     $stripe_api_key = dt_get_StripeSecret();
                    \Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings

                    $charge = \Stripe\Charge::create(array(
                        "amount" => ceil($amount * 100),
                        "currency" => trim($get_current_currency['code']),
                        "source" => $_POST['stripeToken'], // obtained with Stripe.js
                        "description" => dt_translate('donation')
                    ));

                    $charge_response = $charge->jsonSerialize();
                    if ($charge_response['paid'] == true) {

                        $insert['first_name'] = $first_name;
                        $insert['last_name'] = $last_name;
                        $insert['email'] = $email;
                        $insert['created_on'] = date("Y-m:d H:i:s");
                        $insert['amount'] = $amount;
                        $insert['phone'] = $phone;
                        $insert['city'] = $city;
                        $insert['type']='S';
                        $insert['created_by'] = 1;
                        $insert['category_id']=$category_id;
                        $insert['online_transaction_details'] = json_encode($charge_response);
                        $app_donation_id = $this->model_customer->insert("app_donation", $insert);

                        $this->session->set_flashdata('msg', dt_translate('transaction_success') . "<br>" . dt_translate('booking_insert'));
                        $this->session->set_flashdata('msg_class', 'success');

                        //Send email
                        $subject = dt_get_CompanyName()." | ".dt_translate('donation');
                        $define_param['to_name'] = $first_name." ".$last_name;
                        $define_param['to_email'] =$email;

                        $parameter['NAME'] =  $first_name." ".$last_name;
                        $parameter['AMOUNT'] =$amount;

                         $html = $this->load->view("email_template/donation", $parameter, true);
                         $this->sendmail->send($define_param, $subject, $html);

                        $this->session->set_userdata('app_donation_id', $app_donation_id);


                        redirect(base_url('success/'));
                    } else {
                        $this->session->set_flashdata('msg', dt_translate('transaction_fail'));
                        $this->session->set_flashdata('msg_class', 'failure');
                        redirect(base_url('donate/'));
                    }
                } catch (\Stripe\Error\Card $e) {
                    $body = $e->getJsonBody();
                    $err = $body['error'];
                    $this->session->set_flashdata('msg', $err['message']);
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect(base_url('donate/'));
                } catch (\Stripe\Error\RateLimit $e) {
                    $this->session->set_flashdata('msg', "Too many requests made to the API too quickly");
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect(base_url('donate/'));
                } catch (\Stripe\Error\InvalidRequest $e) {
                    $this->session->set_flashdata('msg', "Invalid parameters were supplied to Stripe's API");
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect(base_url('donate/'));
                } catch (\Stripe\Error\Authentication $e) {
                    $this->session->set_flashdata('msg', "Authentication with Stripe's API failed");
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect(base_url('donate/'));
                } catch (\Stripe\Error\ApiConnection $e) {
                    $this->session->set_flashdata('msg', "Network communication with Stripe failed");
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect(base_url('donate/'));
                } catch (\Stripe\Error\Base $e) {
                    $this->session->set_flashdata('msg', "Something else happened, completely unrelated to Stripe");
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect(base_url('donate/'));
                } catch (Exception $e) {
                    $this->session->set_flashdata('msg', "Something else happened, completely unrelated to Stripe");
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect(base_url('donate/'));
                }
            }else{
                $this->session->set_flashdata('msg', "Something else happened, completely unrelated to Stripe");
                $this->session->set_flashdata('msg_class', 'failure');
                redirect(base_url('donate/'));
            }
        }elseif($payment_by=="R"){
            $this->load->library('razorpay');

            $razorpay_merchant_key_id=dt_get_payment_setting('razorpay_merchant_key_id');
            $razorpay_merchant_key_secret=dt_get_payment_setting('razorpay_merchant_key_secret');


            $api = new Api($razorpay_merchant_key_id, $razorpay_merchant_key_secret);

            try{
                $order  = $api->order->create([
                    'receipt'=>dt_translate('donation')."-".date('YmdHis'),
                    'amount'=> $amount*100, // amount in the smallest currency unit
                    'currency'=>trim($get_current_currency['code']),
                    'payment_capture'=>1
                ]);

                if(isset($order['id']) && $order['id']!=""){
                    $this->session->set_userdata('first_name', $first_name);
                    $this->session->set_userdata('last_name', $last_name);
                    $this->session->set_userdata('email', $email);
                    $this->session->set_userdata('phone', $phone);
                    $this->session->set_userdata('city', $city);
                    $this->session->set_userdata('category_id', $category_id);
                    $this->session->set_userdata('amount', $amount);

                    $this->razorpay->add_field('key_id',$razorpay_merchant_key_id);
                    $this->razorpay->add_field('order_id',$order['id']);
                    $this->razorpay->add_field('name',dt_get_CompanyName());
                    $this->razorpay->add_field('description',dt_translate('donation'));
                    $this->razorpay->add_field('image',dt_get_CompanyLogo());
                    $this->razorpay->add_field('prefill[name]',$first_name," ".$last_name);
                    $this->razorpay->add_field('prefill[contact]',$phone);
                    $this->razorpay->add_field('prefill[email]',$email);
                    $this->razorpay->add_field('notes[shipping address]',$city);

                    $this->razorpay->add_field('callback_url', base_url('razorpay-success'));
                    $this->razorpay->add_field('cancel_url', base_url('razorpay-cancel'));

                    $this->razorpay->submit();

                }else{
                    redirect('donate');
                }
            }catch (Exception $e){
                $this->session->set_flashdata('msg',$e->getMessage());
                $this->session->set_flashdata('msg_class', 'failure');
                redirect('donate');
            }
        }else{
            $this->load->library('paypal');

            $this->session->set_userdata('first_name', $first_name);
            $this->session->set_userdata('last_name', $last_name);
            $this->session->set_userdata('email', $email);
            $this->session->set_userdata('phone', $phone);
            $this->session->set_userdata('city', $city);
            $this->session->set_userdata('category_id', $category_id);

            $this->paypal->add_field('rm', 2);
            $this->paypal->add_field('cmd', '_xclick');
            $this->paypal->add_field('amount', $amount);
            $this->paypal->add_field('item_name', "Donation");
            $this->paypal->add_field('currency_code', trim($get_current_currency['code']));
            $this->paypal->add_field('custom', '123');
            $this->paypal->add_field('business', dt_get_payment_setting('paypal_merchant_email'));
            $this->paypal->add_field('cancel_return', base_url('paypal_cancel'));
            $this->paypal->add_field('return', base_url('paypal_success'));
            $this->paypal->submit_paypal_post();
        }
    }else{
        redirect('donate/');
    }


    }

    public function paypal_success() {

        if (isset($_REQUEST['st']) && $_REQUEST['st'] == "Completed") {

            $first_name = $this->session->userdata('first_name',true);
            $last_name = $this->session->userdata('last_name',true);
            $email = $this->session->userdata('email',true);
            $phone = $this->session->userdata('phone',true);
            $city = $this->session->userdata('city',true);
            $category_id = $this->session->userdata('category_id');


            $insert['first_name'] = $first_name;
            $insert['last_name'] = $last_name;
            $insert['email'] = $email;
            $insert['created_on'] = date("Y-m:d H:i:s");
            $insert['amount'] = $_REQUEST['amt'];
            $insert['phone'] = $phone;
            $insert['city'] = $city;
            $insert['type']='P';
            $insert['category_id']=$category_id;
            $insert['created_by'] = 1;
            $insert['online_transaction_details'] = json_encode($_REQUEST);
            $app_donation_id = $this->model_customer->insert("app_donation", $insert);

            //Unset Donation
            unset_donation_session();
            $this->session->set_userdata('app_donation_id', $app_donation_id);

            //Send email
            $subject = dt_get_CompanyName()." | ".dt_translate('donation');
            $define_param['to_name'] = $first_name." ".$last_name;
            $define_param['to_email'] =$email;

            $parameter['NAME'] =  $first_name." ".$last_name;
            $parameter['AMOUNT'] =$_REQUEST['amt'];

            $html = $this->load->view("email_template/donation", $parameter, true);
            $this->sendmail->send($define_param, $subject, $html);

            $this->session->set_flashdata('msg', dt_translate('transaction_success'));
            $this->session->set_flashdata('msg_class', 'success');
            redirect('success/');
        } else {
            //Unset Donation
            unset_donation_session();

            $this->session->set_flashdata('msg', dt_translate('transaction_fail'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url('donate'));
        }
    }

    public function paypal_cancel() {
        //Unset Donation
        unset_donation_session();

        $this->session->set_flashdata('msg', dt_translate('transaction_fail'));
        $this->session->set_flashdata('msg_class', 'failure');
        redirect(base_url('donate'));
    }


    /*Process Razor Pay Action*/
    public function razorpay_success(){

        $razorpay_merchant_key_id=dt_get_payment_setting('razorpay_merchant_key_id');
        $razorpay_merchant_key_secret=dt_get_payment_setting('razorpay_merchant_key_secret');

        if(isset($_REQUEST['razorpay_payment_id']) && $_REQUEST['razorpay_payment_id']!=""){
            $razorpay_payment_id=$_REQUEST['razorpay_payment_id'];
            $razorpay_order_id=$_REQUEST['razorpay_order_id'];
            $razorpay_signature=($_REQUEST['razorpay_signature']);

            $data=$razorpay_order_id."|".$razorpay_payment_id;
            $generated_signature = hash_hmac("sha256",$data,  $razorpay_merchant_key_secret);

            if ($generated_signature == $razorpay_signature) {
                $first_name = $this->session->userdata('first_name',true);
                $last_name = $this->session->userdata('last_name',true);
                $email = $this->session->userdata('email',true);
                $phone = $this->session->userdata('phone',true);
                $city = $this->session->userdata('city',true);
                $category_id = $this->session->userdata('category_id');
                $amount = $this->session->userdata('amount');


                $insert['first_name'] = $first_name;
                $insert['last_name'] = $last_name;
                $insert['email'] = $email;
                $insert['created_on'] = date("Y-m:d H:i:s");
                $insert['amount'] = $amount;
                $insert['phone'] = $phone;
                $insert['city'] = $city;
                $insert['type']='R';
                $insert['category_id']=$category_id;
                $insert['created_by'] = 1;
                $insert['online_transaction_details'] = json_encode($_REQUEST);
                $app_donation_id = $this->model_customer->insert("app_donation", $insert);

                //Unset Donation
                unset_donation_session();
                $this->session->set_userdata('app_donation_id', $app_donation_id);

                //Send email
                $subject = dt_get_CompanyName()." | ".dt_translate('donation');
                $define_param['to_name'] = $first_name." ".$last_name;
                $define_param['to_email'] =$email;

                $parameter['NAME']= $first_name." ".$last_name;
                $parameter['AMOUNT']=$amount;

                $html = $this->load->view("email_template/donation", $parameter, true);
                $this->sendmail->send($define_param, $subject, $html);

                $this->session->set_flashdata('msg', dt_translate('transaction_success'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('success/');
            }else{
                //Unset Donation
                unset_donation_session();

                $this->session->set_flashdata('msg', dt_translate('transaction_fail'));
                $this->session->set_flashdata('msg_class', 'failure');
                redirect(base_url('donate'));
            }
        }else{

            //Unset Donation
            unset_donation_session();

            $this->session->set_flashdata('msg', dt_translate('transaction_fail'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url('donate'));
        }


    }

    public function razorpay_cancel(){
        $this->session->unset_userdata('first_name');
        $this->session->unset_userdata('last_name');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('phone');
        $this->session->unset_userdata('city');
        $this->session->unset_userdata('amount');
        $this->session->unset_userdata('category_id');

        $this->session->set_flashdata('msg', dt_translate('transaction_fail'));
        $this->session->set_flashdata('msg_class', 'failure');
        redirect(base_url('donate'));
    }


    /*Cause Donation Methods*/
    public function save_cause_donation() {

        $first_name=$this->input->post('first_name');
        $last_name=$this->input->post('last_name');
        $email=$this->input->post('email');
        $phone=$this->input->post('phone');
        $amount=$this->input->post('amount');
        $city=$this->input->post('city');
        $payment_by=$this->input->post('payment_by');
        $cause_id=$this->input->post("cause_id");
        $cause_title=$this->input->post("cause_title");
        $get_current_currency=dt_get_current_currency();

        if(isset($payment_by) && in_array($payment_by,array("P","S",'R'))){
            if($payment_by=="S"){
                include APPPATH . 'third_party/init.php';

                if ($this->input->post('stripeToken')) {
                    try {
                        //\Stripe\Stripe::setVerifySslCerts(false);
                        $stripe_api_key = dt_get_StripeSecret();
                        \Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings

                        $charge = \Stripe\Charge::create(array(
                            "amount" => ceil($amount * 100),
                            "currency" => trim($get_current_currency['code']),
                            "source" => $_POST['stripeToken'], // obtained with Stripe.js
                            "description" => dt_translate('causes')." ".dt_translate('donation')."-".$cause_title
                        ));

                        $charge_response = $charge->jsonSerialize();
                        if ($charge_response['paid'] == true) {

                            $insert['first_name'] = $first_name;
                            $insert['last_name'] = $last_name;
                            $insert['email'] = $email;
                            $insert['created_on'] = date("Y-m:d H:i:s");
                            $insert['amount'] = $amount;
                            $insert['phone'] = $phone;
                            $insert['city'] = $city;
                            $insert['type']='S';
                            $insert['status']='S';
                            $insert['cause_id']=$cause_id;
                            $insert['online_transaction_details'] = json_encode($charge_response);
                            $app_cause_donation_id = $this->model_customer->insert("app_cause_donation", $insert);

                            //Send email
                            $subject = dt_get_CompanyName()." | ".dt_translate('donation');
                            $define_param['to_name'] = $first_name." ".$last_name;
                            $define_param['to_email'] =$email;

                            $parameter['NAME'] =  $first_name." ".$last_name;
                            $parameter['AMOUNT'] =$amount;

                            $html = $this->load->view("email_template/donation", $parameter, true);
                            $this->sendmail->send($define_param, $subject, $html);

                            $this->db->query("UPDATE app_causes SET received_amount=received_amount+".$amount." WHERE id=".$cause_id);

                            $this->session->set_flashdata('msg', dt_translate('transaction_success') . "<br>" . dt_translate('booking_insert'));
                            $this->session->set_flashdata('msg_class', 'success');

                            $this->session->set_userdata('app_cause_donation_id', $app_cause_donation_id);

                            redirect(base_url('success/'));
                        } else {
                            $this->session->set_flashdata('msg', dt_translate('transaction_fail'));
                            $this->session->set_flashdata('msg_class', 'failure');
                            redirect(base_url('causes/'));
                        }
                    } catch (\Stripe\Error\Card $e) {
                        $body = $e->getJsonBody();
                        $err = $body['error'];
                        $this->session->set_flashdata('msg', $err['message']);
                        $this->session->set_flashdata('msg_class', 'failure');
                        redirect(base_url('cause-details/'.$cause_id));
                    } catch (\Stripe\Error\RateLimit $e) {
                        $this->session->set_flashdata('msg', "Too many requests made to the API too quickly");
                        $this->session->set_flashdata('msg_class', 'failure');
                        redirect(base_url('cause-details/'.$cause_id));
                    } catch (\Stripe\Error\InvalidRequest $e) {
                        $this->session->set_flashdata('msg', "Invalid parameters were supplied to Stripe's API");
                        $this->session->set_flashdata('msg_class', 'failure');
                        redirect(base_url('cause-details/'.$cause_id));
                    } catch (\Stripe\Error\Authentication $e) {
                        $this->session->set_flashdata('msg', "Authentication with Stripe's API failed");
                        $this->session->set_flashdata('msg_class', 'failure');
                        redirect(base_url('cause-details/'.$cause_id));
                    } catch (\Stripe\Error\ApiConnection $e) {
                        $this->session->set_flashdata('msg', "Network communication with Stripe failed");
                        $this->session->set_flashdata('msg_class', 'failure');
                        redirect(base_url('cause-details/'.$cause_id));
                    } catch (\Stripe\Error\Base $e) {
                        $this->session->set_flashdata('msg', "Something else happened, completely unrelated to Stripe");
                        $this->session->set_flashdata('msg_class', 'failure');
                        redirect(base_url('cause-details/'.$cause_id));
                    } catch (Exception $e) {
                        $this->session->set_flashdata('msg', "Something else happened, completely unrelated to Stripe");
                        $this->session->set_flashdata('msg_class', 'failure');
                        redirect(base_url('cause-details/'.$cause_id));
                    }
                }else{
                    $this->session->set_flashdata('msg', "Something else happened, completely unrelated to Stripe");
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect(base_url('cause-details/'.$cause_id));
                }
            }elseif($payment_by=="R"){
                $this->load->library('razorpay');

                $razorpay_merchant_key_id=dt_get_payment_setting('razorpay_merchant_key_id');
                $razorpay_merchant_key_secret=dt_get_payment_setting('razorpay_merchant_key_secret');

                $api = new Api($razorpay_merchant_key_id, $razorpay_merchant_key_secret);

                try{
                    $order  = $api->order->create([
                        'receipt'=>dt_translate('donation')."-".date('YmdHis'),
                        'amount'=> $amount*100, // amount in the smallest currency unit
                        'currency'=>trim($get_current_currency['code']),
                        'payment_capture'=>1
                    ]);

                    if(isset($order['id']) && $order['id']!=""){

                        $this->session->set_userdata('first_name', $first_name);
                        $this->session->set_userdata('last_name', $last_name);
                        $this->session->set_userdata('email', $email);
                        $this->session->set_userdata('phone', $phone);
                        $this->session->set_userdata('city', $city);
                        $this->session->set_userdata('cause_id', $cause_id);
                        $this->session->set_userdata('amount', $amount);

                        $this->razorpay->add_field('key_id',$razorpay_merchant_key_id);
                        $this->razorpay->add_field('order_id',$order['id']);
                        $this->razorpay->add_field('name',dt_get_CompanyName());
                        $this->razorpay->add_field('description',dt_translate('cause')." ".dt_translate('donation'));
                        $this->razorpay->add_field('image',dt_get_CompanyLogo());
                        $this->razorpay->add_field('prefill[name]',$first_name," ".$last_name);
                        $this->razorpay->add_field('prefill[contact]',$phone);
                        $this->razorpay->add_field('prefill[email]',$email);
                        $this->razorpay->add_field('notes[shipping address]',$city);

                        $this->razorpay->add_field('callback_url', base_url('cause-razorpay-success'));
                        $this->razorpay->add_field('cancel_url', base_url('cause-razorpay-cancel'));

                        $this->razorpay->submit();
                    }else{
                        redirect(base_url('cause-details/'.$cause_id));
                    }
                }catch (Exception $e){
                    $this->session->set_flashdata('msg',$e->getMessage());
                    $this->session->set_flashdata('msg_class', 'failure');
                    redirect(base_url('cause-details/'.$cause_id));
                }

            }else{

                //Paypal Payment
                $this->load->library('paypal');

                $this->session->set_userdata('first_name', $first_name);
                $this->session->set_userdata('last_name', $last_name);
                $this->session->set_userdata('email', $email);
                $this->session->set_userdata('phone', $phone);
                $this->session->set_userdata('city', $city);
                $this->session->set_userdata('cause_id', $cause_id);

                $this->paypal->add_field('rm', 2);
                $this->paypal->add_field('cmd', '_xclick');
                $this->paypal->add_field('amount', $amount);
                $this->paypal->add_field('item_name', dt_translate('causes')." ".dt_translate('donation')."-".$cause_title);
                $this->paypal->add_field('currency_code', trim($get_current_currency['code']));
                $this->paypal->add_field('business', dt_get_payment_setting('paypal_merchant_email'));
                $this->paypal->add_field('cancel_return', base_url('cause_paypal_cancel'));
                $this->paypal->add_field('return', base_url('cause_paypal_success'));
                $this->paypal->submit_paypal_post();
            }
        }else{
            redirect(base_url('cause-details/'.$cause_id));
        }


    }

    public function cause_paypal_success() {

        if (isset($_REQUEST['st']) && $_REQUEST['st'] == "Completed") {

            $first_name = $this->session->userdata('first_name');
            $last_name = $this->session->userdata('last_name');
            $email = $this->session->userdata('email');
            $phone = $this->session->userdata('phone');
            $city = $this->session->userdata('city');
            $cause_id = $this->session->userdata('cause_id');

            $insert['first_name'] = $first_name;
            $insert['last_name'] = $last_name;
            $insert['email'] = $email;
            $insert['created_on'] = date("Y-m:d H:i:s");
            $insert['amount'] = $_REQUEST['amt'];
            $insert['phone'] = $phone;
            $insert['city'] = $city;
            $insert['type']='P';
            $insert['status']='S';
            $insert['cause_id']=$cause_id;
            $insert['online_transaction_details'] = json_encode($_REQUEST);
            $app_cause_donation_id = $this->model_customer->insert("app_cause_donation", $insert);

            //Send email
            $subject = dt_get_CompanyName()." | ".dt_translate('donation');
            $define_param['to_name'] = $first_name." ".$last_name;
            $define_param['to_email'] =$email;

            $parameter['NAME'] =  $first_name." ".$last_name;
            $parameter['AMOUNT'] =$_REQUEST['amt'];

            $html = $this->load->view("email_template/donation", $parameter, true);
            $this->sendmail->send($define_param, $subject, $html);

            $this->db->query("UPDATE app_causes SET received_amount=received_amount+".$_REQUEST['amt']." WHERE id=".$cause_id);

            //Unset Session
            unset_cause_session();
            $this->session->set_userdata('app_cause_donation_id', $app_cause_donation_id);

            $this->session->set_flashdata('msg', dt_translate('transaction_success'));
            $this->session->set_flashdata('msg_class', 'success');
            redirect('success/');
        } else {
            //Unset Session
            unset_cause_session();

            $this->session->set_flashdata('msg', dt_translate('transaction_fail'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url('causes'));
        }
    }

    public function cause_paypal_cancel() {
        //Unset Session
        unset_cause_session();

        $this->session->set_flashdata('msg', dt_translate('transaction_fail'));
        $this->session->set_flashdata('msg_class', 'failure');
        redirect(base_url('donate'));
    }

    /*Process Razor Pay Action*/
    public function cause_razorpay_success(){
        $razorpay_merchant_key_id=dt_get_payment_setting('razorpay_merchant_key_id');
        $razorpay_merchant_key_secret=dt_get_payment_setting('razorpay_merchant_key_secret');

        if(isset($_REQUEST['razorpay_payment_id']) && $_REQUEST['razorpay_payment_id']!=""){
            $razorpay_payment_id=$_REQUEST['razorpay_payment_id'];
            $razorpay_order_id=$_REQUEST['razorpay_order_id'];
            $razorpay_signature=($_REQUEST['razorpay_signature']);

            $data=$razorpay_order_id."|".$razorpay_payment_id;
            $generated_signature = hash_hmac("sha256",$data,  $razorpay_merchant_key_secret);

            if ($generated_signature == $razorpay_signature) {

                $first_name = $this->session->userdata('first_name');
                $last_name = $this->session->userdata('last_name');
                $email = $this->session->userdata('email');
                $phone = $this->session->userdata('phone');
                $city = $this->session->userdata('city');
                $cause_id = $this->session->userdata('cause_id');
                $amount = $this->session->userdata('amount');

                $insert['first_name'] = $first_name;
                $insert['last_name'] = $last_name;
                $insert['email'] = $email;
                $insert['created_on'] = date("Y-m:d H:i:s");
                $insert['amount'] = $amount;
                $insert['phone'] = $phone;
                $insert['city'] = $city;
                $insert['type']='R';
                $insert['status']='S';
                $insert['cause_id']=$cause_id;
                $insert['online_transaction_details'] = json_encode($_REQUEST);
                $app_cause_donation_id = $this->model_customer->insert("app_cause_donation", $insert);

                //Send email
                $subject = dt_get_CompanyName()." | ".dt_translate('donation');
                $define_param['to_name'] = $first_name." ".$last_name;
                $define_param['to_email'] =$email;

                $parameter['NAME']=$first_name." ".$last_name;
                $parameter['AMOUNT']=$amount;

                $html = $this->load->view("email_template/donation", $parameter, true);
                $this->sendmail->send($define_param, $subject, $html);

                $this->db->query("UPDATE app_causes SET received_amount=received_amount+".$amount." WHERE id=".$cause_id);
                //unset session
                $this->session->set_userdata('app_cause_donation_id', $app_cause_donation_id);

                $this->session->set_flashdata('msg', dt_translate('transaction_success'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('success/');
            }else{
                //Unset Session
                unset_cause_session();

                $this->session->set_flashdata('msg', dt_translate('transaction_fail'));
                $this->session->set_flashdata('msg_class', 'failure');
                redirect(base_url('causes'));
            }
        }else{
            //Unset Session
            unset_cause_session();

            $this->session->set_flashdata('msg', dt_translate('transaction_fail'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect(base_url('causes'));
        }
    }

    public function cause_razorpay_cancel(){
        //Unset Session
        unset_cause_session();

        $this->session->set_flashdata('msg', dt_translate('transaction_fail'));
        $this->session->set_flashdata('msg_class', 'failure');
        redirect(base_url('causes'));
    }
    public function donation_success(){

        $app_donation_id = $this->session->userdata('app_donation_id',true);
        $app_cause_donation_id = $this->session->userdata('app_cause_donation_id',true);
        if(isset($app_donation_id) && $app_donation_id>0){

            $app_donation_array=$this->model_customer->getData("app_donation", "*", "id=".$app_donation_id);
            if(isset($app_donation_array) && count($app_donation_array)>0){

                $data['title'] = dt_translate('transaction_successful');
                $data['app_donation']=$app_donation_array[0];
                $this->load->view('front/'.$this->theme.'/donation_success', $data);

            }else{
                redirect(base_url());
            }
        }elseif (isset($app_cause_donation_id) && $app_cause_donation_id>0){
            $app_donation_array=$this->model_customer->getData("app_cause_donation", "*", "id=".$app_cause_donation_id);
            if(isset($app_donation_array) && count($app_donation_array)>0){

                $data['title'] = dt_translate('transaction_successful');
                $data['app_donation']=$app_donation_array[0];
                $this->load->view('front/'.$this->theme.'/donation_success', $data);

            }else{
                redirect(base_url());
            }
        }else{
            redirect(base_url());
        }

    }

}

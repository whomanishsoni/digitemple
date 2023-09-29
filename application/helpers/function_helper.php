<?php
/*Run This Query to Support Group By On MySQL Server*/
function dt_run_default_query() {
    $CI = & get_instance();
    $CI->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
    $CI->db->query("UPDATE app_causes SET status='C' WHERE received_amount>=target_amount");
}

/*Check if given controller is active. This is for link selection*/
function dt_active_link($controller) {
    $CI = &get_instance();
    $class = $CI->router->fetch_class();
    return ($class == $controller) ? 'active' : '';
}

/*Get Date format that need to show*/
function get_formated_date($value, $his = "Y") {
    $CI = & get_instance();
    $CI->db->select('time_format');
    $CI->db->from('app_site_setting');
    $where = "id='1'";
    $CI->db->where($where);
    $site_data = $CI->db->get()->row_array();
    if ($his == "Y") {
        return isset($site_data['time_format']) ? date($site_data['time_format'], strtotime($value)) : date('m-d-Y H:i', strtotime($value));
    } else {
        $explode = explode(" ", $site_data['time_format']);
        return isset($site_data['time_format']) ? date(isset($explode[0]) ? $explode[0] : "m-d-Y", strtotime($value)) : date('m-d-Y', strtotime($value));
    }
}

/*Get Status Badge*/
function dt_get_status_badge($val) {
    if ($val == 'C') {
        return '<span class="badge badge-success">' . dt_translate('completed') . '</span>';
    } elseif ($val == 'I') {
        return '<span class="badge badge-danger">' . dt_translate('inactive') . '</span>';
    } elseif ($val == 'A') {
        return '<span class="badge badge-success">' . dt_translate('active') . '</span>';
    } elseif ($val == 'P') {
        return '<span class="badge badge-info">' . dt_translate('pending') . '</span>';
    } elseif ($val == 'R') {
        return '<span class="badge badge-warning">' . dt_translate('rejected') . '</span>';
    } else {
        return '<span class="badge badge-danger">' . dt_translate('deleted') . '</span>';
    }
}

/*Get Formated Date*/
function dt_get_formated_date($value, $his = "Y") {
    $CI = & get_instance();
    $CI->db->select('time_format');
    $CI->db->from('app_site_setting');
    $where = "id='1'";
    $CI->db->where($where);
    $site_data = $CI->db->get()->row_array();
    if ($his == "Y") {
        return isset($site_data['time_format']) ? date($site_data['time_format'], strtotime($value)) : date('m-d-Y H:i', strtotime($value));
    } else {
        $explode = explode(" ", $site_data['time_format']);
        return isset($site_data['time_format']) ? date(isset($explode[0]) ? $explode[0] : "m-d-Y", strtotime($value)) : date('m-d-Y', strtotime($value));
    }
}

/*Get Site Setting Data*/
function dt_get_site_setting($field) {
    $CI = & get_instance();
    $CI->db->select($field);
    $CI->db->from('app_site_setting');
    $where = "id='1'";
    $CI->db->where($where);
    $site_data = $CI->db->get()->result_array();
    return isset($site_data) && count($site_data) > 0 ? trim($site_data[0][$field]) : '';
}

/*Get CMS Pages data*/
function dt_get_cms_page_status($field) {
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('app_cms_page');
    $where = "code='".$field."'";
    $CI->db->where($where);
    $site_data = $CI->db->get()->row_array();
    return $site_data;
}
/*Get Company Name*/
function dt_get_CompanyName() {
    $CI = & get_instance();
    $CI->db->select('company_name');
    $CI->db->from('app_site_setting');
    $where = "id='1'";
    $CI->db->where($where);
    $user_data = $CI->db->get()->result_array();
    return isset($user_data) && count($user_data) > 0 ? $user_data[0]['company_name'] : '';
}

/*Get Company Logo */
function dt_get_CompanyLogo() {
    $CI = & get_instance();
    $CI->db->select('company_logo');
    $CI->db->from('app_site_setting');
    $where = "id='1'";
    $CI->db->where($where);
    $user_data = $CI->db->get()->row_array();
    if (isset($user_data['company_logo']) && $user_data['company_logo'] != "") {
        $company_logo = $user_data['company_logo'];
        if (file_exists(FCPATH . uploads_path . "/" . $company_logo)) {
            return base_url(uploads_path . "/" . $company_logo);
        } else {
            return base_url('assets/images/logo.png');
        }
    } else {
        return base_url('assets/images/logo.png');
    }
}

/*Get Selected Time zone*/
function dt_set_time_zone() {
    $CI = & get_instance();
    $CI->db->select('time_zone');
    $CI->db->from('app_site_setting');
    $where = "id='1'";
    $CI->db->where($where);
    $user_data = $CI->db->get()->result_array();
    return isset($user_data) && count($user_data) > 0 && $user_data[0]['time_zone'] != '' ? date_default_timezone_set($user_data[0]['time_zone']) : date_default_timezone_set('Asia/Kolkata');
}

/*Get Time zone list*/
function dt_tz_list() {
    $zones_array = array();
    $timestamp = time();
    foreach (timezone_identifiers_list() as $key => $zone) {
        date_default_timezone_set($zone);
        $zones_array[$key]['zone'] = $zone;
        $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
    }
    return $zones_array;
}

/*Get Login User details*/
function dt_get_CustomerDetails() {
    $CI = & get_instance();
    $id = $CI->session->userdata('ADMIN_ID');
    $CI->db->select('first_name, last_name, profile_image,email,type');
    $CI->db->from('app_admin');
    $where = "id='$id'";
    $CI->db->where($where);
    $user_data = $CI->db->get()->result_array();
    return isset($user_data) && count($user_data) > 0 ? $user_data[0] : '';
}

/*Get Active Language*/
function dt_get_Langauge() {
    $CI = & get_instance();
    $CI->db->select('language');
    $CI->db->from('app_site_setting');
    $where = "id='1'";
    $CI->db->where($where);
    $user_data = $CI->db->get()->result_array();
    if (isset($user_data) && count($user_data) > 0) {
        $file = APPPATH . "/language/" . $user_data[0]['language'] . "/";
        if (is_dir($file)) {
            return strtolower($user_data[0]['language']);
        } else {
            return strtolower($CI->config->item('language'));
        }
    } else {
        return strtolower($CI->config->item('language'));
    }
}

/*Get Favicon*/
function dt_get_fevicon() {
    $CI = & get_instance();
    $CI->db->select('fevicon_icon');
    $CI->db->from('app_site_setting');
    $where = "id='1'";
    $CI->db->where($where);
    $user_data = $CI->db->get()->row_array();

    if (isset($user_data['fevicon_icon']) && $user_data['fevicon_icon'] != "") {
        if (file_exists(FCPATH . uploads_path . "/" . $user_data['fevicon_icon'])) {
            return base_url(uploads_path . "/" . $user_data['fevicon_icon']);
        } else {
            return base_url("assets/images/fevicon.png");
        }
    } else {
        return base_url("assets/images/fevicon.png");
    }
}

/*Get Site setting */
function dt_app_site_setting(){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('app_site_setting');
    return $CI->db->get()->row_array();
}

/*Get Stripe Secret*/
function dt_get_StripeSecret() {
    $CI = & get_instance();
    $CI->db->select('stripe_secret,stripe');
    $CI->db->from('app_payment_setting');
    $where = "id='1'";
    $CI->db->where($where);
    $user_data = $CI->db->get()->result_array();
    return isset($user_data) && count($user_data) > 0 && $user_data[0]['stripe'] == 'Y' ? $user_data[0]['stripe_secret'] : '';
}

/*Get Stripe Publish Key*/
function dt_get_Stripepublish() {
    $CI = & get_instance();
    $CI->db->select('stripe_publish,stripe');
    $CI->db->from('app_payment_setting');
    $where = "id='1'";
    $CI->db->where($where);
    $user_data = $CI->db->get()->result_array();
    return isset($user_data) && count($user_data) > 0 && $user_data[0]['stripe'] == 'Y' ? $user_data[0]['stripe_publish'] : '';
}

/*Get Currency*/
function dt_get_current_currency() {
    $currency_id = dt_get_site_setting('currency_id');
    $currency_id = (isset($currency_id) && $currency_id > 0) ? $currency_id : 25;
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('app_currency');
    $CI->db->where('id', $currency_id);
    $data = $CI->db->get()->row_array();
    if (isset($data['id']) && $data['id'] > 0) {
        return isset($data) ? $data : array();
    } else {
        return $CI->db->query("SELECT * FROM app_currency WHERE id=1")->row_array();
    }
}

/*Get Payment Setting*/
function dt_get_payment_setting($field) {
    $CI = & get_instance();
    $CI->db->select($field);
    $CI->db->from('app_payment_setting');
    $where = "id='1'";
    $CI->db->where($where);
    $payment_data = $CI->db->get()->result_array();
    return isset($payment_data) && count($payment_data) > 0 ? $payment_data[0][$field] : '';
}

/*Check if give payment is active*/
function dt_check_payment_method($val) {
    $CI = & get_instance();
    $CI->db->select($val);
    $CI->db->from('app_payment_setting');
    $where = "id='1'";
    $CI->db->where($where);
    $user_data = $CI->db->get()->result_array();
    return isset($user_data) && count($user_data) > 0 && $user_data[0][$val] == 'Y' ? true : false;
}

/*Format Price value*/
function dt_price_format($val) {
    $currency_position = dt_get_site_setting('currency_position');
    $get_current_currency = dt_get_current_currency();

    if ($currency_position == 'R') {
        return number_format((float) $val, 2, '.', '') . "" . $get_current_currency['currency_code'];
    } else {
        return $get_current_currency['currency_code'] . "" . number_format((float) $val, 2, '.', '');
    }
}

/*From here language translate work for given keyword. It will first check language and then select value from language file*/
function dt_translate($word) {
    $CI = & get_instance();
    $CI->load->database();
    $CI->load->helper('language');

    $language_session = $CI->session->userdata('language');
    $language = "english";
    if (isset($language_session) && $language_session != "" && $language_session != NULL) {
        $language = isset($language_session) ? trim($language_session) : "english";
    } else {
        $language = isset($language_session) ? trim($language_session) : "english";
    }

    $CI->lang->load('basic', trim($language));
    $language_word = strtolower(trim($word));
    $translated_word = stripslashes($CI->lang->line($language_word));
    if(empty($translated_word)) {
        $translated_word = ucwords(str_replace("_"," ",$word));
    }
    return $translated_word;
}

/*Get Only active language*/
function get_languages() {
    $CI = & get_instance();
    return $languages = $CI->db->select('*')->where('status', 'A')->from('app_language')->get()->result_array();
}

/*Show sub active link*/
function dt_sub_active_link($controller) {
    $CI = &get_instance();
    $class = $CI->router->fetch_class() . "/" . $CI->router->fetch_method();
    return ($class == $controller) ? 'active' : '';
}

/*Get Team Data */
function dt_get_team($limit=0) {
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('app_team');
    if($limit>0){
        $CI->db->limit($limit);
    }
    $CI->db->where('status','A');
    $record = $CI->db->get()->result_array();
    return $record;
}

/*Get Event Data */
function dt_get_event($limit=0) {
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('app_events');
    if($limit>0){
        $CI->db->limit($limit);
    }
    $CI->db->where('status','A');
    $record = $CI->db->get()->result_array();
    return $record;
}

/*Get Event Data */
function dt_get_project($limit=0) {
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('app_projects');
    if($limit>0){
        $CI->db->limit($limit);
    }
    $CI->db->where('status','A');
    $record = $CI->db->get()->result_array();
    return $record;
}

/*Get cause data */
function dt_get_causes($limit=0) {
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('app_causes');
    if($limit>0){
        $CI->db->limit($limit);
    }
    $CI->db->where('status','A');
    $CI->db->order_by('id','desc');
    $record = $CI->db->get()->result_array();
    return $record;
}

/*Get News Data*/
function dt_get_news($limit=0) {
    $CI = & get_instance();
    $CI->db->select('app_news.*,app_admin.first_name,app_admin.last_name');
    $CI->db->join('app_admin', 'app_admin.id = app_news.created_by');
    $CI->db->from('app_news');
    if($limit>0){
        $CI->db->limit($limit);
    }
    $CI->db->where('app_news.status','A');
    $CI->db->order_by('id','desc');
    $record = $CI->db->get()->result_array();
    return $record;
}

/*Get About us data*/
function dt_get_about_us() {
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('app_content');
    $CI->db->where('title',"about");
    $record = $CI->db->get()->row_array();
    return $record;
}

/*Get Gallery Data*/
function dt_get_gallery($limit=0) {
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('app_gallery');
    if($limit>0){
        $CI->db->limit($limit);
    }
    $CI->db->where('status','A');
    $CI->db->order_by('id','desc');
    $record = $CI->db->get()->result_array();
    return $record;
}

/*Get Site Content*/
function dt_get_content($title) {
    $CI = & get_instance();
    $CI->db->select('details');
    $CI->db->from('app_content');
    $CI->db->where('title',$title);
    $record = $CI->db->get()->row_array();
    return isset($record['details'])?$record['details']:"";
}

/*Get Background images */
function dt_get_content_image($title) {
    $CI = & get_instance();
    $CI->db->select('image');
    $CI->db->from('app_content');
    $CI->db->where('title',$title);
    $record = $CI->db->get()->row_array();
    return isset($record['image'])?$record['image']:"";
}

/*Escape data*/
function escape_data($value){
    $CI = & get_instance();
    $newString = str_replace('\r\n','<br/>',$value);
    $newString = str_replace('\n\r','<br/>',$newString);
    $newString = str_replace('\r','<br/>',$newString);
    $newString = str_replace('\n','<br/>',$newString);
    $newString = str_replace('[removed]','',$newString);
    $newString = str_replace('\'','',$newString);
    return $newString;
}

//Unset - Destroy Cause session
function unset_cause_session(){
    $CI = & get_instance();
    $CI->session->unset_userdata('first_name');
    $CI->session->unset_userdata('last_name');
    $CI->session->unset_userdata('email');
    $CI->session->unset_userdata('phone');
    $CI->session->unset_userdata('city');
    $CI->session->unset_userdata('cause_id');
    $CI->session->unset_userdata('amount');
    $CI->session->unset_userdata('app_cause_donation_id');
}

//Unset - Destroy donation session
function unset_donation_session(){
    $CI = & get_instance();
    $CI->session->unset_userdata('first_name');
    $CI->session->unset_userdata('last_name');
    $CI->session->unset_userdata('email');
    $CI->session->unset_userdata('phone');
    $CI->session->unset_userdata('city');
    $CI->session->unset_userdata('amount');
    $CI->session->unset_userdata('category_id');
    $CI->session->unset_userdata('app_donation_id');
}

//Check if given module is enabled or not.
function is_module_enabled($module){
    $CI = & get_instance();
    $CI->db->select('is_enable');
    $CI->db->from('app_module_setting');
    $CI->db->where('module',$module);
    $record = $CI->db->get()->row_array();
    if(isset($record['is_enable']) && $record['is_enable']=="Y"){
        return true;
    }else{
        return false;
    }
}

//Get account balance
function account_balance($id) {
    $CI = &get_instance();
    $db = $CI->db->query("select sum(amount) as amount from app_transactions where account_id='$id'")->row_array();
    return $db['amount'];
}

//Get total donation for category
function category_donation($id){
    $CI = &get_instance();
    $db = $CI->db->query("select sum(amount) as amount from app_donation where category_id='$id'")->row_array();
    return $db['amount'];
}


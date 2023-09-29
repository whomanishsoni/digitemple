<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Website extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_customer');
        $this->authenticate->check_admin();
    }

    public function manage_banner(){
        $data['title']=dt_translate('manage')." ".dt_translate('banner_images');
        $data['home_background'] = $this->model_customer->getData('app_content', '*', 'title ="home_background"')[0];
        $data['about_us_background'] = $this->model_customer->getData('app_content', '*', 'title ="about_us_background"')[0];
        $data['team_background'] = $this->model_customer->getData('app_content', '*', 'title ="team_background"')[0];
        $data['causes_background'] = $this->model_customer->getData('app_content', '*', 'title ="causes_background"')[0];
        $data['news_background'] = $this->model_customer->getData('app_content', '*', 'title ="news_background"')[0];
        $data['gallery_background'] = $this->model_customer->getData('app_content', '*', 'title ="gallery_background"')[0];
        $data['contact_us_background'] = $this->model_customer->getData('app_content', '*', 'title ="contact_us_background"')[0];
        $data['donation_background'] = $this->model_customer->getData('app_content', '*', 'title ="donation_background"')[0];
        $data['event_background'] = $this->model_customer->getData('app_content', '*', 'title ="event_background"')[0];
        $data['project_background'] = $this->model_customer->getData('app_content', '*', 'title ="project_background"')[0];
        $data['is_banner_enabled'] = $this->model_customer->getData('app_content', '*', 'title ="is_breadcrumb_enabled"')[0];
        $this->load->view('admin/website/manage_banner', $data);
    }

    public function save_banner(){
        $is_banner_enabled['details']=$this->input->post('is_banner_enabled');
        $this->model_customer->update('app_content', $is_banner_enabled, "title='is_breadcrumb_enabled'");

        if (isset($_FILES['home_background']) && $_FILES['home_background']['name'] != '') {

            $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
            $fevicon_tmp_name = $_FILES["home_background"]["tmp_name"];
            $fevicon_temp = explode(".", $_FILES["home_background"]["name"]);
            $fevicon_name = uniqid();
            $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
            move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
            $data1['image'] = $new_fevicon_name;

            $old_image=$this->input->post('old_home_background');
            if(isset($old_image) && $old_image!=""){
                if (file_exists(FCPATH.uploads_path."/".$old_image)){
                    @unlink(FCPATH.uploads_path."/".$old_image);
                }
            }
            $this->model_customer->update('app_content', $data1, "title='home_background'");
        }

        // Upload About Us Banner Image
        if (isset($_FILES['about_us_background']) && $_FILES['about_us_background']['name'] != '') {

            $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
            $fevicon_tmp_name = $_FILES["about_us_background"]["tmp_name"];
            $fevicon_temp = explode(".", $_FILES["about_us_background"]["name"]);
            $fevicon_name = uniqid();
            $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
            move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
            $data2['image'] = $new_fevicon_name;

            $old_about_us_background=$this->input->post('old_about_us_background');
            if(isset($old_about_us_background) && $old_about_us_background!=""){
                if (file_exists(FCPATH.uploads_path."/".$old_about_us_background)){
                    @unlink(FCPATH.uploads_path."/".$old_about_us_background);
                }
            }
            $this->model_customer->update('app_content', $data2, "title='about_us_background'");
        }

        if (isset($_FILES['team_background']) && $_FILES['team_background']['name'] != '') {

            $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
            $fevicon_tmp_name = $_FILES["team_background"]["tmp_name"];
            $fevicon_temp = explode(".", $_FILES["team_background"]["name"]);
            $fevicon_name = uniqid();
            $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
            move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
            $data3['image'] = $new_fevicon_name;

            $old_team_background=$this->input->post('old_team_background');
            if(isset($old_team_background) && $old_team_background!=""){
                if (file_exists(FCPATH.uploads_path."/".$old_team_background)){
                    @unlink(FCPATH.uploads_path."/".$old_team_background);
                }
            }
            $this->model_customer->update('app_content', $data3, "title='team_background'");
        }

        if (isset($_FILES['causes_background']) && $_FILES['causes_background']['name'] != '') {

            $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
            $fevicon_tmp_name = $_FILES["causes_background"]["tmp_name"];
            $fevicon_temp = explode(".", $_FILES["causes_background"]["name"]);
            $fevicon_name = uniqid();
            $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
            move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
            $data4['image'] = $new_fevicon_name;

            $old_causes_background=$this->input->post('old_causes_background');
            if(isset($old_causes_background) && $old_causes_background!=""){
                if (file_exists(FCPATH.uploads_path."/".$old_causes_background)){
                    @unlink(FCPATH.uploads_path."/".$old_causes_background);
                }
            }
            $this->model_customer->update('app_content', $data4, "title='causes_background'");
        }

        if (isset($_FILES['news_background']) && $_FILES['news_background']['name'] != '') {

            $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
            $fevicon_tmp_name = $_FILES["news_background"]["tmp_name"];
            $fevicon_temp = explode(".", $_FILES["news_background"]["name"]);
            $fevicon_name = uniqid();
            $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
            move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
            $data5['image'] = $new_fevicon_name;

            $old_news_background=$this->input->post('old_news_background');
            if(isset($old_news_background) && $old_news_background!=""){
                if (file_exists(FCPATH.uploads_path."/".$old_news_background)){
                    @unlink(FCPATH.uploads_path."/".$old_news_background);
                }
            }
            $this->model_customer->update('app_content', $data5, "title='news_background'");
        }

        if (isset($_FILES['gallery_background']) && $_FILES['gallery_background']['name'] != '') {

            $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
            $fevicon_tmp_name = $_FILES["gallery_background"]["tmp_name"];
            $fevicon_temp = explode(".", $_FILES["gallery_background"]["name"]);
            $fevicon_name = uniqid();
            $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
            move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
            $data6['image'] = $new_fevicon_name;

            $old_gallery_background=$this->input->post('old_gallery_background');
            if(isset($old_gallery_background) && $old_gallery_background!=""){
                if (file_exists(FCPATH.uploads_path."/".$old_gallery_background)){
                    @unlink(FCPATH.uploads_path."/".$old_gallery_background);
                }
            }
            $this->model_customer->update('app_content', $data6, "title='gallery_background'");
        }

        if (isset($_FILES['contact_us_background']) && $_FILES['contact_us_background']['name'] != '') {

            $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
            $fevicon_tmp_name = $_FILES["contact_us_background"]["tmp_name"];
            $fevicon_temp = explode(".", $_FILES["contact_us_background"]["name"]);
            $fevicon_name = uniqid();
            $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
            move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
            $data7['image'] = $new_fevicon_name;

            $old_contact_us_background=$this->input->post('old_contact_us_background');
            if(isset($old_contact_us_background) && $old_contact_us_background!=""){
                if (file_exists(FCPATH.uploads_path."/".$old_contact_us_background)){
                    @unlink(FCPATH.uploads_path."/".$old_contact_us_background);
                }
            }
            $this->model_customer->update('app_content', $data7, "title='contact_us_background'");
        }

        if (isset($_FILES['donation_background']) && $_FILES['donation_background']['name'] != '') {

            $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
            $fevicon_tmp_name = $_FILES["donation_background"]["tmp_name"];
            $fevicon_temp = explode(".", $_FILES["donation_background"]["name"]);
            $fevicon_name = uniqid();
            $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
            move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
            $data8['image'] = $new_fevicon_name;

            $old_donation_background=$this->input->post('old_donation_background');
            if(isset($old_donation_background) && $old_donation_background!=""){
                if (file_exists(FCPATH.uploads_path."/".$old_donation_background)){
                    @unlink(FCPATH.uploads_path."/".$old_donation_background);
                }
            }
            $this->model_customer->update('app_content', $data8, "title='donation_background'");
        }

        if (isset($_FILES['event_background']) && $_FILES['event_background']['name'] != '') {

            $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
            $fevicon_tmp_name_event = $_FILES["event_background"]["tmp_name"];
            $fevicon_temp_event = explode(".", $_FILES["event_background"]["name"]);
            $fevicon_name_event = uniqid();
            $new_fevicon_name_event = $fevicon_name_event . '.' . end($fevicon_temp_event);
            move_uploaded_file($fevicon_tmp_name_event, "$uploadPath/$new_fevicon_name_event");
            $data9['image'] = $new_fevicon_name_event;

            $old_event_background=$this->input->post('old_event_background');
            if(isset($old_event_background) && $old_event_background!=""){
                if (file_exists(FCPATH.uploads_path."/".$old_event_background)){
                    @unlink(FCPATH.uploads_path."/".$old_event_background);
                }
            }
            $this->model_customer->update('app_content', $data9, "title='event_background'");
        }

        if (isset($_FILES['project_background']) && $_FILES['project_background']['name'] != '') {

            $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
            $fevicon_tmp_name_project = $_FILES["project_background"]["tmp_name"];
            $fevicon_temp_project = explode(".", $_FILES["project_background"]["name"]);
            $fevicon_name_project = uniqid();
            $new_fevicon_name_project = $fevicon_name_project . '.' . end($fevicon_temp_project);
            move_uploaded_file($fevicon_tmp_name_project, "$uploadPath/$new_fevicon_name_project");
            $data10['image'] = $new_fevicon_name_project;

            $old_project_background=$this->input->post('old_project_background');
            if(isset($old_project_background) && $old_project_background!=""){
                if (file_exists(FCPATH.uploads_path."/".$old_project_background)){
                    @unlink(FCPATH.uploads_path."/".$old_project_background);
                }
            }
            $this->model_customer->update('app_content', $data10, "title='project_background'");
        }

        $this->session->set_flashdata('msg', dt_translate('record_update'));
        $this->session->set_flashdata('msg_class', 'success');
        redirect('admin/manage-banner', 'redirect');
    }

    /*Manage ABout Us Content*/
    public function manage_about_us(){
        $data['title']=dt_translate('manage')." ".dt_translate('about_us');
        $data['app_content'] = $this->model_customer->getData('app_content', '*', 'title ="about"')[0];
        $this->load->view('admin/website/manage_about_us', $data);
    }

    public function manage_about_us_action(){
        if (isset($_FILES['about_image']) && $_FILES['about_image']['name'] != '') {

            $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
            $fevicon_tmp_name = $_FILES["about_image"]["tmp_name"];
            $fevicon_temp = explode(".", $_FILES["about_image"]["name"]);
            $fevicon_name = uniqid();
            $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
            move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
            $data['image'] = $new_fevicon_name;

            $old_image=$this->input->post('old_image');
            if(isset($old_image) && $old_image!=""){
                if (file_exists(FCPATH.uploads_path."/".$old_image)){
                    @unlink(FCPATH.uploads_path."/".$old_image);
                }
            }

        }
        $data['details']=json_encode($this->input->post('title[]', true));
        $this->model_customer->update('app_content', $data, "title='about'");

        $this->session->set_flashdata('msg', dt_translate('record_update'));
        $this->session->set_flashdata('msg_class', 'success');
        redirect('admin/manage-about-us');
    }

    /*Manage Contact Us Content*/
    public function manage_contact_us(){
        $data['title']=dt_translate('manage')." ".dt_translate('contact_us');
        $data['app_contact_us'] = $this->model_customer->getData('app_contact_us', '*');
        $this->load->view('admin/website/manage_contact_us', $data);
    }

    public function delete_contact_us($id){
        $id = (int) $id;
        if ($id > 0) {
            $this->model_customer->delete('app_contact_us', 'id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
            echo true;
        } else {
            echo FALSE;
        }
    }


    /*Manage causes*/
    public function manage_causes(){
        $data['title']=dt_translate('manage')." ".dt_translate('causes');
        $data['app_causes'] = $this->model_customer->getData("app_causes", "*", "","","id desc");
        $this->load->view('admin/website/manage_causes', $data);
    }
    public function causes_donation($id){
        $id=(int)$id;

        $app_causes=$this->model_customer->getData("app_causes", "*", "id=".$id);
        if(count($app_causes)==0){
            redirect('admin/manage-causes');
        }

        $data['app_causes']=$app_causes[0];
        $data['title']=dt_translate('manage')." ".dt_translate('causes')." ".dt_translate('donation');
        $data['app_cause_donation'] = $this->model_customer->getData("app_cause_donation", "*", "cause_id=".$id,"","id desc");
        $this->load->view('admin/website/causes_donation', $data);
    }
    public function add_causes(){
        $data['title']=dt_translate('add')." ".dt_translate('cause');
        $this->load->view('admin/website/add_update_causes', $data);
    }
    public function update_causes($id){
        $id = (int) $id;
        $app_causes = $this->model_customer->getData("app_causes", "*", "id='$id'");
        if (empty($app_causes)) {
            $this->session->set_flashdata('msg', dt_translate('invalid_request'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('admin/manage-causes');
        }

        if (isset($app_causes[0]) && !empty($app_causes[0])) {
            $data['app_causes'] = $app_causes[0];
            $data['title'] = dt_translate('update') . " " . dt_translate('cause');
            $this->load->view('admin/website/add_update_causes', $data);
        } else {
            redirect('admin/manage-causes');
        }
    }
    public function save_causes(){
        $admin_id = $this->session->userdata("ADMIN_ID");

        $id = (int) $this->input->post('id', true);
        $this->form_validation->set_rules('title', dt_translate('title'), 'trim|required');
        $this->form_validation->set_rules('description', dt_translate('description'), 'trim|required');
        $this->form_validation->set_rules('target_amount', dt_translate('target')." ".dt_translate('target_amount'), 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            if ($id > 0) {
                $this->update_causes($id);
            } else {
                $this->add_causes();
            }
        } else {
            $data['title'] = $this->input->post('title', true);
            $data['description'] = $this->input->post('description',true);
            $data['target_amount'] = $this->input->post('target_amount', true);
            $data['status'] = $this->input->post('status', true);

            if (isset($_FILES['cause_image']) && $_FILES['cause_image']['name'] != '') {

                $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
                $fevicon_tmp_name = $_FILES["cause_image"]["tmp_name"];
                $fevicon_temp = explode(".", $_FILES["cause_image"]["name"]);
                $fevicon_name = uniqid();
                $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
                move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
                $data['image'] = $new_fevicon_name;

                $old_image=$this->input->post('old_image');
                if(isset($old_image) && $old_image!=""){
                    if (file_exists(FCPATH.uploads_path."/".$old_image)){
                        @unlink(FCPATH.uploads_path."/".$old_image);
                    }
                }

            }

            if ($id > 0) {

                $this->model_customer->update('app_causes', $data, "id=" . $id);

                $this->session->set_flashdata('msg', dt_translate('record_update'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-causes', '');

            } else {

                $data['created_by'] = $admin_id;
                $data['created_on'] = date("Y-m-d H:i:s");
                $this->model_customer->insert('app_causes', $data);

                $this->session->set_flashdata('msg', dt_translate('record_insert'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-causes', 'redirect');
            }
        }
    }
    public function delete_causes($id){
        $id = (int) $id;
        if ($id > 0) {
            $app_record_data=$this->model_customer->getData("app_causes", "image", "id=".$id)[0];

            if(isset($app_record_data['image']) && $app_record_data['image']!=""){
                if (file_exists(FCPATH.uploads_path."/".$app_record_data['image'])){
                    @unlink(FCPATH.uploads_path."/".$app_record_data['image']);
                }
            }

            $this->model_customer->delete('app_causes', 'id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
            echo true;
        } else {
            echo FALSE;
        }
    }

    /*Manage news*/
    public function manage_news(){
        $data['title']=dt_translate('manage')." ".dt_translate('news');
        $data['app_news'] = $this->model_customer->getData("app_news", "*", "","","id desc");
        $this->load->view('admin/website/manage_news', $data);
    }
    public function add_news(){
        $data['title']=dt_translate('add')." ".dt_translate('news');
        $this->load->view('admin/website/add_update_news', $data);
    }
    public function update_news($id){
        $id = (int) $id;
        $app_news = $this->model_customer->getData("app_news", "*", "id='$id'");
        if (empty($app_news)) {
            $this->session->set_flashdata('msg', dt_translate('invalid_request'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('admin/manage-news');
        }

        if (isset($app_news[0]) && !empty($app_news[0])) {
            $data['app_news'] = $app_news[0];
            $data['title'] = dt_translate('update') . " " . dt_translate('news');
            $this->load->view('admin/website/add_update_news', $data);
        } else {
            redirect('admin/manage-news');
        }
    }
    public function save_news(){
        $admin_id = $this->session->userdata("ADMIN_ID");

        $id = (int) $this->input->post('id', true);
        $this->form_validation->set_rules('title', dt_translate('title'), 'trim|required');
        $this->form_validation->set_rules('description', dt_translate('description'), 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            if ($id > 0) {
                $this->update_news($id);
            } else {
                $this->add_news();
            }
        } else {
            $data['title'] = $this->input->post('title', true);
            $data['description'] = $this->input->post('description',true);
            $data['status'] = $this->input->post('status', true);

            if (isset($_FILES['news_image']) && $_FILES['news_image']['name'] != '') {
                $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
                $fevicon_tmp_name = $_FILES["news_image"]["tmp_name"];
                $fevicon_temp = explode(".", $_FILES["news_image"]["name"]);
                $fevicon_name = uniqid();
                $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
                move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
                $data['image'] = $new_fevicon_name;

                $old_image=$this->input->post('old_image');
                if(isset($old_image) && $old_image!=""){
                    if (file_exists(FCPATH.uploads_path."/".$old_image)){
                        @unlink(FCPATH.uploads_path."/".$old_image);
                    }
                }
            }

            if ($id > 0) {
                $this->model_customer->update('app_news', $data, "id=" . $id);
                $this->session->set_flashdata('msg', dt_translate('record_update'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-news', 'redirect');
            } else {
                $data['created_by'] = $admin_id;
                $data['created_on'] = date("Y-m-d H:i:s");
                $this->model_customer->insert('app_news', $data);

                $this->session->set_flashdata('msg', dt_translate('record_insert'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-news', 'redirect');
            }
        }
    }
    public function delete_news($id){
        $id = (int) $id;
        if ($id > 0) {

            $app_record_data=$this->model_customer->getData("app_news", "image", "id=".$id)[0];

            if(isset($app_record_data['image']) && $app_record_data['image']!=""){
                if (file_exists(FCPATH.uploads_path."/".$app_record_data['image'])){
                    @unlink(FCPATH.uploads_path."/".$app_record_data['image']);
                }
            }


            $this->model_customer->delete('app_news', 'id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
            echo true;
        } else {
            echo FALSE;
        }
    }



    /*Manage Gallery*/
    public function manage_gallery(){
        $data['title']=dt_translate('manage')." ".dt_translate('gallery');
        $data['app_gallery'] = $this->model_customer->getData("app_gallery", "*", "","","id desc");
        $this->load->view('admin/website/manage_gallery', $data);
    }
    public function add_gallery(){
        $data['title']=dt_translate('add')." ".dt_translate('gallery');
        $this->load->view('admin/website/add_update_gallery', $data);
    }
    public function update_gallery($id){
        $id = (int) $id;
        $app_gallery = $this->model_customer->getData("app_gallery", "*", "id='$id'");
        if (empty($app_gallery)) {
            $this->session->set_flashdata('msg', dt_translate('invalid_request'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('admin/manage-gallery');
        }

        if (isset($app_gallery[0]) && !empty($app_gallery[0])) {
            $data['app_gallery'] = $app_gallery[0];
            $data['title'] = dt_translate('update') . " " . dt_translate('gallery');
            $this->load->view('admin/website/add_update_gallery', $data);
        } else {
            redirect('admin/manage-gallery');
        }
    }
    public function save_gallery(){
        $admin_id = $this->session->userdata("ADMIN_ID");

        $id = (int) $this->input->post('id', true);
        $this->form_validation->set_rules('gallery_image', dt_translate('title'), 'trim');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            if ($id > 0) {
                $this->update_gallery($id);
            } else {
                $this->add_gallery();
            }
        } else {
            $data['status'] = $this->input->post('status', true);

            if (isset($_FILES['gallery_image']) && $_FILES['gallery_image']['name'] != '') {

                $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
                $fevicon_tmp_name = $_FILES["gallery_image"]["tmp_name"];
                $fevicon_temp = explode(".", $_FILES["gallery_image"]["name"]);
                $fevicon_name = uniqid();
                $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
                move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
                $data['image'] = $new_fevicon_name;

                $old_image=$this->input->post('old_image');
                if(isset($old_image) && $old_image!=""){
                    if (file_exists(FCPATH.uploads_path."/".$old_image)){
                        @unlink(FCPATH.uploads_path."/".$old_image);
                    }
                }

            }

            if ($id > 0) {
                $this->model_customer->update('app_gallery', $data, "id=" . $id);
                $this->session->set_flashdata('msg', dt_translate('record_update'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-gallery', 'redirect');

            } else {
                $data['created_by'] = $admin_id;
                $data['created_on'] = date("Y-m-d H:i:s");
                $this->model_customer->insert('app_gallery', $data);

                $this->session->set_flashdata('msg', dt_translate('record_insert'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-gallery', 'redirect');
            }
        }
    }
    public function delete_gallery($id){
        $id = (int) $id;
        if ($id > 0) {
            $app_record_data=$this->model_customer->getData("app_gallery", "image", "id=".$id)[0];

            if(isset($app_record_data['image']) && $app_record_data['image']!=""){
                if (file_exists(FCPATH.uploads_path."/".$app_record_data['image'])){
                    @unlink(FCPATH.uploads_path."/".$app_record_data['image']);
                }
            }

            $this->model_customer->delete('app_gallery', 'id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
            echo true;
        } else {
            echo FALSE;
        }
    }


    /*Manage Team*/
    public function manage_team(){
        $data['title']=dt_translate('manage')." ".dt_translate('team');
        $data['app_team'] = $this->model_customer->getData("app_team", "*", "","","id desc");
        $this->load->view('admin/website/manage_team', $data);
    }
    public function add_team(){
        $data['title']=dt_translate('add')." ".dt_translate('team');
        $this->load->view('admin/website/add_update_team', $data);
    }
    public function update_team($id){
        $id = (int) $id;
        $app_team = $this->model_customer->getData("app_team", "*", "id='$id'");
        if (empty($app_team)) {
            $this->session->set_flashdata('msg', dt_translate('invalid_request'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('admin/manage-team');
        }

        if (isset($app_team[0]) && !empty($app_team[0])) {
            $data['app_team'] = $app_team[0];
            $data['title'] = dt_translate('update') . " " . dt_translate('team');
            $this->load->view('admin/website/add_update_team', $data);
        } else {
            redirect('admin/manage-team');
        }
    }

    public function save_team(){

        $admin_id = $this->session->userdata("ADMIN_ID");

        $id = (int) $this->input->post('id', true);
        $this->form_validation->set_rules('name', dt_translate('name'), 'trim|required');
        $this->form_validation->set_rules('designation', dt_translate('designation'), 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            if ($id > 0) {
                $this->update_team($id);
            } else {
                $this->add_team();
            }
        } else {
            $data['name'] = $this->input->post('name', true);
            $data['designation'] = $this->input->post('designation',true);
            $data['facebook'] = $this->input->post('facebook', true);
            $data['twitter'] = $this->input->post('twitter', true);
            $data['instagram'] = $this->input->post('instagram', true);
            $data['linkdin'] = $this->input->post('linkdin', true);
            $data['status'] = $this->input->post('status', true);

            if (isset($_FILES['team_image']) && $_FILES['team_image']['name'] != '') {

                $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
                $fevicon_tmp_name = $_FILES["team_image"]["tmp_name"];
                $fevicon_temp = explode(".", $_FILES["team_image"]["name"]);
                $fevicon_name = uniqid();
                $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
                move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
                $data['image'] = $new_fevicon_name;

                $old_image=$this->input->post('old_image');
                if(isset($old_image) && $old_image!=""){
                    if (file_exists(FCPATH.uploads_path."/".$old_image)){
                        @unlink(FCPATH.uploads_path."/".$old_image);
                    }
                }

            }

            if ($id > 0) {
                $this->model_customer->update('app_team', $data, "id=" . $id);
                $this->session->set_flashdata('msg', dt_translate('record_update'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-team', 'redirect');
            } else {

                $data['created_by'] = $admin_id;
                $data['created_on'] = date("Y-m-d H:i:s");
                $this->model_customer->insert('app_team', $data);

                $this->session->set_flashdata('msg', dt_translate('record_insert'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-team', 'redirect');
            }
        }
    }
    public function delete_team($id){
        $id = (int) $id;
        if ($id > 0) {
            $app_record_data=$this->model_customer->getData("app_team", "image", "id=".$id)[0];

            if(isset($app_record_data['image']) && $app_record_data['image']!=""){
                if (file_exists(FCPATH.uploads_path."/".$app_record_data['image'])){
                    @unlink(FCPATH.uploads_path."/".$app_record_data['image']);
                }
            }

            $this->model_customer->delete('app_team', 'id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
            echo true;
        } else {
            echo FALSE;
        }
    }

    public function manage_home_content(){
        $data['title']=dt_translate('update')." ".dt_translate('home')." ".dt_translate('content');
        $data['home_content_title'] = $this->model_customer->getData('app_content', '*', 'title ="home_content_title"')[0];
        $data['home_content_description'] = $this->model_customer->getData('app_content', '*', 'title ="home_content_description"')[0];
        $data['video_link_title'] = $this->model_customer->getData('app_content', '*', 'title ="video_link"')[0]['details'];
        $data['home_slogan'] = $this->model_customer->getData('app_content', '*', 'title ="home_slogan"')[0]['details'];

        $this->load->view('admin/website/manage_home_content', $data);
    }

    public function save_home_content(){
        $data['details']=json_encode($this->input->post('title[]', true));
        $this->model_customer->update('app_content', $data, "title='home_content_title'");

        $datas['details']=json_encode($this->input->post('description[]', true));
        $this->model_customer->update('app_content', $datas, "title='home_content_description'");

        $datas['details']=($this->input->post('video_link_title', true));
        $this->model_customer->update('app_content', $datas, "title='video_link'");

        $datas['details']=($this->input->post('home_slogan', true));
        $this->model_customer->update('app_content', $datas, "title='home_slogan'");

        $this->session->set_flashdata('msg', dt_translate('record_update'));
        $this->session->set_flashdata('msg_class', 'success');
        redirect('admin/manage-home-content');
    }


    /*Manage Slider*/
    public function manage_slider(){
        $data['title']=dt_translate('manage')." ".dt_translate('slider');
        $data['app_slider'] = $this->model_customer->getData("app_slider", "*", "","","id desc");
        $this->load->view('admin/website/manage_slider', $data);
    }
    public function add_slider(){
        $data['title']=dt_translate('add')." ".dt_translate('slider');
        $this->load->view('admin/website/add_update_slider', $data);
    }
    public function update_slider($id){
        $id = (int) $id;
        $app_gallery = $this->model_customer->getData("app_slider", "*", "id='$id'");
        if (empty($app_gallery)) {
            $this->session->set_flashdata('msg', dt_translate('invalid_request'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('admin/manage-slider');
        }

        if (isset($app_gallery[0]) && !empty($app_gallery[0])) {
            $data['app_slider'] = $app_gallery[0];
            $data['title'] = dt_translate('update') . " " . dt_translate('slider');
            $this->load->view('admin/website/add_update_slider', $data);
        } else {
            redirect('admin/manage-slider');
        }
    }
    public function save_slider(){
        $admin_id = $this->session->userdata("ADMIN_ID");

        $id = (int) $this->input->post('id', true);
        $this->form_validation->set_rules('gallery_image', dt_translate('title'), 'trim');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            if ($id > 0) {
                $this->update_slider($id);
            } else {
                $this->add_slider();
            }
        } else {
            $data['status'] = $this->input->post('status', true);
            $data['title'] = $this->input->post('title', true);
            $data['sub_title'] = $this->input->post('sub_title', true);

            if (isset($_FILES['slider_image']) && $_FILES['slider_image']['name'] != '') {

                $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
                $fevicon_tmp_name = $_FILES["slider_image"]["tmp_name"];
                $fevicon_temp = explode(".", $_FILES["slider_image"]["name"]);
                $fevicon_name = uniqid();
                $new_fevicon_name = $fevicon_name . '.' . end($fevicon_temp);
                move_uploaded_file($fevicon_tmp_name, "$uploadPath/$new_fevicon_name");
                $data['image'] = $new_fevicon_name;

                $old_image=$this->input->post('old_image');
                if(isset($old_image) && $old_image!=""){
                    if (file_exists(FCPATH.uploads_path."/".$old_image)){
                        @unlink(FCPATH.uploads_path."/".$old_image);
                    }
                }

            }

            if ($id > 0) {
                $this->model_customer->update('app_slider', $data, "id=" . $id);
                $this->session->set_flashdata('msg', dt_translate('record_update'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-slider', 'redirect');

            } else {
                $data['created_by'] = $admin_id;
                $data['created_on'] = date("Y-m-d H:i:s");
                $this->model_customer->insert('app_slider', $data);

                $this->session->set_flashdata('msg', dt_translate('record_insert'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-slider', 'redirect');
            }
        }
    }
    public function delete_slider($id){
        $id = (int) $id;
        if ($id > 0) {
            $app_record_data=$this->model_customer->getData("app_slider", "image", "id=".$id)[0];

            if(isset($app_record_data['image']) && $app_record_data['image']!=""){
                if (file_exists(FCPATH.uploads_path."/".$app_record_data['image'])){
                    @unlink(FCPATH.uploads_path."/".$app_record_data['image']);
                }
            }

            $this->model_customer->delete('app_slider', 'id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
            echo true;
        } else {
            echo FALSE;
        }
    }


    /*Manage Pages*/
    public function manage_page(){
        $data['title']=dt_translate('manage')." ".dt_translate('pages');
        $data['app_cms_page'] = $this->model_customer->getData("app_cms_page", "*", "","","id desc");
        $this->load->view('admin/website/manage_page', $data);
    }
    public function add_page(){
        $data['title']=dt_translate('add')." ".dt_translate('pages');
        $this->load->view('admin/website/add_update_page', $data);
    }
    public function update_page($id){
        $id = (int) $id;
        $app_cms_page = $this->model_customer->getData("app_cms_page", "*", "id='$id'");
        if (empty($app_cms_page)) {
            $this->session->set_flashdata('msg', dt_translate('invalid_request'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('admin/manage-pages');
        }

        if (isset($app_cms_page[0]) && !empty($app_cms_page[0])) {
            $data['app_cms_page'] = $app_cms_page[0];
            $data['title'] = dt_translate('update') . " " . dt_translate('pages');
            $this->load->view('admin/website/add_update_page', $data);
        } else {
            redirect('admin/manage-pages');
        }
    }
    public function save_page(){
        $admin_id = $this->session->userdata("ADMIN_ID");

        $id = (int) $this->input->post('id', true);
        $this->form_validation->set_rules('title', dt_translate('title'), 'trim|required|is_unique[app_cms_page.title.id.' . $id . ']');
        $this->form_validation->set_rules('description', dt_translate('description'), 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            if ($id > 0) {
                $this->update_page($id);
            } else {
                $this->add_page();
            }
        } else {
            $data['title'] = $this->input->post('title', true);
            $data['description'] = $this->input->post('description',true);
            $data['status'] = $this->input->post('status', true);

            if ($id > 0) {
                $this->model_customer->update('app_cms_page', $data, "id=" . $id);
                $this->session->set_flashdata('msg', dt_translate('record_update'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-pages', 'redirect');
            } else {
                $data['created_on'] = date("Y-m-d H:i:s");
                $this->model_customer->insert('app_cms_page', $data);

                $this->session->set_flashdata('msg', dt_translate('record_insert'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-pages', 'redirect');
            }
        }
    }
    public function delete_page($id){
        $id = (int) $id;
        if ($id > 0) {
            $this->model_customer->delete('app_cms_page', 'id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
            echo true;
        } else {
            echo FALSE;
        }
    }

}
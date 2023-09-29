<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Causes extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_customer');
        $this->authenticate->check_admin();
    }


    /*Manage causes*/
    public function manage_causes(){
        $data['title']=dt_translate('manage')." ".dt_translate('causes');
        $data['app_causes'] = $this->model_customer->getData("app_causes", "*", "","","id desc");
        $this->load->view('admin/causes/manage_causes', $data);
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
        $this->load->view('admin/causes/causes_donation', $data);
    }
    public function add_causes(){
        $data['title']=dt_translate('add')." ".dt_translate('cause');
        $this->load->view('admin/causes/add_update_causes', $data);
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
            $this->load->view('admin/causes/add_update_causes', $data);
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
            $app_cause_donation=$this->model_customer->getData("app_cause_donation", "id", "cause_id=".$id)[0];

            if(isset($app_cause_donation) && count($app_cause_donation)){
                $this->session->set_flashdata('msg', dt_translate('delete_already_used'));
                $this->session->set_flashdata('msg_class', 'failure');

                echo FALSE;
            }else{
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
            }
        } else {
            echo FALSE;
        }
    }




    /*Manage Gallery*/
    public function manage_gallery(){
        $data['title']=dt_translate('manage')." ".dt_translate('gallery');
        $data['app_gallery'] = $this->model_customer->getData("app_gallery", "*", "","","id desc");
        $this->load->view('admin/causes/manage_gallery', $data);
    }
    public function add_gallery(){
        $data['title']=dt_translate('add')." ".dt_translate('gallery');
        $this->load->view('admin/causes/add_update_gallery', $data);
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
            $this->load->view('admin/causes/add_update_gallery', $data);
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
        $this->load->view('admin/causes/manage_team', $data);
    }
    public function add_team(){
        $data['title']=dt_translate('add')." ".dt_translate('team');
        $this->load->view('admin/causes/add_update_team', $data);
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
            $this->load->view('admin/causes/add_update_team', $data);
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

        $this->load->view('admin/causes/manage_home_content', $data);
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


}
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_customer');
        $this->authenticate->check_admin();
        $item_donation=is_module_enabled('news');
        if($item_donation==false){
            redirect('admin/dashboard');
        }
    }

    /*Manage news*/
    public function manage_news(){
        $data['title']=dt_translate('manage')." ".dt_translate('news');
        $data['app_news'] = $this->model_customer->getData("app_news", "*", "","","id desc");
        $this->load->view('admin/news/manage_news', $data);
    }
    public function add_news(){
        $data['title']=dt_translate('add')." ".dt_translate('news');
        $this->load->view('admin/news/add_update_news', $data);
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
            $this->load->view('admin/news/add_update_news', $data);
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

}
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_customer');
        $this->authenticate->check_admin();
    }

    /*Manage event*/
    public function index(){
        $data['title']=dt_translate('manage')." ".dt_translate('event');
        $data['app_events'] = $this->model_customer->getData("app_events", "*", "","","event_id desc");
        $this->load->view('admin/event/manage', $data);
    }
    public function add_event(){
        $data['title']=dt_translate('add')." ".dt_translate('event');
        $this->load->view('admin/event/add_update', $data);
    }
    public function update_event($id){
        $id = (int) $id;
        $app_events = $this->model_customer->getData("app_events", "*", "event_id='$id'");
        if (empty($app_events)) {
            $this->session->set_flashdata('msg', dt_translate('invalid_request'));
            $this->session->set_flashdata('msg_class', 'failure');
            redirect('admin/manage-events');
        }

        if (isset($app_events[0]) && !empty($app_events[0])) {
            $data['app_events'] = $app_events[0];
            $data['title'] = dt_translate('update') . " " . dt_translate('event');
            $this->load->view('admin/event/add_update', $data);
        } else {
            redirect('admin/manage-events');
        }
    }
    public function save_event(){
        $admin_id = $this->session->userdata("ADMIN_ID");

        $id = (int) $this->input->post('id', true);
        $this->form_validation->set_rules('title', dt_translate('title'), 'trim|required');
        $this->form_validation->set_rules('description', dt_translate('description'), 'trim|required');
        $this->form_validation->set_rules('event_venue', dt_translate('venue'), 'trim|required');
        $this->form_validation->set_rules('event_date', dt_translate('date'), 'trim|required');
        $this->form_validation->set_rules('event_time', dt_translate('time'), 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            if ($id > 0) {
                $this->update_event($id);
            } else {
                $this->add_event();
            }
        } else {
            $data['title'] = $this->input->post('title', true);
            $data['description'] = $this->input->post('description',true);
            $data['event_venue'] = $this->input->post('event_venue',true);
            $data['event_date'] = $this->input->post('event_date',true);
            $data['event_time'] = $this->input->post('event_time',true);
            $data['status'] = $this->input->post('status', true);

            if (isset($_FILES['event_image']) && $_FILES['event_image']['name'] != '') {
                $uploadPath = dirname(BASEPATH) . "/" . uploads_path;
                $fevicon_tmp_name = $_FILES["event_image"]["tmp_name"];
                $fevicon_temp = explode(".", $_FILES["event_image"]["name"]);
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
                $this->model_customer->update('app_events', $data, "event_id=" . $id);
                $this->session->set_flashdata('msg', dt_translate('record_update'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-events', 'redirect');
            } else {
                $data['created_on'] = date("Y-m-d H:i:s");
                $this->model_customer->insert('app_events', $data);

                $this->session->set_flashdata('msg', dt_translate('record_insert'));
                $this->session->set_flashdata('msg_class', 'success');
                redirect('admin/manage-events', 'redirect');
            }
        }
    }
    public function delete_event($id){
        $id = (int) $id;
        if ($id > 0) {

            $app_record_data=$this->model_customer->getData("app_events", "image", "event_id=".$id)[0];

            if(isset($app_record_data['image']) && $app_record_data['image']!=""){
                if (file_exists(FCPATH.uploads_path."/".$app_record_data['image'])){
                    @unlink(FCPATH.uploads_path."/".$app_record_data['image']);
                }
            }

            $this->model_customer->delete('app_events', 'event_id=' . $id);
            $this->session->set_flashdata('msg', dt_translate('record_delete'));
            $this->session->set_flashdata('msg_class', 'success');
            echo true;
        } else {
            echo FALSE;
        }
    }

}
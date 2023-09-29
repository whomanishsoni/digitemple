<?php

class MY_Controller extends CI_Controller {

    public $login_type;
    public $login_id;

    function __construct() {
        parent::__construct();

        $this->authenticate->check();
        $this->login_type = $this->session->userdata('TYPE');
        dt_run_default_query();
        dt_set_time_zone();

        $language_session = $this->session->userdata('language');

        if (isset($language_session) && $language_session != "" && $language_session != NULL) {
            $this->session->unset_userdata('language');
            $this->session->set_userdata("language",$language_session);
        }else{
            $language = dt_app_site_setting()['language'];

            $this->session->unset_userdata('language');
            $this->session->set_userdata("language",$language);
        }
    }

}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Programma extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Programma';         
        $data['active'] = 'programma';
        
        $this->load->model('planning_model');
        $data['planningen'] = $this->planning_model->getAllPlanningen();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $this->load->model('activiteit_model');
        $data['activiteiten'] = $this->activiteit_model->getActiviteitenActieve();
        
        $this->load->model('aankondiging_model');
        $data['aankondigingen'] = $this->aankondiging_model-> getAankondigingenActieve();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'planning/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
}

/* End of file welcome.php */
/* Location: ./application/models/planning_model */

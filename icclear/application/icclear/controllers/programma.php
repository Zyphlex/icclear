<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Programma extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $this->load->model('inschrijving_model');
        if ($user == null) {
            $data['inschrijving'] = null;
        } else {
            $data['inschrijving'] = $this->inschrijving_model->getInschijvingByGebruiker($user->id);
        }


        $data['title'] = 'IC Clear - Programma';
        $data['active'] = 'programma';

        $this->load->model('planning_model');
        $data['planningen'] = $this->planning_model->getAllPlanningen();

        $this->load->model('conferentie_model');
        $data['actieveId'] = $this->conferentie_model->getActieveConferentie();

        $this->load->model('activiteit_model');
        $data['activiteiten'] = $this->activiteit_model->getActiviteitenActieve();

        $this->load->model('aankondiging_model');
        $data['aankondigingen'] = $this->aankondiging_model->getAankondigingenActieve();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'planning/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function detailSessie() {
        $id = $this->input->get('id');

        $this->load->model('sessies_model');
        $sessie = $this->sessies_model->get($id);

        echo json_encode($sessie);
    }
    
    
    public function detailSpreker() {
        $id = $this->input->get('id');

        $this->load->model('gebruiker_model');
        $spreker = $this->gebruiker_model->getSpreker($id);
        $spreker->url = base_url() . "application/upload/fotos/sprekers/";
        
        echo json_encode($spreker);
    }

}

/* End of file welcome.php */
/* Location: ./application/models/planning_model */

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
        $data['title'] = 'IC Clear - Programma';
        $data['active'] = 'programma';
        
        //Kijken of user reeds is ingeschreven, als dit zo is, knop verbergen op view
        $this->load->model('inschrijving_model');
        if ($user == null) {
            $data['inschrijving'] = null;
        } else {
            $inschrijving = $this->inschrijving_model->IsGebruikerIngeschreven($user->id);
            if ($inschrijving == null) {
                $data['inschrijving'] = null;
            } else {
                $data['inschrijving'] = $inschrijving;
            }
        }

        $this->load->model('planning_model');
        $data['programma'] = $this->planning_model->getOverzichtActieve();

        $this->load->model('activiteit_model');
        $data['activiteiten'] = $this->activiteit_model->getActiviteitenActieve();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'planning/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    //Sessie details tonen in programma
    public function detailSessie() {
        $id = $this->input->get('id');

        $this->load->model('sessies_model');
        $sessie = $this->sessies_model->get($id);

        echo json_encode($sessie);
    }
    
    //Spreker details tonen in programma
    public function detailSpreker() {
        $id = $this->input->get('id');

        $this->load->model('gebruiker_model');
        $spreker = $this->gebruiker_model->getSpreker($id);
        $spreker->url = base_url() . "application/upload/fotos/sprekers/";
        
        echo json_encode($spreker);
    }

}

 
/* Location: ./application/models/planning_model */

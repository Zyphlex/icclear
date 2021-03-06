<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['title'] = 'IC Clear - Home';
        $data['active'] = 'home';

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $this->load->model('algemeneinfo_model');
        $data['algemeneinfo'] = $this->algemeneinfo_model->get();

        $this->load->model('aankondiging_model');
        $data['aankondigingen'] = $this->aankondiging_model->getNieuwsteAankondigingenActieve();

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

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'home/home', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

}

 
 

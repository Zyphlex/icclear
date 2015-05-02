<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sponsor extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
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

        $data['title'] = 'IC Clear - Sponsors';
        $data['active'] = 'sponsors';

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $this->load->model('sponsor_model');
        $data['sponsors'] = $this->sponsor_model->getAll();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'sponsor/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

}

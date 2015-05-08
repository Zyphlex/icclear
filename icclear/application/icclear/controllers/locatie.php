<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Locatie extends CI_Controller {

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


        $data['title'] = 'IC Clear - Venues';
        $data['active'] = 'venue';

        $this->load->model('gebouw_model');
        $data['gebouwen'] = $this->gebouw_model->getGebouwenConferentie();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'locatie/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    //lijst van hotels
    public function hotel() {
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


        $data['title'] = 'IC Clear - Hotels';
        $data['active'] = 'hotel';

        $this->load->model('hotel_model');
        $data['hotels'] = $this->hotel_model->getHotelsConferentie();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'locatie/hotels', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    //lijst van routes
    public function route() {
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


        $data['title'] = 'IC Clear - Routes';
        $data['active'] = '';

        $this->load->model('routes_model');
        $data['routes'] = $this->routes_model->getRoutesConferentie();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'locatie/routes', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    //overzicht van routes
    public function overzichtRoutes() {
        $gebouwId = $this->input->get('gebouwId');

        $this->load->model('routes_model');
        $data['routes'] = $this->routes_model->getRoutesGebouw($gebouwId);

        $this->load->view('locatie/overzichtroutes', $data);
    }

}

 
 

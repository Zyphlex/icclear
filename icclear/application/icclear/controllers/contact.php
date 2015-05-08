<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        if($user == null){
            $data['user'] = '';
        }
        $data['title'] = 'IC Clear - Contact';
        $data['active'] = 'home';

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
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

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'contact/start', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function insturen(){
        $email = $this->input->post('emailadresverzender');
        $boodschap = $this->input->post('boodschapcontact');
    }

}

 
 

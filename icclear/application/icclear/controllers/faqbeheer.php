<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faqbeheer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        if (!$this->authex->loggedIn()) {
            redirect('logon/aanmelden');
            //voorlopig
        } else {
            $user = $this->authex->getUserInfo();
            if ($user->typeId < 3) {
                redirect('logon/aanmelden');
                //voorlopig
            }
        }
    }

    //Alle FAQ tonen in overzicht
    public function index() {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['conferentieId'] = null;
        
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

        $data['title'] = 'IC Clear - F.A.Q.';
        $data['active'] = 'admin';

        $this->load->model('faq_model');
        $data['vragen'] = $this->faq_model->getAll();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/faq/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    //overzicht van alle vragen die je kan beheren
    public function overzicht() {
        $this->load->model('faq_model');
        $data['vragen'] = $this->faq_model->getAll();

        $this->load->view('admin/faq/lijst', $data);
    }

    //details per vraag
    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('faq_model');
        $vraag = $this->faq_model->get($id);

        echo json_encode($vraag);
    }
//updaten van een vraag
    public function update() {
        $faq->id = $this->input->post('id');
        $faq->vraag = $this->input->post('vraag');
        $faq->antwoord = $this->input->post('antwoord');

        $this->load->model('faq_model');
        if ($faq->id == 0) {
            $id = $this->faq_model->insert($faq);
        } else {
            $this->faq_model->update($faq);
        }

        echo $id;
    }
//deleten van een vraag
    public function delete() {
        $id = $this->input->post('id');

        $this->load->model('faq_model');
        $deleted = $this->faq_model->delete($id);

        echo $deleted;
    }

}

 
 

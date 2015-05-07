<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Planningbeheer extends CI_Controller {

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


        $data['title'] = 'IC Clear - Planning';
        $data['active'] = 'admin';
        


        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $this->load->model('gebouw_model'); //Alle gebouwen gebruikt in conferentie ophalen
        $data['zalen'] = $this->gebouw_model->getPerLandGebruikt($data['conferentieId']);
        
        $this->load->model('planning_model');
        $data['dagen'] = $this->planning_model->getAllByDag($data['conferentieId']);
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/planning/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function overzicht() {
        $data['conferentieId'] = $this->session->userdata('conferentieId');

        $this->load->model('planning_model');
        $data['dagen'] = $this->planning_model->getAllByDag($data['conferentieId']);

        $this->load->view('admin/planning/lijst', $data);
    }

    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('planning_model');
        $planning = $this->planning_model->get($id);

        echo json_encode($planning);
    }
    
    public function sessiesOver() {
        $data['conferentieId'] = $this->session->userdata('conferentieId');
               
        $this->load->model('sessies_model');
//        $sessies = $this->sessies_model->getAllNPlanConf($data['conferentieId']); //Alle sessies van een conferentie ophalen, die nog niet gepland zijn
        $sessies = $this->sessies_model->getAllPlanConf($data['conferentieId']); //Alle sessies  van een conferentie ophalen

        echo json_encode($sessies);
    }

    public function update() {
        $planning->id = $this->input->post('id');
        print_r($this->input->post('datum'));
        $planning->conferentiedagId = $this->input->post('datum');
        $planning->sessieId = $this->input->post('sessie');
        $planning->beginUur = $this->input->post('beginuur');
        $planning->eindUur = $this->input->post('einduur');
        $planning->plenair = $this->input->post('plenair');
        $planning->zaalId = $this->input->post('zaal');

        // Toevoegen als record nog niet bestaat, anders updaten
        $this->load->model('planning_model');
        if ($planning->id == 0) {
            $id = $this->planning_model->insert($planning);
        } else {
            $this->planning_model->update($planning);
        }
        
        echo $id;
    }

    public function delete() {
        $id = $this->input->post('id');

        $this->load->model('planning_model');
        $deleted = $this->planning_model->delete($id);

        echo $deleted;
    }

}

 
 

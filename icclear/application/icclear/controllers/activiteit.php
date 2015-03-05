<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activiteit extends CI_Controller {
    
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
    
    public function overzicht() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin';        
                
        $this->load->model('activiteit_model');
        $data['activiteiten'] = $this->activiteit_model->getAllActiviteiten();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/activiteit/lijst', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function wijzig($id) {

        $data['user'] = $this->authex->getUserInfo();
        $data['conferentieId'] = $this->session->userdata('conferentieId');

        $data['title'] = 'IC Clear - Beheer';
        $data['active'] = 'admin';

        $this->load->model('activiteit_model');
        $data['activiteit'] = $this->activiteit_model->get($id);

        $this->load->model('conferentie_model');
        $data['conferenties'] = $this->conferentie_model->getAll();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/activiteit/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
     public function update() {
        $activiteit = new stdClass();

        $activiteit->id = $this->input->post('id');
        $activiteit->naam = $this->input->post('naam');
        $activiteit->omschrijving = $this->input->post('omschrijving');
        $activiteit->prijs = $this->input->post('prijs');
        $activiteit->conferentieId = $this->input->post('conferentie');

        $this->load->model('activiteit_model');

        $this->activiteit_model->update($activiteit);

        $this->overzicht();
    }
    
    public function nieuw() {
        $data['user'] = $this->authex->getUserInfo();
        $data['conferentieId'] = $this->session->userdata('conferentieId');

        $data['title'] = 'IC Clear - Beheer';
        $data['active'] = 'admin';

        $this->load->model('conferentie_model');
        $data['conferenties'] = $this->conferentie_model->getAll();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/activiteit/toevoegen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function insert() {
        $activiteit = new stdClass();

        $activiteit->naam = $this->input->post('naam');
        $activiteit->omschrijving = $this->input->post('omschrijving');
        $activiteit->prijs = $this->input->post('prijs');
        $activiteit->conferentieId = $this->input->post('conferentie');

        $this->load->model('activiteit_model');

        $this->activiteit_model->insert($activiteit);

        $this->overzicht();
    }
    
    public function detail() {        
            $id = $this->input->get('id');
                        
            $this->load->model('activiteit_model');
            $activiteit = $this->activiteit_model->get($id);
            
            echo json_encode($activiteit); 
    }
    
    
    
    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

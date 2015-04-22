<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gebruiker extends CI_Controller {

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
        $data['user'] = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Gebruiker';
        $data['active'] = 'admin';        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        $this->load->model('gebruiker_model');        
        $data['gebruikers'] = $this->gebruiker_model->getAll();
        
        $this->load->model('land_model');        
        $data['landen'] = $this->land_model->getAll();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebruiker/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
      
    public function overzicht() {        
        $this->load->model('gebruiker_model');
        $data['gebruikers'] = $this->gebruiker_model->getAll();
        
        $this->load->model('land_model');        
        $data['landen'] = $this->land_model->getAll();

        $this->load->view('admin/gebruiker/lijst', $data);
    }
    
    public function detail() {        
            $id = $this->input->get('id');
                        
            $this->load->model('gebruiker_model');
            $gebruiker = $this->gebruiker_model->get($id);
            
            echo json_encode($gebruiker); 
    }
    
    public function update() {   
        $gebruiker->id = $this->input->post('id');
        $gebruiker->voornaam = $this->input->post('voornaam');
        $gebruiker->familienaam = $this->input->post('familienaam');
        $gebruiker->geboortedatum = $this->input->post('geboortedatum');
        $gebruiker->emailadres = $this->input->post('emailadres');
        $gebruiker->geslacht = strtolower($this->input->post('geslacht'));
        $gebruiker->typeId = $this->input->post('type');
        $gebruiker->landId = $this->input->post('land');
        $gebruiker->gemeente = $this->input->post('gemeente');
        $gebruiker->postcode = $this->input->post('postcode');
        $gebruiker->straat = $this->input->post('straat');
        $gebruiker->nummer = $this->input->post('nummer');
        
        $this->load->model('gebruiker_model');        
        if ($gebruiker->id == 0) {
            $id = $this->gebruiker_model->insert($gebruiker);
        } else {
            $this->gebruiker_model->update($gebruiker);
        }
        
        echo $id;
    }
    
    public function delete() {       
        $id = $this->input->post('id');
        
        $this->load->model('gebruiker_model');
        $deleted = $this->gebruiker_model->delete($id);
        
        echo $deleted;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

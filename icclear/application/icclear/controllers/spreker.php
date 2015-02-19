<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Spreker extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->helper('form');
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - Sprekers'; 
        $data['active'] = 'spreker';
        
        $this->load->model('gebruiker_model');
        $data['sprekers'] = $this->gebruiker_model->getSprekersActieve();
                
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'spreker/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data); 
    }
    public function voorstel() {
        
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - Sprekers'; 
        $data['active'] = 'spreker';       
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'spreker/voorstel', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data); 
        
    }
    
    public function indienen()
    {
        $this->load->model('conferentie_model');
        $gebruiker = $this->authex->getUserInfo();
        $conferentie = $this->conferentie_model->getActieveConferentie();
        
        $sessie = new stdClass();
        $sessie->onderwerp = $this->input->post('sessieonderwerp');
        $sessie->omschrijving = $this->input->post('sessieomschrijving');
        $sessie->datumIngediend = date('Y-m-d');
        $sessie->isGoedgekeurd = '0';
        $sessie->gebruikerIdSpreker = $gebruiker->id;
        $sessie->conferentieId = $conferentie->id;    

        $this->load->model('sessies_model');
        $this->sessies_model->insert($sessie);
        
        redirect('spreker');
    }
        
    public function biografie($id, $key)
    {
        $data['user'] = $this->authex->getUserInfo();        
        
        $data['title'] = 'IC Clear - Biografie';
        $data['active'] = 'spreker';
         
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $this->load->model('gebruiker_model');
        $spreker = $this->gebruiker_model->get($id);
        $data['spreker'] = $spreker;
        
        if ($id == $spreker->id && $key == $spreker->generatedKey) {
            $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'spreker/biografie', 'footer' => 'main_footer');
        }
        else
        {
            
        }
        $this->template->load('main_master', $partials, $data);    
    }
    
    public function updateBiografie()
    {
        $data['user'] = $this->authex->getUserInfo();        
        
        $data['title'] = 'IC Clear - Biografie';
        $data['active'] = 'spreker';
        
        $id = $this->session->userdata('user_id');
        $biografie = $this->input->post("biografie");
        
        $this->load->model('gebruiker_model');
        $spreker = $this->gebruiker_model->get($id);
        
        $spreker->biografie = $biografie;
        
        $this->gebruiker_model->update($spreker);
        
        redirect('profiel/instellingen');
    }
  
    
}

?>
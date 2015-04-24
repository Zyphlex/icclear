<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inschrijven extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->helper('form');
    }

    public function index() {
         $user  = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['conferentieId'] = $this->session->userdata('conferentieId');        
        $this->load->model('inschrijving_model');
        $data['inschrijving'] = $this->inschrijving_model->getInschijvingByGebruiker($user->id);
              
        $data['title'] = 'IC Clear - Inschrijven'; 
        $data['active'] = 'inschrijven';
        
        $this->load->model('onderdeel_model');
        $data['conferentieOnderdelen'] = $this->onderdeel_model->getOnderdelenPerConferentie();
        
        $this->load->model('activiteit_model');
        $data['activiteiten'] = $this->activiteit_model->getActiviteitenPerConferentie();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'inschrijving/inschrijving', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data); 
    }
    
    public function verzenden() {
        
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - Inschrijven'; 
        $data['active'] = 'home';
                
        $this->load->model('conferentie_model');
        $conf = $this->conferentie_model->getActieveConferentie();
        
        $userId = $this->authex->getUserInfo();
        $betId = 0;
        if ($this->input->post('methode') != 4)
        {
            $betaling->gebruikerId = $userId->id;        
            $this->load->model('betaling_model');
            $betId = $this->betaling_model->insert($betaling);
        }               
             
        $inschrijving->gebruikerId = $userId->id;
        $inschrijving->conferentieId = $conf->id;
        $inschrijving->conferentieOnderdeelId = $this->input->post('conferentieOnderdeelId');
        $inschrijving->datum = date("Y-m-d");
        $inschrijving->methodeId = $this->input->post('methode');
        if ($betId != 0)
        {
            $inschrijving->betalingId = $betId;
        }       
        
        $this->load->model('inschrijving_model');
        $this->inschrijving_model->insert($inschrijving);
        
        $teller = 1;
        
        $act = $this->input->post('aanwezig');
        foreach ($act as $a)
        {
                $activiteit->activiteitId = $a;
                $activiteit->gebruikerId = $userId->id;
                if ($betId != 0)
                {
                    $activiteit->betalingId = $betId;
                }
                
                $activiteit->aantalPersonen = $this->input->post($a);
                $indexP++;
                
                $this->load->model('gebruiker_activiteit_model');
                $actId = $this->gebruiker_activiteit_model->insert($activiteit);
        }         
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        redirect('home');
    }
    
    public function opvolgen(){
        
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - Beheer'; 
        $data['active'] = 'admin';
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        $this->load->model('gebruiker_model');
        $data['gebruikers'] = $this->gebruiker_model->getAll();   
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/inschrijving/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function overzicht(){
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        $this->load->model('inschrijving_model');
        $data['inschrijvingen'] = $this->inschrijving_model->getAllInschijvingByConferentie($data['conferentieId']);       
        
        $this->load->model('gebruiker_activiteit_model');
        $data['gebactiviteiten'] = $this->gebruiker_activiteit_model->getActiviteitPrijs(); 
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $this->load->model('gebruiker_activiteit_model');
        foreach ($data['inschrijvingen'] as $i)
        {
            $confId = $data['conferentieId'];
            $diff = (abs(strtotime($i->conferentie->beginDatum) - strtotime($i->datum)))/86400; 
            if ($diff >= 30)
            {
                $confprijs = $i->confonderdeel->prijs - (($i->confonderdeel->prijs / 100) * $i->confonderdeel->korting);
            } else {
                $confprijs = $i->confonderdeel->prijs;
            }
            
            $i->geld += $this->gebruiker_activiteit_model->getPrijsByConfGebruiker($i->gebruikerId, $confId) + $confprijs;
        }
        
        $this->load->view('admin/inschrijving/lijst', $data);
    }
    
    public function detail() {
        $id = $this->input->get('id');

        $data;

        echo json_encode($data);
    }
    
}

?>
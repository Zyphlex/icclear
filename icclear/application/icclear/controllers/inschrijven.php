<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inschrijven extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->helper('form');
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();        
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
            //$betId = $this->betaling_model->insert($betaling);
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
        //$this->inschrijving_model->insert($inschrijving);
        
        $teller = 1;
        
        $act = $this->input->post('aanwezig');
        $maxP = $this->input->post('aantalPersonen');
        $indexP = 0;
        foreach ($act as $a)
        {
                $activiteit->activiteitId = $a;
                $activiteit->gebruikerId = $userId->id;
                if ($betId != 0)
                {
                    $activiteit->betalingId = $betId;
                }
                if ($maxP[$indexP] != "")
                {
                    $activiteit->aantalPersonen = $maxP[$indexP];
                }
                
                $activiteit->aantalPersonen = $maxP[array_search($a, $act)];
                $indexP++;
                
                $this->load->model('gebruiker_activiteit_model');
                //$actId = $this->gebruiker_activiteit_model->insert($activiteit);
        }
        print_r($this->input->post($a));
        print_r($act);
         
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        //redirect('home');
    }
    
    public function opvolgen(){
        
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - Beheer'; 
        $data['active'] = 'admin';
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');

        $this->load->model('inschrijving_model');
        $data['inschrijvingen'] = $this->inschrijving_model->getAllInschijvingByConferentie($data['conferentieId']);       
        
        $this->load->model('gebruiker_activiteit_model');
        $data['gebactiviteiten'] = $this->gebruiker_activiteit_model->getActiviteitPrijs(); 
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/inschrijving/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
  
    
}

?>
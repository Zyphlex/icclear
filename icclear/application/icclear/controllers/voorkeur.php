<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Voorkeur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));      
    }
   
    public function doorgeven() {
        $user = $this->authex->getUserInfo();
        
        $gebruikerId = $user->id;
        $ids = array();
        $ids = $this->input->post('gekozensessies');
                        
        $this->load->model('voorkeur_model');
        
        foreach ($ids as $i){
            $voorkeur  = new stdClass();
            $voorkeur->sessieId = $i;
            $voorkeur->gebruikerId = $gebruikerId;
            $this->voorkeur_model->insert($voorkeur);
        }
        
        redirect('home');
       
    }
    
}

 
 

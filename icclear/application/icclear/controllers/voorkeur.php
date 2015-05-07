<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Voorkeur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        if (!$this->authex->loggedIn()) {
            redirect('logon/aanmelden');
        }
    }
   
    public function doorgeven() {
        $user = $this->authex->getUserInfo();
        
        $gebruikerId = $user->id;
        $ids = array();
        $ids = $this->input->post('sessie');
        
        echo print_r($ids);
        
        $this->load->model('sessies_model');
        
        foreach ($ids as $i){
            $sessie  = new stdClass();
            $sessie->sessieId = $i;
            $sessie->gebruikerId = $gebruikerId;
            $this->sessies_model->insert($sessie);
        }
       
    }
    
}

 
 

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
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $this->load->model('gebruiker_model');
        $data['sprekers'] = $this->gebruiker_model->getSprekersActieve();
                
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'spreker/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data); 
    }
    public function voorstel() {
        
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - Sprekers'; 
        $data['active'] = 'programma';       
        
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
        
        $this->load->model('gebruiker_model');
        $spreker = $this->gebruiker_model->get($id);
        
        // biografie
        $biografie = $this->input->post("biografie");
        
        // foto
        $config['upload_path'] = base_url() . 'application/upload/';
        $config['allowed_types'] = 'jpg';
        $config['file_name'] = 'spreker' . $spreker->id . '.png';
        $config['max_size'] = 200;
        $config['max_height'] = 500;
        $config['max_width'] = 500;
        
        $this->load->library('upload', $config);
         /*if(!is_dir($config['upload_path'])){
                    mkdir($config['upload_path'],0777,TRUE);
                }*/
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
		}
                
        $spreker->biografie = $biografie;
        $spreker->foto = $config['file_name'];
        
        $this->gebruiker_model->update($spreker);
        
        redirect('profiel/instellingen');
    }
  
    
}

?>
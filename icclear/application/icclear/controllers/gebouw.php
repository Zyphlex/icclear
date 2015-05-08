<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gebouw extends CI_Controller {

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

        $data['title'] = 'IC Clear - Gebouw';
        $data['active'] = 'admin';

        $this->load->model('gebouw_model');
        $data['gebouwen'] = $this->gebouw_model->getAll();
        
        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();
        
        //Actieve conferentie ophalen
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebouw/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function overzicht() {
        $this->load->model('gebouw_model');
        $data['gebouwen'] = $this->gebouw_model->getAll();

        $this->load->view('admin/gebouw/lijst', $data);
    }

    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('gebouw_model');
        $gebouw = $this->gebouw_model->get($id);

        echo json_encode($gebouw);
    }

    public function update() {
        $gebouw->id = $this->input->post('id');
        $gebouw->naam = $this->input->post('naam');
        $gebouw->postcode = $this->input->post('postcode');
        $gebouw->gemeente = $this->input->post('gemeente');
        $gebouw->straat = $this->input->post('straat');
        $gebouw->nummer = $this->input->post('nummer');
        $gebouw->landId = $this->input->post('land');

        
        // foto
        $config['upload_path'] = './application/upload/fotos/gebouwen';
        $config['allowed_types'] = 'jpg';
        $config['file_name'] = 'gebouw' . $gebouw->id . '.jpg';
        $config['max_size'] = 200;
        $config['max_height'] = 700;
        $config['max_width'] = 1280;
        $config['overwrite'] = true;

        // Map aanmaken als deze nog niet bestaat
        if (!is_dir($config['upload_path'])) { 
            mkdir($config['upload_path'], 0777, TRUE);
        }

        // Uploaden
        $this->load->library('upload', $config);
        
        $this->upload->initialize($config);
        $fieldname = 'userfile';
        
        if (!$this->upload->do_upload($fieldname)) {
            $error = array('error' => $this->upload->display_errors());
            echo print_r($config);
            echo print_r($error);
            echo realpath($config['upload_path']);
        }

        $gebouw->foto = $config['file_name'];

        // gebouw toevoegen als het nog niet bestaat, anders updaten
        $this->load->model('gebouw_model');
        if ($gebouw->id == 0) {
            $id = $this->gebouw_model->insert($gebouw);
        } else {
            $this->gebouw_model->update($gebouw);
        }

        redirect('gebouw');
    }

    public function delete() {
        $id = $this->input->post('id');

        $this->load->model('gebouw_model');
        $deleted = $this->gebouw_model->delete($id);

        echo $deleted;
    }

    //Elke datum van een conferentie tonen met het bijbehorende gebouw
    public function gebouwPerDag($conferentieId) {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;

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
        $data['title'] = 'IC Clear - Gebouwen';
        $data['active'] = 'admin';

        $data['conferentieId'] = $conferentieId;

        //Alle conferentiedagen van een conferentie
        $this->load->model('conferentie_model');
        $conferentie = $this->conferentie_model->get($conferentieId);
        $data['conferentie'] = $conferentie;

        $this->load->model('conferentiedag_model');
        $data['conferentiedagen'] = $this->conferentiedag_model->getFromConferentie($conferentie->id);

        //Alle gebouwen die in hetzelfde land als de concerentie gelegen zijn
        $this->load->model('gebouw_model');
        $data['gebouwen'] = $this->gebouw_model->getPerLand($conferentie->landId);

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebouwConferentie/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function gebouwPerDagOpslaan() {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        $conferentieId = $this->session->userdata('conferentieId');
        $this->load->model('inschrijving_model');
        $data['title'] = 'IC Clear - Gebouwen';
        $data['active'] = 'admin';

        $this->load->model('conferentiedag_model');

        //Aantal records dat wordt bewerkt
        $aantal = $this->input->post('aantal');
        for ($i = 1; $i <= $aantal; $i++) {
            $conferentiedag->id = $this->input->post('id' . $i);
            $conferentiedag->gebouwId = $this->input->post('gebouw' . $i);

            $this->conferentiedag_model->update($conferentiedag);
        }

        //Naar dashboard van juiste conferentie gaan
        $id = $this->input->post('conferentieId');
        redirect('admin/dashboard/' . $id);
    }

}

/* End of file gebouw.php  */
/* Location: ./application/controllers/gebouw.php */

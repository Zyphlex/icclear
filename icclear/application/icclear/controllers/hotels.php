<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotels extends CI_Controller {

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

        $data['title'] = 'IC Clear - Hotel';
        $data['active'] = 'admin';

        $this->load->model('hotel_model');
        $data['hotels'] = $this->hotel_model->getAll();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/hotels/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function overzicht() {
        $this->load->model('hotel_model');
        $data['hotels'] = $this->hotel_model->getAll();

        $this->load->view('admin/hotels/lijst', $data);
    }

    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('hotel_model');
        $hotel = $this->hotel_model->get($id);

        echo json_encode($hotel);
    }

    public function update() {
        $hotel->id = $this->input->post('id');
        $hotel->naam = $this->input->post('naam');
        $hotel->website = $this->input->post('website');
        $hotel->straat = $this->input->post('straat');
        $hotel->nummer = $this->input->post('nummer');
        $hotel->gemeente = $this->input->post('gemeente');
        $hotel->postcode = $this->input->post('postcode');

        $this->load->model('hotel_model');
        if ($hotel->id == 0) {
            $id = $this->hotel_model->insert($hotel);
        } else {
            $this->hotel_model->update($hotel);
        }

        echo $id;
    }

    public function delete() {
        $id = $this->input->post('id');

        $this->load->model('hotel_model');
        $deleted = $this->hotel_model->delete($id);

        echo $deleted;
    }

    // TEST
}

 
 

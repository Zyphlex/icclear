<?php

class Conferentie_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    // alle conferenties ophalen
    function getAll() {
        $this->db->order_by('beginDatum');
        $query = $this->db->get('conferentie');
        return $query->result();
    }

    // Een conferentie ophalen
    function getById() {
        $query = $this->db->get('conferentie');
        return $query->result();
    }

    // Een conferentie ophalen met het bijbehorende land
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('conferentie');
        $conferentie = $query->row();

        $this->load->model('land_model');
        $conferentie->land = $this->land_model->get($conferentie->landId);

        return $conferentie;
    }

    // De actieve conferentie ophalen met het bijbehorend land
    function getActieveConferentie() {
        $this->db->where('statusId', '2');
        $query = $this->db->get('conferentie');
        $conferentie = $query->row();

        $this->load->model('land_model');
        $conferentie->land = $this->land_model->get($conferentie->landId);
        
        return $conferentie;
    }

    // Alle conferenties van het verleden ophalen met de bijbehorende landen
    function getVerledenConferentie() {
        $this->db->where('statusId', '1');
        $query = $this->db->get('conferentie');
        $conferenties = $query->result();
        
        $this->load->model('land_model');
        
        foreach ($conferenties as $conferentie) {
            $conferentie->land = $this->land_model->get($conferentie->landId);
        }
        
        return $conferenties;
    }

    // Alle toekomstige conferenties ophalen let bijbehorende landen
    function getToekomstConferentie() {
        $this->db->where('statusId', '3');
        $query = $this->db->get('conferentie');
        $conferenties = $query->result();
        
        $this->load->model('land_model');
        
        foreach ($conferenties as $conferentie) {
            $conferentie->land = $this->land_model->get($conferentie->landId);
        }
        
        return $conferenties;
    }

    // Een conferentie updaten
    function update($conferentie) {
        //Html entities en extra spaties verwijderen
        $conferentie = escape_html($conferentie);

        $this->db->where('id', $conferentie->id);
        $this->db->update('conferentie', $conferentie);
    }

    // Nieuwe conferentie toevoegen
    function insert($conferentie) {
        //Html entities en extra spaties verwijderen
        $conferentie = escape_html($conferentie);

        $this->db->insert('conferentie', $conferentie);
        return $this->db->insert_id();
    }

}

?>
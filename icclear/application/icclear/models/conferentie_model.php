<?php

class Conferentie_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function getAll() {
        $this->db->order_by('beginDatum');
        $query = $this->db->get('conferentie');
        return $query->result();
    }

    function getById() {
        $query = $this->db->get('conferentie');
        return $query->result();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('conferentie');
        $conferentie = $query->row();

        $this->load->model('land_model');
        $conferentie->land = $this->land_model->get($conferentie->landId);

        return $conferentie;
    }

    function getActieveConferentie() {
        $this->db->where('statusId', '2');
        $query = $this->db->get('conferentie');
        $conferentie = $query->row();

        $this->load->model('land_model');
        $conferentie->land = $this->land_model->get($conferentie->landId);
        
        return $conferentie;
    }

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

    function update($conferentie) {
        //Html entities en extra spaties verwijderen
        $conferentie = escape_html($conferentie);

        $this->db->where('id', $conferentie->id);
        $this->db->update('conferentie', $conferentie);
    }

    function insert($conferentie) {
        //Html entities en extra spaties verwijderen
        $conferentie = escape_html($conferentie);

        $this->db->insert('conferentie', $conferentie);
        return $this->db->insert_id();
    }

}

?>
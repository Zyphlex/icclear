<?php

class Conferentiedag_model extends CI_Model {


    function __construct() {
        parent::__construct();
    }

    // Alle conferentiedagen ophalen
    function getAll() {
        $this->db->order_by('datum');
        $query = $this->db->get('conferentiedag');
        return $query->result();
    }

    // Een conferentiedag ophalen
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('conferentiedag');
        return $query->row();
    }
    
    // Alle conferentiedagen van eenzelfde conferentie ophalen
    function getFromConferentie($conferentieId) {
        $this->db->where('conferentieId', $conferentieId);
        $query = $this->db->get('conferentiedag');
        return $query->result();
    }
    
    // Voor elke conferentiedag het gebouw zoeken dat eraan is toegewezen
    function getGebouwenByDag(){
        $query = $this->db->get('conferentiedag');
        $dagen = $query->result();

        $this->load->model('gebouw_model');
        
        foreach ($dagen as $dag) {
            $dag->gebouw = $this->gebouw_model->get($dag->gebouwId);
        }

        return $dagen;
    }
    
    // Een nieuwe conferentiedag toevoegen
    function insert($conferentiedag)
    {
        $this->db->insert('conferentiedag', $conferentiedag);
        return $this->db->insert_id();
    }
    
    // Een conferentiedag verwijderen
    function update($conferentiedag)
    {        
        $this->db->where('id', $conferentiedag->id);
        $this->db->update('conferentiedag', $conferentiedag);
    }

}

?>
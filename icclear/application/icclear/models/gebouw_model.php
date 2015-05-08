<?php

class Gebouw_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Alle gebouwen ophalen
    function getAll() {
        $query = $this->db->get('gebouw');
        return $query->result();
    }

    // Een gebouw ophalen
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('gebouw');
        return $query->row();
    }

    // Voor elke dag van de actieve conferentie het bijbehorend gebouw ophalen
    function getGebouwenConferentie() {
        $this->load->model('conferentie_model');
        $conferentie = $this->conferentie_model->getActieveConferentie();

        $this->db->where('conferentieId', $conferentie->id);
        $this->db->order_by('gebouwId', 'asc');
        $query = $this->db->get('conferentiedag');
        $dagen = $query->result();

        foreach ($dagen as $dag) {
            $dag->gebouw = $this->get($dag->gebouwId);
        }

        return $dagen;
    }

    // Een gebouw updaten
    function update($gebouw) {
        //Html entities en extra spaties verwijderen
        $gebouw = escape_html($gebouw);
        
        $this->db->where('id', $gebouw->id);
        $this->db->update('gebouw', $gebouw);
    }

    // Nieuw gebouw toevoegen
    function insert($gebouw) {
        //Html entities en extra spaties verwijderen
        $gebouw = escape_html($gebouw);
        
        $this->db->insert('gebouw', $gebouw);
        return $this->db->insert_id();
    }

    // Een gebouw verwijderen
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('gebouw');
    }

    // Alle gebouwen van eenzelfde land ophalen
    function getPerLand($landId) {
        $this->db->where('landId', $landId);
        $query = $this->db->get('gebouw');
        return $query->result();    
    }  
    
    // Voor elke dag van een conferentie info over het gebouw en alle zalen ervan ophalen 
    function getPerLandGebruikt($id) {        
        $this->load->model('zaal_model');
        $this->load->model('conferentiedag_model');
        $dagen = $this->conferentiedag_model->getFromConferentie($id);
        
        foreach ($dagen as $d) { 
            $d->gebouw = $this->get($d->gebouwId);
            $d->zalen = $this->zaal_model->getAllPerGebouw($d->gebouw->id);
        }        
        
        return $dagen;
    }

}

?>
<?php

class Betaling_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('betaling');
        return $query->row();
    }
    
    
    function insert($betaling)
    {
        $betaling = escape_html($betaling);
        //html entities en spaties verwijderen
        
        $this->db->insert('betaling', $betaling);
        return $this->db->insert_id();
    }
    
    function getPrijsByGebruiker($id){
        $this->db->where('id', $id);
        $query = $this->db->get('betaling');
        $betaling = $query->row();        
        $this->load->model('gebruiker_activiteit_model');
        $geld = $this->gebruiker_activiteit_model->getPrijsByGebruiker($betaling->gebruikerId);        
        return $geld;
    }
    
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('betaling');
    }
    
}

?>
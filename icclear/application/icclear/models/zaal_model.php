<?php

class Zaal_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    // Een bepaalde zaal ophalen m.b.v. een id
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('zaal');
        return $query->row();
    }
    
    // Alle zalen met het bijbehorende gebouw ophalen
    function getGebouw() {
        $query = $this->db->get('zaal');
        $zalen = $query->result();

        $this->load->model('gebouw_model');


        foreach ($zalen as $zaal) {
            $zaal->gebouw = $this->gebouw_model->get($zaal->gebouwId);            
        }
        return $zalen;
    }
    
    // Alle zalen ophalen
    function getAll() {
        $query = $this->db->get('zaal');
        return $query->result();
    }
    
    // Alle zalen van eenzelfde gebouw ophalen
    function getAllPerGebouw($id) {
        $this->db->where('gebouwId', $id);
        $query = $this->db->get('zaal');
        return $query->result();
    }
    
    // Een bestaande zaal updaten
    function update($zaal)
    {
        //Html entities en extra spaties verwijderen
        $zaal = escape_html($zaal);
        
        $this->db->where('id', $zaal->id);
        $this->db->update('zaal', $zaal);
    }
    
    // Een nieuwe zaal toevoegen
    function insert($zaal)
    {
        //Html entities en extra spaties verwijderen
        $zaal = escape_html($zaal);
        
        $this->db->insert('zaal', $zaal);
        return $this->db->insert_id();
    }
    
    // Een zaal verwijderen
     function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('zaal');
    }

}
?>

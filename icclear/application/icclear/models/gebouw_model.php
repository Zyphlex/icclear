<?php

class Gebouw_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

       
    function getAll()
    {        
        $query = $this->db->get('gebouw');
        return $query->result();
    }
    
    function get($id)
    {        
        $this->db->where('id', $id);
        $query = $this->db->get('gebouw');
        return $query->row();
    }
        
    function getGebouwenConferentie()
    {
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
            
    function update($gebouw)
    {
        //Html entities en extra spaties verwijderen
        $gebouw = escape_html($gebouw);
        
        $this->db->where('id', $gebouw->id);
        $this->db->update('gebouw', $gebouw);
    }
    
    function insert($gebouw)
    {
        //Html entities en extra spaties verwijderen
        $gebouw = escape_html($gebouw);
        
        $this->db->insert('gebouw', $gebouw);
        return $this->db->insert_id();
    }
    
     function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('gebouw');
    }
    
    
}

?>
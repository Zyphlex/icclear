<?php

class Gebouw_model extends CI_Model {

    // +----------------------------------------------------------
    // | Beershop - product_model
    // +----------------------------------------------------------
    // | Thomas More Kempen - 2 TI - 201x-201x
    // +----------------------------------------------------------
    // | Product model
    // |
    // +----------------------------------------------------------
    // | K. Vangeel
    // +----------------------------------------------------------

    function __construct()
    {
        parent::__construct();
    }

       
    function getGebouwen()
    {        
        $query = $this->db->get('gebouw');
        return $query->result();
    }
    
    function getGebouw($id)
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
            $dag->gebouw = $this->getGebouw($dag->gebouwId);
        }
        
        return $dagen;
    }
    
    function update($gebouw)
    {
        $this->db->where('id', $gebouw->id);
        $this->db->update('gebouw', $gebouw);
    }
    
    function insert($gebouw)
    {
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
<?php

class Routes_model extends CI_Model {

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
      
    // Alle routes met bijbehorende gebouwen ophalen
    function getRoutes()
    {        
        $query = $this->db->get('route');
        $routes = $query->result();  
        
        $this->load->model('gebouw_model');   
        foreach ($routes as $route) {
            $route->gebouw = $this->gebouw_model->get($route->gebouwId);
        }
        
        return $routes;
    }
    
    // Een route met bijbehorend gebouw ophalen
    function getRoute($id)
    {        
        $this->db->where('id', $id);
        $query = $this->db->get('route');        
        $route = $query->row();
        
        $this->load->model('gebouw_model');  
        $route->gebouw = $this->gebouw_model->get($route->gebouwId);
            
        return $route;
    }
    
    // Alle routes ophalen van de actieve conferentie, van elke conferentiedag (want 1 gebouw per dag)
    function getRoutesConferentie()
    {
        $this->load->model('conferentie_model');        
        $conferentie = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('conferentieId', $conferentie->id);
        $query = $this->db->get('conferentiedag');   
        $routes = $query->result();
        
        foreach ($routes as $route) {
            $route->route = $this->getRoute($route->routeId);
        }
                                
        return $routes;
    }    
    
    // Alle routes ophalen die bij een gebouw horen, samen met de info van dit gebouw
    function getRoutesGebouw($gebouwId) {              
        $this->db->where('gebouwId', $gebouwId); 
        $query = $this->db->get('route');   
        $routes = $query->result();  
        
        $this->load->model('gebouw_model');   
        foreach ($routes as $route) {
            $route->gebouw = $this->gebouw_model->get($route->gebouwId);
        }
                        
        return $routes;
    }
    
    // Een route updaten
    function update($route) {
        //Html entities en extra spaties verwijderen
        $route = escape_html($route);
        
        $this->db->where('id', $route->id);
        $this->db->update('route', $route);
    }

    // Een route verwijderen
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('route');
    }
    
    // Een nieuwe route toevoegen
    function insert($route)
    {
        //Html entities en extra spaties verwijderen
        $route = escape_html($route);
        
        $this->db->insert('route', $route);
        return $this->db->insert_id();
    }
}

?>
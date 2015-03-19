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
    
    function getRoute($id)
    {        
        $this->db->where('id', $id);
        $query = $this->db->get('route');        
        $route = $query->row();
        
        $this->load->model('gebouw_model');  
        $route->gebouw = $this->gebouw_model->get($route->gebouwId);
            
        return $route;
    }
    
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
    
    function update($route) {
        $this->db->where('id', $route->id);
        $this->db->update('route', $route);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('route');
    }
    
    function insert($route)
    {
        $this->db->insert('route', $route);
        return $this->db->insert_id();
    }
}

?>
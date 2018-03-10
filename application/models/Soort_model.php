<?php

class Soort_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getSoort($id){
        //Geef de soort van de gebruiker afhankelijk van zijn id
        $this->db->order_by('id', 'asc');
        $this->db->where('id', $id);
        $query = $this->db->get('soort');
        return $query->row();
    }
}
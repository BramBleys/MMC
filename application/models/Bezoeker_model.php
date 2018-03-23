<?php

class Bezoeker_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getInhoud($paginaId){
        $this->db->order_by('naam', 'ASC');
        $this->db->where('paginaId', $paginaId);
        $query = $this->db->get('Inhoud');

        return $query->result();
    }
}


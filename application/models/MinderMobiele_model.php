<?php

    class MinderMobiele_model extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        function getNaam($minderMobieleId){
            $this->db->where('id', $minderMobieleId);
            $query = $this->db->get('gebruiker');
            return $query->row();
        }
    }
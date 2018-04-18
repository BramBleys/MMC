<?php


    class beschikbaarheid_model extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        function getBeschikbaarheid($gebruikerId){
            $this->db->where('gebruikerId',$gebruikerId);
            $query = $this->db->get('vrijwilliger');
            return $query->result();
        }
    }
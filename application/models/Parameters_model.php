<?php
    class Parameters_model extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        function update($parameters) {
            $this->db->update('parameters', $parameters);
        }

        function get(){
            $query = $this->db->get('Parameters');
            return $query->row();
        }
    }

?>

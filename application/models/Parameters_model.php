<?php
    class Parameters_model extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        function update($parameters) {
            $this->db->update('parameters', $parameters);
        }

    }

?>

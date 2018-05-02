<?php

/**
 * @Class Parameters_model
 * @brief Model-klasse voor parameters
 *
 * Model-klasse die alle methodes bevat om te
 * interageren et de database-tabel parameters
 */
    class Parameters_model extends CI_Model {

        /**
         * Constructor
         */
        function __construct() {
            parent::__construct();
        }

        /**
         * Retourneert een parameter object uit de tabel parameters
         * @return de opgevraagde records
         */
        function get(){
            $query = $this->db->get('parameters');
            return $query->row();
        }

        /**
         * Past alle records aan in de tabel parameters
         * @param $parameters zijn de parameters naar waar de tabel wordt aangepast
         */
        function update($parameters) {
            $this->db->update('parameters', $parameters);
        }


    }

?>

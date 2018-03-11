<?php

    class gebruiker_model extends CI_Model {
        function update($gegevens) {
            //update de gegevens van de gebruiker waar je aanpassingen voor hebt gedaan
            $this->db->where('id',$gegevens->id);
            $this->db->update('gebruiker', $gegevens);
        }
    }
<?php

    class Gebruiker_model extends CI_Model {
        function update($gegevens) {
            //update de gegevens van de gebruiker waar je aanpassingen voor hebt gedaan
            $this->db->where('id', $gegevens->id);
            $this->db->update('gebruiker', $gegevens);
        }

        function get($id) {
            // geef gebruiker-object met opgegeven id
            $this->db->where('id', $id);
            $query = $this->db->get('gebruiker');
            return $query->row();
        }

        function getGebruikerLogin($gebruikersnaam, $wachtwoord) {
            // geef gebruiker-object met gebruikersnaam en wachtwoord
            $this->db->where('gebruikersnaam', $gebruikersnaam);
            $query = $this->db->get('gebruiker');

            if ($query->num_rows() == 1) {
                $gebruiker = $query->row();
                // controleren of het wachtwoord overeenkomt
                if (password_verify($wachtwoord, $gebruiker->wachtwoord)) {
                    return $gebruiker;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }

        function getGebruikerWithSoort($id) {
            //geef gebruiker-object met soort door opgegeven id
            $this->db->order_by('id', 'asc');
            $query = $this->db->where('id', $id);
            $gebruiker = $query->row();

            $this->load->model('soort_model');
            $gebruiker->soort = $this->soort_model->getSoort($gebruiker->id);

            return $gebruiker;
        }

        function getAllGebruikers() {
            // geef alle gebruiker-objecten
            $this->db->order_by('soortId', 'asc');
            $query = $this->db->get('gebruiker');
            return $query->result();
        }

        function getAllGebruikersWithSoort($soortId) {
            // geef alle gebruiker-objecten met soort
            $this->db->where('soortId',$soortId);
            $query = $this->db->get('gebruiker');
            $gebruikers = $query->result();

            $this->load->model('soort_model');
            foreach ($gebruikers as $gebruiker) {
                $gebruiker->soort = $this->soort_model->getSoort($gebruiker->soortId);
            }

            return $gebruikers;
        }
        
        function getGebruiker($gebruikerId){
            $this->db->where('id', $gebruikerId);
            $query = $this->db->get('gebruiker');
            $gebruiker = $query->row();
            return $gebruiker;
        }

        function getGebruikerWhereCoach($coachId){
            $this->load->model('coach_model');
            $gebruikerIds = $this->coach_model->getGebruikerWhereCoach($coachId);
            $gebruikers = array();
            $this->load->model('gebruiker_model');
            foreach ($gebruikerIds as $gebruikerId){
                $gebruikers[] = $this->gebruiker_model->get($gebruikerId->gebruikerIdMinderMobiele);
            }
            return $gebruikers;
        }
    }
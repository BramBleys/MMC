<?php

    /**
     * @class Gebruiker_model
     * @brief Model-klasse voor de gebruiker
     *
     * Model-klasse die alle methodes bevat om te interageren met de database-tabel gebruiker
     */
    class Gebruiker_model extends CI_Model {

        function insert($gegevens) {
            //voeg een nieuwe gebruiker toe
            $this->db->insert('gebruiker', $gegevens);
            return $this->db->insert_id();
        }

        function update($gegevens) {
            //update de gegevens van de gebruiker waar je aanpassingen voor hebt gedaan
            $this->db->where('id', $gegevens->id);
            $this->db->update('gebruiker', $gegevens);
        }

        /**
         * Retourneert een gebruiker object met gebruikerId = $id
         *
         * @param $id De id van de gebruiker waar we informatie over nodig hebben
         * @return Een gebruiker object
         */
        function get($id) {
            // geef gebruiker-object met opgegeven id
            $this->db->where('id', $id);
            $query = $this->db->get('gebruiker');

            return $query->row();
        }

        /**
         * Retourneert een gebruiker object met gebruikerId = $minderMobieleId
         * @param $minderMobieleId De id van de gebruiker waar we informatie over nodig hebben
         * @return Een gebruiker object
         */
        function getNaam($minderMobieleId){
            $this->db->where('id', $minderMobieleId);
            $query = $this->db->get('gebruiker');
            return $query->row();
        }

        /**
         * Retourneert een gebruiker object als het opgegeven wachtwoord en de opgegeven gebruikersnaam overeen komen met de database. Indien dit niet het geval is dan retourneert het null
         * @param $gebruikersnaam De ingegeven gebruikersnaam
         * @param $wachtwoord Het ingegeven wachtwoord
         * @return null of gebruiker object
         */
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
            $this->db->where('soortId', $soortId);
            $query = $this->db->get('gebruiker');
            $gebruikers = $query->result();

            $this->load->model('soort_model');
            foreach ($gebruikers as $gebruiker) {
                $gebruiker->soort = $this->soort_model->getSoort($gebruiker->soortId);
            }

            return $gebruikers;
        }

        /**
         * Retourneert een gebruiker object met id = $gebruikerId
         *
         * @param $gebruikerId De id van de gebruiker waar we informatie over nodig hebben
         * @return Een gebruiker object
         */
        function getGebruiker($gebruikerId) {
            $this->db->where('id', $gebruikerId);
            $query = $this->db->get('gebruiker');
            $gebruiker = $query->row();
            return $gebruiker;
        }

        /**
         * Retourneert een object van gebruiker-records met coach = $coachId
         *
         * @param $coachId De id van de coach waar we de gebruikers van nodig hebben
         * @see Coach_model::getGebruikerWhereCoach()
         * @see Gebruiker_model::get()
         * @return Array object met gebruiker-records
         */
        function getGebruikerWhereCoach($coachId) {
            $this->load->model('coach_model');
            $gebruikerIds = $this->coach_model->getGebruikerWhereCoach($coachId);
            $gebruikers = array();
            $this->load->model('gebruiker_model');
            foreach ($gebruikerIds as $gebruikerId) {
                $gebruikers[] = $this->gebruiker_model->get($gebruikerId->gebruikerIdMinderMobiele);
            }
            return $gebruikers;
        }

        function getHighestMmcNummer() {
            $this->db->select_max('mmcNummer');
            $query = $this->db->get('gebruiker');

            return $query->row();
        }

        function controleerErkenningsNummerVrij($nummer) {
            $this->db->where('erkenningsNummer', $nummer);
            $query = $this->db->get('gebruiker');

            if ($query->num_rows() == 0) {
                return true;
            } else {
                return false;
            }
        }

        function controleerGebruikersNaamVrij($naam) {
            $this->db->where('gebruikersnaam', $naam);
            $query = $this->db->get('gebruiker');

            if ($query->num_rows() == 0) {
                return true;
            } else {
                return false;
            }
        }
    }
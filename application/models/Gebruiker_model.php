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
        
        function getGebruiker($gebruikerId){
            $this->db->where('id', $gebruikerId);
            $query = $this->db->get('gebruiker');
            $gebruiker = $query->row();
            return $gebruiker;
        }

        function getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatum($gebruikerId)
        {
            // geef gebruiker-object met opgegeven $id met de geplande ritten
            $nu = date('Y-m-d H:i:s');
            $this->db->order_by('vertrekTijdstip');
            $this->db->where('gebruikerIdMinderMobiele', $gebruikerId);
            $this->db->where('vertrekTijdstip >', $nu);
            $query = $this->db->get('rit');
            $ritten = $query->result();

            foreach ($ritten as $rit){
                $rit->chauffeur = $this->MinderMobiele_model->getGebruiker($rit->gebruikerIdVrijwilliger);
                $rit->vertrekAdres = $this->MinderMobiele_model->getAdres($rit->adresIdVertrek);
                $rit->bestemmingAdres = $this->MinderMobiele_model->getAdres($rit->adresIdBestemming);
            }
            return $ritten;
        }

        function getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatumOuder($gebruikerId)
        {
            // geef gebruiker-object met opgegeven $id met de geplande ritten
            $nu = date('Y-m-d H:i:s');
            $this->db->order_by('vertrekTijdstip');
            $this->db->where('gebruikerIdMinderMobiele', $gebruikerId);
            $this->db->where('vertrekTijdstip <', $nu);
            $query = $this->db->get('Rit');
            $ritten = $query->result();

            foreach ($ritten as $rit){
                $rit->chauffeur = $this->MinderMobiele_model->getGebruiker($rit->gebruikerIdVrijwilliger);
                $rit->vertrekAdres = $this->MinderMobiele_model->getAdres($rit->adresIdVertrek);
                $rit->bestemmingAdres = $this->MinderMobiele_model->getAdres($rit->adresIdBestemming);
            }
            return $ritten;
        }
    }
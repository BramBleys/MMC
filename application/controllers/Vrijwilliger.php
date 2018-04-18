<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Vrijwilliger extends CI_Controller {
        public function __construct() {
            parent::__construct();
        }

        public function beschikbaarheidIngeven() {
            //titel veranderen naar Parameters
            $data['titel'] = 'Beschikbaarheid ingeven';
            //Login nakijken
            $gebruiker = $this->authex->getGebruikerInfo();
            $data['gebruiker'] = $gebruiker;

            //Beschikbaarheid van de gebruiker ophalen
            $this->load->model('beschikbaarheid_model');
            $data['beschikbaarheid'] = $this->beschikbaarheid_model->getBeschikbaarheid($gebruiker->id);

            //Templates definieren en inladen
            $partials = array('navigatie' => 'main_menu', 'inhoud' => 'vrijwilliger/beschikbaarheidIngeven');
            $this->template->load('main_master', $partials, $data);
        }

        public function agendaBekijken() {
            $data['titel'] = "Agenda bekijken";

            $gebruiker = $this->authex->getGebruikerInfo();
            $data['gebruiker'] = $gebruiker;

            //Laad rit_model en geef alle ritten voor de aangemelde vrijwilliger
            $this->load->model('rit_model');
            $ritten = $this->rit_model->getAllRitten($gebruiker->id);

            //Laad MinderMobiele_model en Adres_model
            $this->load->model('MinderMobiele_model');
            $this->load->model('adres_model');

            //Doorloop alle ritten
            for ($i = 0; $i < count($ritten); $i++) {
                //Maak een nieuw object aan
                $nieuweRitten[$i] = new stdClass();

                //Zet naam en voornaam in het nieuwe object
                $naam = $this->MinderMobiele_model->getNaam($ritten[$i]->gebruikerIdMinderMobiele);
                $nieuweRitten[$i]->voornaam = $naam->voornaam;
                $nieuweRitten[$i]->naam = $naam->naam;

                //Zet datum en tijd in correct formaat in het nieuwe object
                $datum = strtotime($ritten[$i]->vertrekTijdstip);
                $nieuweRitten[$i]->datum = date('d/m/Y',$datum);
                $nieuweRitten[$i]->vertrekTijdstip = date('H:i',$datum);

                //Haal vertrek adres op uit adres_model met adresId van de rit en zet het in het nieuwe object
                $vertrekAdres = $this->adres_model->getAdres($ritten[$i]->adresIdVertrek);
                $nieuweRitten[$i]->vertrekAdres = $vertrekAdres->straatEnNummer . ' ' . $vertrekAdres->gemeente;

                //Haal bestemming op uit adres_model met adresId van de rit en zet het in het nieuwe object
                $bestemming = $this->adres_model->getAdres($ritten[$i]->adresIdBestemming);
                $nieuweRitten[$i]->bestemming = $bestemming->straatEnNummer . ' ' . $vertrekAdres->gemeente;

                //Voeg suuplmentaire kost, heenrit en opmerking toe aan nieuwe object
                $nieuweRitten[$i]->supplementaireKost = $ritten[$i]->supplementaireKost;
                $nieuweRitten[$i]->heenrit = $ritten[$i]->ritIdHeenrit;
                $nieuweRitten[$i]->opmerking = $ritten[$i]->opmerking;
            }

            $data['ritten'] = $nieuweRitten;
            $partials = array('navigatie' => 'main_menu', 'inhoud' => 'vrijwilliger/agendaBekijken');
            $this->template->load('main_master', $partials, $data);
        }
    }
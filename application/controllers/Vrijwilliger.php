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
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            //Templates definieren en inladen
            $partials = array('navigatie' => 'main_menu', 'inhoud' => 'vrijwilliger/beschikbaarheidIngeven');
            $this->template->load('main_master', $partials, $data);
        }

        public function agendaBekijken() {
            $data['titel'] = "Agenda bekijken";

            $gebruiker = $this->authex->getGebruikerInfo();
            $data['gebruiker'] = $gebruiker;

            $this->load->model('rit_model');
            $ritten = $this->rit_model->getAllRitten($gebruiker->id);

            $this->load->model('MinderMobiele_model');
            $this->load->model('adres_model');
            for ($i = 0; $i < count($ritten); $i++) {
                $nieuweRitten[$i] = new stdClass();

                $naam = $this->MinderMobiele_model->getNaam($ritten[$i]->gebruikerIdMinderMobiele);
                $nieuweRitten[$i]->voornaam = $naam->voornaam;
                $nieuweRitten[$i]->naam = $naam->naam;

                $datum = strtotime($ritten[$i]->vertrekTijdstip);
                $nieuweRitten[$i]->datum = date('d/m/Y',$datum);
                $nieuweRitten[$i]->vertrekTijdstip = date('H:i',$datum);

                $vertrekAdres = $this->adres_model->getAdres($ritten[$i]->adresIdVertrek);
                $nieuweRitten[$i]->vertrekAdres = $vertrekAdres->straatEnNummer . ' ' . $vertrekAdres->gemeente;

                $bestemming = $this->adres_model->getAdres($ritten[$i]->adresIdBestemming);
                $nieuweRitten[$i]->bestemming = $bestemming->straatEnNummer . ' ' . $vertrekAdres->gemeente;

                $nieuweRitten[$i]->supplementaireKost = $ritten[$i]->supplementaireKost;
                $nieuweRitten[$i]->heenrit = $ritten[$i]->ritIdHeenrit;
                $nieuweRitten[$i]->opmerking = $ritten[$i]->opmerking;
            }

            $data['ritten'] = $nieuweRitten;


            $partials = array('navigatie' => 'main_menu', 'inhoud' => 'vrijwilliger/agendaBekijken');
            $this->template->load('main_master', $partials, $data);
        }
    }
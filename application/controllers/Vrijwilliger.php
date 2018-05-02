<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    /**
     * @class Vrijwilliger
     * @brief Controller-klasse voor Vrijwilliger
     *
     * Controller-klasse met alle methodes die gebruikt worden voor de Vrijwilliger
     */
    class Vrijwilliger extends CI_Controller {
        /**
         * Constructor
         */
        public function __construct() {
            parent::__construct();
        }

        /**
         * Haalt de beschikbaarheid op met gebruikerId = $gebruiker->id via Vrijwilliger_model en toont het resulterende object in de view beschikbaarheidIngeven.php
         *
         * @see Vrijwilliger_model::getBeschikbaarheid()
         * @see beschikbaarheidIngeven.php
         */
        public function beschikbaarheidIngeven() {
            //titel veranderen naar Beschikbaarheid ingeven
            $data['titel'] = 'Beschikbaarheid ingeven';
            //Login nakijken
            $gebruiker = $this->authex->getGebruikerInfo();
            $data['gebruiker'] = $gebruiker;
            $data['gemaaktDoor'] = "Bram Bleys";

            //Beschikbaarheid van de gebruiker ophalen
            $this->load->model('vrijwilliger_model');
            $data['beschikbaarheid'] = $this->vrijwilliger_model->getBeschikbaarheid($gebruiker->id);

            //Templates definieren en inladen
            $partials = array('navigatie' => 'main_menu', 'inhoud' => 'vrijwilliger/beschikbaarheidIngeven');
            $this->template->load('main_master', $partials, $data);
        }

        /**
         * Haalt alle ritten op met gebruikerId = $gebruiker->id via Rit_model. Maakt een nieuw object met de naam van de gebruiker, de correcte datums, de correcte adressen en bijkomende kosten via MinderMobiele_model en Adres_model. Dit object wordt getoond in de view agendaBekijken.php
         *
         * @see Rit_model::getAllRitten()
         * @see MinderMobiele_model::getNaam()
         * @see Adres_model::getAdres()
         * @see agendaBekijken.php
         */
        public function agendaBekijken() {
            $data['titel'] = "Agenda bekijken";

            $gebruiker = $this->authex->getGebruikerInfo();
            $data['gebruiker'] = $gebruiker;
            $data['gemaaktDoor'] = "Bram Bleys";


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
                $nieuweRitten[$i]->datum = date('d/m/Y', $datum);
                $nieuweRitten[$i]->vertrekTijdstip = date('H:i', $datum);

                //Haal vertrek adres op uit adres_model met adresId van de rit en zet het in het nieuwe object
                $vertrekAdres = $this->adres_model->getAdres($ritten[$i]->adresIdVertrek);
                $nieuweRitten[$i]->vertrekAdres = $vertrekAdres->straatEnNummer . ' ' . $vertrekAdres->gemeente;

                //Haal bestemming op uit adres_model met adresId van de rit en zet het in het nieuwe object
                $bestemming = $this->adres_model->getAdres($ritten[$i]->adresIdBestemming);
                $nieuweRitten[$i]->bestemming = $bestemming->straatEnNummer . ' ' . $vertrekAdres->gemeente;

                //Voeg suplementaire kost, heenrit en opmerking toe aan nieuwe object
                $nieuweRitten[$i]->supplementaireKost = $ritten[$i]->supplementaireKost;
                $nieuweRitten[$i]->heenrit = $ritten[$i]->ritIdHeenrit;
                $nieuweRitten[$i]->opmerking = $ritten[$i]->opmerking;
            }

            $data['ritten'] = $nieuweRitten;
            $partials = array('navigatie' => 'main_menu', 'inhoud' => 'vrijwilliger/agendaBekijken');
            $this->template->load('main_master', $partials, $data);
        }

        /**
         * Haalt de beschikbaarheid op voor een week met startDatum = $week_start en eindDatum = $week_einde voor de gebruiker met gebruikerId = $gebruikerId via Vrijwilliger_model en geeft het object door naar de ajax functie in beschikbaarheidIngeven.php
         * @see Vrijwilliger_model::getBeschikbaarheidWhereStartDatumEnEindDatum()
         */
        public function haalJsonOp_Datums() {
            $week = $this->input->get('week');
            $jaar = $this->input->get('jaar');
            $gebruikerId = $this->input->get('id');

            $week_start = new DateTime();
            $week_start->setISODate($jaar, $week);
            $week_start = $week_start->format('Y-m-d');
            $week_einde = date('Y-m-d', strtotime($week_start . ' + 6 days'));

            $this->load->model('vrijwilliger_model');
            $datums = $this->vrijwilliger_model->getBeschikbaarheidWhereStartDatumEnEindDatum($gebruikerId, $week_start, $week_einde);

            echo json_encode($datums);
        }

        /**
         * Haalt de begin- en einddatum met weeknummer = $week en een jaar = $jaar op en geeft het object door naar de ajax functie in beschikbaarheidIngeven.php
         */
        public function haalDatumsOp() {
            $week = $this->input->get('week');
            $jaar = $this->input->get('jaar');

            $week_start = new DateTime();
            $week_start->setISODate($jaar, $week);
            $week_start = $week_start->format('Y-m-d');
            $week_einde = date('Y-m-d', strtotime($week_start . ' + 6 days'));

            $weekStartEnEinde[0] = $week_start;
            $weekStartEnEinde[1] = $week_einde;

            echo json_encode($weekStartEnEinde);
        }

        /**
         * Schrijft nieuwe uren weg naar de database met gebruikerId = $gebruikerId, dag = $beginWeek, startUur = $startUur en eindUur = $einUur via Vrijwilliger_model
         * @see Vrijwilliger_model::schrijfNieuweUrenWeg()
         */
        public function schrijfNieuweUrenWeg() {
            $beginWeek = $this->input->get('beginWeek');
            $dagNummer = $this->input->get('dagNummer');
            $startUur = $this->input->get('startUur');
            $eindUur = $this->input->get('eindUur');
            $gebruikerId = $this->input->get('id');

            switch ($dagNummer) {
                case "0":
                    $dag = $beginWeek;
                    break;
                case "1":
                    $dag = date('Y-m-d', strtotime($beginWeek . ' + 1 days'));
                    break;
                case "2":
                    $dag = date('Y-m-d', strtotime($beginWeek . ' + 2 days'));
                    break;
                case "3":
                    $dag = date('Y-m-d', strtotime($beginWeek . ' + 3 days'));
                    break;
                case "4":
                    $dag = date('Y-m-d', strtotime($beginWeek . ' + 4 days'));
                    break;
                case "5":
                    $dag = date('Y-m-d', strtotime($beginWeek . ' + 5 days'));
                    break;
                case "6":
                    $dag = date('Y-m-d', strtotime($beginWeek . ' + 6 days'));
                    break;
            }

            $this->load->model('vrijwilliger_model');
            $this->vrijwilliger_model->schrijfNieuweUrenWeg($gebruikerId, $dag, $startUur, $eindUur);
        }
    }
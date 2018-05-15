<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    /**
     * @class Coach
     * @brief Controller-klasse voor Coach
     *
     * Controller-klasse met alle methodes die gebruikt worden voor de Coach
     */
    class Coach extends CI_Controller {

        /**
         * Constructor
         */
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('notation_helper');
        }

        /**
         * Haalt de gebruikers die de aangemelde gebruiker (coach) beheert op
         * via Gebruiker_model, en toont de view minderMobielen.php
         *
         * @see Gebruiker_model::getGebruikerWhereCoach()
         * @see minderMobielen.php
         */
        public function index() {
            $data['titel'] = 'Overzicht personen';
            $data['gemaaktDoor'] = "Dylan Vernelen Ebert";
            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            if($this->session->has_userdata('gebruiker_id')){
                $gebruikerId = $this->session->userdata('gebruiker_id');

                $this->load->model('gebruiker_model');
                $data['minderMobielen'] = $this->gebruiker_model->getGebruikerWhereCoach($gebruikerId);

                $partials = array('navigatie' => 'main_menu',
                    'inhoud' => 'coach/minderMobielen');
                $this->template->load('main_master', $partials, $data);
            } else {
                redirect('Home');
            }
        }

        /**
         * Haalt de gebruikers die de aangemelde gebruiker (coach) beheert op
         * via Gebruiker_model, haalt de gekozen gebruiker op met id=$accountId
         * via Gebruiker_model, en toont de resulterende objecten in de view rittenBeheren.php
         *
         * @param $accountId De id van het gebruiker-record dat getoond wordt, geef 'a' mee om het eerste record van de beheerde gebruikers te nemen
         * @see Gebruiker_model::getGebruikerWhereCoach()
         * @see Gebruiker_model::get()
         * @see rittenBeheren.php
         */
        public function rittenBeheren($accountId) {
            $data['titel'] = 'De geplande ritten';
            $data['gemaaktDoor'] = "Dylan Vernelen Ebert";
            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            if($this->session->has_userdata('gebruiker_id')) {
                $gebruikerId = $this->session->userdata('gebruiker_id');

                $this->load->model('gebruiker_model');
                $data['minderMobielen'] = $this->gebruiker_model->getGebruikerWhereCoach($gebruikerId);
                if($accountId!='a'){
                    $data['gekozenAccount'] = $this->gebruiker_model->get($accountId);
                } else{
                    if($data['minderMobielen']){
                        $data['gekozenAccount'] = $data['minderMobielen'][0];
                    } else {
                        $gekozenAccount = new stdClass();
                        $gekozenAccount->id="";
                        $gekozenAccount->naam="";
                        $gekozenAccount->voornaam="";
                        $data['gekozenAccount'] = $gekozenAccount;
                    }
                }

                $partials = array('navigatie' => 'main_menu',
                    'inhoud' => 'coach/rittenBeheren');
                $this->template->load('main_master', $partials, $data);
            } else {
                redirect('Home');
            }
        }

        /**
         * Haalt de gebruikersgegevens van de opgehaalde gebruiker op
         * via Gebruiker_model, haalt de geplande ritten van de opgehaalde gebruiker (en aangevuld met gebruiker- en adresgegevens) op
         * via Rit_model, haalt het parameter record op via Parameter_model en toont de resulterende objecten in de view ajax_geplandeRitten.php
         *
         * @see Gebruiker_model::get()
         * @see Parameters_model::get()
         * @see Rit_model::getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatum()
         * @see ajax_geplandeRitten.php
         */
        public function haalAjaxOp_GeplandeRitten() {
            $accountId = $this->input->get('accountId');

            $this->load->model('Gebruiker_model');
            $data['account'] = $this->Gebruiker_model->get($accountId);

            $this->load->model('rit_model');
            $data['ritten'] = $this->rit_model->getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatum($accountId);
            $this->load->model('Parameters_model');
            $parameters = $this->Parameters_model->get();
            $data['parameters'] = $parameters;

            $this->load->view("coach/ajax_geplandeRitten", $data);
        }

        /**
         * Haalt de gebruikers die de aangemelde gebruiker (coach) beheert op
         * via Gebruiker_model, haalt de gekozen gebruiker op met id=$accountId
         * via Gebruiker_model, en toont de resulterende objecten in de view afgelopenRittenCoach.php
         *
         * @param $accountId De id van het gebruiker-record dat getoond wordt, geef 'a' mee om het eerste record van de beheerde gebruikers te nemen
         * @see Gebruiker_model::getGebruikerWhereCoach()
         * @see Gebruiker_model::get()
         * @see afgelopenRittenCoach.php
         */
        public function afgelopenRitten($accountId) {
            $data['titel'] = 'De afgelopen ritten';
            $data['gemaaktDoor'] = "Dylan Vernelen Ebert";

            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            if($this->session->has_userdata('gebruiker_id')){
                $gebruikerId = $this->session->userdata('gebruiker_id');

                $this->load->model('gebruiker_model');
                $data['minderMobielen'] = $this->gebruiker_model->getGebruikerWhereCoach($gebruikerId);
                if($accountId!='a'){
                    $data['gekozenAccount'] = $this->gebruiker_model->get($accountId);
                } else{
                    if($data['minderMobielen']){
                        $data['gekozenAccount'] = $data['minderMobielen'][0];
                    } else {
                        $gekozenAccount = new stdClass();
                        $gekozenAccount->id="";
                        $gekozenAccount->naam="";
                        $gekozenAccount->voornaam="";
                        $data['gekozenAccount'] = $gekozenAccount;
                    }
                }

                $partials = array('navigatie' => 'main_menu',
                    'inhoud' => 'coach/afgelopenRittenCoach');
                $this->template->load('main_master', $partials, $data);
            } else {
                redirect('Home');
            }
        }

        /**
         * Haalt de gebruikersgegevens van de opgehaalde gebruiker op
         * via Gebruiker_model, haalt de agelopen ritten van de opgehaalde gebruiker (en aangevuld met gebruiker- en adresgegevens) op
         * via Rit_model, haalt het parameter record op via Parameter_model en toont de resulterende objecten in de view ajax_afgelopenRitten.php
         *
         * @see Gebruiker_model::get()
         * @see Parameters_model::get()
         * @see Rit_model::getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatumOuder()
         * @see ajax_afgelopenRitten.php
         */
        public function haalAjaxOp_AfgelopenRitten() {
            $accountId = $this->input->get('accountId');

            $this->load->model('Gebruiker_model');
            $data['account'] = $this->Gebruiker_model->get($accountId);

            $this->load->model('rit_model');
            $data['ritten'] = $this->rit_model->getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatumOuder($accountId);
            $this->load->model('Parameters_model');
            $parameters = $this->Parameters_model->get();
            $data['parameters'] = $parameters;

            $this->load->view("coach/ajax_afgelopenRitten", $data);
        }

        /**
         * Haalt de gebruikers die de aangemelde gebruiker (coach) beheert op
         * via Gebruiker_model, haalt de gekozen gebruiker op met id=$accountId
         * via Gebruiker_model, haalt het parameter record op via Parameter_model en toont de resulterende objecten in de view nieuweRitCoach.php
         *
         * @param $accountId De id van het gebruiker-record dat getoond wordt, geef 'a' mee om het eerste record van de beheerde gebruikers te nemen
         * @see Gebruiker_model::getGebruikerWhereCoach()
         * @see Gebruiker_model::get()
         * @see Parameters_model::get()
         * @see nieuweRitCoach.php
         */
        public function nieuweRit($accountId) {
            $data['titel'] = 'Rit aanvragen';
            $data['gemaaktDoor'] = "Dylan Vernelen Ebert";

            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            if($this->session->has_userdata('gebruiker_id')){
                $gebruikerId = $this->session->userdata('gebruiker_id');

                $this->load->model('gebruiker_model');
                $data['minderMobielen'] = $this->gebruiker_model->getGebruikerWhereCoach($gebruikerId);
                if($accountId!='a'){
                    $data['gekozenAccount'] = $this->gebruiker_model->get($accountId);
                } else{
                    if($data['minderMobielen']){
                        $data['gekozenAccount'] = $data['minderMobielen'][0];
                    } else {
                        $gekozenAccount = new stdClass();
                        $gekozenAccount->id="";
                        $gekozenAccount->naam="";
                        $gekozenAccount->voornaam="";
                        $data['gekozenAccount'] = $gekozenAccount;
                    }
                }
                $this->load->model('Parameters_model');
                $parameters = $this->Parameters_model->get();
                $data['parameters'] = $parameters;
                $partials = array( 'navigatie' => 'main_menu',
                    'inhoud' => 'coach/nieuweRitCoach');
                $this->template->load('main_master', $partials, $data);
            } else {
                redirect('Home');
            }
        }

        /**
         * Haalt de gebruikergegevens van het opgehaalde account op
         * via Gebruiker_model, haalt het parameter record op
         * via Parameter_model, haalt de ritten, uit de opgehaalde week, op
         * via Rit_model, haalt het id van het opgehaalde adres op
         * via Adres_model, haalt alle gegevens op van de gesubmitte pagina, voegt indien nodig de opgehaalde adressen toe
         * via Adres_model, voegt de opgehaalde ritgegevens toe
         * via Rit_model en wordt doorverwezen naar de geplande ritten van het opgehaalde account
         *
         * @see Gebruiker_model::getGebruiker()
         * @see Parameters_model::get()
         * @see Rit_model::getWhereDatum()
         * @see Adres_model::getIdWhereStraatEnGemeenteEnPostcode()
         * @see Adres_model::insert()
         * @see Rit_model::insert()
         * @see Coach::rittenBeheren()
         */
        public function ritToevoegen()
        {
            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            $this->load->model('gebruiker_model');
            $accountId = $this->input->post('gekozenAccountId');
            $minderMobiele = $this->gebruiker_model->getGebruiker($accountId);
            if ($this->session->has_userdata('gebruiker_id')) {
                $this->load->model('Parameters_model');
                $parameters = $this->Parameters_model->get();
                $this->load->model('Rit_model');
                $datum = $this->input->post('datum');
                if (!$parameters->maxRitten - count($this->Rit_model->getWhereDatum($minderMobiele->id, $datum)) <= 0) {
                    $rit = new stdClass();
                    $rit->gebruikerIdMinderMobiele = $minderMobiele->id;
                    $adres = new stdClass();
                    if ($this->input->post('vertrekPlaats') != "" && $this->input->post('vertrekPlaats') != NULL) {
                        $adres->straatEnNummer = $this->input->post('vertrekAdres');
                        $adres->gemeente = $this->input->post('vertrekGemeente');
                        $adres->postcode = $this->input->post('vertrekPostcode');
                    } else {
                        $adres->straatEnNummer = $minderMobiele->straatEnNummer;
                        $adres->gemeente = $minderMobiele->gemeente;
                        $adres->postcode = $minderMobiele->postcode;
                    }
                    $this->load->model('adres_model');
                    $adresId = $this->adres_model->getIdWhereStraatEnGemeenteEnPostcode($adres);
                    if ($adresId) {
                        $rit->adresIdVertrek = $adresId;
                    } else {
                        $rit->adresIdVertrek = $this->adres_model->insert($adres);
                    }
                    $adres->straatEnNummer = $this->input->post('aankomstAdres');
                    $adres->gemeente = $this->input->post('aankomstGemeente');
                    $adres->postcode = $this->input->post('aankomstPostcode');
                    $adresId = $this->adres_model->getIdWhereStraatEnGemeenteEnPostcode($adres);
                    if ($adresId) {
                        $rit->adresIdBestemming = $adresId;
                    } else {
                        $rit->adresIdBestemming = $this->adres_model->insert($adres);
                    }
                    $datum = $this->input->post('datum');
                    $uur = $this->input->post('uur');
                    $rit->vertrekTijdstip = $datum . ' ' . $uur . ':00';
                    $rit->opmerking = ($this->input->post('opmerkingen') == '' || $this->input->post('opmerkingen') == ' ' ? NULL : $this->input->post('opmerkingen'));
                    $this->load->model('rit_model');
                    $heenRitId = $this->rit_model->insert($rit);
                    if ($this->input->post('terugRit') != "" && $this->input->post('terugRit') != NULL) {
                        $terugRit = new stdClass();
                        $terugRit->gebruikerIdMinderMobiele = $minderMobiele->id;
                        $terugRit->adresIdVertrek = $rit->adresIdBestemming;
                        $terugRit->adresIdBestemming = $rit->adresIdVertrek;
                        $datum = $this->input->post('datumTerug');
                        $uur = $this->input->post('uurTerug');
                        $terugRit->vertrekTijdstip = $datum . ' ' . $uur . ':00';
                        $terugRit->opmerking = ($this->input->post('opmerkingenTerug') == '' || $this->input->post('opmerkingenTerug') == ' ' ? NULL : $this->input->post('opmerkingenTerug'));
                        $terugRit->ritIdHeenrit = $heenRitId;
                        $terugRitId = $this->rit_model->insert($terugRit);
                    }
                }
                redirect('coach/rittenBeheren/' . $accountId);
            } else {
                redirect('Home');
            }
        }

        /**
         * Haalt het gebruiker-record met id=$accountId op
         * via Gebruiker_model, haalt de gebruikers die de aangemelde gebruiker (coach) beheert op
         * via Gebruiker_model, haalt de gekozen gebruiker op met id=$accountId
         * via Gebruiker_model, haalt het rit-record op met id=$id en indien aanwezig de terugrit met ritIdHeenrit=$id (en aangevuld met adresgegevens) op
         * via Rit_model, haalt het parameter record op
         * via Parameter_model en toont de objecten in de view wijzigRitCoach.php
         *
         * @param $id De id van het rit-record dat getoond wordt
         * @param $accountId De id van het gekozen account
         * @see Gebruiker_model::getGebruiker()
         * @see Gebruiker_model::getGebruikerWhereCoach()
         * @see Gebruiker_model::get()
         * @see Rit_model::get()
         * @see Rit_model::getByHeenRit()
         * @see Adres_model::getAdres()
         * @see Parameters_model::get()
         * @see wijzigRitCoach.php
         */
        public function wijzigRit($accountId, $id){

            $data['titel'] = 'Rit wijzigen';
            $data['gemaaktDoor'] = "Dylan Vernelen Ebert";

            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            $minderMobiele = $this->gebruiker_model->getGebruiker($accountId);
            if($this->session->has_userdata('gebruiker_id')){
                $gebruikerId = $this->session->userdata('gebruiker_id');
                $this->load->model('rit_model');
                $rit = $this->rit_model->get($id);
                if ($rit->ritIdHeenrit){
                    $heenRit = $this->rit_model->get($rit->ritIdHeenrit);
                    $heenRit->terugRit = $rit;
                } else {
                    $heenRit = $rit;
                    if ($this->rit_model->getByHeenRit($heenRit->id)) {
                        $heenRit->terugRit = $this->rit_model->getByHeenRit($heenRit->id);
                    } else {
                        $heenRit->terugRit = new stdClass();
                        $heenRit->terugRit->id = "";
                        $heenRit->terugRit->vertrekTijdstip = "";
                        $heenRit->terugRit->opmerking = "";
                    }
                }
                $this->load->model('adres_model');
                $adres = $this->adres_model->getAdres($heenRit->adresIdVertrek);
                $heenRit->adres = $adres;
                $bestemming = $this->adres_model->getAdres($heenRit->adresIdBestemming);
                $heenRit->bestemming = $bestemming;
                $data['heenrit'] = $heenRit;
                if($minderMobiele->straatEnNummer==$adres->straatEnNummer && $minderMobiele->postcode==$adres->postcode && $minderMobiele->gemeente==$adres->gemeente){
                    $data['vertrekThuis'] = true;
                } else {
                    $data['vertrekThuis'] = false;
                }

                $this->load->model('gebruiker_model');
                $data['minderMobielen'] = $this->gebruiker_model->getGebruikerWhereCoach($gebruikerId);
                if($accountId!='a'){
                    $data['gekozenAccount'] = $this->gebruiker_model->get($accountId);
                } else{
                    if($data['minderMobielen']){
                        $data['gekozenAccount'] = $data['minderMobielen'][0];
                    } else {
                        $gekozenAccount = new stdClass();
                        $gekozenAccount->id="";
                        $gekozenAccount->naam="";
                        $gekozenAccount->voornaam="";
                        $data['gekozenAccount'] = $gekozenAccount;
                    }
                }

                $this->load->model('Parameters_model');
                $parameters = $this->Parameters_model->get();
                $data['parameters'] = $parameters;
                $partials = array( 'navigatie' => 'main_menu',
                    'inhoud' => 'coach/wijzigRitCoach');
                $this->template->load('main_master', $partials, $data);
            } else {
                redirect('Home');
            }
        }

        /**
         * Haalt de gebruikergegevens van het opgehaalde account op
         * via Gebruiker_model, haalt het parameter record op
         * via Parameter_model, haalt de ritten, uit de opgehaalde week, op
         * via Rit_model, haalt het id van het opgehaalde adres op
         * via Adres_model, verwijdert de opgehaalde rit en zijn terugrit
         * via Rit_model, haalt alle gegevens op van de gesubmitte pagina, voegt indien nodig de opgehaalde adressen toe
         * via Adres_model, voegt de opgehaalde ritgegevens toe
         * via Rit_model en wordt doorverwezen naar de geplande ritten van het opgehaalde account
         *
         * @see Gebruiker_model::getGebruiker()
         * @see Parameters_model::get()
         * @see Rit_model::getWhereDatum()
         * @see Adres_model::getIdWhereStraatEnGemeenteEnPostcode()
         * @see Adres_model::insert()
         * @see Rit_model::insert()
         * @see Coach::rittenBeheren()
         */
        public function wijzigingOpslaan(){
            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            $this->load->model('gebruiker_model');
            $accountId = $this->input->post('gekozenAccountId');
            $minderMobiele = $this->gebruiker_model->getGebruiker($accountId);
            if($this->session->has_userdata('gebruiker_id')){
                $this->load->model('Parameters_model');
                $parameters = $this->Parameters_model->get();
                $this->load->model('Rit_model');
                $datum = $this->input->post('datum');
                if(!$parameters->maxRitten - count($this->Rit_model->getWhereDatum($minderMobiele->id, $datum)) <= 0){

                    $oudeId = $this->input->post('heenritId');
                    $oudeTerugRitId = $this->input->post('terugRitId');
                    $this->load->model('rit_model');
                    $this->rit_model->delete($oudeId);
                    $this->rit_model->delete($oudeTerugRitId);
                    $rit = new stdClass();
                    $rit->gebruikerIdMinderMobiele = $minderMobiele->id;
                    $adres = new stdClass();
                    if($this->input->post('vertrekPlaats')!="" && $this->input->post('vertrekPlaats')!=NULL){
                        $adres->straatEnNummer = $this->input->post('vertrekAdres');
                        $adres->gemeente = $this->input->post('vertrekGemeente');
                        $adres->postcode = $this->input->post('vertrekPostcode');
                    } else{
                        $adres->straatEnNummer = $minderMobiele->straatEnNummer;
                        $adres->gemeente = $minderMobiele->gemeente;
                        $adres->postcode = $minderMobiele->postcode;
                    }
                    $this->load->model('adres_model');
                    $adresId = $this->adres_model->getIdWhereStraatEnGemeenteEnPostcode($adres);
                    if($adresId){
                        $rit->adresIdVertrek = $adresId;
                    } else {
                        $rit->adresIdVertrek = $this->adres_model->insert($adres);
                    }
                    $adres->straatEnNummer = $this->input->post('aankomstAdres');
                    $adres->gemeente = $this->input->post('aankomstGemeente');
                    $adres->postcode = $this->input->post('aankomstPostcode');
                    $adresId = $this->adres_model->getIdWhereStraatEnGemeenteEnPostcode($adres);
                    if($adresId){
                        $rit->adresIdBestemming = $adresId;
                    } else {
                        $rit->adresIdBestemming = $this->adres_model->insert($adres);
                    }
                    $datum = $this->input->post('datum');
                    $uur = $this->input->post('uur');
                    $rit->vertrekTijdstip = $datum . ' ' . $uur . ':00';
                    $rit->opmerking = ($this->input->post('opmerkingen') == '' || $this->input->post('opmerkingen') == ' ' ? NULL : $this->input->post('opmerkingen'));
                    $this->load->model('rit_model');
                    $heenRitId = $this->rit_model->insert($rit);
                    if ($this->input->post('terugRit')!="" && $this->input->post('terugRit')!=NULL){
                        $terugRit = new stdClass();
                        $terugRit->gebruikerIdMinderMobiele = $minderMobiele->id;
                        $terugRit->adresIdVertrek = $rit->adresIdBestemming;
                        $terugRit->adresIdBestemming = $rit->adresIdVertrek;
                        $datum = $this->input->post('datumTerug');
                        $uur = $this->input->post('uurTerug');
                        $terugRit->vertrekTijdstip = $datum . ' ' . $uur . ':00';
                        $terugRit->opmerking = ($this->input->post('opmerkingenTerug') == '' || $this->input->post('opmerkingenTerug') == ' ' ? NULL : $this->input->post('opmerkingenTerug'));
                        $terugRit->ritIdHeenrit = $heenRitId;
                        $terugRitId = $this->rit_model->insert($terugRit);
                    }
                }
                redirect('coach/rittenBeheren/' . $accountId);
            } else {
                redirect('Home');
            }
        }

        /**
         * Verwijdert het rit-record op met id=$ritId en indien aanwezig de terugrit met ritIdHeenrit=$ritId
         * via Rit_model en wordt doorverwezen naar de geplande ritten van het account met id=$accountId
         *
         * @param $ritId De id van het rit-record dat verwijdert wordt met zijn terugrit
         * @param $accountId De id van het account waarvan de geplande ritten worden getoond op de doorverwezen pagina
         * @see Rit_model::getByHeenRit()
         * @see Rit_model::delete()
         * @see Coach::rittenBeheren()
         */
        public function schrap($accountId, $ritId){
            $this->load->model('rit_model');
            if ($this->rit_model->getByHeenRit($ritId)){
                $terugRit = $this->rit_model->getByHeenRit($ritId);
                $this->rit_model->delete($terugRit->id);
            }
            $this->rit_model->delete($ritId);
            redirect('coach/rittenBeheren/' . $accountId);
        }

        /**
         * Haalt de gebruikers die de aangemelde gebruiker (coach) beheert op
         * via Gebruiker_model, haalt de gekozen gebruiker op met id=$accountId
         * via Gebruiker_model, en toont de resulterende objecten in de view accountsBeheren.php
         *
         * @param $accountId De id van het gebruiker-record dat getoond wordt, geef 'a' mee om het eerste record van de beheerde gebruikers te nemen
         * @see Gebruiker_model::getGebruikerWhereCoach()
         * @see Gebruiker_model::get()
         * @see accountsBeheren.php
         */
        public function accountsBeheren($accountId) {
            $data['titel'] = 'Persoonlijke gegevens aanpassen';
            $data['gemaaktDoor'] = "Dylan Vernelen Ebert";
            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            if($this->session->has_userdata('gebruiker_id')) {
                $gebruikerId = $this->session->userdata('gebruiker_id');

                $this->load->model('gebruiker_model');
                $data['minderMobielen'] = $this->gebruiker_model->getGebruikerWhereCoach($gebruikerId);
                $data['gekozenAccount'] = $this->gebruiker_model->get($accountId);

                $partials = array('navigatie' => 'main_menu',
                    'inhoud' => 'coach/accountsBeheren');
                $this->template->load('main_master', $partials, $data);
            } else {
                redirect('Home');
            }
        }

        /**
         * Haalt alle gegevens op van de gesubmitte pagina, wijzigt het record via Gebruiker_model
         * en wordt doorverwezen naar het overzicht van de minder mobielen die de coach beheert
         *
         * @see Gebruiker_model::update()
         * @see Coach::index()
         */
        public function accountGegevensOpslaan() {
            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            $data['gemaaktDoor'] = "Dylan Vernelen Ebert";
            if($this->session->has_userdata('gebruiker_id')) {
                $gegevens = new stdClass();
                $gegevens->id = $this->input->post('getoondAccountId');
                $gegevens->voornaam = $this->input->post('voornaam');
                $gegevens->naam = $this->input->post('naam');
                $gegevens->telefoonnummer = $this->input->post('telefoonnummer');
                $gegevens->email = $this->input->post('email');
                $gegevens->gemeente = $this->input->post('gemeente');
                $gegevens->postcode = $this->input->post('postcode');
                $gegevens->straatEnNummer = $this->input->post('straatEnNummer');

                $contactvorm = $this->input->post('contactvorm');
                if($contactvorm === "leeg"){
                    $contactvorm = NULL;
                }
                $gegevens->contactvorm = $contactvorm;

                $this->load->model('gebruiker_model');
                $this->gebruiker_model->update($gegevens);

                redirect('coach');
            } else {
                redirect('Home');
            }
        }

        /**
         * Haalt de gebruikergegevens van de opgehaalde gebruiker op via Gebruiker_model
         * en toont het resulterende object in de view ajax_account.php
         *
         * @see Gebruiker_model::get()
         * @see ajax_account.php
         */
        public function haalAjaxOp_Gebruiker() {
            $accountId = $this->input->get('accountId');

            $this->load->model('Gebruiker_model');
            $data['account'] = $this->Gebruiker_model->get($accountId);

            $this->load->view("coach/ajax_account", $data);
        }
    }
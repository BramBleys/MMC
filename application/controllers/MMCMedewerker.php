<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MMCMedewerker extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Template');
        $this->load->helper('form');
        $this->load->helper('notation_helper');
    }

    public function gebruikersBeheren($soort) {
        $data['titel'] = 'Gebruikers beheren';
        $data['gemaaktDoor'] = 'Christophe Van Hoof';

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')){
            $this->load->model('Gebruiker_model');
            $data['gebruikers'] = $this->Gebruiker_model->getAllGebruikers();

            $data['soortId'] = $soort;

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'MMCMedewerker/gebruikersBeheren');
            $this->template->load('main_master', $partials, $data);
        } else {
            redirect('Home');
        }
    }

    public function haalAjaxOp_Gebruikers() {
        $soort = $this->input->get('soortId');
        $data['soortId'] = $soort;

        $this->load->model('Gebruiker_model');
        $data['gebruikers'] = $this->Gebruiker_model->getAllGebruikers();

        $this->load->view("MMCMedewerker/ajax_gebruikers", $data);
    }

    public function gebruikerToevoegen() {
        $data['titel'] = "Gebruiker toevoegen";
        $data['gemaaktDoor'] = 'Christophe Van Hoof';

        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        if($this->session->has_userdata('gebruiker_id')) {

            $this->load->model('Gebruiker_model');
            $data['hoogsteNummer'] = $this->Gebruiker_model->getHighestMmcNummer();

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'MMCMedewerker/gebruikerToevoegen');
            $this->template->load('main_master', $partials, $data);

        } else {

            redirect('Home');

        }
    }

    public function gebruikerBewerken($gebruikerId) {
        $data['titel'] = "Gebruiker bewerken";
        $data['gemaaktDoor'] = 'Christophe Van Hoof';

        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        if($this->session->has_userdata('gebruiker_id')) {

            $this->load->model('Gebruiker_model');
            $data['account'] = $this->Gebruiker_model->get($gebruikerId);

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'MMCMedewerker/gebruikerBewerken');
            $this->template->load('main_master', $partials, $data);

        } else {

            redirect('Home');

        }
    }

    public function voegToe() {
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')) {
            //haal alle gegevens op uit het ingevulde formulier en steek ze in een object
            $gegevens = new stdClass();

            $gegevens->mmcNummer = $this->input->post('mmcNummer');
            $gegevens->erkenningsNummer = $this->input->post('erkenningsNummer');
            $gegevens->voornaam = $this->input->post('voornaam');
            $gegevens->naam = $this->input->post('naam');
            $gegevens->gebruikersnaam = $this->input->post('gebruikersnaam');
            $gegevens->straatEnNummer = $this->input->post('straatEnNummer');
            $gegevens->postcode = $this->input->post('postcode');
            $gegevens->gemeente = $this->input->post('gemeente');
            $gegevens->telefoonnummer = $this->input->post('telefoonnummer');
            $gegevens->email = $this->input->post('email');
            $gegevens->wachtwoord = password_hash($this->input->post('wachtwoord'), PASSWORD_DEFAULT);
            $gegevens->inactief = $this->input->post('inactief');

            $contactvorm = $this->input->post('contactvorm');
            if($contactvorm === "leeg"){
                $contactvorm = NULL;
            }

            $gegevens->contactvorm = $contactvorm;

            $soortId = $this->input->post('type');

            if (count($soortId) > 1) {
                $soort = "";

                for ($i = 0; $i < count($soortId); $i++) { //balk opvullen voor gebruiker van meerdere types
                    $soort .= $soortId[$i];
                }

                $gegevens->soortId = $soort;
            } else {
                $gegevens->soortId = $soortId[0];
            }

            $this->load->model('gebruiker_model');

            $erkenningVrij = $this->gebruiker_model->controleerErkenningsNummerVrij($gegevens->erkenningsNummer);
            $gebruikersnaamVrij = $this->gebruiker_model->controleerGebruikersnaamVrij($gegevens->gebruikersnaam);

            if($erkenningVrij && $gebruikersnaamVrij) {

                $this->gebruiker_model->insert($gegevens);

                redirect('MMCMedewerker/toonMeldingRegistratieOk/' . $soortId[0]);
            } else {
                if(!$erkenningVrij) {
                    redirect('MMCMedewerker/toonMeldingErkenningBestaat');
                } else {
                    redirect('MMCMedewerker/toonMeldingGebruikersnaamBestaat');
                }
            }

        } else {
            redirect('Home');
        }
    }

    public function wijzig() {
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')) {
            //haal alle gegevens op uit het ingevulde formulier en steek ze in een object
            $gegevens = new stdClass();

            $gegevens->id = $this->input->post('id');
            $gegevens->mmcNummer = $this->input->post('mmcNummer');
            $gegevens->erkenningsNummer = $this->input->post('erkenningsNummer');
            $gegevens->voornaam = $this->input->post('voornaam');
            $gegevens->naam = $this->input->post('naam');
            $gegevens->gebruikersnaam = $this->input->post('gebruikersnaam');
            $gegevens->straatEnNummer = $this->input->post('straatEnNummer');
            $gegevens->postcode = $this->input->post('postcode');
            $gegevens->gemeente = $this->input->post('gemeente');
            $gegevens->telefoonnummer = $this->input->post('telefoonnummer');
            $gegevens->email = $this->input->post('email');
            $gegevens->inactief = $this->input->post('inactief');

            $contactvorm = $this->input->post('contactvorm');
            if($contactvorm === "leeg"){
                $contactvorm = NULL;
            }

            $gegevens->contactvorm = $contactvorm;

            $soortId = $this->input->post('type');

            if (count($soortId) > 1) {
                $soort = "";

                for ($i = 0; $i < count($soortId); $i++) { //balk opvullen voor gebruiker van meerdere types
                    $soort .= $soortId[$i];
                }

                $gegevens->soortId = $soort;
            } else {
                $gegevens->soortId = $soortId[0];
            }

            $this->load->model('gebruiker_model');
            $this->gebruiker_model->update($gegevens);

            redirect('MMCMedewerker/toonMeldingWijzigingOk/' . $soortId[0]);

        } else {
            redirect('Home');
        }
    }

    public function toonMelding($titel, $boodschap, $link = null)
    {
        $data['titel'] = $titel;
        $data['gemaaktDoor'] = 'Christophe Van Hoof';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['boodschap'] = $boodschap;
        $data['link'] = $link;

        $partials = array( 'navigatie' => 'main_menu',
            'inhoud' => 'MMCMedewerker/melding');
        $this->template->load('main_master', $partials, $data);
    }

    public function toonMeldingErkenningBestaat() {
        $this->toonMelding('Fout', 'Erkenningsnummer bestaat reeds. Probeer opnieuw!', array("url" => "/MMCMedewerker/gebruikerToevoegen", "tekst" => "Terug"));

    }

    public function toonMeldingGebruikersnaamBestaat() {
        $this->toonMelding('Fout', 'Gebruikersnaam bestaat reeds. Probeer opnieuw!', array("url" => "/MMCMedewerker/gebruikerToevoegen", "tekst" => "Terug"));
    }

    public function toonMeldingRegistratieOk($soortId) {
        $this->toonMelding('Gelukt!', 'De gebruiker is succesvol aangemaakt!', array("url" => "/MMCMedewerker/gebruikersBeheren/" . $soortId, "tekst" => "Terug"));
    }

    public function toonMeldingWijzigingOk($soortId) {
        $this->toonMelding('Gelukt!', 'De gebruiker is succesvol gewijzigd!', array("url" => "/MMCMedewerker/gebruikersBeheren/" . $soortId, "tekst" => "Terug"));

    }

    public function rittenBekijken($gebruikerId)
    {
        $data['titel'] = 'Geplande ritten voor ';
        $data['gemaaktDoor'] = "Christophe Van Hoof";

        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        if($this->session->has_userdata('gebruiker_id')){

            $this->load->model('Gebruiker_model');
            $data['account'] = $this->Gebruiker_model->get($gebruikerId);

            $this->load->model('Rit_model');
            $data['ritten'] = $this->Rit_model->getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatum($gebruikerId);

            $this->load->model('Parameters_model');
            $data['parameters'] = $this->Parameters_model->get();

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'MMCMedewerker/geplandeRitten');
            $this->template->load('main_master', $partials, $data);
        } else {
            redirect('Home');
        }
    }

    // Aanvragen beheren
    public function aanvragenBeheren() {
        if(!$this->authex->isAangemeld()) {
            redirect('home/inloggen');
        } else {
            $data['titel'] = 'Aanvragen beheren';
            $data['gemaaktDoor'] = "Christophe Van Hoof";
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            $this->load->model('Rit_model');
            $data['ritten'] = $this->Rit_model->getAllByDatumWithGebruikerEnAdres();

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'MMCMedewerker/aanvragenBeheren');
            $this->template->load('main_master', $partials, $data);
        }
    }

    // Aanvraag wijzigen
    public function aanvraagWijzigen($ritId) {
        if(!$this->authex->isAangemeld()) {
            redirect('home/inloggen');
        } else {
            $data['titel'] = 'Aanvraag wijzigen';
            $data['gemaaktDoor'] = "Christophe Van Hoof";
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            $this->load->model('Rit_model');
            $data['rit'] = $this->Rit_model->getRitWithGebruikerEnAdres($ritId);

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'MMCMedewerker/wijzigAanvraag');
            $this->template->load('main_master', $partials, $data);
        }
    }

    // Chauffeurs zoeken
    public function haalAjaxOp_Chauffeurs() {

            $ritId = $this->input->get('ritId');

            $this->load->model('Rit_model');
            $data['rit'] = $this->Rit_model->getRitWithGebruikerEnAdres($ritId);

            $this->load->model('Gebruiker_model');
            $chauffeurs = $this->Gebruiker_model->getAllGebruikersWithSoortLike(3);

            $this->load->model('Vrijwilliger_model');

            foreach ($chauffeurs as $chauffeur) {
                $chauffeur->beschikbaarheid = $this->Vrijwilliger_model->getBeschikbaarheid($chauffeur->id);
            }

            $data['chauffeurs'] = $chauffeurs;

            $this->load->view("MMCMedewerker/ajax_zoekChauffeur", $data);
    }

    public function haalAjaxOp_vulChauffeurIn() {
        $gebruikerId = $this->input->get('gebruikerId');

        $this->load->model('Gebruiker_model');
        $data['chauffeur'] = $this->Gebruiker_model->get($gebruikerId);

        $this->load->view("MMCMedewerker/ajax_vulChauffeurIn", $data);
    }
}
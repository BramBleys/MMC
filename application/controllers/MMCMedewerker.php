<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MMCMedewerker extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Template');
        $this->load->helper('form');
    }

    public function gebruikersBeheren($soort) {
        $data['titel'] = 'Gebruikers beheren';
        $data['gemaaktDoor'] = 'Christophe Van Hoof';

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')){
            $gebruikerId = $this->session->userdata('gebruiker_id');

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
        $data['soortId'] = $this->input->get('soortId');

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
                    $soort += $soortId[$i];
                }

                $gegevens->soortId = $soort;
            } else {
                $gegevens->soortId = $soortId[0];
            }

            $this->load->model('gebruiker_model');
            $this->gebruiker_model->insert($gegevens);

            redirect('MMCMedewerker/gebruikersBeheren/' . $soortId[0]);
        } else {
            redirect('Home');
        }
    }
}
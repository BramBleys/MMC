<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Coach extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->helper('notation_helper');
        }

        public function index() {
            $data['titel'] = 'Minder Mobielen';
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
        /*
        public function rittenBeheren() {
            //laad de view accountBeheren
            $data['titel'] = 'Minder Mobielen';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'coach/minderMobielen');
            $this->template->load('main_master', $partials, $data);
        }
        */

        /*
        public function ritAanmaken() {
            $data['titel'] = 'Home';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            //haal alle gegevens op uit het ingevulde formulier en steek ze in een object
            $gegevens = new stdClass();
            $gegevens->id = $this->input->post('hidden');
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

            $data['gegevens'] = $gegevens;

            $this->load->model('gebruiker_model');
            $this->gebruiker_model->update($gegevens);

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'gebruiker/gegevensBevestiging');
            $this->template->load('main_master', $partials, $data);
        }
        */

        public function accountsBeheren($accountId) {
            $data['titel'] = 'Account beheren';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            if($this->session->has_userdata('gebruiker_id')) {
                $gebruikerId = $this->session->userdata('gebruiker_id');

                $this->load->model('gebruiker_model');
                $data['minderMobielen'] = $this->gebruiker_model->getGebruikerWhereCoach($gebruikerId);

                $partials = array('navigatie' => 'main_menu',
                    'inhoud' => 'coach/accountsBeheren');
                $this->template->load('main_master', $partials, $data);
            } else {
                redirect('Home');
            }
        }
        /*
        public function haalAjaxOp_Gebruiker() {
            $accountId = $this->input->get('accountId');

            $this->load->model('Gebruiker_model');
            $data['account'] = $this->Gebruiker_model->get($accountId);

            $this->load->view("coach/ajax_account", $data);
        }
        */
    }
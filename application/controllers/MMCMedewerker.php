<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MMCMedewerker extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Template');
    }

    public function gebruikersBeheren() {
        $data['titel'] = 'Gebruikers beheren';

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')){
            $gebruikerId = $this->session->userdata('gebruiker_id');

            $this->load->model('Gebruiker_model');
            $data['gebruikers'] = $this->Gebruiker_model->getAllGebruikers();

            $data['soortId'] = 1;

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
}
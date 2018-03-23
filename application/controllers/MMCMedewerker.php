<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MMCMedewerker extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Template');
    }

    public function gebruikersBeheren() {
        $data['titel'] = 'MMC Medewerker';

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')){
            $gebruikerId = $this->session->userdata('gebruiker_id');

            $this->load->model('MMCMedewerker_model');
            $data['inhoud'] = 'Jos Bos';

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'mmc-medewerker/home');
            $this->template->load('main_master', $partials, $data);
        } else {
            redirect('Home');
        }
    }
}
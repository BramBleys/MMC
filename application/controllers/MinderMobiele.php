<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 3/9/2018
 * Time: 1:20 PM
 */

class MinderMobiele extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('notation_helper');
    }

    public function index()
    {
        $data['titel'] = 'Mijn geplande ritten';

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')){
            $gebruikerId = $this->session->userdata('gebruiker_id');

            $this->load->model('gebruiker_model');
            $data['ritten'] = $this->gebruiker_model->getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatum($gebruikerId);

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'minderMobiele/geplandeRitten');
            $this->template->load('main_master', $partials, $data);
        } else {
            redirect('Home');
        }
    }

    public function afgelopenRitten() {
        $data['titel'] = 'Mijn afgelopen ritten';

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')){
            $gebruikerId = $this->session->userdata('gebruiker_id');

            $this->load->model('gebruiker_model');
            $data['ritten'] = $this->gebruiker_model->getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatumOuder($gebruikerId);

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'minderMobiele/afgelopenRitten');
            $this->template->load('main_master', $partials, $data);
        } else {
            redirect('Home');
        }
    }

    public function nieuweRit() {
        $data['titel'] = 'Rit aanmaken';

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')){
            $gebruikerId = $this->session->userdata('gebruiker_id');

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'minderMobiele/nieuweRit');
            $this->template->load('main_master', $partials, $data);
        } else {
            redirect('Home');
        }
    }

    public function ritToevoegen() {

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')){
            $rit = new stdClass();
            $rit->gebruikerIdMinderMobiele = $this->session->userdata('gebruiker_id');

            $this->load->model('gebruiker_model');
            $this->gebruiker_model->insertRit($gebruikerId);
        } else {
            redirect('Home');
        }
    }
}
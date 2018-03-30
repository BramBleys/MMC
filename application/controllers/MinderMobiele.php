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

            $this->load->model('Rit_model');
            $data['ritten'] = $this->Rit_model->getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatum($gebruikerId);

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

            $this->load->model('Rit_model');
            $data['ritten'] = $this->Rit_model->getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatumOuder($gebruikerId);

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

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'minderMobiele/nieuweRit');
            $this->template->load('main_master', $partials, $data);
        } else {
            redirect('Home');
        }
    }

    public function ritToevoegen() {
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $minderMobiele = $data['gebruiker'];
        if($this->session->has_userdata('gebruiker_id')){
            $rit = new stdClass();
            $rit->gebruikerIdMinderMobiele = $this->session->userdata('gebruiker_id');
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
            $rit->supplementaireKost = ($this->input->post('supplementaireKost')=='0' || $this->input->post('supplementaireKost')=='' ? NULL : $this->input->post('supplementaireKost'));
            $rit->opmerking = ($this->input->post('opmerkingen') == '' || $this->input->post('opmerkingen') == ' ' ? NULL : $this->input->post('opmerkingen'));
            $this->load->model('rit_model');
            $heenRitId = $this->rit_model->insert($rit);
            if ($this->input->post('terugRit')!="" && $this->input->post('terugRit')!=NULL){
                $terugRit = new stdClass();
                $terugRit->gebruikerIdMinderMobiele = $this->session->userdata('gebruiker_id');
                $terugRit->adresIdVertrek = $rit->adresIdBestemming;
                $terugRit->adresIdBestemming = $rit->adresIdVertrek;
                $datum = zetOmNaarYYYYMMDD($this->input->post('datumTerug'));
                $uur = $this->input->post('uurTerug');
                $datumTijd = new DateTime($datum . ' ' . $uur);
                $terugRit->vertrekTijdstip = $datumTijd;
                $terugRit->supplementaireKost = $this->input->post('supplementaireKostTerug');
                $terugRit->opmerking = $$this->input->post('opmerkingenTerug');
                $terugRit->ritIdHeenrit = $heenRitId;
                $terugRitId = $this->rit_model->insert($terugRit);
            }
            redirect('MinderMobiele');
        } else {
            redirect('Home');
        }
    }

    public function wijzig($id){

        $data['titel'] = 'Rit wijzigen';

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')){
            $this->load->model('rit_model');
            $data['rit'] = $this->rit_model->get($id);

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'minderMobiele/weizigRit');
            $this->template->load('main_master', $partials, $data);
        } else {
            redirect('Home');
        }
    }

    public function schrap($id){

    }
}
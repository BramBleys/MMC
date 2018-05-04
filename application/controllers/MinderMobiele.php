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
        $data['gemaaktDoor'] = "Dylan Vernelen Ebert";

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')){
            $gebruikerId = $this->session->userdata('gebruiker_id');

            $this->load->model('Rit_model');
            $data['ritten'] = $this->Rit_model->getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatum($gebruikerId);
            $this->load->model('Parameters_model');
            $parameters = $this->Parameters_model->get();
            $data['parameters'] = $parameters;

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'minderMobiele/geplandeRitten');
            $this->template->load('main_master', $partials, $data);
        } else {
            redirect('Home');
        }
    }

    public function haalJsonOp_GeplandeRitten(){
            $gebruikerId = $this->input->get('gebruikerId');
            $this->load->model('Rit_model');
            $ritten = $this->Rit_model->getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatum($gebruikerId);

            echo json_encode($ritten);
    }

    public function haalJsonOp_AfgelopenRitten(){
        $gebruikerId = $this->input->get('gebruikerId');
        $this->load->model('Rit_model');
        $ritten = $this->Rit_model->getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatumOuder($gebruikerId);

        echo json_encode($ritten);
    }

    public function haalJsonOp_RittenWeek(){
        $gebruikerId = $this->input->get('gebruikerId');
        $datum = $this->input->get('datum');
        $this->load->model('Rit_model');
        $ritten = $this->Rit_model->getWhereDatum($gebruikerId, $datum);

        echo json_encode($ritten);
    }

    public function afgelopenRitten() {
        $data['titel'] = 'Mijn afgelopen ritten';
        $data['gemaaktDoor'] = "Dylan Vernelen Ebert";

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')){
            $gebruikerId = $this->session->userdata('gebruiker_id');

            $this->load->model('Rit_model');
            $data['ritten'] = $this->Rit_model->getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatumOuder($gebruikerId);
            $this->load->model('Parameters_model');
            $data['parameters'] = $this->Parameters_model->get();

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'minderMobiele/afgelopenRitten');
            $this->template->load('main_master', $partials, $data);
        } else {
            redirect('Home');
        }
    }

    public function nieuweRit() {
        $data['titel'] = 'Rit aanvragen';
        $data['gemaaktDoor'] = "Dylan Vernelen Ebert";

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        if($this->session->has_userdata('gebruiker_id')){
            $this->load->model('Parameters_model');
            $parameters = $this->Parameters_model->get();
            $data['parameters'] = $parameters;
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
            $this->load->model('Parameters_model');
            $parameters = $this->Parameters_model->get();
            $this->load->model('Rit_model');
            $datum = $this->input->post('datum');
            if(!$parameters->maxRitten - count($this->Rit_model->getWhereDatum($minderMobiele->id, $datum)) <= 0){
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
                $rit->opmerking = ($this->input->post('opmerkingen') == '' || $this->input->post('opmerkingen') == ' ' ? NULL : $this->input->post('opmerkingen'));
                $this->load->model('rit_model');
                $heenRitId = $this->rit_model->insert($rit);
                if ($this->input->post('terugRit')!="" && $this->input->post('terugRit')!=NULL){
                    $terugRit = new stdClass();
                    $terugRit->gebruikerIdMinderMobiele = $this->session->userdata('gebruiker_id');
                    $terugRit->adresIdVertrek = $rit->adresIdBestemming;
                    $terugRit->adresIdBestemming = $rit->adresIdVertrek;
                    $datum = $this->input->post('datumTerug');
                    $uur = $this->input->post('uurTerug');
                    $terugRit->vertrekTijdstip = $datum . ' ' . $uur . ':00';;
                    $terugRit->opmerking = ($this->input->post('opmerkingenTerug') == '' || $this->input->post('opmerkingenTerug') == ' ' ? NULL : $this->input->post('opmerkingenTerug'));
                    $terugRit->ritIdHeenrit = $heenRitId;
                    $terugRitId = $this->rit_model->insert($terugRit);
                }
            }
            redirect('MinderMobiele');
        } else {
            redirect('Home');
        }
    }

    public function wijzigRit($id){

        $data['titel'] = 'Rit wijzigen';
        $data['gemaaktDoor'] = "Dylan Vernelen Ebert";

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $minderMobiele = $data['gebruiker'];
        if($this->session->has_userdata('gebruiker_id')){
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
            $this->load->model('Parameters_model');
            $parameters = $this->Parameters_model->get();
            $data['parameters'] = $parameters;
            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'minderMobiele/wijzigRit');
            $this->template->load('main_master', $partials, $data);
        } else {
            redirect('Home');
        }
    }

    public function wijzigingOpslaan(){
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $minderMobiele = $data['gebruiker'];
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
                $rit->opmerking = ($this->input->post('opmerkingen') == '' || $this->input->post('opmerkingen') == ' ' ? NULL : $this->input->post('opmerkingen'));
                $this->load->model('rit_model');
                $heenRitId = $this->rit_model->insert($rit);
                if ($this->input->post('terugRit')!="" && $this->input->post('terugRit')!=NULL){
                    $terugRit = new stdClass();
                    $terugRit->gebruikerIdMinderMobiele = $this->session->userdata('gebruiker_id');
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
            redirect('MinderMobiele');
        } else {
            redirect('Home');
        }
    }
    
    public function schrap($id){
        $this->load->model('rit_model');
        if ($this->rit_model->getByHeenRit($id)){
            $terugRit = $this->rit_model->getByHeenRit($id);
            $this->rit_model->delete($terugRit->id);
        }
        $this->rit_model->delete($id);
        redirect('MinderMobiele');
    }
}
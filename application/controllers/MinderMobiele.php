<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @class MinderMobiele
 * @brief Controller-klasse voor Minder Mobielen
 *
 * Controller-klasse met alle methodes die gebruikt worden voor de Minder Mobielen
 */
class MinderMobiele extends CI_Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('notation_helper');
    }

    /**
     * Haalt de geplande ritten van de aangemelde gebruiker (en aangevuld met gebruiker- en adresgegevens) op
     * via Rit_model, en haalt het parameter record op via Parameter_model en toont de resulterende objecten in de view geplandeRitten.php
     *
     * @see Parameters_model::get()
     * @see Rit_model::getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatum()
     * @see geplandeRitten.php
     */
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

    /**
     * Haalt de geplande ritten van de opgehaalde gebruiker (en aangevuld met gebruiker- en adresgegevens) op
     * via Rit_model, en vertaalt dit object naar JSON
     *
     * @see Rit_model::getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatum()
     */
    public function haalJsonOp_GeplandeRitten(){
            $gebruikerId = $this->input->get('gebruikerId');
            $this->load->model('Rit_model');
            $ritten = $this->Rit_model->getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatum($gebruikerId);

            echo json_encode($ritten);
    }

    /**
     * Haalt de afgelopen ritten van de opgehaalde gebruiker (en aangevuld met gebruiker- en adresgegevens) op
     * via Rit_model, en vertaalt dit object naar JSON
     *
     * @see Rit_model::getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatumOuder()
     */
    public function haalJsonOp_AfgelopenRitten(){
        $gebruikerId = $this->input->get('gebruikerId');
        $this->load->model('Rit_model');
        $ritten = $this->Rit_model->getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatumOuder($gebruikerId);

        echo json_encode($ritten);
    }

    /**
     * Haalt de ritten, uit de week van de opgehaalde datum, van de opgehaalde gebruiker op
     * via Rit_model, en vertaalt dit object naar JSON
     *
     * @see Rit_model::getWhereDatum()
     */
    public function haalJsonOp_RittenWeek(){
        $gebruikerId = $this->input->get('gebruikerId');
        $datum = $this->input->get('datum');
        $this->load->model('Rit_model');
        $ritten = $this->Rit_model->getWhereDatum($gebruikerId, $datum);

        echo json_encode($ritten);
    }

    /**
     * Haalt de afgelopen ritten van de aangemelde gebruiker (en aangevuld met gebruiker- en adresgegevens) op
     * via Rit_model, en haalt het parameter record op
     * via Parameter_model en toont de resulterende objecten in de view afgelopenRitten.php
     *
     * @see Parameters_model::get()
     * @see Rit_model::getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatumOuder()
     * @see afgelopenRitten.php
     */
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

    /**
     * Haalt het parameter record op
     * via Parameter_model en toont de view nieuweRit.php
     *
     * @see Parameters_model::get()
     * @see nieuweRit.php
     */
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

    /**
     * Haalt het parameter record op
     * via Parameter_model, haalt de ritten, uit de opgehaalde week, op
     * via Rit_model, haalt het id van het opgehaalde adres op
     * via Adres_model, haalt alle gegevens op van de gesubmitte pagina, voegt indien nodig de opgehaalde adressen toe
     * via Adres_model, voegt de opgehaalde ritgegevens toe
     * via Rit_model en wordt doorverwezen naar zijn geplande ritten
     *
     * @see Parameters_model::get()
     * @see Rit_model::getWhereDatum()
     * @see Adres_model::getIdWhereStraatEnGemeenteEnPostcode()
     * @see Adres_model::insert()
     * @see Rit_model::insert()
     * @see MinderMobiele::index()
     */
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

    /**
     * Haalt het rit-record op met id=$id en indien aanwezig de terugrit met ritIdHeenrit=$id (en aangevuld met adresgegevens) op
     * via Rit_model, haalt het parameter record op
     * via Parameter_model en toont de objecten in de view wijzigRit.php
     *
     * @param $id De id van het rit-record dat getoond wordt
     * @see Rit_model::get()
     * @see Rit_model::getByHeenRit()
     * @see Adres_model::getAdres()
     * @see Parameters_model::get()
     * @see wijzigRit.php
     */
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

    /**
     * Haalt het parameter record op
     * via Parameter_model, haalt de ritten, uit de opgehaalde week, op
     * via Rit_model, haalt het id van het opgehaalde adres op
     * via Adres_model, verwijdert de opgehaalde rit en zijn terugrit
     * via Rit_model, haalt alle gegevens op van de gesubmitte pagina, voegt indien nodig de opgehaalde adressen toe
     * via Adres_model, voegt de opgehaalde ritgegevens toe
     * via Rit_model en wordt doorverwezen naar zijn geplande ritten
     *
     * @see Parameters_model::get()
     * @see Rit_model::getWhereDatum()
     * @see Adres_model::getIdWhereStraatEnGemeenteEnPostcode()
     * @see Rit_model::delete()
     * @see Adres_model::insert()
     * @see Rit_model::insert()
     * @see MinderMobiele::index()
     */
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

    /**
     * Verwijdert het rit-record op met id=$id en indien aanwezig de terugrit met ritIdHeenrit=$id
     * via Rit_model en wordt doorverwezen naar zijn geplande ritten
     *
     * @param $id De id van het rit-record dat verwijdert wordt met zijn terugrit
     * @see Rit_model::getByHeenRit()
     * @see Rit_model::delete()
     * @see MinderMobiele::index()
     */
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
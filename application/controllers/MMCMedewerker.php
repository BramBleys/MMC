<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @class MMCMedewerker
 * @brief Controller-klasse voor MMC-medewerkers
 *
 * Controller-klasse met alle methodes die gebruikt worden voor de gebruiker MMC-medewerker
 */

class MMCMedewerker extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Template');
        $this->load->helper('form');
        $this->load->helper('notation_helper');
    }

    /**
     * Haalt alle gebruikers op via Gebruiker_model en toont de objecten in de view gebruikersBeheren.php
     *
     * @param $soort Het type van gebruiker dat standaard getoond wordt
     * @see Gebruiker_model::getAllGebruikers()
     * @see MMCMedewerker/gebruikersBeheren.php
     */
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

    /**
     * Haalt alle gebruikers op via AJAX en het model Gebruiker_model en toont de objecten in de view ajax_gebruikers.php
     *
     * @see Gebruiker_model::getAllGebruikers()
     * @see MMCMedewerker/ajax_gebruikers.php
     */
    public function haalAjaxOp_Gebruikers() {
        $soort = $this->input->get('soortId');
        $data['soortId'] = $soort;

        $this->load->model('Gebruiker_model');
        $data['gebruikers'] = $this->Gebruiker_model->getAllGebruikers();

        $this->load->view("MMCMedewerker/ajax_gebruikers", $data);
    }

    /**
     * Haalt het hoogste MMC-nummer via het model Gebruiker_model en toont een formulier om een nieuwe gebruiker toe te voegen in de view gebruikerToevoegen.php
     *
     * @see Gebruiker_model::getHighestMmcNummer()
     * @see MMCMedewerker/gebruikerToevoegen.php
     */
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

    /**
     * Haalt het gebruiker-object met id=$gebruikerId op via Gebruiker_model en toont een formulier om dit gebruiker-record aan te passen in de view gebruikerBewerken.php
     *
     * @param $gebruikerId De gebruiker die aangepast dient te worden
     * @see Gebruiker_model::get()
     * @see MMCMedewerker/gebruikerBewerken.php
     */
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

    /**
     * Haalt alle gegevens uit het formulier om een nieuwe gebruiker toe te voegen en voert enkele controle-acties uit via Gebruiker_model.
     * Afhankelijk van de waarde van de controle-acties zal één van volgende methodes opgeroepen worden:
     *  - toonMeldingRegistratieOk/$soortId
     *  - toonMeldingErkenningBestaat
     *  - toonMeldingGebruikersnaamBestaat
     *
     * @see Gebruiker_model::controleerErkenningsNummerVrij()
     * @see Gebruiker_model::controleerGebruikersnaamVrij()
     * @see Gebruiker_model::insert()
     * @see MMCMedewerker::toonMeldingRegistratieOk()
     * @see MMCMedewerker::toonMeldingErkenningBestaat()
     * @see MMCMedewerker::toonMeldingGebruikersnaamBestaat()
     */
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

    /**
     * Haalt alle gegevens uit het formulier om een gebruiker te wijzigen en voert de wijzigingen door via het Gebruiker_model en roept de methode toonMeldingWijzigingOk/$soortId op
     *
     * @see Gebruiker_model::update()
     * @see MMCMedewerker::toonMeldingWijzigingOk()
     */
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

    /**
     * Wordt gebruikt om verschillende meldingen te tonen via de view melding.php
     *
     * @param $titel De titel voor de te tonen melding
     * @param $boodschap De boodschap van de te tonen melding
     * @param null $link Een link om naar een bepaalde pagina terug te keren
     * @see MMCMedewerker/melding.php
     */
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

    /**
     * Toont een melding wanneer al een gebruiker ingegeven is met een bepaalde erkenningsnummer via de methode toonMelding en genereert een link om terug te keren naar de methode gebruikerToevoegen
     *
     * @see MMCMedewerker::toonMelding()
     * @see MMCMedewerker::gebruikerToevoegen()
     */
    public function toonMeldingErkenningBestaat() {
        $this->toonMelding('Fout', 'Erkenningsnummer bestaat reeds. Probeer opnieuw!', array("url" => "/MMCMedewerker/gebruikerToevoegen", "tekst" => "Terug"));

    }

    /**
     * Toont een melding wanneer al een gebruiker ingegeven is met een bepaalde gebruikersnaam via de methode toonMelding en genereert een link om terug te keren naar de methode gebruikerToevoegen
     *
     * @see MMCMedewerker::toonMelding()
     * @see MMCMedewerker::gebruikerToevoegen()
     */
    public function toonMeldingGebruikersnaamBestaat() {
        $this->toonMelding('Fout', 'Gebruikersnaam bestaat reeds. Probeer opnieuw!', array("url" => "/MMCMedewerker/gebruikerToevoegen", "tekst" => "Terug"));
    }

    /**
     * Toont een melding wanneer de registratie van een gebruiker goed verlopen is via de methode toonMelding en genereert een link om terug te keren naar de methode gebruikersBeheren/$soortId
     *
     * @see MMCMedewerker::toonMelding()
     * @see MMCMedewerker::gebruikersBeheren()
     */
    public function toonMeldingRegistratieOk($soortId) {
        $this->toonMelding('Gelukt!', 'De gebruiker is succesvol aangemaakt!', array("url" => "/MMCMedewerker/gebruikersBeheren/" . $soortId, "tekst" => "Terug"));
    }

    /**
     * Toont een melding wanneer de wijziging van een gebruiker goed verlopen is via de methode toonMelding en genereert een link om terug te keren naar de methode gebruikersBeheren/$soortId
     *
     * @see MMCMedewerker::toonMelding()
     * @see MMCMedewerker::gebruikersBeheren()
     */
    public function toonMeldingWijzigingOk($soortId) {
        $this->toonMelding('Gelukt!', 'De gebruiker is succesvol gewijzigd!', array("url" => "/MMCMedewerker/gebruikersBeheren/" . $soortId, "tekst" => "Terug"));

    }

    /**
     * Toont een melding wanneer de wijziging van een aanvraag goed verlopen is via de methode toonMelding en genereert een link om terug te keren naar de methode aanvragenBeheren
     *
     * @see MMCMedewerker::toonMelding()
     * @see MMCMedewerker::aanvragenBeheren()
     */
    public function toonMeldingWijzigingOkAanvraag() {
        $this->toonMelding('Gelukt!', 'De rit is succesvol gewijzigd!', array("url" => "/MMCMedewerker/aanvragenBeheren", "tekst" => "Terug"));
    }

    /**
     * Haalt alle ritten (samen met gebruikers en adres) op voor de mindermobiele met id=$gebruikerId via Rit_model en toont deze in de view geplandeRitten.php
     *
     * @param $gebruikerId Gebruiker-id van de gebruiker waarvan de ritten getoond moeten worden
     * @see Gebruiker_model::get()
     * @see Rit_model::getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatum()
     * @see Parameters_model::get()
     * @see MMCMedewerker/geplandeRitten.php
     */
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

    /**
     * Haalt alle aanvragen voor ritten op via Rit_model en toont deze in de view aanvragenBeheren.php
     *
     * @see Rit_model::getAllByDatumWithGebruikerEnAdres()
     * @see MMCMedewerker/aanvragenBeheren.php
     */
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

    /**
     * Haalt het rit-object op met id=$ritId via Rit_model en toont een formulier om deze record aan te passen via de view wijzigAanvraag.php
     *
     * @param $ritId
     * @see Rit_model::getRitWithGebruikerEnAdres()
     * @see Rit_model::getByHeenRit()
     * @see MMCMedewerker/wijzigAanvraag.php
     */
    public function aanvraagWijzigen($ritId) {
        if(!$this->authex->isAangemeld()) {
            redirect('home/inloggen');
        } else {
            $data['titel'] = 'Aanvraag wijzigen';
            $data['gemaaktDoor'] = "Christophe Van Hoof";
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            $this->load->model('Rit_model');
            $data['rit'] = $this->Rit_model->getRitWithGebruikerEnAdres($ritId);

            $terugRit = $this->Rit_model->getByHeenRit($ritId);
            if($terugRit) {
                $data['terugRit'] = $terugRit;
            } else {
                $data['terugRit'] = false;
            }

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'MMCMedewerker/wijzigAanvraag');
            $this->template->load('main_master', $partials, $data);
        }
    }

    /**
     * Haalt alle chauffeurs (met beschikbaarheid en ritten) op via AJAX via Rit_model, Gebruiker_model en Vrijwilliger_model en toont deze in de view ajax_zoekChauffeur.php
     *
     * @see Rit_model::getRitWithGebruikerEnAdres()
     * @see Gebruiker_model::getAllGebruikersWithSoortLike()
     * @see Vrijwilliger_model::getBeschikbaarheid()
     * @see MMCMedewerker/ajax_zoekChauffeur.php
     */
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

    /**
     * Haalt het gekozen chauffeur-object op geeft dit door aan de view ajax_vulChauffeurIn.php
     *
     * @see Gebruiker_model::get()
     * @see MMCMedewerker/ajax_vulChauffeurIn.php
     */
    public function haalAjaxOp_vulChauffeurIn() {
        $gebruikerId = $this->input->get('gebruikerId');

        $this->load->model('Gebruiker_model');
        $data['chauffeur'] = $this->Gebruiker_model->get($gebruikerId);

        $this->load->view("MMCMedewerker/ajax_vulChauffeurIn", $data);
    }

    /**
     * Haalt het adres en woonplaats van de passagier op en geeft deze door aan de view ajax_vulThuisAdresIn.php
     *
     * @see Gebruiker_model::get()
     * @see MMCMedewerker/ajax_vulThuisAdresIn.php
     */
    public function haalAjaxOp_thuisAdres() {
        $gebruikerId = $this->input->get('gebruikerId');
        $data['checked'] = $this->input->get('checked');

        $this->load->model('Gebruiker_model');
        $data['minderMobiele'] = $this->Gebruiker_model->get($gebruikerId);

        $this->load->view("MMCMedewerker/ajax_vulThuisAdresIn", $data);
    }

    /**
     * Haalt alle gegevens op uit het formulier van de view wijzigAanvraag.php (samen met adres-gegevens) voor de gekozen rit en voert de wijzigingen uit via Adres_model en Rit_model.
     * Vervolgens wordt de methode toonMeldingWijzigingOkAanvraag opgeroepen.
     *
     * @see Adres_model::getIdWhereStraatEnGemeenteEnPostcode()
     * @see Adres_model::insert()
     * @see Rit_model::insert()
     * @see Rit_model::update()
     * @see MMCMedewerker::toonMeldingWijzigingOkAanvraag()
     */
    public function wijzigAanvraag() {
        //haal alle gegevens op uit het ingevulde formulier en steek ze in een object
        $gegevens = new stdClass();
        $adresVertrek = new stdClass();
        $adresBestemming = new stdClass();

        $this->load->model('Rit_model');

        $gegevens->id = $this->input->post('ritId');
        $gegevens->gebruikerIdVrijwilliger = $this->input->post('vrijwilligerId');

        $this->load->model('Adres_model');

        $adresVertrek->straatEnNummer = $this->input->post('straatEnNummerVertrek');
        $adresVertrek->postcode = $this->input->post('postcodeVertrek');
        $adresVertrek->gemeente = $this->input->post('gemeenteVertrek');
        $adresVertrekId = $this->Adres_model->getIdWhereStraatEnGemeenteEnPostcode($adresVertrek);

        if($adresVertrekId !== '') {
            $gegevens->adresIdVertrek = $adresVertrekId;
        } else {
            $gegevens->adresIdVertrek = $this->Adres_model->insert($adresVertrek);
        }

        $adresBestemming->straatEnNummer = $this->input->post('straatEnNummerBestemming');
        $adresBestemming->postcode = $this->input->post('postcodeBestemming');
        $adresBestemming->gemeente = $this->input->post('gemeenteBestemming');
        $adresBestemmingId = $this->Adres_model->getIdWhereStraatEnGemeenteEnPostcode($adresBestemming);

        if($adresBestemmingId !== '') {
            $gegevens->adresIdBestemming = $adresBestemmingId;
        } else {
            $gegevens->adresIdBestemming = $this->Adres_model->insert($adresBestemming);
        }

        $datum = $this->input->post('datum');
        $uur = $this->input->post('uur');
        $gegevens->vertrekTijdstip = $datum . ' ' . $uur . ':00';

        if($this->input->post('terugRit')) {
            $terugRit = new stdClass();
            if($this->input->post('terugRitId')) {
                $terugRit->id = $this->input->post('terugRitId');
                $terugRit->ritIdHeenRit = $this->input->post('ritId');

                $this->Rit_model->update($terugRit);
            } else {
                $terugRit->gebruikerIdMinderMobiele = $this->input->post('minderMobieleId');
                $terugRit->adresIdVertrek = $gegevens->adresIdBestemming;
                $terugRit->adresIdBestemming = $gegevens->adresIdVertrek;
                $terugRit->vertrekTijdstip = $gegevens->vertrekTijdstip;
                $terugRit->ritIdHeenRit = $gegevens->id;

                $this->Rit_model->insert($terugRit);
            }
        }

        $this->Rit_model->update($gegevens);

        redirect('MMCMedewerker/toonMeldingWijzigingOkAanvraag');
    }

    /**
     * Toont een formulier voor het toevoegen van een nieuwe ritaanvraag via de view aanvraagToevoegen.php
     *
     * @see MMCMedewerker/aanvraagToevoegen.php
     */
    public function aanvraagToevoegen() {
        if(!$this->authex->isAangemeld()) {
            redirect('home/inloggen');
        } else {
            $data['titel'] = 'Nieuwe rit toevoegen';
            $data['gemaaktDoor'] = "Christophe Van Hoof";
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'MMCMedewerker/aanvraagToevoegen');
            $this->template->load('main_master', $partials, $data);
        }
    }

    /**
     * Haalt alle passagiers (met coach) op via AJAX via Gebruiker_model en Coach_model en toont deze in de view ajax_allePassagiersTonen.php
     *
     * @see Gebruiker_model::getAllGebruikersWithSoortLike()
     * @see Coach_model::getCoachWhereMinderMobiele()
     * @see MMCMedewerker/ajax_allePassagiersTonen.php
     */
    public function haalAjaxOp_AllePassagiers() {

        $this->load->model('Gebruiker_model');
        $passagiers = $this->Gebruiker_model->getAllGebruikersWithSoortLike(1);

        $this->load->model('Coach_model');


        foreach ($passagiers as $passagier) {

            $coach = $this->Coach_model->getCoachWhereMinderMobiele($passagier->id);

            if($coach !== Null) {
                $passagier->coach = $this->Gebruiker_model->get($coach->gebruikerIdCoach);
            } else {
                $passagier->coach = Null;
            }
        }

        $data['passagiers'] = $passagiers;

        $this->load->view("MMCMedewerker/ajax_allePassagiersTonen", $data);
    }

    /**
     * Haalt alle chauffeurs op via AJAX via Gebruiker_model en toont deze in de view ajax_alleChauffeursTonen.php
     *
     * @see Gebruiker_model::getAllGebruikersWithSoortLike()
     * @see MMCMedewerker/ajax_alleChauffeursTonen.php
     */
    public function haalAjaxOp_AlleChauffeurs() {

        $this->load->model('Gebruiker_model');
        $data['chauffeurs'] = $this->Gebruiker_model->getAllGebruikersWithSoortLike(3);

        $this->load->view("MMCMedewerker/ajax_alleChauffeursTonen", $data);
    }

    /**
     * Haalt het gekozen passagier-object op geeft dit door aan de view ajax_vulPassagierIn.php
     *
     * @see Gebruiker_model::get()
     * @see MMCMedewerker/ajax_vulChauffeurIn.php
     */
    public function haalAjaxOp_vulPassagierIn() {
        $gebruikerId = $this->input->get('gebruikerId');
        $coachId = $this->input->get('coachId');

        $this->load->model('Gebruiker_model');
        $data['passagier'] = $this->Gebruiker_model->get($gebruikerId);

        if($coachId !== 0) {
            $coach = $this->Gebruiker_model->get($coachId);
        } else {
            $coach = null;
        }
        $data['coach'] = $coach;

        $this->load->view("MMCMedewerker/ajax_vulPassagierIn", $data);
    }

    /**
     * Haalt alle gegevens op uit het formulier van de view aanvraagToevoegen.php (samen met adres-gegevens) voor een nieuwe rit en voert de nieuwe gegevens in via Adres_model en Rit_model.
     * Vervolgens wordt de methode toonMeldingRegistratieOkAanvraag opgeroepen.
     *
     * @see Adres_model::getIdWhereStraatEnGemeenteEnPostcode()
     * @see Adres_model::insert()
     * @see Rit_model::insert()
     * @see MMCMedewerker::toonMeldingRegistratieOk()
     */
    public function voegToeAanvraag() {
        //haal alle gegevens op uit het ingevulde formulier en steek ze in een object
        $gegevens = new stdClass();
        $adresVertrek = new stdClass();
        $adresBestemming = new stdClass();

        $this->load->model('Rit_model');

        $gegevens->gebruikerIdMinderMobiele = $this->input->post('passagierId');
        $gegevens->gebruikerIdVrijwilliger = $this->input->post('vrijwilligerId');

        $this->load->model('Adres_model');

        $adresVertrek->straatEnNummer = $this->input->post('straatEnNummerVertrek');
        $adresVertrek->postcode = $this->input->post('postcodeVertrek');
        $adresVertrek->gemeente = $this->input->post('gemeenteVertrek');
        $adresVertrekId = $this->Adres_model->getIdWhereStraatEnGemeenteEnPostcode($adresVertrek);

        if($adresVertrekId !== 0) {
            $gegevens->adresIdVertrek = $adresVertrekId;
        } else {
            $gegevens->adresIdVertrek = $this->Adres_model->insert($adresVertrek);
        }

        $adresBestemming->straatEnNummer = $this->input->post('straatEnNummerBestemming');
        $adresBestemming->postcode = $this->input->post('postcodeBestemming');
        $adresBestemming->gemeente = $this->input->post('gemeenteBestemming');
        $adresBestemmingId = $this->Adres_model->getIdWhereStraatEnGemeenteEnPostcode($adresBestemming);

        if($adresBestemmingId !== 0) {
            $gegevens->adresIdBestemming = $adresBestemmingId;
        } else {
            $gegevens->adresIdBestemming = $this->Adres_model->insert($adresBestemming);
        }

        $datum = $this->input->post('datumHeen');
        $uur = $this->input->post('uurHeen');
        $vertrekTijdstip = $datum . ' ' . $uur . ':00';

        $gegevens->vertrekTijdstip = date_create($vertrekTijdstip);

        $heenRitId = $this->Rit_model->insert($gegevens);

        if($this->input->post('terugRit') == 'checked') {
            $terugRit = new stdClass();

            $datum = $this->input->post('datumTerug');
            $uur = $this->input->post('uurTerug');
            $vertrekTijdstip = strtotime($datum . ' ' . $uur . ':00');

            $terugRit->gebruikerIdMinderMobiele = $gegevens->gebruikerIdMinderMobiele;
            $terugRit->adresIdVertrek = $gegevens->adresIdBestemming;
            $terugRit->adresIdBestemming = $gegevens->adresIdVertrek;
            $terugRit->vertrekTijdstip = $vertrekTijdstip;
            $terugRit->ritIdHeenRit = $heenRitId;

            $this->Rit_model->insert($terugRit);
        }

        redirect('MMCMedewerker/toonMeldingWijzigingOkAanvraag');
    }
}
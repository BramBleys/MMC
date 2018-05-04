<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @class Administrator
 * @brief Controller-klasse voor Administrator
 *
 * Controller-klasse met alle methodes die gebruikt worden in Administrator
 */
class Administrator extends CI_Controller
{
    /**
     * Constructor
     */
    public function __construct(){
        parent::__construct();
        //De Template library inladen
        $this->load->library('Template');
    }

    /**
     * Haalt de parameter-records op
     * via Parameters_model en toont het resulterende object in de view parameters.php
     *
     * @see Parameters_model::get()
     * @see parameters.php
     */
    public function index(){
        //titel veranderen naar Parameters
        $data['titel'] = 'Parameters';
        //Gebruikersinformatie ophalen
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['gemaaktDoor'] = "Kilian Fastenakels";
        $parameters = new stdClass();

        $this->load->model('Parameters_model');
        $parameters = $this->Parameters_model->get();

        $data['parameters'] = $parameters;
        //Templates definieren en inladen
        $partials = array( 'navigatie' => 'main_menu', 'inhoud' => 'administrator/parameters');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Slaagt de ingevulde parameters op
     * via Parameters_model en toont het resulterende object in de view parametersBevesting.php
     *
     * @see Parameters_model::update()
     * @see parametersBevestiging.php
     */
    public function parametersOpslagen(){
        //titel veranderen naar Parameters Opgeslagen
        $data['titel'] = 'Parameters Opgeslagen';
        //Login nakijken
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['gemaaktDoor'] = "Kilian Fastenakels";
        //Variabel aanmaken om parameters in op te slagen
        $parameters = new stdClass();

        //Ingevulde parameters opslagen in het variabel
        $parameters->maxRitten = $this->input->post('maxRitten');
        $parameters->prijsPerKM = $this->input->post('prijsPerKM');
        $parameters->annulatieTijd = $this->input->post('annulatieTijd');

        //in data stoppen
        $data['parameters'] = $parameters;

        //Parameters model laden en de database updaten
        $this->load->model('Parameters_model');
        $this->Parameters_model->update($parameters);

        //bevestiging pagina tonen
        $partials = array( 'navigatie' => 'main_menu', 'inhoud' => 'administrator/parametersBevestiging');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Haalt de sjabloon-records op
     * via Inhoud_model en toont het resulterende object in de view sjablonenBeheren.php
     *
     * @see Inhoud_model::getInhoudWhereTypeInhoudId()
     * @see sjablonenBeheren.php
     */
    public function sjablonenBeheren(){
        //titel veranderen naar Sjablonen
        $data['titel'] = 'Sjablonen beheren';
        //Gebruikersinformatie ophalen
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['gemaaktDoor'] = "Kilian Fastenakels";
        //Variabel aanmaken om sjablonen in op te slagen


        //Parameters model laden en inhoud ophalen waar het typeInhoudId 3 is, dit zijn sjablonen
        $this->load->model('Inhoud_model');
        $sjablonen = $this->Inhoud_model->getInhoudWhereTypeInhoudId("3");

        $data['sjablonen'] = $sjablonen;

        //bevestiging pagina tonen
        $partials = array( 'navigatie' => 'main_menu', 'inhoud' => 'administrator/sjablonenBeheren');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Haalt het sjabloon-record met id=$id op
     * via Inhoud_model en toont het resulterende object in de view sjabloonWijzigen.php
     *
     * @param $id de id van het sjabloon record dat getoond wordt
     * @see Inhoud_model::getInhoudWhereId()
     * @see sjabloonWijzigen.php
     */
    public function sjabloonwijzigen($id){
        //titel veranderen naar Sjablonen
        $data['titel'] = 'Sjabloon wijzigen';
        //Gebruikersinformatie ophalen
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['gemaaktDoor'] = "Kilian Fastenakels";
        //Variabel aanmaken om het sjabloon in op te slagen
        $sjabloon = new stdClass();

        //Geselecteerde sjabloon van Sjablonen beheren ophalen
        $this->load->model('Inhoud_model');
        $sjabloon = $this->Inhoud_model->getInhoudWhereId($id);

        $data['sjabloon'] = $sjabloon;

        //bevestiging pagina tonen
        $partials = array( 'navigatie' => 'main_menu', 'inhoud' => 'administrator/sjabloonWijzigen');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Slaagt het aangepaste sjabloon op
     * via Inhoud_model en toont het resulterende object in de view sjabloonBeheren.php
     *
     * @see Inhoud_model::update()
     * @see sjablooneheren.php
     */
    public function sjabloonOpslagen(){
        //titel veranderen naar Sjabloon Opgeslagen
        $data['titel'] = 'Sjabloon opgeslagen';
        //Login nakijken
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['gemaaktDoor'] = "Kilian Fastenakels";
        //Variabel aanmaken om sjabloon in op te slagen
        $sjabloon = new stdClass();

        //Ingevulde sjabloon opslagen in het variabel
        $sjabloon->id = $this->input->post('id');
        $sjabloon->titel = $this->input->post('titel');
        $sjabloon->inhoud = $this->input->post('inhoud');


        //Inhoud model laden en de database updaten
        $this->load->model('Inhoud_model');
        $this->Inhoud_model->update($sjabloon);

        //Parameters model laden en inhoud ophalen waar het typeInhoudId 3 is, dit zijn sjablonen
        $this->load->model('Inhoud_model');
        $sjablonen = $this->Inhoud_model->getInhoudWhereTypeInhoudId("3");

        $data['sjablonen'] = $sjablonen;

        //Terug naar Sjablonen beheren gaan
        $partials = array( 'navigatie' => 'main_menu', 'inhoud' => 'administrator/sjablonenBeheren');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Verwijdert het sjabloon-record met id=$id
     * via Inhoud_model en toont het resulterende object in de view sjabloonBeheren.php
     *
     * @param $id de id van het sjabloon-record dat verwijdert word.
     * @see Inhoud_model::leegMaken()
     * @see sjabloonBeheren.php
     */
    public function sjabloonVerwijderen($id){
        //titel veranderen naar Sjabloon verwijderen
        $data['titel'] = 'Sjabloon verwijderen';
        //Login nakijken
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['gemaaktDoor'] = "Kilian Fastenakels";
        //Variabel aanmaken om sjabloon in op te slagen
        $sjabloon = new stdClass();

        //Gekozen sjabloon opslagen in het variabel
        $sjabloon->id = $id;
        $sjabloon->titel = "Leeg sjabloon";
        $sjabloon->inhoud = "Dit sjabloon is leeg.";

        //Inhoud model laden en de database updaten
        $this->load->model('Inhoud_model');
        $this->Inhoud_model->leegMaken($sjabloon);

        //Parameters model laden en inhoud ophalen waar het typeInhoudId 3 is, dit zijn sjablonen
        $this->load->model('Inhoud_model');
        $sjablonen = $this->Inhoud_model->getInhoudWhereTypeInhoudId("3");

        $data['sjablonen'] = $sjablonen;

        //Terug naar Sjablonen beheren gaan
        $partials = array( 'navigatie' => 'main_menu', 'inhoud' => 'administrator/sjablonenBeheren');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Haalt de inhoud-records op waar TypeInhoudId 1 is
     * van Inhoud_model en toont het resulterende object in de view websiteBeheren.php
     *
     * @see Inhoud_model::getInhoudWhereTypeInhoudId()
     * @see websiteBeheren.php
     */
    public function websiteBeheren(){
        //titel veranderen naar Website Beheren
        $data['titel'] = 'Website beheren';
        //Gebruikersinformatie ophalen
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['gemaaktDoor'] = "Kilian Fastenakels";
        //Variabel aanmaken om sjablonen in op te slagen


        //Administrator model laden en inhoud ophalen waar het paginaId juist is
        $this->load->model('Inhoud_model');
        $teBeherenText = $this->Inhoud_model->getInhoudWhereTypeInhoudId("1");

        $data['teBeherenText'] = $teBeherenText;

        //bevestiging pagina tonen
        $partials = array( 'navigatie' => 'main_menu', 'inhoud' => 'administrator/websiteBeheren');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Slaagt de aangepaste inhoud-records op
     * via Inhoud_model en toont het resulterende object in de view websiteBeheren.php
     *
     * @see Inhoud_model::updateText()
     * @see websiteBeheren.php
     */
    public function websiteOpslagen(){
        //titel veranderen naar Website Beheren
        $data['titel'] = 'Website beheren';
        //Gebruikersinformatie ophalen
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['gemaaktDoor'] = "Kilian Fastenakels";

        $teBeherenText = new stdClass();
        $this->load->model('Inhoud_model');
        for($i = 0; $i < 7; $i++){
            $teBeherenText->id = $this->input->post('id' . $i);
            $teBeherenText->titel = $this->input->post('titel' . $i);
            $teBeherenText->inhoud = $this->input->post('inhoud' . $i);
            $this->Inhoud_model->updateText($teBeherenText);
        }

        $nieuweText = $this->Inhoud_model->getInhoudWhereTypeInhoudId("1");

        $data['teBeherenText'] = $nieuweText;

        //bevestiging pagina tonen
        $partials = array( 'navigatie' => 'main_menu', 'inhoud' => 'administrator/websiteBeheren');
        $this->template->load('main_master', $partials, $data);
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
                'inhoud' => 'administrator/gebruikersBeheren');
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

        $this->load->view("administrator/ajax_gebruikers", $data);
    }

    public function gebruikerToevoegen() {
        $data['titel'] = "Gebruiker toevoegen";
        $data['gemaaktDoor'] = 'Christophe Van Hoof';

        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        if($this->session->has_userdata('gebruiker_id')) {

            $this->load->model('Gebruiker_model');
            $data['hoogsteNummer'] = $this->Gebruiker_model->getHighestMmcNummer();

            $partials = array( 'navigatie' => 'main_menu',
                'inhoud' => 'administrator/gebruikerToevoegen');
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
                'inhoud' => 'administrator/gebruikerBewerken');
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

                redirect('administrator/toonMeldingRegistratieOk/' . $soortId[0]);
            } else {
                if(!$erkenningVrij) {
                    redirect('administrator/toonMeldingErkenningBestaat');
                } else {
                    redirect('administrator/toonMeldingGebruikersnaamBestaat');
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

            redirect('administrator/toonMeldingWijzigingOk/' . $soortId[0]);

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
            'inhoud' => 'administrator/melding');
        $this->template->load('main_master', $partials, $data);
    }

    public function toonMeldingErkenningBestaat() {
        $this->toonMelding('Fout', 'Erkenningsnummer bestaat reeds. Probeer opnieuw!', array("url" => "/administrator/gebruikerToevoegen", "tekst" => "Terug"));
    }

    public function toonMeldingGebruikersnaamBestaat() {
        $this->toonMelding('Fout', 'Gebruikersnaam bestaat reeds. Probeer opnieuw!', array("url" => "/administrator/gebruikerToevoegen", "tekst" => "Terug"));
    }

    public function toonMeldingRegistratieOk($soortId) {
        $this->toonMelding('Gelukt!', 'De gebruiker is succesvol aangemaakt!', array("url" => "/administrator/gebruikersBeheren/" . $soortId, "tekst" => "Terug"));
    }

    public function toonMeldingWijzigingOk($soortId) {
        $this->toonMelding('Gelukt!', 'De gebruiker is succesvol gewijzigd!', array("url" => "/administrator/gebruikersBeheren/" . $soortId, "tekst" => "Terug"));
    }
}
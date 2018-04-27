<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 3/9/2018
 * Time: 1:20 PM
 */

class Administrator extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        //De Template library inladen
        $this->load->library('Template');
    }

    public function index(){
        //titel veranderen naar Parameters
        $data['titel'] = 'Parameters';
        //Gebruikersinformatie ophalen
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['gemaaktDoor'] = "Kilian Fastenakels";

        //Templates definieren en inladen
        $partials = array( 'navigatie' => 'main_menu', 'inhoud' => 'administrator/parameters');
        $this->template->load('main_master', $partials, $data);
    }

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

    public function mmcMedewerkersBeheren(){
        $data['titel'] = 'MMC Medewerkers Beheren';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['gemaaktDoor'] = "Kilian Fastenakels";

        //Templates definieren en inladen
        $partials = array( 'navigatie' => 'main_menu', 'inhoud' => 'administrator/mmcMedewerkerBeheren');
        $this->template->load('main_master', $partials, $data);
    }

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

    public function websiteOpslagen(){
        //titel veranderen naar Website Beheren
        $data['titel'] = 'Website beheren';
        //Gebruikersinformatie ophalen
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['gemaaktDoor'] = "Kilian Fastenakels";
        $teBeherenText1 = new stdClass();
        $teBeherenText2 = new stdClass();
        $teBeherenText3 = new stdClass();
        $teBeherenText4 = new stdClass();
        $teBeherenText5 = new stdClass();
        $teBeherenText6 = new stdClass();
        $teBeherenText7 = new stdClass();

        $teBeherenText1->id = $this->input->post('id1');
        $teBeherenText1->titel = $this->input->post('titel1');
        $teBeherenText1->inhoud = $this->input->post('inhoud1');
        $teBeherenText2->id = $this->input->post('id2');
        $teBeherenText2->titel = $this->input->post('titel2');
        $teBeherenText2->inhoud = $this->input->post('inhoud2');
        $teBeherenText3->id = $this->input->post('id3');
        $teBeherenText3->titel = $this->input->post('titel3');
        $teBeherenText3->inhoud = $this->input->post('inhoud3');
        $teBeherenText4->id = $this->input->post('id4');
        $teBeherenText4->titel = $this->input->post('titel4');
        $teBeherenText4->inhoud = $this->input->post('inhoud4');
        $teBeherenText5->id = $this->input->post('id5');
        $teBeherenText5->titel = $this->input->post('titel5');
        $teBeherenText5->inhoud = $this->input->post('inhoud5');
        $teBeherenText6->id = $this->input->post('id6');
        $teBeherenText6->titel = $this->input->post('titel6');
        $teBeherenText6->inhoud = $this->input->post('inhoud6');
        $teBeherenText7->id = $this->input->post('id7');
        $teBeherenText7->inhoud = $this->input->post('inhoud7');

        //Inhoud model laden en de database updaten
        $this->load->model('Inhoud_model');
        $this->Inhoud_model->updateText($teBeherenText1, $teBeherenText2, $teBeherenText3, $teBeherenText4, $teBeherenText5, $teBeherenText6, $teBeherenText7);
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
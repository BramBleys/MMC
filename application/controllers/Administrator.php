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
}
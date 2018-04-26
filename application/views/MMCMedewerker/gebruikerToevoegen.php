

<?php


echo heading($titel,2,'class="mb-3"') . "\n";
echo form_open('MMCMedewerker/voegToe');
echo heading('Persoon',3,'class="mb-2"') . "\n";

?>

<div class="form-row">
    <div class="col">
        <?php

        echo "<p>" .
            form_label('Voornaam', 'voornaam') .
            "<br>" .
            form_input('voornaam','','id="voornaam" class="form-control"') .
            "</p>\n";

        echo "<p>" .
            form_label('Naam', 'naam') .
            "<br>" .
            form_input('naam','','id="naam" class="form-control"') .
            "</p>\n";

        echo "<p>" .
            form_label('Gebruikersnaam', 'gebruikersnaam') .
            "<br>" .
            form_input('gebruikersnaam','','id="gebruikersnaam" class="form-control"') .
            "</p>\n";

        echo "<p>" .
            form_label('Wachtwoord', 'wachtwoord') .
            "<br>" .
            form_password('wachtwoord','','id="wachtwoord" class=" form-control"') .
            "</p>\n";

        echo "<p>" .
            form_label('MMC-nummer', 'mmcNummer') .
            "<br>" .
            form_input('mmcNummer','','id="mmcNummer" class="form-control"') .
            "</p>\n";

        ?>
    </div>
    <div class="col">
        <?php

        echo "<p>" .
            form_label('Telefoonnummer', 'telefoonnummer') .
            "<br>" .
            form_input('telefoonnummer','','id="telefoonnummer" class="form-control"') .
            "</p>\n";

        echo "<p>" .
            form_label('E-mail', 'email') .
            "<br>" .
            form_input('email','','id="email" class="form-control"') .
            "</p>\n";

        echo "<p>" .
            form_label('Erkenningsnummer', 'erkenningsNummer') .
            "<br>" .
            form_input('erkenningsNummer','','id="erkenningsNummer" class="form-control"') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12">
        <?php

        echo heading('Adres',3,'class="mb-2"') . "\n";

        ?>
    </div>
    <div class="col-5">
        <?php

        echo "<p>" .
            form_label('Postcode', 'postcode') .
            "<br>" .
            form_input('postcode','','id="postcode" class="form-control"') .
            "</p>\n";

        ?>
    </div>
    <div class="col-7">
        <?php

        echo "<p>" .
            form_label('Gemeente', 'gemeente') .
            "<br>" .
            form_input('gemeente','','id="gemeente" class="form-control"') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12">
        <?php

        echo "<p>" .
            form_label('Straat + Nr. + Bus', 'straatEnNummer') .
            "<br>" .
            form_input('straatEnNummer','','id="straatEnNummer" class="form-control"') .
            "</p>\n";

        echo heading('Overige',3,'class="mb-2"') . "\n";

        ?>
    </div>
    <div class="col-4">
        <?php

        $options = array(
            '0' =>  'inactief',
            '1' =>  'actief'
        );

        echo "<p>" .
            form_label('Status', 'inactief') .
            "<br>" .
            form_dropdown('inactief',$options, '1', 'id="inactief" class="custom-select"');

        $options = array(
            '1' =>  'Minder Mobiele',
            '2' =>  'Coach',
            '3' =>  'Vrijwilliger'
        );

        echo "<p>" .
            form_label('Type gebruiker', 'type') .
            "<br>" .
            form_multiselect('type[]', $options, '' , 'id="type" class="custom-select"') .
            "</p>\n";

        ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="d-flex flex-nowrap justify-content-end">
        <?php

        echo form_submit('submit','Gebruiker toevoegen', 'class="btn btn-primary order-2"');
        echo form_close();

        echo anchor('MMCMedewerker/gebruikersBeheren/1','Annuleren','class="btn btn-outline-primary mr-2 order-1"');

        ?>
        </div>
    </div>
</div>

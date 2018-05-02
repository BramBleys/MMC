<?php

echo heading($titel,2,'class="mb-3"') . "\n";

echo form_open('MMCMedewerker/wijzigAanvraag', 'class="needs-validation" novalidate');

echo heading('Persoon',3,'class="mb-2"') . "\n";

?>

<div class="form-row">
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Naam passagier', 'passagier') .
            "<br>" .
            form_input('passagier','','id="voornaam" class="form-control" disabled') .
            "<span class=\"invalid-feedback\">Vul hier de voornaam van de gebruiker in</span>" .
            "</p>\n";

        echo "<p>" .
            form_label('MMC-nummer', 'mmcNummer') .
            "<br>" .
            form_input('',$rit->minderMobiele->mmcNummer,'id="mmcNummer" class="form-control" disabled') .
            form_hidden('mmcNummer', $rit->minderMobiele->mmcNummer);
        "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Naam', 'coach') .
            "<br>" .
            form_input('naam','','id="naam" class="form-control"required') .
            "<span class=\"invalid-feedback\">Vul hier de achternaam van de gebruiker in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Telefoonnummer', 'telefoonnummer') .
            "<br>" .
            form_input('telefoonnummer','','id="telefoonnummer" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier het telefoonnummer in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('E-mail', 'email') .
            "<br>" .
            form_input('email','','id="email" class="form-control"') .
            "<span class=\"invalid-feedback\">Vul hier het e-mailadres in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Erkenningsnummer', 'erkenningsNummer') .
            "<br>" .
            form_input('erkenningsNummer','','id="erkenningsNummer" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier het erkenningsnummer van de overheid in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('MMC-nummer', 'mmcNummer') .
            "<br>" .
            form_input('',$rit->minderMobiele->mmcNummer,'id="mmcNummer" class="form-control" disabled') .
            form_hidden('mmcNummer', $rit->minderMobiele->mmcNummer);
        "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php



        ?>
    </div>
    <div class="col-12">
        <?php

        echo heading('Adres',3,'class="mb-2"') . "\n";

        ?>
    </div>
    <div class="col-4">
        <?php

        echo "<p>" .
            form_label('Postcode', 'postcode') .
            "<br>" .
            form_input('postcode','','id="postcode" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de postcode in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-8">
        <?php

        echo "<p>" .
            form_label('Gemeente', 'gemeente') .
            "<br>" .
            form_input('gemeente','','id="gemeente" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de gemeente in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12">
        <?php

        echo "<p>" .
            form_label('Straat + Nr. + Bus', 'straatEnNummer') .
            "<br>" .
            form_input('straatEnNummer','','id="straatEnNummer" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de straat, nummer en eventueel busnummer in</span>" .
            "</p>\n";

        echo heading('Account',3,'class="mb-2"') . "\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Gebruikersnaam', 'gebruikersnaam') .
            "<br>" .
            form_input('gebruikersnaam','','id="gebruikersnaam" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier een gebruikersnaam in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Wachtwoord', 'wachtwoord') .
            "<br>" .
            form_password('wachtwoord','','id="wachtwoord" class=" form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier een wachtwoord in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        $options = array(
            '1' =>  'Minder Mobiele',
            '2' =>  'Coach',
            '3' =>  'Vrijwilliger'
        );

        echo "<p>" .
            form_label('Type gebruiker', 'type') .
            "<br>" .
            form_multiselect('type[]', $options, '' , 'id="type" class="custom-select" required') .
            "<span class=\"invalid-feedback\">Kies hier het type gebruiker</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        $options = array(
            '1' =>  'actief',
            '0' =>  'inactief'
        );

        echo "<p>" .
            form_label('Status', 'inactief') .
            "<br>" .
            form_dropdown('inactief',$options, '1', 'id="inactief" class="custom-select"');

        ?>
    </div>
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


<?php


echo heading($titel,2,'class="mb-3"') . "\n";
echo form_open();
echo heading('Persoon',3,'class="mb-2"') . "\n";


?>
<div class="form-row">
    <div class="col">
        <?php

        echo "<p>" .
            form_label('Voornaam', 'voornaam') .
            "<br>" .
            form_input('',$account->voornaam,'id="voornaam" class="form-control"') .
            "</p>\n";

        echo "<p>" .
            form_label('Naam', 'naam') .
            "<br>" .
            form_input('',$account->naam,'id="naam" class="form-control"') .
            "</p>\n";

        echo "<p>" .
            form_label('MMC-nummer', 'mmcNummer') .
            "<br>" .
            form_input('',$account->mmcNummer,'id="mmcNummer" class="form-control"') .
            "</p>\n";

        ?>
    </div>
    <div class="col">
        <?php

        echo "<p>" .
            form_label('Telefoonnummer', 'tel') .
            "<br>" .
            form_input('',$account->telefoonnummer,'id="tel" class="form-control"') .
            "</p>\n";

        echo "<p>" .
            form_label('E-mail', 'mail') .
            "<br>" .
            form_input('',$account->email,'id="mail" class="form-control"') .
            "</p>\n";

        echo "<p>" .
            form_label('Erkenningsnummer', 'erkenningsNummer') .
            "<br>" .
            form_input('',$account->erkenningsNummer,'id="erkenningsNummer" class="form-control"') .
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
            form_input('',$account->postcode,'id="postcode" class="form-control"') .
            "</p>\n";

        ?>
    </div>
    <div class="col-7">
        <?php

        echo "<p>" .
            form_label('Gemeente', 'gemeente') .
            "<br>" .
            form_input('',$account->gemeente,'id="gemeente" class="form-control"') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12">
        <?php

        echo "<p>" .
            form_label('Straat + Nr. + Bus', 'straatEnNr') .
            "<br>" .
            form_input('',$account->straatEnNummer,'id="straatEnNr" class="form-control"') .
            "</p>\n";

        echo heading('Overige',3,'class="mb-2"') . "\n";

        ?>
    </div>
    <div class="col-4">
        <?php

        $options = array(
                '1' =>  'Minder Mobiele',
                '2' =>  'Coach',
                '3' =>   'Vrijwilliger',
        );

        echo "<p>" .
            form_label('Type gebruiker', 'type') .
            "<br>" .
            form_multiselect('type', $options, $account->soortId , 'id="type" class="custom-select"') .
            "</p>\n";

        ?>
    </div>
</div>
<div class="row justify-content-end">
    <div class="col-12">
        <?php

        echo anchor('','Annuleren','class="btn btn-outline-primary mr-2"');
        echo form_submit('submit','Wijzigingen opslaan', 'class="btn btn-primary"');
        echo form_close();

        ?>
    </div>
</div>

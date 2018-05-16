<?php

/**
 * @file administrator/gebruikerBewerken.php
 *
 * View voor het bewerken van een gebruiker
 *  - krijgt een $gebruiker-object binnen
 */

echo heading($titel,2,'class="mb-3"') . "\n";

echo form_open('administrator/wijzig', 'class="needs-validation" novalidate');
echo form_hidden('id', $account->id);

echo heading('Persoon',3,'class="mb-2"') . "\n";

?>

<div class="form-row">
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Voornaam', 'voornaam') .
            "<br>" .
            form_input('voornaam',$account->voornaam,'id="voornaam" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de voornaam van de gebruiker in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Naam', 'naam') .
            "<br>" .
            form_input('naam',$account->naam,'id="naam" class="form-control"required') .
            "<span class=\"invalid-feedback\">Vul hier de achternaam van de gebruiker in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Telefoonnummer', 'telefoonnummer') .
            "<br>" .
            form_input('telefoonnummer',$account->telefoonnummer,'id="telefoonnummer" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier het telefoonnummer in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('E-mail', 'email') .
            "<br>" .
            form_input('email',$account->email,'id="email" class="form-control"') .
            "<span class=\"invalid-feedback\">Vul hier het e-mailadres in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Erkenningsnummer', 'erkenningsNummer') .
            "<br>" .
            form_input('erkenningsNummer',$account->erkenningsNummer,'id="erkenningsNummer" class="form-control" disabled') .
            form_hidden('erkenningsNummer', $account->erkenningsNummer) .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('MMC-nummer', 'mmcNummer') .
            "<br>" .
            form_input('',$account->mmcNummer,'id="mmcNummer" class="form-control" disabled') .
            form_hidden('mmcNummer', $account->mmcNummer);
        "</p>\n";

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
            form_input('postcode',$account->postcode,'id="postcode" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de postcode in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-8">
        <?php

        echo "<p>" .
            form_label('Gemeente', 'gemeente') .
            "<br>" .
            form_input('gemeente',$account->gemeente,'id="gemeente" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de gemeente in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12">
        <?php

        echo "<p>" .
            form_label('Straat + Nr. + Bus', 'straatEnNummer') .
            "<br>" .
            form_input('straatEnNummer',$account->straatEnNummer,'id="straatEnNummer" class="form-control" required') .
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
            form_input('gebruikersnaam',$account->gebruikersnaam,'id="gebruikersnaam" class="form-control" disabled') .
            form_hidden('gebruikersnaam', $account->gebruikersnaam) .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6"></div>
    <div class="col-12 col-md-6">
        <?php

        $options = array(
            '1' =>  'Minder Mobiele',
            '2' =>  'Coach',
            '3' =>  'Vrijwilliger',
            '4' =>  'MMC Medewerkergt'
        );

        echo "<p>" .
            form_label('Type gebruiker', 'type') .
            "<br>" .
            form_multiselect('type[]', $options, $account->soortId , 'id="type" class="custom-select" required') .
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
            form_dropdown('inactief',$options, $account->inactief, 'id="inactief" class="custom-select"');

        ?>
    </div>
    <div class="col-12">
        <div class="d-flex flex-nowrap justify-content-end">
            <?php

            echo form_submit('submit','Wijzigingen opslaan', 'class="btn btn-primary order-2"');
            echo form_close();

            echo anchor('administrator/gebruikersBeheren/' . $account->soortId,'Annuleren','class="btn btn-outline-primary mr-2 order-1"');

            ?>
        </div>
    </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<?php

/**
 * @file MMCMedewerker/aanvraagToevoegen.php
 *
 */

?>

<script>
    function zoekChauffeur() {
        $.ajax({type : "GET",
            url : site_url + "/MMCMedewerker/haalAjaxOp_AlleChauffeurs",
            data : { },
            success : function(result){
                $("#resultaat").html(result);
                $('#modalGebruiker').modal('show');

            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    function zoekPassagier() {
        $.ajax({type : "GET",
            url : site_url + "/MMCMedewerker/haalAjaxOp_AllePassagiers",
            data : { },
            success : function(result){
                $("#resultaat").html(result);
                $('#modalGebruiker').modal('show');

            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    $(document).ready(function(){
        $("#terugRitResultaat").hide();

        $( ".zoekChauffeur" ).click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            zoekChauffeur(id);
        });

        $( ".zoekPassagier" ).click(function(e) {
            e.preventDefault();
            zoekPassagier();
        });

        $( "#thuisAdres" ).change(function(e) {
            e.preventDefault();

            if($("#thuisAdres").is(":checked")) {
                $("#thuisAdresResultaat").hide();
                $("#postcodeVertrek").val('0000');
                $("#gemeenteVertrek").val('Mol');
                $("#straatEnNummerVertrek").val('Klein 1');

            } else {
                $("#thuisAdresResultaat").show();
                $("#postcodeVertrek").val('');
                $("#gemeenteVertrek").val('');
                $("#straatEnNummerVertrek").val('');
            }
        });

        $("#terugRit").change(function() {
            if($("#terugRit").is(":checked")) {
                $("#terugRitResultaat").show();
                $("#datumTerug").attr("min",$("#datumHeen").val());
            } else {
                $("#terugRitResultaat").hide();
            }
        });
    });
</script>

<?php

echo heading($titel,2,'class="mb-3"') . "\n";

echo form_open('MMCMedewerker/voegToeAanvraag', 'class="needs-validation" novalidate');

echo heading('Persoonsgegevens',3,'class="mb-2"') . "\n";
?>
<div class="form-row">
    <div class="col-12">
        <?php

        echo heading('Passagier',5,'class="mb-2"') . "\n";
        echo anchor('', 'Zoek een passagier', array('class' => 'btn btn-primary mb-2 zoekPassagier')) . "\n";

        ?>
    </div>
</div>
<div class="form-row" id="passagierResultaat">
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Naam', 'passagierNaam') .
            "<br>" .
            form_input('passagierNaam','','id="passagierNaam" class="form-control" disabled') .
            form_hidden("passagierId",'');
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('MMC-nummer', 'passagierMmcNummer') .
            "<br>" .
            form_input('passagierMmcNummer','','id="passagierMmcNummer" class="form-control" disabled') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12">
        <?php

        echo heading('Coach',5,'class="mb-2"') . "\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Naam', 'coachNaam') .
            "<br>" .
            form_input('coachNaam','','id="coachNaam" class="form-control" disabled') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('MMC-nummer', 'coachMmcNummer') .
            "<br>" .
            form_input('coachMmcNummer','','id="coachMmcNummer" class="form-control" disabled') .
        "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Telefoonnummer', 'coachTelefoonnummer') .
            "<br>" .
            form_input('coachTelefoonnummer','','id="coachTelefoonnummer" class="form-control" disabled') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('E-mail', 'coachEmail') .
            "<br>" .
            form_input('coachEmail','','id="coachEmail" class="form-control" disabled') .
            "</p>\n";

        ?>
    </div>
</div>
<div class="form-row">
    <div class="col-12">
        <?php

        echo heading('Chauffeur',5,'class="mb-2"') . "\n";
        echo anchor('', 'Zoek een chauffeur', array('class' => 'btn btn-primary mb-2 zoekChauffeur')) . "\n";

        ?>
    </div>
</div>
<div class="form-row" id="chauffeur">
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Naam', 'vrijwilligerNaam') .
            "<br>" .
            form_input('vrijwilligerNaam','','id="vrijwilligerNaam" class="form-control" disabled') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('MMC-nummer', 'vrijwilligerMmcNummer') .
            "<br>" .
            form_input('vrijwilligerMmcNummer','','id="vrijwilligerMmcNummer" class="form-control" disabled') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Telefoonnummer', 'vrijwilligerTelefoonnummer') .
            "<br>" .
            form_input('vrijwilligerTelefoonnummer','','id="vrijwilligerTelefoonnummer" class="form-control" disabled') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('E-mail', 'vrijwilligerEmail') .
            "<br>" .
            form_input('vrijwilligerEmail','','id="vrijwilligerEmail" class="form-control" disabled') .
            "</p>\n";

        ?>
    </div>
</div>
<div class="form-row">
    <div class="col-12">
        <?php

        echo heading('Ritgegevens',3,'class="mb-2"') . "\n" .
            heading('Vertrek',5,'class="mb-2"') . "\n";

        ?>
    </div>
</div>
<div class="form-row">
    <div class="col-12">
        <?php

        $checkbox = array(
            'name'          => 'thuisAdres',
            'id'            => 'thuisAdres',
            'value'         => ''
        );

        echo form_checkbox($checkbox);
        echo form_label('De rit start bij het thuisadres van de passagier','thuisAdres', 'class="ml-1"');

        ?>
    </div>
</div>
<div class="form-row" id="thuisAdresResultaat">
    <div class="col-4">
        <?php

        echo "<p>" .
            form_label('Postcode', 'postcodeVertrek') .
            "<br>" .
            form_input('postcodeVertrek','','id="postcodeVertrek" pattern="[0-9]{4}" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de postcode in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-8">
        <?php

        echo "<p>" .
            form_label('Gemeente', 'gemeenteVertrek') .
            "<br>" .
            form_input('gemeenteVertrek','','id="gemeenteVertrek" pattern=".{2,}" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de gemeente in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12">
        <?php

        echo "<p>" .
            form_label('Straat + Nr. + Bus', 'straatEnNummerVertrek') .
            "<br>" .
            form_input('straatEnNummerVertrek','','id="straatEnNummerVertrek" pattern=".{2,} [0-9]{1,}.*" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de straat, nummer en eventueel busnummer in</span>" .
            "</p>\n";

        ?>
    </div>
</div>
<div class="form-row">
    <div class="col-6">
        <?php

        $vandaag = date('Y-m-d');

        echo "<p>" .
            form_label('Datum', 'datumHeen') .
            "<br>" .
            '<input type="date" id="datumHeen" value="" name="datumHeen" class="form-control" min="' . $vandaag . '" required/>' .
            "<span class=\"invalid-feedback\">Vul hier de datum in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-6">
        <?php

        echo "<p>" .
            form_label('Uur', 'uurHeen') .
            "<br>" .
            '<input type="time" id="uurHeen" value="" name="uurHeen" class="form-control" required/>' .
            "<span class=\"invalid-feedback\">Vul hier het vertrekuur in</span>" .
            "</p>\n";
        ?>
    </div>
    <div class="col-12">
        <?php

        echo heading('Bestemming',5,'class="mb-2"') . "\n";

        ?>
    </div>
    <div class="col-4">
        <?php

        echo "<p>" .
            form_label('Postcode', 'postcodeBestemming') .
            "<br>" .
            form_input('postcodeBestemming','','id="postcodeBestemming" pattern="[0-9]{4}" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de postcode in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-8">
        <?php

        echo "<p>" .
            form_label('Gemeente', 'gemeenteBestemming') .
            "<br>" .
            form_input('gemeenteBestemming','','id="gemeenteBestemming" pattern=".{2,}" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de gemeente in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12">
        <?php

        echo "<p>" .
            form_label('Straat + Nr. + Bus', 'straatEnNummerBestemming') .
            "<br>" .
            form_input('straatEnNummerBestemming','','id="straatEnNummerBestemming" pattern=".{2,} [0-9]{1,}.*" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de straat, nummer en eventueel busnummer in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12">
        <?php

        echo heading('Terugrit',5,'class="mb-2"') . "\n";

        $checkbox = array(
            'name'          => 'terugRit',
            'id'            => 'terugRit',
            'value'         => 'checked'
        );

        echo form_checkbox($checkbox);
        echo form_label('Terugrit ingeven','terugRit', 'class="ml-1"');

        ?>
    </div>
</div>
<div class="form-row" id="terugRitResultaat">
    <div class="col-6">
        <?php

        echo "<p>" .
            form_label('Datum', 'datumTerug') .
            "<br>" .
            '<input type="date" id="datumTerug" value="" name="datumTerug" class="form-control" min="' . $vandaag . '"/>' .
            "<span class=\"invalid-feedback\">Vul hier de datum in</span>" .
            "</p>\n";
        ?>
    </div>
    <div class="col-6">
        <?php

        echo "<p>" .
            form_label('Uur', 'uurTerug') .
            "<br>" .
            '<input type="time" id="uurTerug" value="" name="uurTerug" class="form-control"/>' .
            "<span class=\"invalid-feedback\">Vul hier het uur in</span>" .
            "</p>\n";
        ?>
    </div>
</div>
<div class="form-row">
    <div class="col-12">
        <?php

        echo heading('Opmerkingen',5,'class="mb-2"') . "\n";

        $textarea = array(
            'name'        => 'opmerkingen',
            'id'          => 'opmerkingen',
            'class'       => 'form-control',
            'rows'        => '5'
        );

        echo "<p>" .
            form_label('Vul hier opmerkingen aan indien nodig', 'opmerkingen') .
            "<br>" .
            form_textarea($textarea) .
            "</p>\n";
        ?>
    </div>
    <div class="col-12">
        <div class="d-flex flex-nowrap justify-content-end">
            <?php

            echo form_submit('submit','Aanvraag bevestigen', 'class="btn btn-primary order-2"');
            echo form_close();

            echo anchor('MMCMedewerker/aanvragenBeheren/','Annuleren','class="btn btn-outline-primary mr-2 order-1"');

            ?>
        </div>
    </div>
</div>

<!-- Dialoogvenster -->
<div class="modal fade" id="modalGebruiker" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Inhoud dialoogvenster-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gebruiker zoeken</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div id="resultaat"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
            </div>
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
<script>
    function zoekChauffeur(id) {
        $.ajax({type : "GET",
            url : site_url + "/MMCMedewerker/haalAjaxOp_Chauffeurs",
            data : { ritId : id },
            success : function(result){
                $("#resultaat").html(result);
                $('#modalChauffeur').modal('show');

            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    function thuisAdresInvullen(checked, gebruikerId) {
        $.ajax({type : "GET",
            url : site_url + "/MMCMedewerker/haalAjaxOp_thuisAdres",
            data : { checked: checked, gebruikerId : gebruikerId },
            success : function(result){
                $("#vertrekAdres").html(result);
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    $(document).ready(function(){
        if($("#terugRit").is(":checked")) {
            $("#terugRitDiv").show();
        } else {
            $("#terugRitDiv").hide();
        }

        $( ".zoekChauffeur" ).click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            zoekChauffeur(id);
        });

        $( "#thuisAdres" ).change(function(e) {
            e.preventDefault();
            var checked = $(this).data('bool');
            var gebruikerId = $(this).data('id');
            thuisAdresInvullen(checked, gebruikerId);
        });

        $("#terugRit").change(function() {
            if($("#terugRit").is(":checked")) {
                $("#terugRitDiv").show();
            } else {
                $("#terugRitDiv").hide();
            }
        });
    });
</script>

<?php

echo heading($titel,2,'class="mb-3"') . "\n";

echo form_open('MMCMedewerker/wijzigAanvraag', 'class="needs-validation" novalidate');

echo heading('Persoonsgegevens',3,'class="mb-2"') . "\n";
?>

<div class="form-row">
    <div class="col-12">
        <?php

        echo heading('Passagier',5,'class="mb-2"') . "\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Naam', 'passagier') .
            "<br>" .
            form_input('passagier',$rit->minderMobiele->voornaam . ' ' . $rit->minderMobiele->naam,'id="voornaam" class="form-control" disabled') .
            form_hidden('minderMobieleId', $rit->minderMobiele->id) .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('MMC-nummer', 'mmcNummer') .
            "<br>" .
            form_input('',$rit->minderMobiele->mmcNummer,'id="mmcNummer" class="form-control" disabled') .
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
            form_label('Naam', 'coach') .
            "<br>" .
            form_input('naam',$rit->coach->voornaam . ' ' . $rit->coach->naam,'id="naam" class="form-control" disabled') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('MMC-nummer', 'mmcNummer') .
            "<br>" .
            form_input('',$rit->coach->mmcNummer,'id="mmcNummer" class="form-control" disabled') .
            form_hidden('mmcNummer', $rit->coach->mmcNummer);
        "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Telefoonnummer', 'telefoonnummer') .
            "<br>" .
            form_input('telefoonnummer',$rit->coach->telefoonnummer,'id="telefoonnummer" class="form-control" disabled') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('E-mail', 'email') .
            "<br>" .
            form_input('email',$rit->coach->email,'id="email" class="form-control" disabled') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12">
        <?php

        echo heading('Chauffeur',5,'class="mb-2"') . "\n";
        echo anchor('', 'Zoek een andere chauffeur', array('class' => 'btn btn-primary mb-2 zoekChauffeur', 'data-id' => $rit->id)) . "\n";


        ?>
    </div>
</div>
<div class="form-row" id="chauffeur">
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Naam', 'vrijwilliger') .
            "<br>" .
            form_input('naam',$rit->chauffeur->voornaam . ' ' . $rit->chauffeur->naam,'id="naamVrijwilliger" class="form-control" disabled') .
            form_hidden('vrijwilliger', $rit->chauffeur->id) .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('MMC-nummer', 'mmcNummer') .
            "<br>" .
            form_input('',$rit->chauffeur->mmcNummer,'id="mmcNummerVrijwilliger" class="form-control" disabled') .
        "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('Telefoonnummer', 'telefoonnummer') .
            "<br>" .
            form_input('telefoonnummer',$rit->chauffeur->telefoonnummer,'id="telefoonnummer" class="form-control" disabled') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('E-mail', 'email') .
            "<br>" .
            form_input('email',$rit->chauffeur->email,'id="email" class="form-control" disabled') .
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
<div class="form-row" id="vertrekAdres">
    <div class="col-12">
        <?php

        if ($rit->minderMobiele->straatEnNummer == $rit->vertrekAdres->straatEnNummer) {
            $checked = 1;
        } else {
            $checked = 0;
        }

        $checkbox = array(
            'name'          => 'thuisAdres',
            'id'            => 'thuisAdres',
            'value'         => 'ja',
            'checked'       => $checked,
            'data-bool'     => $checked,
            'data-id'       => $rit->minderMobiele->id
        );

        echo form_checkbox($checkbox);
        echo form_label('De rit start bij het thuisadres van de passagier','thuisAdres', 'class="ml-1"');

        ?>
    </div>
    <div class="col-4">
        <?php

        echo "<p>" .
            form_label('Postcode', 'postcode') .
            "<br>" .
            form_input('postcode','','id="postcode" pattern="[0-9]{4}" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de postcode in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-8">
        <?php

        echo "<p>" .
            form_label('Gemeente', 'gemeente') .
            "<br>" .
            form_input('gemeente','','id="gemeente" pattern=".{2,}" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de gemeente in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12">
        <?php

        echo "<p>" .
            form_label('Straat + Nr. + Bus', 'straatEnNummer') .
            "<br>" .
            form_input('straatEnNummer','','id="straatEnNummer" pattern=".{2,} [0-9]{1,}.*" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de straat, nummer en eventueel busnummer in</span>" .
            "</p>\n";

        ?>
    </div>
</div>
<div class="form-row">
    <div class="col-6">
        <?php

        $vandaag = date('Y-m-d');

        $datum = date_create($rit->vertrekTijdstip);
        $datumHeenRit = date_format($datum, 'Y-m-d');

        $uur = date_create($rit->vertrekTijdstip);
        $uurHeenRit = date_format($uur, 'H:i');

        echo "<p>" .
            form_label('Datum', 'datum') .
            "<br>" .
            '<input type="date" id="datum" value="' . $datumHeenRit . '" name="datum" class="form-control" min="' . $vandaag . '" required/>' .
            "<span class=\"invalid-feedback\">Vul hier de datum in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-6">
        <?php

        echo "<p>" .
            form_label('Uur', 'uur') .
            "<br>" .
            '<input type="time" id="uur" value="' . $uurHeenRit . '" name="uur" class="form-control" required/>' .
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
            form_label('Postcode', 'postcode') .
            "<br>" .
            form_input('postcode','','id="postcode" pattern="[0-9]{4}" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de postcode in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-8">
        <?php

        echo "<p>" .
            form_label('Gemeente', 'gemeente') .
            "<br>" .
            form_input('gemeente','','id="gemeente" pattern=".{2,}" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de gemeente in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12">
        <?php

        echo "<p>" .
            form_label('Straat + Nr. + Bus', 'straatEnNummer') .
            "<br>" .
            form_input('straatEnNummer','','id="straatEnNummer" pattern=".{2,} [0-9]{1,}.*" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de straat, nummer en eventueel busnummer in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-12">
        <?php

        echo heading('Terugrit',5,'class="mb-2"') . "\n";

        $hiddenId = '';
        $datumTerugRit = '';
        $uurTerugRit = '';

        if ($terugRit) {
            $checked = 1;

            $datum = date_create($terugRit->vertrekTijdstip);
            $datumTerugRit = date_format($datum, 'Y-m-d');

            $uur = date_create($terugRit->vertrekTijdstip);
            $uurTerugRit = date_format($uur, 'H:i');

            $hiddenId = $terugRit->id;
        } else {
            $checked = 0;
        }

        $checkbox = array(
            'name'          => 'terugRit',
            'id'            => 'terugRit',
            'value'         => '1',
            'checked'       => $checked,
        );

        echo form_checkbox($checkbox);
        echo form_label('Terugrit ingeven','terugRit', 'class="ml-1"');
        echo form_hidden('terugRitId',$hiddenId);

        ?>
    </div>
</div>
<div class="form-row" id="terugRitDiv">
    <div class="col-6">
        <?php

        $datumHeenRit = date_create($rit->vertrekTijdstip);
        $naHeenRit = date_format($datumHeenRit, 'Y-m-d');

            echo "<p>" .
                form_label('Datum', 'datum') .
                "<br>" .
                '<input type="date" id="datum" value="' . $datumTerugRit . '" name="datum" class="form-control" min="' . $naHeenRit . '"/>' .
                "<span class=\"invalid-feedback\">Vul hier de datum in</span>" .
                "</p>\n";
        ?>
    </div>
    <div class="col-6">
        <?php

        echo "<p>" .
            form_label('Uur', 'uur') .
            "<br>" .
            '<input type="time" id="uur" value="' . $uurTerugRit . '" name="uur" class="form-control"/>' .
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

            echo form_submit('submit','Aanvraag wijzigen', 'class="btn btn-primary order-2"');
            echo form_close();

            echo anchor('MMCMedewerker/aanvragenBeheren/','Annuleren','class="btn btn-outline-primary mr-2 order-1"');

            ?>
        </div>
    </div>
</div>

<!-- Dialoogvenster -->
<div class="modal fade" id="modalChauffeur" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Inhoud dialoogvenster-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chauffeur zoeken</h5>
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
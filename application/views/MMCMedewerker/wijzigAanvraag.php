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

    $(document).ready(function(){

        $( ".zoekChauffeur" ).click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            zoekChauffeur(id);
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
            form_label('Naam', 'coach') .
            "<br>" .
            form_input('naam',$rit->chauffeur->voornaam . ' ' . $rit->chauffeur->naam,'id="naam" class="form-control" disabled') .
            "</p>\n";

        ?>
    </div>
    <div class="col-12 col-md-6">
        <?php

        echo "<p>" .
            form_label('MMC-nummer', 'mmcNummer') .
            "<br>" .
            form_input('',$rit->chauffeur->mmcNummer,'id="mmcNummer" class="form-control" disabled') .
            form_hidden('mmcNummer', $rit->chauffeur->mmcNummer);
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
    <div class="col-12">
        <?php

        if ($rit->minderMobiele->straatEnNummer == $rit->vertrekAdres->straatEnNummer) {
            $checked = true;
        } else {
            $checked = false;
        }

        echo form_radio('thuisAdres','Ja', $checked,'id="thuisAdres"');
        echo form_label('De rit start bij het thuisadres van de passagier','thuisAdres');

        $checkbox = array(
            'name'          => 'thuisAdres',
            'id'            => 'thuisAdres',
            'value'         => 'ja',
            'checked'       => $checked,
        );

        echo form_checkbox($checkbox);


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

        ?>
    </div>
    <div class="col-6">
        <?php

        echo "<p>" .
            form_label('Datum', 'datum') .
            "<br>" .
            form_input('datum','','id="datum" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de gemeente in</span>" .
            "</p>\n";

        ?>
    </div>
    <div class="col-6">
        <?php

        echo "<p>" .
            form_label('Uur', 'uur') .
            "<br>" .
            form_input('uur','','id="uur" class="form-control" required') .
            "<span class=\"invalid-feedback\">Vul hier de gemeente in</span>" .
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
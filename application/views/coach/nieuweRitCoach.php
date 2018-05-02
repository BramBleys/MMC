<script>
    function haalRittenWeekOp(id, datum) {
        $.ajax({type: "GET",
            url: site_url + "/MinderMobiele/haalJsonOp_RittenWeek",
            data: {gebruikerId: id,
                datum: datum},
            success: function (result) {
                try {
                    var ritten = jQuery.parseJSON(result);
                    var aantalRitten = ritten.length;
                    var maxRitten = $('input[name="maxRitten"').val();
                    console.log(aantalRitten);
                    console.log(maxRitten);
                    console.log(maxRitten - aantalRitten);
                    if(maxRitten - aantalRitten <= 0){
                        $('#popupKnop').attr("disabled", "disabled");
                        $('#popupKnop').attr("style", "pointer-events: none;");
                        $('#popupKnopTooltip').attr("data-original-title", "Je heb jouw " + maxRitten + " ritten voor de gekozen week al gebruikt.");
                    } else {
                        $('#popupKnop').removeAttr("disabled");
                        $('#popupKnop').removeAttr("style");
                        $('#popupKnopTooltip').attr("data-original-title", "Je heb nog " + (maxRitten - aantalRitten) + " ritten voor de gekozen week over.");
                    }
                } catch (error) {
                    alert("-- ERROR IN JSON --\n" + result);
                }
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        var accountId;
        $("#vertrekGegevens").hide();
        $("#terugritGegevens").hide();

        $('select[name="minderMobielen"]').change(function(){
            accountId = $(this).val();

            var datum = $('#datum').val();
            haalRittenWeekOp(accountId, datum);
            $('input[name="gekozenAccountId"]').val(accountId);
            $('.naamTitel').text($('select[name="minderMobielen"] option:selected' ).text());
        });

        $("#checkboxVertrek").click(function () {
            if ($("#vertrekPlaats").is(':checked')) {
                $("#vertrekGegevens input").attr("required", "required");
                $("#vertrekGegevens").slideDown(500);
            } else {
                $("#vertrekGegevens input").removeAttr("required");
                $("#vertrekGegevens").slideUp(500);
            }
        });
        $("#checkboxTerugrit").click(function () {
            if ($("#terugRit").is(':checked')) {
                $("#terugritGegevens input[type='date'],#terugritGegevens input[type='time']").attr("required", "required");
                $("#terugritGegevens").slideDown(500);
            } else {
                $("#terugritGegevens input[type='date'],#terugritGegevens input[type='time']").removeAttr("required");
                $("#terugritGegevens").slideUp(500);
            }
        });
        $("#datum").blur(function () {
            var datum = $(this).val();
            var id = $('input[name="accountId"').val();
            haalRittenWeekOp(id, datum);
        });
    });
</script>
<?php
if(count($minderMobielen)!=0) {
    echo "<h2>$titel voor <span class=\"naamTitel\">$gekozenAccount->voornaam $gekozenAccount->naam</span></h2>\n";
    echo "<div class=\"form-row\">\n<div class=\"col-md-4\">";
    echo form_labelpro('Persoon', 'minderMobielen');
    $dataDropdown = array();
    $idArray = str_split($gebruiker->soortId);
    if(in_array('1', $idArray)){
        $dataDropdown[$gebruiker->id] = "$gebruiker->voornaam $gebruiker->naam";
    }
    foreach ($minderMobielen as $minderMobiele) {
        $dataDropdown[$minderMobiele->id] = "$minderMobiele->voornaam $minderMobiele->naam";
    }
    echo form_dropdown('minderMobielen', $dataDropdown, $gekozenAccount->id, array('class' => 'form-control')) . "\n";
    echo "</div>\n</div>";
    echo form_hidden('accountId', $gekozenAccount->id);
    echo "<hr>\n";?>
    <h3 class="marginTop">Rit gegevens</h3>
    <?php
    echo form_hidden('gebruikerId', $gebruiker->id) . "\n";
    echo form_hidden('maxRitten', $parameters->maxRitten) . "\n";
    $attributenFormulier = array('id' => 'mijnFormulier',
        'class' => 'needs-validation',
        'novalidate' => 'novalidate');
    echo form_open('coach/ritToevoegen', $attributenFormulier);
    echo form_hidden('gekozenAccountId', $gekozenAccount->id);
    ?>
    <div class="form-row">
        <div class="col-sm-6">
            <?php
            echo form_labelpro('Datum', 'datum');
            $dataDatum = array('name' => 'datum',
                'id' => 'datum',
                'class' => 'form-control',
                'required' => 'required',
                'type' => 'date',
                'min' => date("Y-m-d", strtotime("+3 Days", strtotime("+$parameters->annulatieTijd hours")))
            );
            echo form_input($dataDatum) . "\n";
            ?>
            <div class="invalid-feedback">
                Geef een correcte datum in.
            </div>
        </div>
        <div class="col-sm-6">
            <?php
            echo form_labelpro('Uur', 'uur');
            $dataUur = array('name' => 'uur',
                'id' => 'uur',
                'class' => 'form-control',
                'required' => 'required',
                'type' => 'time'
            );
            echo form_input($dataUur) . "\n";
            ?>
            <div class="invalid-feedback">
                Geef een correct uur in.
            </div>
        </div>
    </div>
    <hr>
    <div class="form-row" id="checkboxVertrek">
        <div class="custom-control custom-checkbox">
            <?php
            $dataVertrekPlaats = array('name' => 'vertrekPlaats',
                'id' => 'vertrekPlaats',
                'class' => 'custom-control-input',
                'value' => 'accept',
            );
            echo form_checkbox($dataVertrekPlaats) . "\n";
            $attributes = array('class' => 'custom-control-label');
            echo form_label('Ik vertrek niet vanaf thuis', 'vertrekPlaats', $attributes);
            ?>
        </div>
    </div>
    <div id="vertrekGegevens" class="marginTop">
        <div class="form-row">
            <div class="col-sm-6">
                <?php
                echo form_labelpro('Vertrek Adres', 'vertrekAdres');
                $dataVertrekAdres = array('name' => 'vertrekAdres',
                    'id' => 'vertrekAdres',
                    'class' => 'form-control',
                    'placeholder' => "Schoolstraat 36",
                    'pattern' => '([a-zA-Z0-9._-]{2,}\s)+\d[a-zA-Z0-9._-]*',
                    'maxlength' => '100',
                );
                echo form_input($dataVertrekAdres) . "\n";
                ?>
                <div class="invalid-feedback">
                    Geef een correct adres in.
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-6">
                <?php
                echo form_labelpro('Gemeente', 'vertrekGemeente');
                $dataVertrekGemeente = array('name' => 'vertrekGemeente',
                    'id' => 'vertrekGemeente',
                    'class' => 'form-control',
                    'placeholder' => "Geel",
                    'pattern' => '([a-zA-Z0-9._-]{2,}\s?)+',
                    'maxlength' => '100',
                );
                echo form_input($dataVertrekGemeente) . "\n";
                ?>
                <div class="invalid-feedback">
                    Geef een correcte gemeente in.
                </div>
            </div>
            <div class="col-sm-3">
                <?php
                echo form_labelpro('Postcode', 'vertrekPostcode');
                $dataVertrekPostcode = array('name' => 'vertrekPostcode',
                    'id' => 'vertrekPostcode',
                    'class' => 'form-control',
                    'placeholder' => "2440",
                    'min' => '1000',
                    'max' => '9999',
                    'type' => 'number'
                );
                echo form_input($dataVertrekPostcode) . "\n";
                ?>
                <div class="invalid-feedback">
                    Geef een correcte postcode in.
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="form-row">
        <div class="col-sm-6">
            <?php
            echo form_labelpro('Aankomst Adres', 'aankomstAdres');
            $dataAankomstAdres = array('name' => 'aankomstAdres',
                'id' => 'aankomstAdres',
                'class' => 'form-control',
                'placeholder' => "Schoolstraat 36",
                'pattern' => '([a-zA-Z0-9._-]{2,}\s)+\d[a-zA-Z0-9._-]*',
                'maxlength' => '100',
                'required' => 'required'
            );
            echo form_input($dataAankomstAdres) . "\n";
            ?>
            <div class="invalid-feedback">
                Geef een correct adres in.
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-6">
            <?php
            echo form_labelpro('Gemeente', 'aankomstGemeente');
            $dataAankomstGemeente = array('name' => 'aankomstGemeente',
                'id' => 'aankomstGemeente',
                'class' => 'form-control',
                'placeholder' => "Geel",
                'pattern' => '([a-zA-Z0-9._-]{2,}\s?)+',
                'maxlength' => '100',
                'required' => 'required'
            );
            echo form_input($dataAankomstGemeente) . "\n";
            ?>
            <div class="invalid-feedback">
                Geef een correcte gemeente in.
            </div>
        </div>
        <div class="col-sm-3">
            <?php
            echo form_labelpro('Postcode', 'aankomstPostcode');
            $dataAankomstPostcode = array('name' => 'aankomstPostcode',
                'id' => 'aankomstPostcode',
                'class' => 'form-control',
                'placeholder' => "2440",
                'required' => 'required',
                'min' => '1000',
                'max' => '9999',
                'type' => 'number'
            );
            echo form_input($dataAankomstPostcode) . "\n";
            ?>
            <div class="invalid-feedback">
                Geef een correcte postcode in.
            </div>
        </div>
    </div>

    <hr>
    <div class="form-row marginTop">
        <div class="col-md-8">
            <?php
            echo form_labelpro('Opmerkingen', 'opmerkingen');
            $dataOpmerkingen = array('name' => 'opmerkingen',
                'id' => 'opmerkingen',
                'class' => 'form-control',
                'placeholder' => "Een tijdje parkeren, kostprijs: ...&#13;&#10;Ik rij samen met ...&#13;&#10;Een tussen stop maken bij de ...",
                'maxlength' => '500',
                'rows' => '3'
            );
            echo form_textarea($dataOpmerkingen);
            ?>
        </div>
    </div>

    <hr>
    <h3 class="marginTop">Terugrit</h3>
    <div class="form-row"  id="checkboxTerugrit">
        <div class="custom-control custom-checkbox">
            <?php
            $dataTerugRit = array('name' => 'terugRit',
                'id' => 'terugRit',
                'class' => 'custom-control-input',
                'value' => 'accept'
            );
            echo form_checkbox($dataTerugRit) . "\n";
            $attributes = array('class' => 'custom-control-label');
            echo form_label('Heen- en terugrit', 'terugRit', $attributes);
            ?>
        </div>
    </div>

    <div id="terugritGegevens" class="marginTop">
        <div class="form-row">
            <div class="col-sm-6">
                <?php
                echo form_labelpro('Datum', 'datumTerug');
                $dataDatumTerug = array('name' => 'datumTerug',
                    'id' => 'datumTerug',
                    'class' => 'form-control',
                    'type' => 'date',
                    'min' => date("Y-m-d", strtotime("+3 Days", strtotime("+$parameters->annulatieTijd hours")))
                );
                echo form_input($dataDatumTerug) . "\n";
                ?>
                <div class="invalid-feedback">
                    Geef een correcte datum in.
                </div>
            </div>
            <div class="col-sm-6">
                <?php
                echo form_labelpro('Uur', 'uurTerug');
                $dataUurTerug = array('name' => 'uurTerug',
                    'id' => 'uurTerug',
                    'class' => 'form-control',
                    'type' => 'time'
                );
                echo form_input($dataUurTerug) . "\n";
                ?>
                <div class="invalid-feedback">
                    Geef een correct uur in.
                </div>
            </div>
        </div>
        <hr>
        <div class="form-row marginTop">
            <div class="col-md-8">
                <?php
                echo form_labelpro('Opmerkingen', 'opmerkingenTerug');
                $dataOpmerkingen = array('name' => 'opmerkingenTerug',
                    'id' => 'opmerkingenTerug',
                    'class' => 'form-control',
                    'placeholder' => "Een tijdje parkeren, kostprijs: ...&#13;&#10;Ik rij samen met ...&#13;&#10;Een tussen stop maken bij de ...",
                    'maxlength' => '500',
                    'rows' => '3'
                );
                echo form_textarea($dataOpmerkingen);
                ?>
            </div>
        </div>
    </div>
    <span id="popupKnopTooltip" class="d-inline-block marginTop" tabindex="0" data-toggle="tooltip">
    <?php
    $dataPopupKnop = array('name' => 'popupKnop',
        'id' => 'popupKnop',
        'class' => 'btn btn-primary',
        'data-toggle' => 'modal',
        'data-target' => '#bevestigingPopup',
        'content' => 'Opslaan'
    );
    echo form_button($dataPopupKnop);
    ?>
    </span>
    <!-- Modal -->
    <div class="modal fade" id="bevestigingPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bevestigingPopupTitle">Aanvraag bevestigen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    echo "Beste $gebruiker->voornaam $gebruiker->naam, uw aanvraag voor <span class=\"naamTitel\">$gekozenAccount->voornaam $gekozenAccount->naam</span> wordt zo meteen verstuurd naar onze medewerkers! U ";
                    switch ($gebruiker->contactvorm){
                        case "email":
                            echo "krijgt een e-mail toegestuurd naar $gebruiker->email wanneer uw afspraak is behandeld door een van onze medewerkers. ";
                            break;

                        case "telefonisch":
                            echo "wordt gebeld op $gebruiker->telefoonnummer wanneer uw afspraak is behandeld door een van onze medewerkers. ";
                            break;

                        case "sms":
                            echo "krijgt een sms op $gebruiker->telefoonnummer wanneer uw afspraak is behandeld door een van onze medewerkers. ";
                            break;

                        default:
                            echo "hebt niet voor een verwittiging gekozen. ";
                    }
                    echo "<br>Wanneer uw afspraak is behandeld door een van onze vrijwilligers wordt er in het overzicht van de geplande ritten van <span class=\"naamTitel\">$gekozenAccount->voornaam $gekozenAccount->naam</span> de bestuurder getoond die deze rit zal uitvoeren.<br>Bevestig alstublieft deze rit.";
                    ?>
                </div>
                <div class="modal-footer">
                    <?php
                    $dataAnnuleer = array(
                        'class' => 'btn btn-secondary',
                        'data-dismiss' => 'modal',
                        'content' => 'Annuleer'
                    );
                    echo form_button($dataAnnuleer);
                    echo form_submit('Rit aanmaken', 'Opslaan', 'class="btn btn-primary"');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    echo form_close();
    ?>
<?php
    echo "<div id=\"ritGegevens\"></div>";
} else {
    echo "<p>Je beheert nog geen minder mobielen.</p>\n";
}
?>

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
                $("#popupKnop").click(function () {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                });
            });
        }, false);
    })();
</script>










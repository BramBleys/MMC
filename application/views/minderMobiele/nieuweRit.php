<script>
    $(document).ready(function () {

        $("#vertrekGegevens").hide();
        $("#terugritGegevens").hide();

        $("#checkboxVertrek").click(function () {
            if ($("#vertrekPlaats").is(':checked')) {
                $("#vertrekAdres").attr("required", "required");
                $("#vertrekGemeente").attr("required", "required");
                $("#vertrekPostcode").attr("required", "required");
                $("#vertrekGegevens").slideDown(500);
            } else {
                $("#vertrekAdres").removeAttr("required");
                $("#vertrekGemeente").removeAttr("required");
                $("#vertrekPostcode").removeAttr("required");
                $("#vertrekGegevens").slideUp(500);
            }
        });
        $("#checkboxTerugrit").click(function () {
            if ($("#terugRit").is(':checked')) {
                $("#uurTerug").attr("required", "required");
                $("#datumTerug").attr("required", "required");
                $("#terugritGegevens").slideDown(500);
            } else {
                $("#uurTerug").removeAttr("required");
                $("#datumTerug").removeAttr("required");
                $("#terugritGegevens").slideUp(500);
            }
        });
    });
</script>

<h2><?= $titel ?></h2>
<h3 class="marginTop">Rit gegevens</h3>
<?php
    $attributenFormulier = array('id' => 'mijnFormulier',
        'class' => 'needs-validation',
        'novalidate' => 'novalidate');
    echo form_open('minderMobiele/gegevensOpslaan', $attributenFormulier);
?>
<div class="form-row">
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Datum', 'datum');
        $dataDatum = array('name' => 'datum',
            'id' => 'datum',
            'class' => 'form-control',
            'required' => 'required',
            'type' => 'date'
            //,'value' => $gebruiker->voornaam
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
            //,'value' => $gebruiker->voornaam
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
                //,'value' => $gebruiker->voornaam
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
                //,'value' => $gebruiker->voornaam
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
                //,'value' => $gebruiker->voornaam
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
            'required' => 'required'
            //,'value' => $gebruiker->voornaam
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
            'required' => 'required'
            //,'value' => $gebruiker->voornaam
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
            'required' => 'required'
            //,'value' => $gebruiker->voornaam
        );
        echo form_input($dataAankomstPostcode) . "\n";
        ?>
        <div class="invalid-feedback">
            Geef een correcte postcode in.
        </div>
    </div>
</div>
<hr>
<h3 class="marginTop">Terug rit</h3>
<div class="form-row"  id="checkboxTerugrit">
    <div class="custom-control custom-checkbox">
        <?php
        $dataTerugRit = array('name' => 'terugRit',
            'id' => 'terugRit',
            'class' => 'custom-control-input',
            'value' => 'accept',
        );
        echo form_checkbox($dataTerugRit) . "\n";
        $attributes = array('class' => 'custom-control-label');
        echo form_label('Heen en terug rit', 'terugRit', $attributes);
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
                'type' => 'date'
                //,'value' => $gebruiker->voornaam
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
                //,'value' => $gebruiker->voornaam
            );
            echo form_input($dataUurTerug) . "\n";
            ?>
            <div class="invalid-feedback">
                Geef een correct uur in.
            </div>
        </div>
    </div>
</div>
<hr>
<div class="form-row marginTop">
    <?php
    echo form_labelpro('Opmerkingen', 'opmerkingen');
    $dataOpmerkingen = array('name' => 'opmerkingen',
        'id' => 'opmerkingen',
        'class' => 'form-control',
        'placeholder' => "Een tijdje parkeren, kostprijs: ...&#13;&#10;Ik rij samen met ...&#13;&#10;Een tussen stop maken bij de ...",
        'rows' => '3'
                //,'value' => $gebruiker->voornaam
    );
    echo form_textarea($dataOpmerkingen);
    ?>
</div>
<?php
    echo form_submit('Rit aanmaken', 'Opslaan', 'class="btn achtergrond marginTop"');
    echo form_close();
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
            });
        }, false);
    })();
</script>










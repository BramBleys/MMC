<script>
</script>

<?php echo haalJavascriptOp("validator.js"); ?>

<h2><?= $titel ?></h2>
<h3 class="marginTop">Contactgegevens</h3>
<?php
    $attributenFormulier = array('id' => 'mijnFormulier',
        'data-toggle' => 'validator',
        'role' => 'form');
    echo form_open('minderMobiele/gegevensOpslaan', $attributenFormulier);
?>
<div class="form-group row">
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Datum', 'datum', 'class="col-form-label"');
        $dataDatum = array('name' => 'datum',
            'id' => 'datum',
            'class' => 'form-control',
            'placeholder' => "30/05/2018",
            'required' => 'required'
            //,'value' => $gebruiker->voornaam
        );
        echo form_input($dataDatum) . "\n";
        ?>
        <div class="help-block with-errors"></div>
    </div>
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Uur', 'uur', 'class="col-form-label"');
        $dataUur = array('name' => 'uur',
            'id' => 'uur',
            'class' => 'form-control',
            'placeholder' => "18:30",
            'required' => 'required'
            //,'value' => $gebruiker->voornaam
        );
        echo form_input($dataUur) . "\n";
        ?>
        <div class="help-block with-errors"></div>
    </div>
</div>
<hr>
<div class="form-group row">
    <?php
    $dataVertrekPlaats = array('name' => 'vertrekPlaats',
        'id' => 'vertrekPlaats',
        'value' => 'accept',
    );
    echo form_checkbox($dataVertrekPlaats) . "\n";
    echo form_labelpro('Ik vertrek niet vanaf thuis', 'vertrekPlaats', 'class="col-form-label"');
    ?>
</div>
<div class="form-group row">
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Vertrek Adres', 'vertrekAdres', 'class="col-form-label"');
        $dataVertrekAdres = array('name' => 'vertrekAdres',
            'id' => 'vertrekAdres',
            'class' => 'form-control',
            'placeholder' => "Schoolstraat 36",
            'required' => 'required'
            //,'value' => $gebruiker->voornaam
        );
        echo form_input($dataVertrekAdres) . "\n";
        ?>
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Gemeente', 'vertrekGemeente', 'class="col-form-label"');
        $dataVertrekGemeente = array('name' => 'vertrekGemeente',
            'id' => 'vertrekGemeente',
            'class' => 'form-control',
            'placeholder' => "Geel",
            'required' => 'required'
            //,'value' => $gebruiker->voornaam
        );
        echo form_input($dataVertrekGemeente) . "\n";
        ?>
        <div class="help-block with-errors"></div>
    </div>
    <div class="col-sm-3">
        <?php
        echo form_labelpro('Postcode', 'vertrekPostcode', 'class="col-form-label"');
        $dataVertrekPostcode = array('name' => 'vertrekPostcode',
            'id' => 'vertrekPostcode',
            'class' => 'form-control',
            'placeholder' => "Geel",
            'required' => 'required'
            //,'value' => $gebruiker->voornaam
        );
        echo form_input($dataVertrekPostcode) . "\n";
        ?>
        <div class="help-block with-errors"></div>
    </div>
</div>
<hr>
<div class="form-group row">
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Aankomst Adres', 'aankomstAdres', 'class="col-form-label"');
        $dataAankomstAdres = array('name' => 'aankomstAdres',
            'id' => 'aankomstAdres',
            'class' => 'form-control',
            'placeholder' => "Schoolstraat 36",
            'required' => 'required'
            //,'value' => $gebruiker->voornaam
        );
        echo form_input($dataAankomstAdres) . "\n";
        ?>
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Gemeente', 'aankomstGemeente', 'class="col-form-label"');
        $dataAankomstGemeente = array('name' => 'aankomstGemeente',
            'id' => 'aankomstGemeente',
            'class' => 'form-control',
            'placeholder' => "Geel",
            'required' => 'required'
            //,'value' => $gebruiker->voornaam
        );
        echo form_input($dataAankomstGemeente) . "\n";
        ?>
        <div class="help-block with-errors"></div>
    </div>
    <div class="col-sm-3">
        <?php
        echo form_labelpro('Postcode', 'aankomstPostcode', 'class="col-form-label"');
        $dataAankomstPostcode = array('name' => 'aankomstPostcode',
            'id' => 'aankomstPostcode',
            'class' => 'form-control',
            'placeholder' => "Geel",
            'required' => 'required'
            //,'value' => $gebruiker->voornaam
        );
        echo form_input($dataAankomstPostcode) . "\n";
        ?>
        <div class="help-block with-errors"></div>
    </div>
</div>
<hr>

<div class="form-group row">
    <?php
    $dataTerugRit = array('name' => 'terugRit',
        'id' => 'terugRit',
        'value' => 'accept',
    );
    echo form_checkbox($dataTerugRit) . "\n";
    echo form_labelpro('Heen en terug rit', 'terugRit', 'class="col-form-label"');
    ?>
</div>

<h3 class="marginTop">Terug rit</h3>
<div class="form-group row">
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Datum', 'datumTerug', 'class="col-form-label"');
        $dataDatumTerug = array('name' => 'datumTerug',
            'id' => 'datumTerug',
            'class' => 'form-control',
            'placeholder' => "30/05/2018",
            'required' => 'required'
            //,'value' => $gebruiker->voornaam
        );
        echo form_input($dataDatumTerug) . "\n";
        ?>
        <div class="help-block with-errors"></div>
    </div>
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Uur', 'uurTerug', 'class="col-form-label"');
        $dataUurTerug = array('name' => 'uurTerug',
            'id' => 'uurTerug',
            'class' => 'form-control',
            'placeholder' => "18:30",
            'required' => 'required'
            //,'value' => $gebruiker->voornaam
        );
        echo form_input($dataUurTerug) . "\n";
        ?>
        <div class="help-block with-errors"></div>
    </div>

<?php
    echo form_submit('Rit aanmaken', 'Opslaan', 'class="btn achtergrond marginTop"');
    echo form_close();
?>











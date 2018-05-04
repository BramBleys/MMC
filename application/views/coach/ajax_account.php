<div class="form-row">
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Voornaam', 'voornaam');
        $dataVoornaam = array('name' => 'voornaam',
            'id' => 'voornaam',
            'class' => 'form-control',
            'placeholder' => "voornaam",
            'maxlength' => '100',
            'pattern' => '([a-zA-Z._-]{2,}\s?)+',
            'value' => $account->voornaam,
            'required' => 'required'
        );
        echo form_input($dataVoornaam) . "\n";
        ?>
        <div class="invalid-feedback">
            Geef een correcte voornaam in.
        </div>
    </div>
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Naam', 'naam');
        $dataNaam = array('name' => 'naam',
            'id' => 'naam',
            'class' => 'form-control',
            'placeholder' => "naam",
            'maxlength' => '100',
            'pattern' => '([a-zA-Z._-]{2,}\s?)+',
            'value' => $account->naam,
            'required' => 'required'
        );
        echo form_input($dataNaam) . "\n";
        ?>
        <div class="invalid-feedback">
            Geef een correcte naam in.
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Telefoonnummer', 'telefoonnummer');
        $dataTelefoonnummer = array('name' => 'telefoonnummer',
            'id' => 'telefoonnummer',
            'class' => 'form-control',
            'placeholder' => "telefoonnummer",
            'maxlength' => '100',
            'minlength' => '9',
            'value' => $account->telefoonnummer,
            'required' => 'required'
        );
        echo form_input($dataTelefoonnummer) . "\n";
        ?>
        <div class="invalid-feedback">
            Geef een correct telefoonnummer in.
        </div>
    </div>
    <div class="col-sm-6">
        <?php
        echo form_labelpro('E-mail', 'email');
        $dataEmail = array('name' => 'email',
            'id' => 'email',
            'class' => 'form-control',
            'placeholder' => "email",
            'maxlength' => '100',
            'pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$',
            'value' => $account->email,
            'required' => 'required'
        );
        echo form_input($dataEmail) . "\n";
        ?>
        <div class="invalid-feedback">
            Geef een correct e-mailadres in.
        </div>
    </div>
</div>
<hr>
<h3 class="marginTop">Woonplaatsgegevens</h3>
<div class="form-row">
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Adres', 'straatEnNummer');
        $dataAdres = array('name' => 'straatEnNummer',
            'id' => 'straatEnNummer',
            'class' => 'form-control',
            'placeholder' => "Schoolstraat 36",
            'pattern' => '([a-zA-Z0-9._-]{2,}\s)+\d[a-zA-Z0-9._-]*',
            'maxlength' => '100',
            'required' => 'required',
            'value' => $account->straatEnNummer
        );
        echo form_input($dataAdres) . "\n";
        ?>
        <div class="invalid-feedback">
            Geef een correct adres in.
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-6">
        <?php
        echo form_labelpro('Gemeente', 'gemeente');
        $dataGemeente = array('name' => 'gemeente',
            'id' => 'gemeente',
            'class' => 'form-control',
            'placeholder' => "Geel",
            'pattern' => '([a-zA-Z0-9._-]{2,}\s?)+',
            'maxlength' => '100',
            'required' => 'required',
            'value' => $account->gemeente
        );
        echo form_input($dataGemeente) . "\n";
        ?>
        <div class="invalid-feedback">
            Geef een correcte gemeente in.
        </div>
    </div>
    <div class="col-sm-3">
        <?php
        echo form_labelpro('Postcode', 'postcode');
        $dataPostcode = array('name' => 'postcode',
            'id' => 'postcode',
            'class' => 'form-control',
            'placeholder' => "2440",
            'min' => '1000',
            'max' => '9999',
            'type' => 'number',
            'required' => 'required',
            'value' => $account->postcode
        );
        echo form_input($dataPostcode) . "\n";
        ?>
        <div class="invalid-feedback">
            Geef een correcte postcode in.
        </div>
    </div>
</div>

<?php
    $attributes = "class=\"form-check-input\" type=\"radio\" name=\"contactvorm\"";
    $attributesEmail = "$attributes value=\"email\" id=\"email\"";
    $attributesTelefoon = "$attributes value=\"telefonisch\" id=\"telefonisch\"";
    $attributesSms = "$attributes value=\"sms\" id=\"sms\"";
    $attributesLeeg = "$attributes value=\"leeg\" id=\"leeg\"";
    switch ($account->contactvorm) {
        case "email":
            $attributesEmail = "$attributesEmail checked=\"checked\"";
            break;
        case "telefonisch":
            $attributesTelefoon = "$attributesTelefoon checked=\"checked\"";
            break;
        case "sms":
            $attributesSms = "$attributesSms checked=\"checked\"";
            break;
        default:
            $attributesLeeg = "$attributesLeeg checked=\"checked\"";
            break;
    }
?>
<hr>
<h3 class="marginTop">Voorkeur herinnering</h3>
<div class="form-check">
    <label class="form-check-label">
        <input <?=$attributesEmail ?> > E-mail </label>
</div>
<div class="form-check">
    <label class="form-check-label">
        <input <?= $attributesTelefoon ?> >
        Telefonisch </label>
</div>
<div class="form-check">
    <label class="form-check-label">
        <input <?= $attributesSms ?> >
        SMS </label>
</div>
<div class="form-check disabled">
    <label class="form-check-label">
        <input <?= $attributesLeeg ?> > Leeg </label>
</div>

<input type="hidden" value="<?= $account->id ?>" name="getoondAccountId"/>













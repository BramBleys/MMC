
<!--TODO nog controleren op string/int + juiste bolletje nog selecteren in script hierboven + custom tooltip error message-->

<h2>Account gegevens wijzigen</h2>
<h3 class="marginTop">Contactgegevens</h3>
<?php
    $attributes = array('name' => 'formulier');
    echo form_open('Gebruiker/gegevensOpslaan', $attributes);
?>
<div class="form-group row">
    <?php echo form_label('Voornaam', 'voornaam', 'class="col-sm-6 col-form-label"'); ?>
    <?php echo form_label('Naam', 'naam', 'class="col-sm-6 col-form-label"'); ?>
    <div class="col-sm-6">
        <?php echo form_input(array('name' => 'voornaam', 'id' => 'voornaam', 'class' => 'form-control', 'value' => $account->voornaam, 'required' => 'required')); ?>
    </div>
    <div class="col-sm-6">
        <?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'class' => 'form-control', 'value' => $account->naam, 'required' => 'required')); ?>
    </div>
</div>
<div class="form-group row">
    <?php echo form_label('Telefoonnummer', 'telefoonnummer', 'class="col-sm-12 col-form-label"'); ?>
    <div class="col-sm-6">
        <?php echo form_input(array('name' => 'telefoonnummer', 'id' => 'telefoonnummer', 'class' => 'form-control', 'value' => $account->telefoonnummer, 'required' => 'required')); ?>
    </div>
</div>
<div class="form-group row">
    <?php echo form_label('E-mail', 'email', 'class="col-sm-12 col-form-label"'); ?>
    <div class="col-sm-6">
        <?php echo form_input(array('type' => 'email','name' => 'email', 'id' => 'email', 'class' => 'form-control', 'value' => $account->email, 'required' => 'required')); ?>
    </div>
</div>

<h3 class="marginTop">Adresgegevens</h3>
<div class="form-group row">
    <?php echo form_label('Gemeente', 'gemeente', 'class="col-sm-6 col-form-label"'); ?>
    <?php echo form_label('Postcode', 'postcode', 'class="col-sm-3 col-form-label"'); ?>
    <div class="col-sm-6">
        <?php echo form_input(array('name' => 'gemeente', 'id' => 'gemeente', 'class' => 'form-control', 'value' => $account->gemeente, 'required' => 'required')); ?>
    </div>
    <div class="col-sm-3">
        <?php echo form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => 'form-control', 'value' => $account->postcode, 'required' => 'required')); ?>
    </div>
</div>
<div class="form-group row">
    <?php echo form_label('Straat + nummer', 'straatEnNummer', 'class="col-sm-9 col-form-label"'); ?>
    <div class="col-sm-9">
        <?php echo form_input(array('name' => 'straatEnNummer', 'id' => 'straatEnNummer', 'class' => 'form-control', 'value' => $account->straatEnNummer, 'required' => 'required')); ?>
    </div>
</div>

<?php
    $attributes = "class=\"form-check-input\" type=\"radio\" name=\"contactvorm\"";
    $attributesEmail = $attributes + "  value=\"email\" id=\"email\"";
    $attributesTelefoon = $attributes + " value=\"telefonisch\" id=\"telefonisch\"";
    $attributesSms = $attributes + " value=\"sms\" id=\"sms\"";
    $attributesLeeg = $attributes + " value=\"leeg\" id=\"leeg\"";
    switch ($account->contactvorm) {
        case "email":
            $attributesEmail += " checked=\"checked\"";
            break;
        case "telefonisch":
            $attributesTelefoon += " checked=\"checked\"";
            break;
        case "sms":
            $attributesSms += " checked=\"checked\"";
            break;
        default:
            $attributesTelefoon += " checked=\"checked\"";
            break;
    }
?>
<h3 class="marginTop">Voorkeur herinnering</h3>
<div class="form-check">
    <label class="form-check-label">
        <input <?= $attributesEmail ?> > E-mail </label>
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

<input type="hidden" value="<?php echo $account->id ?>" name="hidden"/>

<?php
    echo form_submit('opslaan', 'Opslaan', 'class="btn achtergrond marginTop"');
    echo form_close();
?>











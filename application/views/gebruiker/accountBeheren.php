<script>
    var voorkeur = <?php echo json_encode($gebruiker); ?>;
console.log(voorkeur.contactvorm);
    if (voorkeur.contactvorm === "telefonisch") {
        $("#telefonisch").prop("checked", true);
    } else if (voorkeur.contactvorm === "email") {
        $("#email").prop("checked", true);
    } else if (voorkeur.contactvorm === "beide") {
        $("#email").prop("checked", true);
    }
</script>

<h2>Account gegevens wijzigen</h2>
<h3 class="marginTop">Contactgegevens</h3>
<?php
    $attributes = array('name' => 'formulier');
    echo form_open('home/gegevensOpslaan', $attributes);
?>
<div class="form-group row">
    <?php echo form_label('Voornaam', 'voornaam', 'class="col-sm-6 col-form-label"'); ?>
    <?php echo form_label('Naam', 'naam', 'class="col-sm-6 col-form-label"'); ?>
    <div class="col-sm-6">
        <?php echo form_input(array('name' => 'voornaam', 'id' => 'voornaam', 'class' => 'form-control', 'value' => $gebruiker->voornaam)); ?>
    </div>
    <div class="col-sm-6">
        <?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'class' => 'form-control', 'value' => $gebruiker->naam)); ?>
    </div>
</div>
<div class="form-group row">
    <?php echo form_label('Telefoonnummer', 'telefoonnummer', 'class="col-sm-12 col-form-label"'); ?>
    <div class="col-sm-6">
        <?php echo form_input(array('name' => 'telefoonnummer', 'id' => 'telefoonnummer', 'class' => 'form-control', 'value' => $gebruiker->telefoonnummer)); ?>
    </div>
</div>
<div class="form-group row">
    <?php echo form_label('E-mail', 'email', 'class="col-sm-12 col-form-label"'); ?>
    <div class="col-sm-6">
        <?php echo form_input(array('name' => 'email', 'id' => 'email', 'class' => 'form-control', 'value' => $gebruiker->email)); ?>
    </div>
</div>

<h3 class="marginTop">Adresgegevens</h3>
<div class="form-group row">
    <?php echo form_label('Gemeente', 'gemeente', 'class="col-sm-6 col-form-label"'); ?>
    <?php echo form_label('Postcode', 'postcode', 'class="col-sm-3 col-form-label"'); ?>
    <div class="col-sm-6">
        <?php echo form_input(array('name' => 'gemeente', 'id' => 'gemeente', 'class' => 'form-control', 'value' => $gebruiker->gemeente)); ?>
    </div>
    <div class="col-sm-3">
        <?php echo form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => 'form-control', 'value' => $gebruiker->postcode)); ?>
    </div>
</div>
<div class="form-group row">
    <?php echo form_label('Straat + nummer', 'straatEnNummer', 'class="col-sm-9 col-form-label"'); ?>
    <div class="col-sm-9">
        <?php echo form_input(array('name' => 'straatEnNummer', 'id' => 'straatEnNummer', 'class' => 'form-control', 'value' => $gebruiker->straatEnNummer)); ?>
    </div>
</div>

<h3 class="marginTop">Voorkeur herinnering</h3>
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="contactvorm" value="email" id="email"> E-mail </label>
</div>
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="contactvorm" value="telefonisch" id="telefonisch">
        Telefonisch </label>
</div>
<div class="form-check disabled">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="contactvorm" value="beide" id="beide"> Beide </label>
</div>

<input type="hidden" value="<?php echo $gebruiker->id ?>" name="hidden"/>

<?php
    echo form_submit('opslaan', 'Opslaan', 'class="btn achtergrond marginTop"');
    echo form_close();
?>











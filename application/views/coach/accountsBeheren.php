<script>

    function haalGebruikersOp(soortId)
    {
        $.ajax({type : "GET",
            url : site_url + "/MMCMedewerker/haalAjaxOp_Gebruikers",
            data : { soortId : soortId },
            success : function(result){
                $("#gebruikers").html(result);

            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    $(document).ready(function () {

        $(".gebruikerOphalen").click(function (e) {
            e.preventDefault();
            var soortId = $(this).data('id');
            haalGebruikersOp(soortId);
        });

    });

</script>

<!--TODO nog controleren op string/int + juiste bolletje nog selecteren in script hierboven + custom tooltip error message-->

<h2><?= $titel ?></h2>
<div id="accountGegevens">

</div>
<h3 class="marginTop">Contactgegevens</h3>
<?php
    $attributes = array('name' => 'formulier');
    echo form_open('coach/accountGegevensOpslaan', $attributes);
?>
<div class="form-group row">
    <?php echo form_label('Voornaam', 'voornaam', 'class="col-sm-6 col-form-label"'); ?>
    <?php echo form_label('Naam', 'naam', 'class="col-sm-6 col-form-label"'); ?>
    <div class="col-sm-6">
        <?php echo form_input(array('name' => 'voornaam', 'id' => 'voornaam', 'class' => 'form-control', 'value' => $gebruiker->voornaam, 'required' => 'required')); ?>
    </div>
    <div class="col-sm-6">
        <?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'class' => 'form-control', 'value' => $gebruiker->naam, 'required' => 'required')); ?>
    </div>
</div>
<div class="form-group row">
    <?php echo form_label('Telefoonnummer', 'telefoonnummer', 'class="col-sm-12 col-form-label"'); ?>
    <div class="col-sm-6">
        <?php echo form_input(array('name' => 'telefoonnummer', 'id' => 'telefoonnummer', 'class' => 'form-control', 'value' => $gebruiker->telefoonnummer, 'required' => 'required')); ?>
    </div>
</div>
<div class="form-group row">
    <?php echo form_label('E-mail', 'email', 'class="col-sm-12 col-form-label"'); ?>
    <div class="col-sm-6">
        <?php echo form_input(array('type' => 'email','name' => 'email', 'id' => 'email', 'class' => 'form-control', 'value' => $gebruiker->email, 'required' => 'required')); ?>
    </div>
</div>

<h3 class="marginTop">Adresgegevens</h3>
<div class="form-group row">
    <?php echo form_label('Gemeente', 'gemeente', 'class="col-sm-6 col-form-label"'); ?>
    <?php echo form_label('Postcode', 'postcode', 'class="col-sm-3 col-form-label"'); ?>
    <div class="col-sm-6">
        <?php echo form_input(array('name' => 'gemeente', 'id' => 'gemeente', 'class' => 'form-control', 'value' => $gebruiker->gemeente, 'required' => 'required')); ?>
    </div>
    <div class="col-sm-3">
        <?php echo form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => 'form-control', 'value' => $gebruiker->postcode, 'required' => 'required')); ?>
    </div>
</div>
<div class="form-group row">
    <?php echo form_label('Straat + nummer', 'straatEnNummer', 'class="col-sm-9 col-form-label"'); ?>
    <div class="col-sm-9">
        <?php echo form_input(array('name' => 'straatEnNummer', 'id' => 'straatEnNummer', 'class' => 'form-control', 'value' => $gebruiker->straatEnNummer, 'required' => 'required')); ?>
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
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="contactvorm" value="sms" id="sms">
        SMS </label>
</div>
<div class="form-check disabled">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="contactvorm" value="leeg" id="leeg"> Leeg </label>
</div>

<input type="hidden" value="<?php echo $gebruiker->id ?>" name="hidden"/>

<?php
    echo form_submit('opslaan', 'Opslaan', 'class="btn achtergrond marginTop"');
    echo form_close();
?>











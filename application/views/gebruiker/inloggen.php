<?php
    /**
     * @file inloggen.php
     *
     *  View waar de gebruiker zijn inloggegevens kan invullen
     */
?>

<?php
    $attributes = array('name' => 'formulier');
    echo form_open("home/controleerInloggen", $attributes);
?>

    <div class="form-group row">
        <?php echo form_label('Gebruikersnaam:', 'gebruikersnaam', 'class="col-md-2 col-form-label"'); ?>
        <div class="col-md-10">
            <?php echo form_input(array('name' => 'gebruikersnaam', 'id' => 'gebruikersnaam', 'class' => 'form-control')); ?>
        </div>
    </div>

    <div class="form-group row">
        <?php echo form_label('Wachtwoord:', 'wachtwoord', 'class="col-md-2 col-form-label"'); ?>
        <div class="col-md-10">
            <?php echo form_input(array('name' => 'wachtwoord', 'id' => 'wachtwoord', 'class' => 'form-control', 'type' => 'password')); ?>
        </div>
    </div>


<?php
    echo form_submit("inloggen", "Inloggen", 'class="btn achtergrond marginTop"');
    echo form_close();
?>
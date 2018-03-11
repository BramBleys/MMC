<?php
    $attributes = array('name' => 'formulier');
    echo form_open("home/controleerInloggen", $attributes);
?>

    <div class="form-group row">
        <?php echo form_label('E-mail:', 'email', 'class="col-sm-2 col-form-label"'); ?>
        <div class="col-sm-10">
            <?php echo form_input(array('name' => 'email', 'id' => 'email', 'class' => 'form-control')); ?>
        </div>
    </div>

    <div class="form-group row">
        <?php echo form_label('Wachtwoord:', 'wachtwoord', 'class="col-sm-2 col-form-label"'); ?>
        <div class="col-sm-10">
            <?php echo form_input(array('name' => 'wachtwoord', 'id' => 'wachtwoord', 'class' => 'form-control', 'type' => 'password')); ?>
        </div>
    </div>


<?php
    echo form_submit("inloggen", "Inloggen", 'class="btn achtergrond marginTop"');
    echo form_close();
?>
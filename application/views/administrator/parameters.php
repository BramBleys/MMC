<?php
/**
 * @file parameters.php
 *
 * View waarin de parameters worden weergegeven
 * - krijgt een $parameters-object binnen
 * - gebruikt
 */
?>
<html>
<head>
</head>
<body>
    <h2>Parameters beheren</h2>
<?php
echo form_open('administrator/parametersOpslagen');
?>
    <div class="form-group">
        <label for="exampleInputEmail1">Maximum aantal ritten - per week</label>
        <input type="number" class="form-control" name="maxRitten" id="maxRitten" value="<?php echo $parameters->maxRitten; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Prijs - per kilometer</label>
        <input type="number" step="0.01" class="form-control" name="prijsPerKM" id="prijsPerKM" value="<?php echo $parameters->prijsPerKm; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Tijd voor annulatie - in werkdagen</label>
        <input type="number" class="form-control" name="annulatieTijd" id="annulatieTijd" value="<?php echo $parameters->annulatieTijd; ?>">
    </div>
<?php echo form_submit('knop', 'Opslaan', array('class' =>'btn achtergrond')); ?>
<?php echo form_close(); ?>
</body>
</html>

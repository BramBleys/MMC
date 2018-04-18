<?php
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 4/18/2018
 * Time: 1:58 PM
 */
?>
<html>
<head>

</head>
<body>
    <?php
       echo '<p>' . $sjabloon->titel . '</p>';
    ?>
<?php
    echo form_open('administrator/sjabloonOpslagen');
    ?>
    <div class="form-group">
        <label for="exampleInputEmail1">Maximum aantal ritten</label>
        <input type="number" class="form-control" name="maxRitten" id="maxRitten" placeholder="Per week">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Prijs</label>
        <input type="number" step="0.01" class="form-control" name="prijsPerKM" id="prijsPerKM" placeholder="Per kilometer">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Tijd voor annulatie</label>
        <input type="number" class="form-control" name="annulatieTijd" id="annulatieTijd" placeholder="In werkdagen">
    </div>
    <?php echo form_submit('knop', 'Opslaan', array('class' =>'btn achtergrond')); ?>
    <?php echo form_close(); ?>
</body>
</html>

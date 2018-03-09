<?php
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 3/9/2018
 * Time: 1:32 PM
 */
?>
<html>
<head>
</head>
<body>
<?php
$attributes = array('name' => 'parametersFormulier');
echo form_open('administrator/parametersOpslagen', $attributes);
?>
<table>
    <tr>
        <td><?php echo form_label('Max ritten per week:', 'maxRitten'); ?></td>
        <td><?php echo form_input(array('name' => 'maxRitten', 'id' => 'maxRitten', 'size' => '3')); ?></td>
    </tr>
    <tr>
        <td><?php echo form_label('Bedrag per KM:', 'bedragPerKM'); ?></td>
        <td><?php echo form_input(array('name' => 'bedragPerKM', 'id' => 'bedragPerKM', 'size' => '3')); ?></td>
    </tr>
    <tr>
        <td><?php echo form_label('Tijd voor annulatie (in werkdagen):', 'annulatieTijd'); ?></td>
        <td><?php echo form_input(array('name' => 'annulatieTijd', 'id' => 'annulatieTijd', 'size' => '3')); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo form_submit('knop', 'Opslaan'); ?></td>
    </tr>
</table>

<?php echo form_close(); ?>
</body>
</html>

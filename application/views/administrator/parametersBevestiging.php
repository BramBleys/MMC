<?php

/**
 * @file parametersBevestiging.php
 *
 * View waarin het resultaat van de aangepaste parameters wordt weergegeven
 * - krijgt een $parameters-object binnen
 */

?>

<ul class="list-group">
    <li class="list-group-item achtergrond">Wijzigingen aangepast</li>
    <li class="list-group-item"><?php echo '<p>Maximum aantal ritten is aangepast naar: ' . $parameters->maxRitten . '</p>';  ?></li>
    <li class="list-group-item"><?php echo '<p>Prijs per kilometer is aangepast naar: ' . $parameters->prijsPerKM . '</p>'; ?></li>
    <li class="list-group-item"><?php echo '<p>Annulatie tijd is aangepast naar: ' . $parameters->annulatieTijd . '</p>'; ?></li>

</ul>
<?php
echo anchor('/Administrator/index', 'Terug', array('class' => 'btn btn-primary mt-3')) . "\n";
?>
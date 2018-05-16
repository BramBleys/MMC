<?php

/**
 * @file MMCMedewerker/melding.php
 *
 */

echo heading($titel,2,'class="mb-3"') . "\n";

?>

    <p> <?php echo $boodschap; ?> </p>

<?php if ($link != null){
    echo anchor($link["url"], $link["tekst"]);
}
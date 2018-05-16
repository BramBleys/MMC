<?php

/**
 * @file administrator/melding.php
 *
 * View die wordt gebruikt voor het tonen van diverse meldingen.
 *  - krijgt $titel, $boodschap en een $link binnen
 */

echo heading($titel,2,'class="mb-3"') . "\n";

?>

    <p> <?php echo $boodschap; ?> </p>

<?php if ($link != null){
    echo anchor($link["url"], $link["tekst"]);
}
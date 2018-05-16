<?php

/**
 * @file MMCMedewerker/ajax_vulChauffeurIn.php
 *
 * AJAX-view waarin het gekozen vrijwilliger-Object wordt ingevuld, dit wordt getoond in de view MMCMedewerker/aanvraagToevoegen.php
 *  - krijgt een vrijwilliger-object binnen
 */

?>

<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('Naam', 'vrijwilligerNaam') .
        "<br>" .
        form_input('vrijwilligerNaam',$chauffeur->voornaam . ' ' . $chauffeur->naam,'id="vrijwilligerNaam" class="form-control" disabled') .
        form_hidden('vrijwilligerId',$chauffeur->id);
        "</p>\n";

    ?>
</div>
<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('MMC-nummer', 'vrijwilligerMmcNummer') .
        "<br>" .
        form_input('vrijwilligerMmcNummer',$chauffeur->mmcNummer,'id="vrijwilligerMmcNummer" class="form-control" disabled') .
    "</p>\n";

    ?>
</div>
<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('Telefoonnummer', 'vrijwilligerTelefoonnummer') .
        "<br>" .
        form_input('vrijwilligerTelefoonnummer',$chauffeur->telefoonnummer,'id="vrijwilligerTelefoonnummer" class="form-control" disabled') .
        "</p>\n";

    ?>
</div>
<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('E-mail', 'vrijwilligerEmail') .
        "<br>" .
        form_input('vrijwilligerEmail',$chauffeur->email,'id="vrijwilligerEmail" class="form-control" disabled') .
        "</p>\n";

    ?>
</div>
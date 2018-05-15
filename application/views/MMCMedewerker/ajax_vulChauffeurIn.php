<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('Naam', 'coach') .
        "<br>" .
        form_input('naam',$chauffeur->voornaam . ' ' . $chauffeur->naam,'id="naam" class="form-control" disabled') .
        "</p>\n";

    ?>
</div>
<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('MMC-nummer', 'mmcNummer') .
        "<br>" .
        form_input('',$chauffeur->mmcNummer,'id="mmcNummer" class="form-control" disabled') .
        form_hidden('mmcNummer', $chauffeur->mmcNummer);
    "</p>\n";

    ?>
</div>
<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('Telefoonnummer', 'telefoonnummer') .
        "<br>" .
        form_input('telefoonnummer',$chauffeur->telefoonnummer,'id="telefoonnummer" class="form-control" disabled') .
        "</p>\n";

    ?>
</div>
<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('E-mail', 'email') .
        "<br>" .
        form_input('email',$chauffeur->email,'id="email" class="form-control" disabled') .
        "</p>\n";

    ?>
</div>
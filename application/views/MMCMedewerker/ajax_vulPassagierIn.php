<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('Naam', 'passagierNaam') .
        "<br>" .
        form_input('passagierNaam',$passagier->voornaam . " " . $passagier->naam,'id="passagierNaam" class="form-control" disabled') .
        form_hidden("passagierId",$passagier->id) .
        "</p>\n";

    ?>
</div>
<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('MMC-nummer', 'passagierMmcNummer') .
        "<br>" .
        form_input('passagierMmcNummer',$passagier->mmcNummer,'id="passagierMmcNummer" class="form-control" disabled') .
        "</p>\n";



    ?>
</div>
<div class="col-12">
    <?php

    echo heading('Coach',5,'class="mb-2"') . "\n";

    ?>
</div>
<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('Naam', 'coachNaam') .
        "<br>";
        if ($coach) {
            echo form_input('coachNaam',$coach->voornaam . " " . $coach->naam,'id="coachNaam" class="form-control" disabled') .
                form_hidden("coachId",$coach->id) .
                "</p>\n";
        } else {
            echo form_input('coachNaam','','id="coachNaam" class="form-control" disabled') .
            "</p>\n";
        }

    ?>
</div>
<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('MMC-nummer', 'coachMmcNummer') .
        "<br>";
    if ($coach) {
        echo form_input('',$coach->mmcNummer,'id="coachMmcNummer" class="form-control" disabled') .
            "</p>\n";
    } else {
        echo form_input('','','id="coachMmcNummer" class="form-control" disabled') .
            "</p>\n";
    }

    ?>
</div>
<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('Telefoonnummer', 'coachTelefoonnummer') .
        "<br>";
    if ($coach) {
        echo form_input('coachTelefoonnummer',$coach->telefoonnummer,'id="coachTelefoonnummer" class="form-control" disabled') .
            "</p>\n";
    } else {
        echo form_input('coachTelefoonnummer','','id="coachTelefoonnummer" class="form-control" disabled') .
            "</p>\n";
    }

    ?>
</div>
<div class="col-12 col-md-6">
    <?php

    echo "<p>" .
        form_label('E-mail', 'coachEmail') .
        "<br>";
    if ($coach) {
        echo form_input('coachEmail',$coach->email,'id="coachEmail" class="form-control" disabled') .
            "</p>\n";
    } else {
        echo form_input('coachEmail','','id="coachEmail" class="form-control" disabled') .
            "</p>\n";
    }

    ?>
</div>
<div class="row">

<?php


echo heading($titel,2,'class="mb-3"') . "\n";
echo form_open();
echo heading('Persoon',3,'class="mb-2"') . "\n";


?>

<div class="col-lg-6">
    <?php

    echo "<p>" .
        form_label('Voornaam', 'voornaam') .
        "<br>" .
        form_input('','','id="voornaam"') .
        "</p>\n";

    echo "<p>" .
        form_label('Naam', 'naam') .
        "<br>" .
        form_input('','','id="naam"') .
        "</p>\n";

    echo "<p>" .
        form_label('MMC-nummer', 'mmcNummer') .
        "<br>" .
        form_input('','','id="mmcNummer"') .
        "</p>\n";

    ?>
</div>
<div class="col-lg-6">
    <?php

    echo "<p>" .
        form_label('Voornaam', 'voornaam') .
        "<br>" .
        form_input('','','id="voornaam"') .
        "</p>\n";

    echo "<p>" .
        form_label('Naam', 'naam') .
        "<br>" .
        form_input('','','id="naam"') .
        "</p>\n";

    echo "<p>" .
        form_label('MMC-nummer', 'mmcNummer') .
        "<br>" .
        form_input('','','id="mmcNummer"') .
        "</p>\n";

    ?>
</div>

</div>

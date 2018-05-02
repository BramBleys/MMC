<?php
    /**
     * @file contact.php
     *
     * View waar de bezoeker of gebruiker de contactgegevens kan vinden
     */
?>
<div class="row">
    <?php
        echo '<h3 class="col-lg-12">' . $titel . '</h3>';

        foreach ($inhoud as $rij) {
            switch ($rij->naam) {
                case "blok1":
                    $inhoud = explode(";", $rij->inhoud);
                    echo '<h3 class="col-lg-12">' . $rij->titel . '</h3>';
                    echo '<p class="col-lg-6">' . $inhoud[0] . '<br />' . $inhoud[1] . '<p>';
                    echo '<p class="col-lg-6">' . $inhoud[2] . ' ' . $inhoud[3] . ' <br />' . $inhoud[4] . '</p>';
                    break;
                case "blok2":
                    $inhoud = explode(";", $rij->inhoud);
                    echo '<p class="col-lg-12 marginTop">' . $inhoud[0] . '<a href="tel: ' . str_replace(' ', '', $inhoud[1]) . '">' . ' ' . $inhoud[1] . '</a>'
                        . '<br/>' . $inhoud[2] . '<a href="mailto: ' . str_replace(' ', '', $inhoud[3]) . '">' . ' ' . $inhoud[3] . '</a>'
                        . '<br/>' . $inhoud[4] . '<a href="http://www.taxistop.be">' . ' ' . $inhoud[5] . '</a></p>';
                    break;
            }
        }
    ?>
</div>


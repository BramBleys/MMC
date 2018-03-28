<div class="row">
    <?php
        foreach ($inhoud as $rij) {
            switch ($rij->naam) {
                case "blok1":
                    echo '<div class="col-lg-12"><h3>' . $rij->titel . '</h3><p>' . $rij->inhoud . "</p></div>\n";
                    break;
                case "blok2":
                    echo '<div class="col-lg-6"><h3>' . $rij->titel . '</h3><p>' . $rij->inhoud . "</p></div>\n";
                    break;
                case "blok3":
                    echo '<div class="col-lg-6"><h3>' . $rij->titel . '</h3><p>' . $rij->inhoud . "</p></div>\n";
                    break;
                case "blok4":
                    $inhoud = explode("-", $rij->inhoud);
                    echo '<div class="col-lg-12"><h3>' . $rij->titel . '</h3>';
                    echo '<ul>';
                    for ($i = 0; $i < count($inhoud); $i++) {
                        echo '<li>' . $inhoud[$i] . '</li>';
                    }
                    echo '</ul></div>';
                    break;
                case "blok5":
                    echo '<div class="col-lg-4">' . toonAfbeelding($rij->inhoud, 'alt="' . $rij->titel . '" class="img-fluid"') . "</div>\n";
                    break;
                case "blok6":
                    echo '<div class="col-lg-4">' . toonAfbeelding($rij->inhoud, 'alt="' . $rij->titel . '" class="img-fluid"') . "</div>\n";
                    break;
                case "blok7":
                    echo '<div class="col-lg-4">' . toonAfbeelding($rij->inhoud, 'alt="' . $rij->titel . '" class="img-fluid"') . "</div>\n";
                    break;
            }
        }
    ?>
</div>

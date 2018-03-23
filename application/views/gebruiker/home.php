<?php
    foreach ($inhoud as $rij) {
        switch ($rij->naam) {
            case "blok1":
                echo '<div class="col-lg-12"><h3>' . $rij->titel . '</h3><p>' . $rij->inhoud . '</p></div>';
                break;
            case "blok2":
                //TODO langs elkaar zetten, col-lg-6 werkt precies niet?
                echo '<div class="col-lg-4"><h3>' . $rij->titel . '</h3><p>' . $rij->inhoud . '</p></div>';
                break;
            case "blok3":
                echo '<div class="col-lg-4"><h3>' . $rij->titel . '</h3><p>' . $rij->inhoud . '</p></div>';
                break;
            case "blok4":
                //TODO ul maken ipv p
                echo '<div class="col-lg-12"><h3>' . $rij->titel . '</h3><p>' . $rij->inhoud . '</p></div>';
                break;
            case "blok5":
                echo toonAfbeelding($rij->inhoud,'alt="' . $rij->titel .'" class="col-lg-4"');
                break;
            case "blok6":
                echo toonAfbeelding($rij->inhoud,'alt="' . $rij->titel .'" class="col-lg-4"');
                break;
            case "blok7":
                echo toonAfbeelding($rij->inhoud,'alt="' . $rij->titel .'" class="col-lg-4"');
                break;
        }
    }
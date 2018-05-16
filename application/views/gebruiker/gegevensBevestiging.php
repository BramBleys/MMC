<?php
    /**
     * @file gegevensBevestiging.php
     *
     * View waar de gebruiker een overzicht krijgt van de wijzigingen die hij gedaan heeft aan zijn account.
     */
?>

<ul class="list-group">
    <li class="list-group-item achtergrond">Wijzigingen aangepast</li>
    <?php
        //ga door het object en laat zien wat de nieuwe gegevens zijn
        foreach ($gegevens as $name => $value) {
            if($name !== "id"){
                echo '<li class="list-group-item">' . ucfirst($name) . ': ' . $value . '</li>';
            }
        }
    ?>
</ul>
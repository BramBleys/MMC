<?php
    /**
     * @file home_fout.php
     *
     * View met een error melding voor de gebruiker waarvan de gebruikersnaam of het wachtwoord verkeerd was bij het inloggen
     */
?>
    <h3>De gebruikersnaam of het wachtwoord is niet correct.</h3>
<?php
    echo anchor('home/inloggen', 'Terug');

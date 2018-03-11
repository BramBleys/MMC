<div class="nav flex-column achtergrond marginTop">
    <ul>
        <?php
            //als er niemand aangemeld is
            if ($gebruiker == null) {
                echo '<li class="nav-item">' . anchor("home/inloggen", "Inloggen", 'class= "nav-link"') . '</li>';
            } else {
                //kijken met welk type gebruiker je bent aangemeld en bijpassende balk tonen
                switch ($gebruiker->soortId) {
                    case 1: //minder mobiele
                        echo '<li class="nav-item">' . anchor("MinderMobiele/rittenBeheren", "Ritten beheren", 'class= "nav-link"') . '</li>';
                        break;
                    case 2: //coach
                        echo '<li class="nav-item">' . anchor("Coach/rittenBeheren", "Ritten beheren", 'class= "nav-link"') . '</li>';
                        echo '<li class="nav-item">' . anchor("Coach/minderMobieleBeheren", "Minder mobielen beheren", 'class= "nav-link"') . '</li>';
                        break;
                    case 3: //vrijwilliger
                        echo '<li class="nav-item">' . anchor("Vrijwilliger/beschikbaarheidIngeven", "Beschikbaarheid ingeven", 'class= "nav-link"') . '</li>';
                        echo '<li class="nav-item">' . anchor("Vrijwilliger/agendaBekijken", "Agenda bekijken", 'class= "nav-link"') . '</li>';
                        break;
                    case 4: //mmc medewerker
                        echo '<li class="nav-item">' . anchor("MMCMedewerker/aanvragenBeheren", "Aanvragen beheren", 'class= "nav-link"') . '</li>';
                        echo '<li class="nav-item">' . anchor("MMCMedewerker/gebruikersBeheren", "Gebruikers beheren", 'class= "nav-link"') . '</li>';
                        break;
                    case 5: //administrator
                        echo '<li class="nav-item">' . anchor("Administrator/aanvragenBeheren", "Aanvragen beheren", 'class= "nav-link"') . '</li>';
                        echo '<li class="nav-item">' . anchor("Administrator/gebruikersBeheren", "Gebruikers beheren", 'class= "nav-link"') . '</li>';
                        echo '<li class="nav-item">' . anchor("Administrator/sjablonenBeheren", "Sjablonen beheren", 'class= "nav-link"') . '</li>';
                        echo '<li class="nav-item">' . anchor("Administrator/websiteBeheren", "Website beheren", 'class= "nav-link"') . '</li>';
                        echo '<li class="nav-item">' . anchor("Administrator/index", "Configuratie beheren", 'class= "nav-link"') . '</li>';
                        echo '<li class="nav-item">' . anchor("Administrator/MMCMedewerkersBeheren", "MMC medewerkers beheren", 'class= "nav-link"') . '</li>';
                        break;
                }

                //2 linken die elke gebruiker ziet
                echo '<li class="nav-item marginTop">' . anchor("home/accountBeheren", "Account beheren", 'class= "nav-link"') . '</li>';
                echo '<li class="nav-item">' . anchor("home/uitloggen", "Uitloggen", 'class= "nav-link"') . '</li>';
            }
        ?>
    </ul>
</div>
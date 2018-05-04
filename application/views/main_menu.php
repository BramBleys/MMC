<div class="nav flex-column achtergrond marginTop">
    <ul>
        <?php
            //als er niemand aangemeld is
            if ($gebruiker == null) {
                echo '<li class="nav-item">' . anchor("home/faq", "FAQ", 'class= "nav-link"') . '</li>';
                echo '<li class="nav-item">' . anchor("home/inloggen", "Inloggen", 'class= "nav-link"') . '</li>';
            } else if($gebruiker === "0"){
                echo '<li class="nav-item">' . anchor("home/faq", "FAQ", 'class= "nav-link"') . '</li>';
            } else {
                //controleren of de gebruiker meer als 1 type gebruiker is. (Bv Coach en vrijwilliger)
                if (strlen($gebruiker->soortId) > 1) {
                    $idArray = str_split($gebruiker->soortId); //meerdere types opsplitsen
                    for ($i = 0; $i < count($idArray); $i++) { //balk opvullen voor gebruiker van meerdere types
                        //kijken met welk type gebruiker je bent aangemeld en bijpassende balk tonen
                        switch ($idArray[$i]) {
                            case 1: //minder mobiele
                                if(!in_array('2', $idArray)){
                                    echo '<li class="nav-item">' . anchor("MinderMobiele/", "Overzicht ritten", 'class= "nav-link"') . '</li>';
                                    echo '<li class="nav-item">' . anchor("MinderMobiele/nieuweRit", "Nieuwe rit aanvragen", 'class= "nav-link"') . '</li>';
                                }
                                break;
                            case 2: //coach
                                if(in_array('1', $idArray)){
                                    echo '<li class="nav-item">' . anchor("Coach/rittenBeheren/$gebruiker->id", "Overzicht ritten", 'class= "nav-link"') . '</li>';
                                    echo '<li class="nav-item">' . anchor("Coach/nieuweRit/$gebruiker->id", "Nieuwe rit aanvragen", 'class= "nav-link"') . '</li>';
                                } else{
                                    echo '<li class="nav-item">' . anchor("Coach/rittenBeheren/a", "Overzicht ritten", 'class= "nav-link"') . '</li>';
                                    echo '<li class="nav-item">' . anchor("Coach/nieuweRit/a", "Nieuwe rit aanvragen", 'class= "nav-link"') . '</li>';
                                }
                                echo '<li class="nav-item">' . anchor("Coach/", "Overzicht personen", 'class= "nav-link"') . '</li>';
                                break;
                            case 3: //vrijwilliger
                                echo '<li class="nav-item">' . anchor("Vrijwilliger/beschikbaarheidIngeven", "Beschikbaarheid ingeven", 'class= "nav-link"') . '</li>';
                                echo '<li class="nav-item">' . anchor("Vrijwilliger/agendaBekijken", "Agenda bekijken", 'class= "nav-link"') . '</li>';
                                break;
                            case 4: //mmc medewerker
                                echo '<li class="nav-item">' . anchor("MMCMedewerker/aanvragenBeheren", "Aanvragen beheren", 'class= "nav-link"') . '</li>';
                                echo '<li class="nav-item">' . anchor("MMCMedewerker/gebruikersBeheren/1", "Gebruikers beheren", 'class= "nav-link"') . '</li>';
                                break;
                            case 5: //administrator
                                echo '<li class="nav-item">' . anchor("administrator/aanvragenBeheren", "Aanvragen beheren", 'class= "nav-link"') . '</li>';
                                echo '<li class="nav-item">' . anchor("administrator/gebruikersBeheren/1", "Gebruikers beheren", 'class= "nav-link"') . '</li>';
                                echo '<li class="nav-item">' . anchor("administrator/sjablonenBeheren", "Sjablonen beheren", 'class= "nav-link"') . '</li>';
                                echo '<li class="nav-item">' . anchor("administrator/websiteBeheren", "Website beheren", 'class= "nav-link"') . '</li>';
                                echo '<li class="nav-item">' . anchor("administrator/index", "Parameters beheren", 'class= "nav-link"') . '</li>';
                                break;
                        }
                    }
                } else { //Als de gebruiker maar 1 type gebruiker is
                    switch ($gebruiker->soortId) {
                        case 1: //minder mobiele
                            echo '<li class="nav-item">' . anchor("MinderMobiele/", "Overzicht ritten", 'class= "nav-link"') . '</li>';
                            echo '<li class="nav-item">' . anchor("MinderMobiele/nieuweRit", "Nieuwe rit aanvragen", 'class= "nav-link"') . '</li>';
                            break;
                        case 2: //coach
                            echo '<li class="nav-item">' . anchor("Coach/rittenBeheren/a", "Overzicht ritten", 'class= "nav-link"') . '</li>';
                            echo '<li class="nav-item">' . anchor("Coach/nieuweRit/a", "Nieuwe rit aanvragen", 'class= "nav-link"') . '</li>';
                            echo '<li class="nav-item">' . anchor("Coach/", "Overzicht personen", 'class= "nav-link"') . '</li>';
                            break;
                        case 3: //vrijwilliger
                            echo '<li class="nav-item">' . anchor("Vrijwilliger/beschikbaarheidIngeven", "Beschikbaarheid ingeven", 'class= "nav-link"') . '</li>';
                            echo '<li class="nav-item">' . anchor("Vrijwilliger/agendaBekijken", "Agenda bekijken", 'class= "nav-link"') . '</li>';
                            break;
                        case 4: //mmc medewerker
                            echo '<li class="nav-item">' . anchor("MMCMedewerker/aanvragenBeheren", "Aanvragen beheren", 'class= "nav-link"') . '</li>';
                            echo '<li class="nav-item">' . anchor("MMCMedewerker/gebruikersBeheren/1", "Gebruikers beheren", 'class= "nav-link"') . '</li>';
                            break;
                        case 5: //administrator
                            echo '<li class="nav-item">' . anchor("Administrator/aanvragenBeheren", "Aanvragen beheren", 'class= "nav-link"') . '</li>';
                            echo '<li class="nav-item">' . anchor("Administrator/gebruikersBeheren/1", "Gebruikers beheren", 'class= "nav-link"') . '</li>';
                            echo '<li class="nav-item">' . anchor("Administrator/sjablonenBeheren", "Sjablonen beheren", 'class= "nav-link"') . '</li>';
                            echo '<li class="nav-item">' . anchor("Administrator/websiteBeheren", "Website beheren", 'class= "nav-link"') . '</li>';
                            echo '<li class="nav-item">' . anchor("Administrator/index", "Parameters beheren", 'class= "nav-link"') . '</li>';
                            break;
                    }
                }

                //2 linken die elke gebruiker ziet
                echo '<li class="nav-item marginTop">' . anchor("home/faq", "FAQ", 'class= "nav-link"') . '</li>';

                if ( !in_array('2', str_split($gebruiker->soortId))){
                    echo '<li class="nav-item">' . anchor("Gebruiker/accountBeheren", "Persoonlijke gegevens aanpassen", 'class= "nav-link"') . '</li>';
                } else {
                    echo '<li class="nav-item">' . anchor("Coach/accountsBeheren/$gebruiker->id", "Gegevens personen aanpassen", 'class= "nav-link"') . '</li>';
                }
                echo '<li class="nav-item">' . anchor("home/uitloggen", "Uitloggen", 'class= "nav-link"') . '</li>';
            }
        ?>
    </ul>
</div>

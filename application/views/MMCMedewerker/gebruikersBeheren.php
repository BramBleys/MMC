<h2><?php echo $titel; ?></h2>

<div class="row">
    <div class="col-12">
        <form action="" class="form-inline">
            <div class="form-group">
                <label for="zoekVeld"></label>
                <input type="text" class="form-control" placeholder="Vul hier een zoekterm in.">
                <button type="submit" class="btn btn-primary mx-2">Zoeken</button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <a href="" class="btn btn-primary">Minder Mobielen</a>
        <a href="" class="btn btn-primary">Coaches</a>
        <a href="" class="btn btn-primary">Chauffeurs</a>
        <a href="" class="btn btn-primary">Gebruiker toevoegen</a>
    </div>
    <div class="col-9">
        <table class="table">
            <tr>
                <th>Voornaam</th>
                <th>Naam</th>
                <th>E-mail</th>
                <th></th>
            </tr>
            <?php

            foreach ($gebruikers as $gebruiker) {
                echo "<tr>\n" .
                    "<td>" . $gebruiker->voornaam . "</td>\n" .
                    "<td>" . $gebruiker->naam . "</td>\n" .
                    "<td>" . $gebruiker->email . "</td>\n" .
                    "<td>" .
                    "<i class=\"material-icons\"><a href=\"\">edit</a></i>\n" .
                    "<i class=\"material-icons\"><a href=\"\">directions_car</a></i>\n" .
                    "</td>\n" .
                    "</tr>\n";
            }

            ?>
        </table>
    </div>
</div>
<h3>Bezoeker</h3>
<div>
    <div class="card">
        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
            <h6 class="mb-0">Waarom kan ik mij niet inloggen?</h6>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                Om in te loggen moet je geregistreerd zijn in ons systeem. Als je geen minder mobiele, vrijwilliger,
                coach of MMC medewerker bent dan zal je je niet kunnen inloggen. Als je wel 1 van deze personen bent dan
                is je gebruikersnaam of wachtwoord fout.
            </div>
        </div>
    </div>
</div>

<h3 class="mt-4">Minder Mobiele</h3>
<div id="accordion">
    <div class="card">
        <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo">
            <h6 class="mb-0">Waarom kan ik geen nieuwe rit meer aanmaken?</h6>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                Er zit een limiet op het aantal ritten dat je kan aanmaken als minder mobiele. Momenteel staat de limiet
                ingesteld op <?php echo $parameters->maxRitten ?>.
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseThree">
            <h6 class="mb-0">Waarom kan ik een rit niet annuleren?</h6>
        </div>

        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
                Je kan een rit niet annuleren als de tijd tot de rit minder is
                dan <?php echo $parameters->annulatieTijd ?> uur.
            </div>
        </div>
    </div>
</div>
<h3 class="mt-4">Vrijwilliger</h3>
<div>
    <div class="card">
        <div class="card-header" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-controls="collapseFour">
            <h6 class="mb-0">Hoe moet ik de agenda gebruiken om mijn beschikbaarheid in te geven?</h6>
        </div>

        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
            <div class="card-body">
                Om de agenda makkelijk te kunnen gebruiken hebben wij een hulpfunctie voorzien. Door op de knop "Help
                en ondersteuning" te klikken die op de pagina van de agenda staat kan je deze hulpfunctie bekijken.
            </div>
        </div>
    </div>
</div>
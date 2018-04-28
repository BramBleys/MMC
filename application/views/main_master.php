<?php
    /**
     * @mainpage Commentaar bij Project21_1718
     * # Wat?
     * Je vindt hier onze Doxygen-commentaar bij het PHP-project <b>Project21_1718</b>.
     * - De commentaar bij onze model- en controller-klassen vind je onder het menu <em>Klassen</em>
     * - De commentaar bij onze view-bestanden vind je onder het menu <em>Bestanden</em>
     * - ook de originele commentaar geschreven bij het CodeIgniter-framework is opgenomen.
     *
     * # Wie?
     * Dit project is geschreven en becommentarieerd door Bram Bleys, Kilian Fastenakels, Dylan Vernelen Ebert, Christophe Van Hoof
     */
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Font awesome-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Eigen CSS -->
    <?php echo haalCssOp("mmc.css"); ?>
    <?php echo haalCssOp("plugin.css");?>


    <title>MMC - <?php echo $titel; ?></title>

    <script type="text/javascript">
        var site_url = '<?php echo site_url(); ?>';
        var base_url = '<?php echo base_url(); ?>';
    </script>

    <!--laad jQuery-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <?php echo anchor('home/index', 'MMC', array('class' => 'navbar-brand')) . "\n" ?>
                <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="primaryNav">
                    <div class="navbar-nav">
                        <?php echo anchor('home/index', 'Home <span class="sr-only">(current)</span>', array('class' => 'nav-item nav-link active')) . "\n" ?>
                        <?php echo anchor('home/contact', 'Contact', array('class' => 'nav-item nav-link')) . "\n" ?>

                    </div>
                </div>
                <div class="text-right">
                    <span><i>Dit is een proefproject!</i></span>
                </div>
            </div>
        </nav>
    </header>
    <main id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 offset-lg-1 order-lg-12">
                    <aside>
                        <nav>
                            <?php echo $navigatie; ?>
                        </nav>
                    </aside>
                </div>
                <div class="col-lg-8 order-lg-1">
                    <main class="marginTop">
                        <?php echo $inhoud; ?>
                    </main>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer sticky-bottom">
        <div class="footer-main d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8 leftText">
                        <p>Deze pagina is gemaakt door <?php echo $gemaaktDoor; ?></p>
                        <h5>Team 21</h5>
                        <p>
                            Bram Bleys<br>
                            Kilian Fastenakels<br>
                            Dylan Vernelen Ebert<br>
                            Christophe Van Hoof
                        </p>
                        <p>Opdrachtgever: Mevr. Maes</p>
                    </div>
                    <div class="col-12 col-md-4 rightText">
                        <h3>Contactgegevens</h3>
                        <p>
                            Tel: 070 22 22 92<br>
                            E-mail: mmc@taxistop.be<br>
                            Andere websites: www.taxistop.be
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <hr class="hr-footer">
                    </div>
                    <div class="col-6">
                        <p class="text-left">Made with <i class="material-icons">favorite</i> by Brogrammers</p>
                    </div>
                    <div class="col-6">
                        <p class="text-right">&copy; MMC - 2018</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqlqcIjp4kyOuwbT3HgmNrhKN1shR4R90" async defer></script>
</body>
</html>
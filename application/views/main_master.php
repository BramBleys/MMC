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
    <!-- Eigen CSS -->
    <?php echo haalCssOp("mmc.css"); ?>


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
                <?php echo anchor('home/index', 'MMC' , array('class' => 'navbar-brand')) . "\n" ?>
                <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="primaryNav">
                    <div class="navbar-nav">
                        <?php echo anchor('home/index', 'Home <span class="sr-only">(current)</span>' , array('class' => 'nav-item nav-link active')) . "\n" ?>
                        <?php echo anchor('home/contact', 'Contact' , array('class' => 'nav-item nav-link')) . "\n" ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <main class="marginTop">
                        <?php echo $inhoud; ?>
                    </main>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <aside>
                        <nav>
                            <?php echo $navigatie; ?>
                        </nav>
                    </aside>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer sticky-bottom">
        <div class="footer-main d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">

                    </div>
                    <div class="col-lg-6 text-right">
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
                    <div class="col">
                        <p class="text-left">Made with <i class="material-icons">favorite</i> by <a href="#">Brogrammers</a></p>
                    </div>
                    <div class="col">
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
</body>
</html>
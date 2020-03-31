<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fSit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>GSB</title>

    <!-- Bootstrap core CSS -->
    <link href="style_header.css" rel="stylesheet">
    <?php if(isset($headerCSS)) {
        echo $headerCSS;
    }
    ?>
</head>

<body>


<header>
     
    <!-- <nav class="navbar navbar-expand-md navbar-dark bg-dark">  -->
    <div class="container">
            <div class="branding">
              <a href="../index.php"><img src="../img/logo-gsb2.png" alt="" class="logo_gsb"></a> 
            </div>

    <nav class="header-nav">
                <ul>
                    <li class="active"><a href="../index.php">Accueil</a></li>
                    <li><a href="../about.php">About</a></li>
                    <li><a href="../nouveaute.php">Nouveaute</a></li>
                    <li><a href="../galerie.php">Galerie</a></li>
                    <li><a href="../contact.php">Contact</a></li>                  
                </ul>

        <!-- <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto"> -->

            <?php if(isset($_SESSION['auth'])): ?>

        
                    <a class="nav-link" href="logout.php">Se deconnecter</a>
               <?php else: ?>
                    <a class="nav-link" href="register.php">S'inscrire </a>
                    <a class="nav-link" href="login.php">Se connecter </a>
              



<?php endif; ?>


          

        
    </nav>

    <!-- <div class="container">  -->
    <section class="showcase">
        <div class="container"></div>
    </section>

    <?php if(isset($_SESSION['flash'])): ?>
    <?php
        // envoie les alert danger ... en type message
        foreach($_SESSION['flash'] as $type => $messge):?>

            <div class="alert alert-<?= $type; ?>">
            <?= $messge; ?>
            </div>

    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
    <?php endif ;?>
</header>
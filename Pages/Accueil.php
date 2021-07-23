<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../FeuilleCss.css">
  <title>Accueil</title>
</head>
<body>
  <header class="accueil">
    <div class="header">
      <div class="logo">
        <img class="logo" src="../Images/logo.png" alt="">
      </div>
      <div class="Titre">
        <h1 class="vva">Village Vacances</h1>
      </div>
      <div class="Connect">
        <?php
        if(isset($_SESSION['username'])){
          echo '<h2 class="test">Mon profil : <a class="connecté" href="profil.php">', $_SESSION["username"]. '</a><br /><a class="connexion" href="../include/deconnexion.php">Se déconnecter</a></h2>';
        }
        else {
          echo '<h2><a class="connexion" href="inscrixion.php">Se connecter</a></h2>';
        }
        ?>
      </div>
    </div>
    <nav class="photo">
      <div class="nav">
        <a href="Accueil.php"><img class="icone" src="../images/home.png" alt=""> </a>
      </div>
      <div class="nav">
        <a class="nav" href="Animations.php">Nos Animations</a>
      </div>
      <div class="nav">
        <a class="nav" href="Reserver.php">Réserver</a>
      </div>
    </nav>
  </header>
  <div class="imgacc">
    <img src="../Images/neige.jpg" alt="">
  </div>
  <div class="image">
  <div class="Imageuh">
    <div>
      <h1 class="titre"> Nos pistes </h1>
      <h3>Nous proposons des pistes pour tous les ages allant de 7 à 77 ans. Celles-ci sont aussi classées par difficulté mais sont bien évidemment encadrée par nos professionnels qui feront tout pour vous épauler tout au long de votre séjour parmi nous.</h3>
    </div>
    <figure class="droite">
      <img class="img2" src="../images/piste.jpg" alt="" width="500px">
    </figure>
  </div>
  <div class="Imageuh">
    <figure>
      <img class="img" src="../images/ski.jpg" alt="" width="500px">
    </figure>
    <div class="textimg">
      <h1 class="titre"> Loisirs : </h1>
      <h3>Pour ceux qui veulent uniquement passer un bon moment en famille ou entre amis, nous proposons à la location des skis, des snowboards, et des combinaisons qui sauront ravir chacun d'entre vous car VVA est là pour vous.</h3>
      </div>
    </div>
    <div class="Imageuh">
      <div>
        <h1 class="titre"> Locaux : </h1>
        <h3>Nous proposons évidemment à la location des chalets afin que vous puissiez vous reposer après une rude journée, les chalets sont intégralement chauffés et tout équipé, l'idéal est à portée de main.</h3>
      </div>
      <figure class="droite">
        <img class="img2" src="../images/chalet.jpg" alt="" width="500px">
      </figure>
    </div>
  </div>

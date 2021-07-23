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
    <nav>
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
  <div class="anima">
    <?php
    $con = mysqli_connect("localhost", "root", "", "Gacti");
    mysqli_set_charset($con,"utf8");
    $req = "SELECT * FROM ACTIVITE ORDER BY NOACT";
    $res = mysqli_query($con, $req);
    echo "<table class='presta'><tr><th class='presta'> Numéro Activité </th><th class='presta'> Code animation </th><th class='presta'> Code Etat Activité </th><th class='presta'> Date Activité </th><th class='presta'> Heure RDV Activité </th>
    <th class='presta'> Prix Activité </th><th class='presta'> Heure Début Activité </th><th class='presta'> Heure Fin Activité </th><th class='presta'> Nom Reponsable </th><th class='presta'> Prénom Responsable </th></tr>";
    while ($ligne = mysqli_fetch_array($res)) {
      echo '<tr> <td class="presta">', $ligne["NOACT"], '</td> <td class="presta">', $ligne["CODEANIM"], '</td> <td class="presta">', $ligne["CODEETATACT"],
      '</td> <td class="presta">', $ligne["DATEACT"], '</td> <td class="presta">', $ligne["HRRDVACT"], '</td> <td class="presta">', $ligne["PRIXACT"],'</td> <td class="presta">',
      $ligne["HRDEBUTACT"],'</td> <td class="presta">', $ligne["HRFINACT"],'</td> <td class="presta">', $ligne["NOMRESP"],'</td>', '<td class="presta">', $ligne["PRENOMRESP"],'</td></tr>';}
      echo "</table>";
      mysqli_close($con);
      ?>

      <form class='bouton' action='Reserver.php' method='post'>
        <input class='bouton marge' type='submit' name='inscription' value='Inscription'>
        <input class='bouton' type='submit' name='avoid' value='Annuler une inscription'>
      </form>

      <?php if (isset($_POST["inscription"])) {
        include("../include/Reservation.php");
      }
      if(isset($_SESSION['username'])){
        if (isset($_POST['Inscrip'])) {
          $user = $_SESSION['username'];
          $con = mysqli_connect("localhost", "root", "", "Gacti");
          mysqli_set_charset($con,"utf8");
          $Num = $_POST['NumInscr'];
          $date = date('y-m-d');
          $req = "INSERT INTO inscription(USER,NOACT,DATEINSCRIP,DATEANNULE) VALUES ('$user',$Num,'$date',NULL)";
          $res = mysqli_query($con,$req);
        }
      }

      if (isset($_POST['avoid'])) {
        include("../include/Annula.php");
        $con= mysqli_connect("localhost","root","","Gacti");
        mysqli_set_charset($con,"utf8");
        $user = $_SESSION['username'];
        $req = "SELECT * from Inscription WHERE USER = '$user'";
        $res = mysqli_query($con,$req);
        while ($ligne = mysqli_fetch_array($res)) {
          echo '<tr><td class="presta">', $ligne["NOINSCRIP"], '</td><td class="presta">', $ligne["NOACT"], '</td><td class="presta">', $ligne["DATEINSCRIP"],'</td></tr>';
        }
          echo "</table>";
          echo "<br><br>";
          include("../include/AnnulationReserv.php");

      }
      if (isset($_POST['désinscrire'])) {
        $Num = $_POST['NumInscri'];
        $con = mysqli_connect("localhost", "root", "", "Gacti");
        mysqli_set_charset($con,"utf8");
        $req = "DELETE FROM Inscription WHERE NOINSCRIP = '$Num'";
        $res = mysqli_query($con,$req);
      }
      if(isset($_SESSION['username'])){
        $user = $_SESSION['username'];
        $con = mysqli_connect("localhost", "root", "", "Gacti");
        mysqli_set_charset($con,"utf8");
        $req = "SELECT typeprofil FROM Compte WHERE typeprofil = 'RP' AND user='$user'";
        $res = mysqli_query($con, $req);
        $rows= mysqli_num_rows($res);
        if ($rows==1) {
          echo "<form class='bouton' action='Reserver.php' method='post'>
            <input class='bouton' type='submit' name='Voir' value='Voir les inscrits'>
            </form>
            <br>";
          }
        }
        if (isset($_POST['Voir'])) {
          include("../Include/Voir.php");
        }
        if (isset($_POST['connaitre'])) {
          $Num = $_POST['NumInscri'];
          $con = mysqli_connect("localhost", "root", "", "Gacti");
          mysqli_set_charset($con,"utf8");
          $req = "SELECT * FROM inscription WHERE NOACT = '$Num'";
          $res = mysqli_query($con, $req);
          echo '<table class="presta"><tr><td class="presta">', "Nom : ", '</td></tr>' ;
          while ($ligne = mysqli_fetch_array($res)) {
            echo '<tr><td class="presta">', $ligne["USER"], '</td></tr>';
        }
      }
      ?>

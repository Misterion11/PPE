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
    $con =  mysqli_connect("localhost", "root", "", "Gacti");
    mysqli_set_charset($con,"utf8");
    $req = "SELECT * FROM ETAT_ACT";
    $res = mysqli_query($con, $req);
    echo "<table class='presta'><tr><th> Code Etat Activité </th><th> Nom Etat Activité </th>";
    while ($ligne = mysqli_fetch_array($res)) {
      echo '<tr> <td class="presta">', $ligne["CODEETATACT"], '</td> <td class="presta">', $ligne["NOMETATACT"], '</td></tr>';}
      echo "</table>";
      ?>
    </div>
    <form class='bouton' action='EtatAct.php' method='post'>
      <input class='bouton marge' type='submit' name='ajoutE' value='Ajouter Etat Activité'>
      <input class='bouton marge' type='submit' name='modifE' value='Modifier Etat Activité'>
      <input class='bouton marge' type='submit' name='suppE' value='Supprimer Etat Activité'>
    </form>


    <!-- Ajouter une animation -->
    <?php if (isset($_POST["ajoutE"])) {
      include('../include/FormAjoutEtat.html');
    }
    if (isset($_POST['AjouterEt'])) {
      $codeEt = $_POST['CodeEt'];
      $NomEt = $_POST['NomEt'];
        $req = "INSERT INTO Etat_act (CODEETATACT,NOMETATACT) VALUES ('$codeEt','$NomEt')";
        $res= mysqli_query($con,$req);
        mysqli_close($con);
        header("Refresh:0");
      }
// Pensez à ajouter une modification automatique du type animation dans animation en cas de modif via le formualaire (suppression ou modif)

    // Modifier une animation
    if (isset($_POST["modifE"])) {
      include('../include/FormModifEtat.html');
    }
    if (isset($_POST['ModifierEt'])) {
      $OldcodeEt = $_POST['AncienCodeEt'];
      $codeEt = $_POST['CodeEt'];
      $NomEt = $_POST['NomEt'];
      $req = "SELECT * FROM ETAT_ACT WHERE CODEETATACT = '$OldcodeEt'";
      $res = mysqli_query($con,$req);
      $ligne = mysqli_fetch_array($res);
      if (empty($codeEt)) {
        $codeEt =  $OldcodeEt ;
      }
      if (empty($NomEt)) {
        $NomEt = $ligne['NOMETATACT'];
      }
      $req = "UPDATE ETAT_ACT SET CODEETATACT= '$codeEt', NOMETATACT = '$NomEt' WHERE CODEETATACT = '$OldcodeEt'";
      $res= mysqli_query($con,$req);
      header("Refresh:0");
    }

    // La suppression
    if (isset($_POST["suppE"])) {
      include('../include/FormSupprEtat.html');
    }
    if (isset($_POST['supprEt'])) {
      $codeE = $_POST['codeE'];
      $con = mysqli_connect("localhost","root","","Gacti");
      mysqli_set_charset($con,"utf8");
      $req = "DELETE FROM ETAT_ACT WHERE CODEETATACT = '$codeE'";
      $res = mysqli_query($con,$req);
      mysqli_close($con);
      header("Refresh:0");
    }
    ?>

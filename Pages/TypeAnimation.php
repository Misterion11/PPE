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
    $req = "SELECT * FROM TYPE_ANIM";
    $res = mysqli_query($con, $req);
    echo "<table class='presta'><tr><th> Code Type Animation </th><th> Nom Type Animation </th>";
    while ($ligne = mysqli_fetch_array($res)) {
      echo '<tr> <td class="presta">', $ligne["CODETYPEANIM"], '</td> <td class="presta">', $ligne["NOMTYPEANIM"], '</td></tr>';}
      echo "</table>";
      ?>
    </div>
    <form class='bouton' action='TypeAnimation.php' method='post'>
      <input class='bouton marge' type='submit' name='ajoutT' value='Ajouter Type animation'>
      <input class='bouton marge' type='submit' name='modifT' value='Modifier Type animation'>
      <input class='bouton marge' type='submit' name='suppT' value='Supprimer Type animation'>
    </form>


    <!-- Ajouter une animation -->
    <?php if (isset($_POST["ajoutT"])) {
      include('../include/FormAjoutType.html');
    }
    if (isset($_POST['AjouterTy'])) {
      $codety = $_POST['CodeTy'];
      $NomTy = $_POST['NomTy'];
        $req = "INSERT INTO TYPE_ANIM (CODETYPEANIM,NOMTYPEANIM)
        VALUES ('$codety','$NomTy')";
        $res= mysqli_query($con,$req);
        mysqli_close($con);
        header("Refresh:0");
      }
// Pensez à ajouter une modification automatique du type animation dans animation en cas de modif via le formualaire (suppression ou modif)

    // Modifier une animation
    if (isset($_POST["modifT"])) {
      include('../include/FormModifType.html');
    }
    if (isset($_POST['ModifierTy'])) {
      $Oldcodety = $_POST['AncienCodeTy'];
      $codetym = $_POST['CodeTyM'];
      $NomTym = $_POST['NomTyM'];
      $req = "SELECT * FROM TYPE_ANIM WHERE CODETYPEANIM = '$Oldcodety'";
      $res = mysqli_query($con,$req);
      $ligne = mysqli_fetch_array($res);
      if (empty($codetym)) {
        $codetym =  $Oldcodety ;
      }
      if (empty($NomTym)) {
        $NomTym = $ligne['NOMTYPEANIM'];
      }
      $req = "UPDATE TYPE_ANIM SET CODETYPEANIM = '$codetym', NOMTYPEANIM = '$NomTym' WHERE CODETYPEANIM = '$Oldcodety'";
      $res= mysqli_query($con,$req);
      header("Refresh:0");
    }

    // La suppression
    if (isset($_POST["suppT"])) {
      include('../include/FormSupprType.html');
    }
    if (isset($_POST['supprTy'])) {
      $codetyS = $_POST['codetypeS'];
      $con= mysqli_connect("localhost","root","","Gacti");
      mysqli_set_charset($con,"utf8");
      $req = "DELETE FROM TYPE_ANIM WHERE CODETYPEANIM = '$codetyS'";
      $res = mysqli_query($con,$req);
      mysqli_close($con);
      header("Refresh:0");
    }
    ?>

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
    $req = "SELECT * FROM Animation";
    $res = mysqli_query($con, $req);
    echo "<table class='presta'><tr><th class='presta'> Code Animation </th><th class='presta'> Code type animation </th><th class='presta'> Nom Animation </th><th class='presta'> Date Création Animation </th><th class='presta'> Date Validité Animation </th>
    <th class='presta'> Durée Animation </th><th class='presta'> Age limite </th><th class='presta'> Tarif Animation </th><th class='presta'> Nombre places restantes </th><th class='presta'> Description Animation </th><th class='presta'> Commentaire Animation </th><th class='presta'> Difficulté Animation </th></tr>";
    while ($ligne = mysqli_fetch_array($res)) {
      echo '<tr> <td class="presta">', $ligne["CODEANIM"], '</td> <td class="presta">', $ligne["CODETYPEANIM"], '</td> <td class="presta">', $ligne["NOMANIM"],
      '</td> <td class="presta">', $ligne["DATECREATIONANIM"], '</td> <td class="presta">', $ligne["DATEVALIDITEANIM"], '</td> <td class="presta">',
      $ligne["DUREEANIM"],'</td> <td class="presta">', $ligne["LIMITEAGE"],'</td> <td class="presta">', $ligne["TARIFANIM"], '</td> <td class="presta">', $ligne["NBREPLACEANIM"],
      '</td><td class="presta">', $ligne['DESCRIPTANIM'], '</td><td class="presta">', $ligne['COMMENTANIM'], '</td><td class="presta">', $ligne['DIFFICULTEANIM'], '</td></tr>';}
      echo "</table></div>";

      if(isset($_SESSION['username'])){
        $user = $_SESSION['username'];
        $con = mysqli_connect("localhost", "root", "", "Gacti");
        mysqli_set_charset($con,"utf8");
        $req = "SELECT typeprofil FROM Compte WHERE typeprofil = 'RP' AND user='$user'";
        $res = mysqli_query($con, $req);
        $rows= mysqli_num_rows($res);
        if ($rows==1) {
          echo "<form class='bouton' action='Animations.php' method='post'>
            <input class='bouton' type='submit' name='ajout' value='Ajouter animation'>
            <input class='bouton marge' type='submit' name='modif' value='Modifier animation'>
            <input class='bouton marge' type='submit' name='supp' value='Supprimer animation'>
            <input class='bouton marge' type='submit' name='swap' value='Type Animation'>
            <input class='bouton marge' type='submit' name='activite' value='Voir les activités'>
          </form>";
        } ?>




        <!-- Augmenter limites données chiffrées formulaire/ contrôle sur les dates  -->
        <!-- Ajouter une animation -->
        <?php if (isset($_POST["ajout"])) {
          include('../include/FormAjout.php');
        }
        if (isset($_POST['Ajouter'])) {
          $code = $_POST['code'];
          $type = $_POST['type'];
          $nom = $_POST['nom'];
          $datecréa = $_POST['datecréa'];
          $datevalid = $_POST['datevalid'];
          $duree = $_POST['durée'];
          $age = $_POST['age'];
          $tarif = $_POST['tarif'];
          $place = $_POST['place'];
          $descri = $_POST['descri'];
          $descri = addslashes($descri);
          $com = $_POST['com'];
          $com = addslashes($com);
          $diffi = $_POST['diffi'];
          $diffi = addslashes($diffi);
          $req = "SELECT CODETYPEANIM FROM type_anim WHERE CODETYPEANIM = '$type'";
          $res = mysqli_query($con,$req);
          $rows = mysqli_num_rows($res);
          if ($rows==1) {
            $req = "INSERT INTO animation (CODEANIM,CODETYPEANIM,NOMANIM,DATECREATIONANIM,DATEVALIDITEANIM,DUREEANIM,LIMITEAGE,TARIFANIM,NBREPLACEANIM,DESCRIPTANIM,COMMENTANIM,DIFFICULTEANIM)
            VALUES ('$code','$type','$nom','$datecréa','$datevalid','$duree','$age','$tarif','$place','$descri','$com','$diffi')";
            $res= mysqli_query($con,$req);
            mysqli_close($con);
            header("Refresh:0");
          }
          else {
            $req = "INSERT INTO type_anim (CODETYPEANIM,NOMTYPEANIM) VALUES ('$type',NULL)";
            $res = mysqli_query($con,$req);
            $req = "INSERT INTO animation (CODEANIM,CODETYPEANIM,NOMANIM,DATECREATIONANIM,DATEVALIDITEANIM,DUREEANIM,LIMITEAGE,TARIFANIM,NBREPLACEANIM,DESCRIPTANIM,COMMENTANIM,DIFFICULTEANIM)
            VALUES ('$code','$type','$nom','$datecréa','$datevalid','$duree','$age','$tarif','$place','$descri','$com','$diffi')";
            $res= mysqli_query($con,$req);
            mysqli_close($con);
            header("Refresh:0");
          }
        }

        //Il manque le type animation, donc s'il ajoute mais que typeanimation existe pas alors on lui dit pareil pour modif
        // Idée pour type animation, faire un select option pour afficher les types animations (à voir selon la flemme)

        // Modifier une animation
        if (isset($_POST["modif"])) {
          include('../include/FormModif.html');
        }
        if (isset($_POST['Modifier'])) {
          $Oldcode = $_POST['Oldcode'];
          $codeM = $_POST['newcode'];
          $typeM = $_POST['typeM'];
          $nomM = $_POST['nomM'];
          $datecréaM = $_POST['datecréaM'];
          $datevalidM = $_POST['datevalidM'];
          $dureeM = $_POST['duréeM'];
          $ageM = $_POST['ageM'];
          $tarifM = $_POST['tarifM'];
          $placeM = $_POST['placeM'];
          $descriM = $_POST['descriM'];
          $descriM = addslashes($descriM);
          $comM = $_POST['comM'];
          $comM = addslashes($comM);
          $diffiM = $_POST['diffiM'];
          $diffiM = addslashes($diffiM);
          $req = "SELECT * FROM Animation WHERE CODEANIM = '$Oldcode'";
          $res = mysqli_query($con,$req);
          $ligne = mysqli_fetch_array($res);
          if (empty($codeM)) {
            $codeM = $ligne['CODEANIM'];
          }
          if (empty($typeM)) {
            $typeM = $ligne['CODETYPEANIM'];
          }
          if (empty($nomM)) {
            $nomM = $ligne['NOMANIM'];
          }
          if (empty($datecréaM)) {
            $datecréaM = $ligne['DATECREATIONANIM'];
          }
          if (empty($datevalidM)) {
            $datevalidM = $ligne['DATEVALIDITEANIM'];
          }
          if (empty($dureeM)) {
            $dureeM = $ligne['DUREEANIM'];
          }
          if (empty($ageM)) {
            $ageM = $ligne['LIMITEAGE'];
          }
          if (empty($tarifM)) {
            $tarifM = $ligne['TARIFANIM'];
          }
          if (empty($placeM)) {
            $placeM = $ligne['NBREPLACEANIM'];
          }
          if (empty($descriM)) {
            $descriM = $ligne['DESCRIPTANIM'];
          }
          if (empty($comM)) {
            $comM = $ligne['COMMENTANIM'];
          }
          if (empty($diffiM)) {
            $diffiM = $ligne['DIFFICULTEANIM'];
          }
          $req = "UPDATE Animation SET CODEANIM = '$codeM', CODETYPEANIM = '$typeM', NOMANIM = '$nomM', DATECREATIONANIM = '$datecréaM',DATEVALIDITEANIM = '$datevalidM', DUREEANIM = '$dureeM',
          LIMITEAGE = '$ageM', TARIFANIM = '$tarifM', NBREPLACEANIM = '$placeM', DESCRIPTANIM = '$descriM', COMMENTANIM = '$comM', DIFFICULTEANIM = '$diffiM' WHERE CODEANIM = '$Oldcode'";
          $res= mysqli_query($con,$req);
          header("Refresh:0");
        }


        // La suppression
        if (isset($_POST["supp"])) {
          include('../include/FormSuppr.html');
        }
        if (isset($_POST['suppr'])) {
          $codeS = $_POST['codeS'];
          $con= mysqli_connect("localhost","root","","Gacti");
          mysqli_set_charset($con,"utf8");
          $req = "DELETE FROM Animation WHERE CODEANIM = '$codeS'";
          $res = mysqli_query($con,$req);
          mysqli_close($con);
          header("Refresh:0");
        }


        //Passer sur type animation
        if (isset($_POST['swap'])) {
          header("Location: TypeAnimation.php");
        }

        //Passer sur la modif des activités
        if (isset($_POST['activite'])) {
          header("Location: Activ.php");
        }
      }

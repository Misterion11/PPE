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

        if(isset($_SESSION['username'])){
          $user = $_SESSION['username'];
          $con = mysqli_connect("localhost", "root", "", "Gacti");
          mysqli_set_charset($con,"utf8");
          $req = "SELECT typeprofil FROM Compte WHERE typeprofil = 'RP' AND user='$user'";
          $res = mysqli_query($con, $req);
          $rows= mysqli_num_rows($res);
          if ($rows==1) {
            echo "<form class='bouton' action='Activ.php' method='post'>
              <input class='bouton' type='submit' name='ajoutA' value='Ajouter activité'>
              <input class='bouton marge' type='submit' name='modifA' value='Modifier activité'>
              <input class='bouton marge' type='submit' name='suppA' value='Supprimer activité'>
              <input class='bouton marge' type='submit' name='Etat' value='Etat Activité'>
            </form>";
          } ?>

          <!-- Ajouter une activité  -->
          <?php if (isset($_POST["ajoutA"])) {
            include('../include/FormAjoutActiv.php');
          }
          if (isset($_POST['AjouterActi'])) {
            $numActi = $_POST['numActi'];
            $CodeAnim = $_POST['CodeAnim'];
            $EtatActi = $_POST['EtatActi'];
            $dateActi = $_POST['dateActi'];
            $HrRDV = $_POST['HrRDV'];
            $PrixActi = $_POST['PrixActi'];
            $HrDebut = $_POST['HrDebut'];
            $HrFin = $_POST['HrFin'];
            $NomResp = $_POST['NomResp'];
            $PrénomResp = $_POST['PrénomResp'];
            $req = "SELECT CODEETATACT FROM ETAT_ACT WHERE CODEETATACT = '$EtatActi'";
            $res = mysqli_query($con,$req);
            $rows = mysqli_num_rows($res);
            if ($rows==1) {
              $req = "INSERT INTO ACTIVITE (NOACT,CODEANIM,CODEETATACT,DATEACT,HRRDVACT,PRIXACT,HRDEBUTACT,HRFINACT,DATEANNULEACT,NOMRESP,PRENOMRESP)
              VALUES ('$numActi','$CodeAnim','$EtatActi','$dateActi','$HrRDV','$PrixActi','$HrDebut','$HrFin',NULL,'$NomResp','$PrénomResp')";
              $res= mysqli_query($con,$req);
              mysqli_close($con);
              header("Refresh:0");
            }
            else {
              $req = "INSERT INTO ETAT_ACT (CODEETATACT,NOMETATACT) VALUES ('$EtatActi',NULL)";
              $res = mysqli_query($con,$req);
              $req = "INSERT INTO ACTIVITE (NOACT,CODEANIM,CODEETATACT,DATEACT,HRRDVACT,PRIXACT,HRDEBUTACT,HRFINACT,DATEANNULEACT,NOMRESP,PRENOMRESP)
              VALUES ('$numActi','$CodeAnim','$EtatActi','$dateActi','$HrRDV','$PrixActi','$HrDebut','$HrFin',NULL,'$NomResp','$PrénomResp')";
              $res= mysqli_query($con,$req);
              mysqli_close($con);
              header("Refresh:0");
            }
          }
        }


        // Modifier une activité

        if (isset($_POST["modifA"])) {
          include('../include/FormModifActi.html');
        }
        if (isset($_POST['ModifierActi'])) {
          $Oldnum = $_POST['Oldnum'];
          $newnumActi = $_POST['newnum'];
          $CodeMA = $_POST['CodeMA'];
          $EtatMA = $_POST['EtatMA'];
          $dateActiMA = $_POST['DateActiMA'];
          $HeureRDVActiMA = $_POST['HeureRDVActiMA'];
          $PrixActiMA = $_POST['PrixActiMA'];
          $HeureDebActiMA = $_POST['HeureDebActiMA'];
          $HeureFinActiMA = $_POST['HeureFinActiMA'];
          $DateAnnu = NULL;
          $NomRespMA = $_POST['NomRespMA'];
          $PrénomRespMA = $_POST['PrénomRespMA'];
          $req = "SELECT * FROM ACTIVITE WHERE NOACT = '$Oldnum'";
          $res = mysqli_query($con,$req);
          $ligne = mysqli_fetch_array($res);
          if (empty($newnumActi)) {
            $newnumActi = $ligne['NOACT'];
          }
          if (empty($CodeMA)) {
            $CodeMA = $ligne['CODEANIM'];
          }
          if (empty($EtatMA)) {
            $EtatMA = $ligne['CODEETATACT'];
          }
          if (empty($dateActiMA)) {
            $dateActiMA = $ligne['DATEACT'];
          }
          if (empty($HeureRDVActiMA)) {
            $HeureRDVActiMA = $ligne['HRRDVACT'];
          }
          if (empty($PrixActiMA)) {
            $PrixActiMA = $ligne['PRIXACT'];
          }
          if (empty($HeureDebActiMA)) {
            $HeureDebActiMA = $ligne['HRDEBUTACT'];
          }
          if (empty($HeureFinActiMA)) {
            $HeureFinActiMA = $ligne['HRFINACT'];
          }
          if (empty($NomRespMA)) {
            $NomRespMA = $ligne['NOMRESP'];
          }
          if (empty($PrénomRespMA)) {
            $PrénomRespMA = $ligne['PRENOMRESP'];
          }
          $req = "UPDATE ACTIVITE SET NOACT = '$newnumActi', CODEANIM = '$CodeMA', CODEETATACT = '$EtatMA', DATEACT = '$dateActiMA', HRRDVACT = '$HeureRDVActiMA', PRIXACT = '$PrixActiMA',
          HRDEBUTACT = '$HeureDebActiMA', HRFINACT = '$HeureFinActiMA', NOMRESP = '$NomRespMA', PRENOMRESP = '$PrénomRespMA' WHERE NOACT = '$Oldnum'";
          $res= mysqli_query($con,$req);
          header("Refresh:0");
        }


        //Supprimer une activité
        if (isset($_POST["suppA"])) {
          include('../include/FormSupprActi.html');
        }
        if (isset($_POST['supprSA'])) {
          $codeSA = $_POST['codeSA'];
          $con= mysqli_connect("localhost","root","","Gacti");
          mysqli_set_charset($con,"utf8");
          $req = "DELETE FROM ACTIVITE WHERE NOACT = '$codeSA'";
          $res = mysqli_query($con,$req);
          mysqli_close($con);
          header("Refresh:0");
        }

        if (isset($_POST["Etat"])) {
          header('Location: EtatAct.php');
        }

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../FeuilleCss.css">
  <title>Page</title>
</head>
<body>
  <header>
    <div class="header">
      <div class="logo">
        <img class="logo" src="../images/logo.png" alt="">
      </div>
      <div class="Titre">
        <h1 class="fdf">Village Vacances</h1>
      </div>
      <div class="Connect">
      </div>
    </div>
    <nav>
      <div class="nav">
        <a href="Accueil.php"><img class="icone" src="../images/home.png" alt=""> </a>
      </div>
      <!-- <div class="nav">
        <a class="nav" href="inscrixion.php?page=inscription">Inscription</a> &nbsp;
      </div> -->
      <div class="nav">
        <a class="nav" href="inscrixion.php?page=connexion">Connexion</a> &nbsp;
      </div>
    </nav>
  </header>
  <div class="Formulaire">
    <?php if (isset($_GET['page'])){
      switch($_GET['page']){
        case "inscription" :
        include("../include/inscription.php");
        break;
        case "connexion" :
        include("../include/connexion.php");
        break;
        case'mdperreur';
        include("../include/inscription.php");
        echo "<br />Les deux mots de passes ne sont pas identitiques";
        case 'erreur':
        include("../include/connexion.php");
        echo "Login ou Mot de passe erroné";
      //   case 'réussie':
      //   echo "<br />Inscription terminée <a href='inscrixion.php?page=connexion'>Connectez vous</a>";
      //   break;
      //   case 'inscriptionfausse':
      //   include('../include/inscription.php');
      //   echo "<br />Nom d'utilisateur déjà choisi, veuillez en choisir un autre";
      //   break;
      //   break;
      //   break;
    }}?>
      </div>
    </body>
    </html>

<form class="inscription" action="../include/inscription.php" method="post">
  <fieldset>
    <legend class="inscription">
      Inscrivez-vous
    </legend>
    <p class="Formulaire">
      Votre pseudo : <br/> <input type="text" name="username" maxlength="8" placeholder="8 caractères maximum" required />
    </p>
    <p class="Formulaire">
      Votre mot de passe : <br/> <input type="password" name="password" required />
    </p>
    <p class="Formulaire">
      Confirmez votre mot de passe : <br/> <input type="password" name="repeatpassword" required> <br>
      <p class="Formulaire">
        Prénom : <br> <input type="text" name="prenom" required>
      </p>
      <p class="Formulaire">
        Nom : <br> <input type="text" name="nom" required>
      </p>
      <input class="bouton" type="submit" name="submit" value="S'inscrire">
    </fieldset>
  </form>
  <!-- changement de statut qd vacances terminées -->
  <?php
  if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatpassword = $_POST['repeatpassword'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $con= mysqli_connect("localhost","root","","gacti");
    mysqli_set_charset($con,"utf8");
    if ($password==$repeatpassword) {
      $req= "INSERT INTO compte (user,mdp,nomcpte,prenomcpte,DATEINSCPTE,TypeCompte) VALUES('$username','$password','$nom','$prenom','$dateinscri','$type')";
      $res= mysqli_query($con,$req);
      if (!$res) {
        printf(mysqli_error($con));
        exit();
      }
      header('Location: ../Pages/inscrixion.php?page=réussie');
    }
    else {
      header('Location: ../Pages/inscrixion.php?page=mdperreur');
    }
  }?>
</body>
</html>

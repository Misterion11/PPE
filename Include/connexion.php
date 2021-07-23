<?php
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  if ($username&&$password) {
    $con= mysqli_connect("localhost","root","","Gacti");
    mysqli_set_charset($con,"utf8");
    $req= "SELECT * FROM compte WHERE user='$username' && mdp='$password'";
    $res = mysqli_query($con,$req);
    $rows= mysqli_num_rows($res);
    if ($rows==1) {
      session_start();
      $_SESSION['username']=$username;
      $_SESSION['password']=$password;
      $req = "SELECT dtfinadh FROM adherant WHERE user= '".$_SESSION['username']."'";
      $res = mysqli_query($con,$req);
      $ligne = mysqli_fetch_array($res);
      header('Location: ../Pages/Accueil.php');
    }
    else {
      header('Location: ../Pages/inscrixion.php?page=erreur');
    }
  }
}
?>
<form class="connexion" action="../include/connexion.php" method="post">
  <fieldset class="connexion">
    <legend>Connectez-vous</legend>
    <div class="centrage">
      <p>Votre pseudo:</p>
      <input type="text" name="username" value="" required>
      <p>Votre password</p>
      <input type="password" name="password" value="" required> <br>
      <input class="bouton" type="submit" name="submit" value="Se connecter">
    </div>
  </fieldset>
</form>

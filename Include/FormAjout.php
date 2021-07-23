<form class="changement" action="Animations.php" method="post">
  <legend class="modif">Veuillez remplir le formualaire suivant pour ajouter une animation : </legend>
  <table>
    <tr class="modif">
      <td>Code Animation : <br> <input type="text" name="code" maxlength="6"></td>
      <td>Code Type Animation :  <br><input type="text" name="type" value="" maxlength="5"></td>
      <td>Nom Animation :  <br><input type="text" name="nom" value="" maxlength="40"></td>
    </tr>
    <tr class="modif">
      <td>Date de Création : <br> <input type="date" name="datecréa" value=""></td>
      <td>Date de Validité : <br> <input type="date" name="datevalid" value=""></td>
      <td>Duree Animation : <br> <input type="number" name="durée" value="" max="99"></td>
    </tr>
    <tr class="modif">
      <td>Age Limite : <br> <input type="number" name="age" value="" max="99"></td>
      <td>Tarif : <br> <input type="number" name="tarif" value="" max="99" step='0.01'></td>
      <td>Nombre de Place : <br> <input type="number" name="place" value="" max="99"></td>
    </tr>
    <tr class="modif">
      <td>Description : <br> <textarea name="descri" rows="3" cols="35" maxlength="200"></textarea></td>
      <td>Commentaire : <br> <textarea name="com" rows="3" cols="35" maxlength="255"></textarea> </td>
      <td>Difficulté :  <br> <textarea name="diffi" rows="3" cols="35" maxlength="40"></textarea></td>
    </tr>
  </table>
  <div class="center"><input class="bouton" type="submit" name="Ajouter" value="Ajouter"></div>
</form>

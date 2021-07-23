<form class="changement" action="Activ.php" method="post">
  <legend class="modif">Veuillez remplir le formualaire suivant pour ajouter une activité : </legend>
  <table>
    <tr class="modif">
      <td>Numéro Activité : <br> <input type="number" name="numActi"></td>
      <td>Code Animation :  <br><input type="text" name="CodeAnim" value="" maxlength="8"></td>
    </tr>
    <tr class="modif">
      <td>Code Etat Activité :  <br><input type="text" name="EtatActi" value="" maxlength="2"></td>
      <td>Date Activité : <br> <input type="date" name="dateActi" value=""></td>

    </tr>
    <tr class="modif">
      <td>Heure RDV Activité : <br> <input type="time" name="HrRDV" value=""></td>
      <td>Prix Activité : <br> <input type="number" name="PrixActi" value="" step="0.1"></td>
    </tr>
    <tr class="modif">
      <td>Heure Debut Activité : <br> <input type="time" name="HrDebut" value=""></td>
      <td>Heure Fin Activité : <br> <input type="time" name="HrFin" value=""></td>
    </tr>
    <tr class="modif">
      <td>Nom Responsable : <br> <input type="text" name="NomResp" value="" maxlength="40"></td>
      <td>Prénom Responsable : <br> <input type="text" name="PrénomResp" value="" maxlength="20"></td>
    </tr>
  </table>
  <div class="center"><input class="bouton" type="submit" name="AjouterActi" value="Ajouter"></div>
</form>

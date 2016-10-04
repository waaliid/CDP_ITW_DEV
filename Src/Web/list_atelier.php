<!DOCTYPE html>
<html>
<head>
<title>Fête de la science</title>
  <link rel="stylesheet" type="text/css" href="css/style_form.css">
<script src="js/delete_confirm.js"></script> 
 <meta charset="UTF-8"> 
 
</head>
<body onload="load()">

<form id="edit-form" method = "POST">

<div class = "form-group" >
<select id ="workshopSelector" name="workshopList[]" multiple>

<?php

include("connexion.php");


$reponse = $bdd->query('SELECT titre FROM atelier');
$i = 1;
while ($donnees = $reponse->fetch())
{
	echo "<option value=";
	echo "\"$i\">";
	echo $donnees['titre'];
	echo "</option>";
	$i = $i + 1;
}

$reponse->closeCursor();

?>

</select>
</div>

<div class= "form-inline">
<input type="submit" id= "editWorkshop" value="modifier" formaction="edit_atelier.php">
<input type="submit" id="deleteWorkshop" class="delete_confirm" data-confirm="Etes vous sûr de vouloir supprimmer cet atelier?" value="supprimer" formaction="delete_atelier.php" >
</div>

</form>

</body>
</html>



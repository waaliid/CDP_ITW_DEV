<?php include("connexion.php");?>
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
<h3>Liste des Ateliers</h3>
<table>
 	<tr>
 	<th>Titre</th>
 	<th>Thème</th>
 	<th>Type</th>
 	<th>Remarque</th>
 	<th>Lieu</th>
 	<th>Durée</th>
 	<th>Capacité</th>
 	<th>Modifier</th>
 	<th>Supprimer</th>

 	</tr>
<?php
$reponse = $bdd->query('SELECT * FROM atelier');
while ($donnees = $reponse->fetch())
{ ?>

	<tr>
		<td><?php echo $donnees['titre']; ?></td>
		<td><?php echo $donnees['theme']; ?></td>
		<td><?php echo $donnees['type']; ?></td>
		<td><?php echo $donnees['Remarque']; ?></td>
		<td><?php echo $donnees['lieu']; ?></td>
		<td><?php echo $donnees['duree']; ?></td>
		<td><?php echo $donnees['capacite']; ?></td>
		<td><input type="submit" id= "editWorkshop" value="modifier" formaction="edit_atelier.php"></td>
		<td><input type="submit" id="deleteWorkshop" class="delete_confirm" data-confirm="Etes vous sûr de vouloir supprimmer cet atelier?" value="supprimer" formaction="delete_atelier.php" ></td>
	</tr>
<?php 
}

$reponse->closeCursor();

?>
</table>
</div>

<div class= "form-inline">
</div>

</form>
</body>
</html>
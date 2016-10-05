<?php 
include("connexion.php");
if(isset($_GET['supp_article'])){
  
  $rep = $bdd->prepare('DELETE FROM atelier WHERE id_Atelier =?');
  $rep->execute(array($_GET['supp_article']));
  $donnees = $rep->fetch();
  $rep->closeCursor();
  }
?>



<!DOCTYPE html>
<html>
<head>
<title>Fête de la science</title>
<link rel="stylesheet" type="text/css" href="css/style_form.css">
 <meta charset="UTF-8"> 
</head>
<body>
<h1> Votre atelier a bien été supprimer</h1>


<form method="POST" action="list_atelier.php">
<input type="submit" name = "validate" value="Retour liste" >
</form>


</body>
</html>


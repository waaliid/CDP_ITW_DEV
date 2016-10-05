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
 <meta charset="UTF-8"> 
</head>
<body>
<h1> Votre atelier a bien été supprimer</h1>
</body>
</html>
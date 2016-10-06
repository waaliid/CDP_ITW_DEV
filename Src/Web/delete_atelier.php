<?php 
include("connexion.php");
if(isset($_GET['supp_article'])){
  
  $rep = $bdd->prepare('DELETE FROM atelier WHERE id_Atelier =?');
  $rep->execute(array($_GET['supp_article']));
  $donnees = $rep->fetch();

  $rep2 = $bdd->prepare('DELETE FROM creneaux WHERE id_atelier =?');
  $rep2->execute(array($_GET['supp_article']));
  $donnees2 = $rep2->fetch();
  
  $rep->closeCursor();
  $rep2->closeCursor();

  header('Location: list_atelier.php');
  }
?>
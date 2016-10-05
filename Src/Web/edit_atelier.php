<?php include("connexion.php");?>
<?php
if(isset($_GET['modif_article'])){
  
  $rep = $bdd->prepare('SELECT * FROM atelier WHERE id_Atelier =?');
  $rep->execute(array($_GET['modif_article']));
  $donnees = $rep->fetch();
  $rep->closeCursor();
  }
?>
<?php
if(isset($_POST['modifier'])){

    $req = $bdd->prepare("UPDATE atelier SET titre = ?, theme = ?, type = ?, Remarque = ?, lieu = ?, duree = ?, capacite = ? WHERE id_Atelier =?");
    $req->execute(array($_POST['titre'], $_POST['theme'],$_POST['type'],$_POST['remarque'],$_POST['lieu']
      ,$_POST['duree'],$_POST['capacite'], $_POST['id']));
    header('Location: list_atelier.php');
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
<h3></h3>
<form action="edit_atelier.php" method="POST">
  <h1>Modifier un atelier</h1>
  <input type="hidden" name="id" value="<?php echo $_GET['modif_article']?>">
  <label>Titre</label><br>
  <input type="text" name="titre" value="<?php echo $donnees['titre']?>"><br>
  <label>Thème</label><br>
  <input type="text" name="theme" value="<?php echo $donnees['theme']?>"><br>
  <label>Type</label><br>
  <input type="text" name="type" value="<?php echo $donnees['type']?>"><br>
  <label>Lieu</label><br>
  <input type="text" name="lieu" value="<?php echo $donnees['lieu']?>"><br>
  <label>Remarque</label><br>
  <textarea rows="4" cols="50" name="remarque">
   <?php echo $donnees['Remarque']?>
  </textarea><br>
  <label>Durée</label><br>
  <input type="text" name="duree" value="<?php echo $donnees['duree']?>"><br>
  <label>Capacité</label><br>
  <input type="text" name="capacite" value="<?php echo $donnees['capacite']?>"><br>
  
  <input type="submit" name= "modifier" value="modifier">
</form>
 
</body>
</html>
<?php 
include("connexion.php");

if(isset($_GET['modif_article'])){
  
  $rep = $bdd->prepare('SELECT * FROM atelier WHERE id_Atelier =?');
  $rep->execute(array($_GET['modif_article']));
  $donnees = $rep->fetch();
  $rep->closeCursor();
  
  $repCreneau = $bdd->prepare('SELECT * FROM creneaux WHERE id_atelier =?');
  $repCreneau ->execute(array($_GET['modif_article']));
  $donnees_creneau = $repCreneau->fetch();
}

if(isset($_POST['modifier'])){
  if(!empty($_POST['titre']) && !empty($_POST['theme']) && !empty($_POST['type']) &&
    !empty($_POST['remarque']) && !empty($_POST['lieu']) && !empty($_POST['duree']) && !empty($_POST['capacite'])){
    $req = $bdd->prepare("UPDATE atelier SET titre = ?, theme = ?, type = ?, Remarque = ?, lieu = ?, duree = ?, capacite = ? WHERE id_Atelier =?");
    $req->execute(array($_POST['titre'], $_POST['theme'],$_POST['type'],$_POST['remarque'],$_POST['lieu']
      ,$_POST['duree'],$_POST['capacite'], $_POST['id']));
    header('Location: list_atelier.php');
  }else{
   // echo "Erreur : Un des champs est vide !";
}
}

function planning($jour, $creneau){
if (($creneau[0]==0) && ($creneau[1]==0)){
  return $jour."-"."  "."-";
}else{
  if(($creneau[0]==1) && ($creneau[1]==1)){
    return $jour.": matin"."  "."apres midi"; 
}else{
  if(($creneau[0]==1) && ($creneau[1]==0)){
    return $jour.": matin"."  "."-";
  }else{
    return $jour.": -"."  "."apres midi";
  }
}
}
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
  <h3><a href="index.php">Accueil</a>|<a href="list_atelier.php">Liste des ateliers</a></h3>
  <h2>Modifier un atelier</h2>
  <input type="hidden" name="id" value="<?php echo $_GET['modif_article']?>" required = "required">
  <label>Titre</label><br>
  <input type="text" name="titre" value="<?php echo $donnees['titre']?>" required = "required"><br>
  <label>Thème</label><br>
  <input type="text" name="theme" value="<?php echo $donnees['theme']?>" required = "required"><br>
  <label>Type</label><br>
  <input type="text" name="type" value="<?php echo $donnees['type']?>" required = "required"><br>
  <label>Lieu</label><br>
  <input type="text" name="lieu" value="<?php echo $donnees['lieu']?>" required = "required"><br>
  <label>Remarque</label><br>
  <textarea rows="4" cols="50" name="remarque" required = "required">
   <?php echo $donnees['Remarque']?>
  </textarea><br>
  <label>Créneaux</label>
  <TABLE class="form-checkbox">
      <tr>
        <td>Lundi</td>
        <td><input type="checkbox" name="" 
        checked = "<?php if ($donnees_creneau['lundi'][0] == 1){echo "checked";}else{echo " ";}?>">Matin</td>
        <td><input type="checkbox" name=""
        checked = "<?php if ($donnees_creneau['lundi'][1] == 1){echo "checked";}else{echo " ";}?>">Après-Midi</td>
      </tr>
      <tr>
        <td>Mardi</td>
        <td><input type="checkbox" name="" 
        checked = "<?php if ($donnees_creneau['mardi'][0] == 1){echo "checked";}else{echo " ";}?>">Matin</td>
        <td><input type="checkbox" name=""
        checked = "<?php if ($donnees_creneau['mardi'][1] == 1){echo "checked";}else{echo " ";}?>">Après-Midi</td>
      </tr>
      <tr>
        <td>Mercredi</td>
        <td><input type="checkbox" name="" 
        checked = "<?php if ($donnees_creneau['mercredi'][0] == 1){echo "checked";}else{echo "";}?>">Matin</td>
        <td><input type="checkbox" name=""
        checked = "<?php if ($donnees_creneau['mercredi'][1] == 1){echo "checked";}else{echo "";}?>">Après-Midi</td>
      </tr>
      <tr>
        <td>Jeudi</td>
        <td><input type="checkbox" name="" 
        checked = "<?php if ($donnees_creneau['jeudi'][0] == 1){echo "checked";}else{echo "";}?>">Matin</td>
        <td><input type="checkbox" name=""
        checked = "<?php if ($donnees_creneau['jeudi'][1] == 1){echo "checked";}else{echo "";}?>">Après-Midi</td>
      </tr>
      <tr>
        <td>Vendredi</td>
        <td><input type="checkbox" name="" 
        checked = "<?php if ($donnees_creneau['vendredi'][0] == 1){echo "checked";}else{echo "";}?>">Matin</td>
        <td><input type="checkbox" name=""
        checked = "<?php if ($donnees_creneau['vendredi'][1] == 1){echo "checked";}else{echo "";}?>">Après-Midi</td>
      </tr>
  </TABLE>
  <br>
  <label>Durée</label><br>
  <input type="text" name="duree" value="<?php echo $donnees['duree']?>" required = "required"><br>
  <label>Capacité</label><br>
  <input type="text" name="capacite" value="<?php echo $donnees['capacite']?>" required = "required"><br>
  
  <input type="submit" name= "modifier" value="modifier">
</form>
 
</body>
</html>
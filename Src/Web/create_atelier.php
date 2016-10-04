<?php

	
 if (isset($_POST["validate"]))
 {
 	
   	 $title=$_POST['title'];
   	 $theme=$_POST['theme'];
   	 $type=$_POST['type'];
   	 $place=$_POST['place'];
   	 $duration=$_POST['duration'];
   	 $capacity=$_POST['capacity'];
   	 $id_labo = 3;
   	 $id_creneaux = 2;
   	 $id_atelier= 4;   	
   	 $remarque = "Remarque";
   	 $query = "INSERT INTO atelier (id_Atelier,titre, theme, type, Remarque, lieu, duree, capacite,id_creneaux, id_labo) VALUES (_id_atelier,_title, _theme, _type, _remarque, _place, _duration, _capacity,_id_creneaux,_id_lab)"; 
   	 $request = $bdd->prepare($query);
   	 $request->execute(array("_id_atelier" => $id_atelier, "_title"=>$titre, "_theme"=>$theme, "_type"=>$type, "_remarque" => $remarque, "_place"=>$lieu, "_duration"=>$duree, "_capacity"=>$capacite, "_id_creneaux"=>$id_creneaux,"_id_lab"=>$id_lab));
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
<form action="create_atelier.php">
  <h1>Ajout d'un atelier</h1>
  <input type="text" name="title" value="Titre">
  <br>
  <input type="text" name="theme" value="Thème">
  <br>
  <input type="text" name="type" value="Type">
  <br>
	Date : <br>
  <TABLE>
    <tr>
    <td>
    <input type="checkbox" name="" value="">Lundi matin<br>
    </td>
    <td>
    <input type="checkbox" name="" value="">Lundi après-midi<br>
    </td> 
    </tr>
    <tr>
    <td>
    <input type="checkbox" name="" value="">Mardi matin<br>
    </td>
    <td>
    <input type="checkbox" name="" value="">Mardi après-midi<br>
    </td> 
    </tr>
    <tr>
    <td>
    <input type="checkbox" name="" value="">Mercredi matin<br>
    </td>
    <td>
    <input type="checkbox" name="" value="">Mercredi après-midi<br>
    </td> 
    </tr>
    <tr>
    <td>
    <input type="checkbox" name="" value="">Jeudi matin<br>
    </td>
    <td>
    <input type="checkbox" name="" value="">Jeudi après-midi<br>
    </td> 
    </tr>
    <tr>
    <td>
    <input type="checkbox" name="" value="">Vendredi matin<br>
    </td>
    <td>
    <input type="checkbox" name="" value="">Vendredi après-midi<br>
    </td> 
    </tr>
    
  </TABLE>
  <input type="text" name="labo" value="Laboratoire">
  <br>
  <input type="text" name="place" value="Lieu">
  <br>
  <textarea rows="4" cols="50">
   Remarque
  </textarea>
  <br>
  <input type="text" name="duration" value="Durée de l'atelier">
  <br>
  <input type="text" name="capacity" value="Capacité">
  <br>
  <input type="submit" name = "validate" value="valider">
</form> 
</body>
</html>
<?php

	include("connexion.php");
	
	/**
	 * Create a new workshop.
	 */
	 
	function create_workshop($bdd, $arguments)
	{
		$state = array();

		$keys = array_keys($arguments);
		$values = array_values($arguments);

		$sql_query = $bdd->prepare("INSERT INTO " . "atelier" . " (titre , theme, type, Remarque, lieu, duree, capacite,id_creneaux, id_labo)"
												." VALUES ( :title, :theme, :type, :remarque, :place, :duration, :capacity, :id_creneaux, :id_lab)");
		
		$sql_query->bindParam($keys[0], $values[0]);
		$sql_query->bindParam($keys[1], $values[1]);
		$sql_query->bindParam($keys[2], $values[2]);
		$sql_query->bindParam($keys[3], $values[3]);
		$sql_query->bindParam($keys[4], $values[4]);
		$sql_query->bindParam($keys[5], $values[5], PDO::PARAM_INT);
		$sql_query->bindParam($keys[6], $values[6], PDO::PARAM_INT);
		$sql_query->bindParam($keys[7], $values[7], PDO::PARAM_INT);
		$sql_query->bindParam($keys[8], $values[8], PDO::PARAM_INT);


		$sql_query->execute();
		
		echo $values[0];
		
		if ($sql_query) {
			$state['query'] = 1;
		}
		else {
			$state['query'] = 0;
		}
		
		return $state;
 	}	
 	
 if (isset($_POST["validate"]))
 {
 	
   	 $title=$_POST['title'];
   	 $theme=$_POST['theme'];
   	 $type=$_POST['type'];
   	 $place=$_POST['place'];
   	 $duration=$_POST['duration'];
   	 $capacity=$_POST['capacity'];
   	 $id_labo = '1';
   	 $id_creneaux = '1';
   	 $id_atelier = '4';
   	 $remarque = "Remarque";
   	 $workshop_data = array(":title" => $title , ":theme"=>$theme, ":type"=>$type, ":remarque" => $remarque, ":place"=>$place, ":duration"=>$duration, ":capacity"=>$capacity, ":id_creneaux"=>$id_creneaux,":id_lab"=>$id_labo);
	 $response = create_workshop($bdd,$workshop_data);

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
<form method="POST" >
  <h1>Ajout d'un atelier</h1>
  <input type="text" name="title" >
  <br>
  <input type="text" name="theme"  >
  <br>
  <input type="text" name="type"  >
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
      <select name="labo">
          <?php
          $sql_lab = $bdd->prepare('SELECT * FROM laboratoire');
          $sql_lab->execute();
          if ( $sql_lab->rowCount() > 0 ) {
            $sql_lab->setFetchMode(PDO::FETCH_ASSOC);

              while ($lab = $sql_lab->fetch()) { ?>


                  <option value = "<?php echo $lab['nom']?>"> "<?php echo $lab['nom']?>" </option>


              <?php }}
          $sql_lab->closeCursor(); // we will not use it anymore, so we must close server connection
          ?>
      </select>
  <br>
  <input type="text" name="place">
  <br>
  <textarea rows="4" cols="50">
   Remarque
  </textarea>
  <br>
  <input type="text" name="duration" >
  <br>
  <input type="text" name="capacity" >
  <br>
  <input type="submit" name = "validate" value="valider">
</form> 
</body>
</html>
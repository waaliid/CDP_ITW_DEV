<?php

	include("connexion.php");
	
	/**
	 * Create a new workshop.
	 */

	function process_slots($slots){
	    $result = array();
        foreach($slots as $key => &$val){
            if(count($val) == 2){
               $result[$key] = "11";
            }
            if(count($val) == 1){
                if(array_key_exists("am",$val)){
                    $result[$key] = "10";
                }else{
                    $result[$key] = "01";
                }
            }
            if(count($val) == 0){
                $result[$key] = "00";
            }
        }
        return $result;
    }
	function create_workshop($bdd, $arguments)
	{
		$state = array();

		$keys = array_keys($arguments);
		$values = array_values($arguments);

		$sql_query = $bdd->prepare("INSERT INTO". " atelier"   . " (titre , theme, type, Remarque, lieu, duree, capacite,id_creneaux, id_labo)"
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
				
		if ($sql_query) {
			$state['query'] = 1;
		}
		else {
			$state['query'] = 0;
		}
		
		return $state;
 	}	


 	function create_slots($bdd, $arguments,$id_atelier)
    {
        $state = array();

        $original = array( "mon"=>array(), "tue" => array(), "wed" => array(), "thu" => array(), "fri" => array());
        $complete = array_merge($original,$arguments);
        $allKeys = array_merge(array("id_atelier"),array_keys($complete));

        $keys = preg_filter('/^/', ':',$allKeys);

        $new_arguments = process_slots($complete);
        $values = array_merge(array($id_atelier),array_values($new_arguments));

        $params = array_combine($keys,$values);


        // -- insert into database
        $query = "INSERT INTO". " creneaux "  . " (id_atelier,lundi,mardi,mercredi,jeudi,vendredi)"
            ." VALUES (". implode(', ',$keys ) . ")";
        $sql_query = $bdd->prepare($query);

        foreach ($params as $key => &$val) {
            $sql_query->bindParam($key, $val, PDO::PARAM_INT);
        }


        $sql_query->execute();

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
   	 $remarque = $_POST['remark'];
   	 $workshop_data = array(":title" => $title , ":theme"=>$theme, ":type"=>$type, ":remarque" => $remarque, ":place"=>$place, ":duration"=>$duration, ":capacity"=>$capacity, ":id_creneaux"=>$id_creneaux,":id_lab"=>$id_labo);
	 $response = create_workshop($bdd,$workshop_data);

     if( isset($_POST['slots']) && is_array($_POST['slots']) ) {
         $slots = $_POST['slots'];
         $response = create_slots($bdd,$slots,$id_atelier);

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
    <input type="checkbox" name="slots[mon][am]">Lundi matin<br>
    </td>
    <td>
    <input type="checkbox" name="slots[mon][pm]">Lundi après-midi<br>
    </td> 
    </tr>
    <tr>
    <td>
    <input type="checkbox" name="slots[tue][am]" >Mardi matin<br>
    </td>
    <td>
    <input type="checkbox" name="slots[tue][pm]" >Mardi après-midi<br>
    </td>
    </tr>
    <tr>
    <td>
    <input type="checkbox" name="slots[wed][am]" value="">Mercredi matin<br>
    </td>
    <td>
    <input type="checkbox" name="slots[wed][pm]" value="">Mercredi après-midi<br>
    </td> 
    </tr>
    <tr>
    <td>
    <input type="checkbox" name="slots[thu][am]" value="">Jeudi matin<br>
    </td>
    <td>
    <input type="checkbox" name="slots[thu][pm]" value="">Jeudi après-midi<br>
    </td> 
    </tr>
    <tr>
    <td>
    <input type="checkbox" name="slots[fri][am]" value="">Vendredi matin<br>
    </td>
    <td>
    <input type="checkbox" name="slots[fri][pm]" value="">Vendredi après-midi<br>
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
  <textarea name = "remark" rows="4" cols="50">
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
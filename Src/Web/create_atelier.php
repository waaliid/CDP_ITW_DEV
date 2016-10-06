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
		if(empty($arguments))
			return;
			
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


 	function create_slots($bdd, $arguments)
    {
        if(empty($arguments))
        	return;
        	
        $state = array();

        $workshop = $bdd->prepare("SELECT `id_Atelier` FROM atelier ORDER BY `id_Atelier` DESC LIMIT 1" );
        $workshop->execute();
        $workshop->setFetchMode(PDO::FETCH_ASSOC);
        $id_atelier = $workshop->fetch()['id_Atelier'];


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
   	 $remarque = $_POST['remark'];
   	 $workshop_data = array(":title" => $title , ":theme"=>$theme, ":type"=>$type, ":remarque" => $remarque, ":place"=>$place, ":duration"=>$duration, ":capacity"=>$capacity, ":id_creneaux"=>$id_creneaux,":id_lab"=>$id_labo);
	 $response = create_workshop($bdd,$workshop_data);

     if( isset($_POST['slots']) && is_array($_POST['slots']) ) {
         $slots = $_POST['slots'];
         $response = create_slots($bdd,$slots);

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
<form class = "createWorkshop" method="POST" >
  <h1>Ajout d'un atelier</h1>
  <div class="form_item">
    <label for="title">Titre</label>
      <input type="text" name="title" id="title"  />
  </div>
    <div class="form_item">

    <label for="theme">Thème</label>

    <input type="text" name="theme" id="theme"   >
  	</div>
  	
    <div class="form_item">
    <label for="type">Type</label>
    <input type="text" name="type" id="type" >
    </div>


<table class="form-checkbox">
    <tbody>
    <tr>
        <th>Créneaux</th>
    <td>

        <fieldset class="morningSlots">

            <label for="checkOne" ><input type="checkbox" id="checkOne" name="slots[mon][am]">Lundi matin</label><br />


            <label for="checkTwo" ><input type="checkbox" id="checkTwo" name="slots[tue][am]" >Mardi matin</label><br />


            <label for="checkThree" ><input type="checkbox" id="checkThree" name="slots[thu][am]" value="">Jeudi matin</label><br />


            <label for="checkFour"> <input type="checkbox" id="checkFour" name="slots[wed][am]" value="">Mercredi matin</label><br />



            <label for="checkFive"> <input type="checkbox" id="checkFive" name="slots[fri][am]" value="">Vendredi matin</label><br />

        </fieldset>

    </td>

        <td>

        <fieldset class="afternoonSlots">


    <label for="checkSix"><input type="checkbox" id="checkSix" name="slots[mon][pm]">Lundi après-midi</label><br />


    <label for="checkSeven" ><input type="checkbox" id="checkSeven" name="slots[tue][pm]">Mardi après-midi</label><br />

    <label for="checkEight" ><input type="checkbox"id="checkEight" name="slots[wed][pm]" value="">Mercredi après-midi</label><br />


    <label for="checkNine" ><input type="checkbox" id="checkNine" name="slots[thu][pm]" value="">Jeudi après-midi</label><br />

    <label for="checkTen" ><input type="checkbox" id="checkTen" name="slots[fri][pm]" value="">Vendredi après-midi</label><br />
    </fieldset>
        </td>

    </tr>
    </tbody>
</table>


    <div class="form_item">
        <label>Laboratoires</label>
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
    </div>

    <div class="form_item">

    <label for="place">Lieu</label>

    <input type="text" name="place">
    </div>
    <div class="form_item">

    <label>Remarque</label>
  <textarea name = "remark" rows="4" cols="50">
  </textarea>
    </div>

    <div class="form_item">

    <label for="duration">Durée </label>

    <input type="text" name="duration" id="duration">
        </div>
    <div class="form_item">

    <label for = "capacity">Capacitée</label>

    <input type="text" name="capacity" id="capacity" >
    </div>

    <input type="submit" name = "validate" value="valider">
</form>
</body>
</html>
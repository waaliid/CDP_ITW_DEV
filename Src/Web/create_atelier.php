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

    function empty_values($array){
        foreach ($array as $value){
            if(!empty(trim($value)))
                return false;
        }
        return true;
    }
    function getLastWorkshopId($bdd){
        $workshop = $bdd->prepare("SELECT `id_Atelier` FROM atelier ORDER BY `id_Atelier` DESC LIMIT 1" );
        $workshop->execute();
        $id = $workshop->fetch(PDO::FETCH_ASSOC);
        return (empty($id))?0:$id['id_Atelier'];
    }

    function getLastSlotsId($bdd){
        $slot = $bdd->prepare("SELECT `id_creneau` FROM creneaux ORDER BY `id_creneau` DESC LIMIT 1" );
        $slot->execute();
        $id = $slot->fetch(PDO::FETCH_ASSOC);
        return (empty($id)?0:$id['id_creneau']);
    }

	function create_workshop($bdd, $arguments)
	{
		if(empty_values($arguments))
			return;
			
		$state = array();
        $complete = array_merge($arguments,array(":id_creneaux"=>"0",":id_lab"=>"0"));
		$keys = array_keys($complete);
		$values = array_values($complete);

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


        $state = array();


        $id_workshop = getLastWorkshopId($bdd);


        $original = array( "mon"=>array(), "tue" => array(), "wed" => array(), "thu" => array(), "fri" => array());
        $complete = array_merge($original,$arguments);
        $allKeys = array_merge(array("id_atelier"),array_keys($complete));

        $keys = preg_filter('/^/', ':',$allKeys);

        $new_arguments = process_slots($complete);
        $values = array_merge(array($id_workshop),array_values($new_arguments));

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

        $query = "UPDATE atelier SET  `id_creneaux` = :slot_id WHERE `id_Atelier` = :workshop_id";
        $worskhop_query = $bdd->prepare($query);
        $worskhop_query->execute(array(
            'slot_id' => getLastSlotsId($bdd),
            'workshop_id' => $id_workshop
        ));
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
   	 $remarque = $_POST['remark'];
   	 $workshop_data = array(":title" => $title , ":theme"=>$theme, ":type"=>$type, ":remarque" =>$remarque, ":place"=>$place, ":duration"=>$duration, ":capacity"=>$capacity);
     $response = create_workshop($bdd,$workshop_data);

     if( isset($_POST['slots']) && is_array($_POST['slots']) ) {
         $slots = $_POST['slots'];
         $response = create_slots($bdd,$slots);
     }else{
         $response = create_slots($bdd,array());
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
  <h3><a href="index.php">Accueil</a></h3>
  <h2>Ajout d'un atelier</h2>
  <div class="form_item">
    <label for="title">Titre</label>
      <input type="text" name="title" id="title"  required = "required"/>
  </div>
    <div class="form_item">

    <label for="theme">Thème</label>

    <input type="text" name="theme" id="theme"  required = "required"/>
  	</div>
  	
    <div class="form_item">
    <label for="type">Type</label>
    <input type="text" name="type" id="type" required = "required"/>
    </div>


<table class="form-checkbox" >
    <tbody>
    <tr>
        <th>Créneaux</th>
    <td>

        <fieldset class="morningSlots">

            <label for="checkOne" ><input type="checkbox" id="checkOne" name="slots[mon][am]" >Lundi matin</label><br />


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

    <input type="text" name="place" required = "required">
    </div>
    <div class="form_item">

    <label>Remarque</label>
  <textarea name = "remark" rows="4" cols="50" required = "required">
  </textarea>
    </div>

    <div class="form_item">

    <label for="duration">Durée </label>

    <input type="text" name="duration" id="duration" required = "required">
        </div>
    <div class="form_item">

    <label for = "capacity">Capacitée</label>

    <input type="text" name="capacity" id="capacity" required = "required">
    </div>

    <input type="submit" name = "validate" value="valider">
</form>
</body>
</html>
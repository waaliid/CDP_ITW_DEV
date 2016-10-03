<!DOCTYPE html>
<html>
<head>
<title>Fête de la science</title>
 <link rel="stylesheet" type="text/css" href="css/style_form.css">
 <meta charset="UTF-8"> 
</head>
<body>
<?php


if(isset($_POST['workshopList']) && !empty($_POST['workshopList'])){
	$values = $_POST['workshopList'];
	$title = (isset($values[0]) && $values[0] == 1)? "La terre dans le système solaire" : "Title";

    foreach($values as $selectValue){
		//affichage des valeurs sélectionnées
                echo $selectValue."<br>";
	}
}
?>

<form action="edit_atelier.php">
  Titre:<br>
  <input type="text" name="firstname" value="<?php echo $title ?>">
  <br>
  Thème :<br>
  <input type="text" name="lastname" value="Thème">
  <br>
	Laboratoire :<br>
  <input type="text" name="lastname" value="Labo">
  <br>
   Autre :<br>
  <input type="text" name="lastname" value="Autre">
  <br>
   Decription :<br>
  <textarea rows="4" cols="50">
 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta finibus elit. Aliquam ultrices congue ligula, non aliquet augue lobortis sed. Sed euismod tortor non arcu auctor malesuada. Curabitur ac orci in est dignissim pharetra vitae et mi. Proin ligula orci, vehicula ac augue at, condimentum ornare arcu. Aliquam sodales posuere porta. Cras eget sagittis elit, in molestie odio.

Curabitur semper ante at ex bibendum pharetra. Sed viverra massa vel ex ullamcorper volutpat. Fusce tincidunt sed eros eget convallis. Mauris suscipit, nunc a facilisis suscipit, mi felis congue massa, at tincidunt diam erat vitae lacus. In augue massa, aliquet vitae maximus a, pellentesque quis turpis. Integer erat ex, vehicula ac velit id, molestie tincidunt nisi. Vestibulum eu ligula nunc. Ut bibendum congue tortor sed interdum. Nullam in rhoncus nulla. Proin et dui a est viverra scelerisque. Nam non arcu pretium, facilisis eros a, porta odio. Suspendisse vitae commodo ipsum.

</textarea>
  <br>
  <input type="submit" value="modifier">
</form>
 
</body>
</html>
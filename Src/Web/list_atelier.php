<!DOCTYPE html>
<html>
<head>
<title>Fête de la science</title>
  <link rel="stylesheet" type="text/css" href="css/style_form.css">
<script src="js/delete_confirm.js"></script> 
 <meta charset="UTF-8"> 
 
</head>
<body onload="load()">

<form id="edit-form" method = "POST">

<div class = "form-group" >
<select id ="workshopSelector" name="workshopList[]" multiple>
  <option value="1">La terre dans le système solaire</option>
  <option value="2">Le code, tout un programme</option>
  <option value="3">Neurone artificiel</option>
  <option value="4">Illusion sonore</option>
</select>
</div>

<div class= "form-inline">
<input type="submit" id= "editWorkshop" value="modifier" formaction="edit_atelier.php">
<input type="submit" id="deleteWorkshop" class="delete_confirm" data-confirm="Etes vous sûr de vouloir supprimmer cet atelier?" value="supprimer" formaction="delete_atelier.php" >
</div>

</form>

</body>
</html>
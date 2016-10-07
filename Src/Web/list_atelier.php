<?php include("connexion.php");?>
<!DOCTYPE html>
<html>
<head>
<title>Fête de la science</title>
  <link rel="stylesheet" type="text/css" href="css/style_form.css">
<script src="js/delete_confirm.js"></script> 
 <meta charset="UTF-8"> 
 
</head>
<body onload="load()">

<form id="edit-form" method = "GET">

<div class = "form-group" >
<h3><a href="index.php">Accueil</a></h3>
<h3>Liste des Ateliers</h3>
<table>
      
	<tr>
 	<th>Titre</th>
 	<th>Thème</th>
 	<th>Type</th>
 	<th>Remarque</th>
 	<th>Lieu</th>
 	<th>Durée</th>
 	<th>Capacité</th>
 	<th>Modifier</th>
 	<th>Supprimer</th>

 	</tr>
<?php
$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
$limite = 5;
$debut = ($page - 1) * $limite;
$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM atelier LIMIT :limite OFFSET :debut';
$query = $bdd->prepare($query);
$query->bindValue('limite', $limite, PDO::PARAM_INT);
$query->bindValue('debut', $debut, PDO::PARAM_INT);
$query->execute();

$resultFoundRows = $bdd->query('SELECT found_rows()');
$nombredElementsTotal = $resultFoundRows->fetchColumn();

while ($donnees = $query->fetch())
{ ?>

	 <?php $bool=true; 
        if ($bool== true){$bool = false;?>
        <tr class="even">
        <?php }else{$bool=true;?>
        <tr class="odd">
     <?php }?>
	
		<td><?php echo $donnees['titre']; ?></td>
		<td><?php echo $donnees['theme']; ?></td>
		<td><?php echo $donnees['type']; ?></td>
		<td><?php echo $donnees['Remarque']; ?></td>
		<td><?php echo $donnees['lieu']; ?></td>
		<td><?php echo $donnees['duree']; ?></td>
		<td><?php echo $donnees['capacite']; ?></td>
		<td><a href="edit_atelier.php?modif_article=<?php echo $donnees['id_Atelier']; ?>'">Modifier</a></td>
		<td><a href="delete_atelier.php?supp_article=<?php echo $donnees['id_Atelier']; ?>'">Supprimer</a></td>
	<!-- javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')) document.location.href=' -->
	</tr>
<?php }
?>
</table>
<?php
$nombreDePages = ceil($nombredElementsTotal / $limite);
if ($page > 1):
    ?><a href="?page=<?php echo $page - 1; ?>">Page précédente</a> — <?php
endif;
for ($i = 1; $i <= $nombreDePages; $i++):
    ?><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a> <?php
endfor;
if ($page < $nombreDePages):
    ?> — <a href="?page=<?php echo $page + 1; ?>">Page suivante</a><?php
endif;
?>
</div>

<div class= "form-inline">
</div>

</form>
</body>
</html>
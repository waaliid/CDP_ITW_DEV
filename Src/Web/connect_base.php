<?php 
// On met en variables les informations de connexion 
$hote = 'localhost'; // Adresse du serveur 
$login = 'root'; // Login 
$pass = ''; // Mot de passe 
$base = 'basegestionatelier'; // Base de données à utiliser 
 
// On se connecte à la base de données 
mysql_connect($hote, $login, $pass); 
 
// On selectionne la base de données souhaitée 
mysql_select_db($base); 
?>
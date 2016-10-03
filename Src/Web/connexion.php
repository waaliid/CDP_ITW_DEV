<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=cdp_itw_bdd;charset=utf8', 'root', '');
	
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());

}
?>
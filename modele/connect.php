<?php
		

	$hostname = "localhost";	//ou localhost
	$base= "projet_pwebc";
	$loginBD= "root";	//ou "root"
	$passBD="";				//ou "root" ou ""
	//$pdo = null;

try {

	$pdo = new PDO ("mysql:server=$hostname; dbname=$base", "$loginBD", "$passBD");
}

catch (PDOException $e) {
	die  ("Echec de connexion : " . $e->getMessage() . "\n");
}

?>
<?php
function get_objs_bd(&$resultat=array()){
	require ("./modele/connect.php");
	$sql="select * from objets";
	
	try {
		$commande = $pdo->prepare($sql);
		$bool=$commande->execute();
		if ($bool)$resultat=$commande->fetchAll(PDO::FETCH_ASSOC);
		if ($resultat== null) return false; 
		else return true;
	}
	
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
}

function save_result_bd($id_user,$res,$timestamp){
	require ("./modele/connect.php"); 

	$date= date('Y-m-d H:i:s', $timestamp);
	echo $date;

	$sql='INSERT INTO histoire(id_user, res, date) values (:id_user, :res,:date)';
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':id_user', $id_user);
		$commande->bindParam(':res', $res);
		$commande->bindParam(':date', $date);


		$bool=$commande->execute();
		
		if($bool){
			return true;
		}
		else{
			return false;
		}
		}
	
	
	catch (PDOException $e) {
		echo utf8_encode("Echec d'ajouter : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
}


function get_description_bd($id,&$resultat){
	require ("./modele/connect.php");
	$sql="select description from objets_descript where id=:id";
	
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':id', $id);
		$bool=$commande->execute();
		if ($bool)$resultat=$commande->fetch(PDO::FETCH_ASSOC);
		if ($resultat== null) return false; 
		else return true;
	}
	
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
}

function get_histoire_bd($id_user,&$resultat=array()){
	require ("./modele/connect.php");
	$sql="select * from histoire where id_user=:id_user";
	
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':id_user', $id_user);
		$bool=$commande->execute();
		if ($bool)$resultat=$commande->fetchAll(PDO::FETCH_ASSOC);
		if ($resultat== null) return false; 
		else return true;
	}
	
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
}

function get_bestscore_bd($id_user,&$resultat){
	require ("./modele/connect.php");
	$sql="select min(res) from histoire where id_user=:id_user";
	
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':id_user', $id_user);
		$bool=$commande->execute();
		if ($bool)$resultat=$commande->fetch(PDO::FETCH_ASSOC);
		if ($resultat== null) return false; 
		else return true;
	}
	
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
}

?>
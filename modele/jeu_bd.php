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

function get_classement_bd($id,&$resultat=array()){
	require ("./modele/connect.php");
	$sql="select DISTINCT utilisateur.id,utilisateur.name,(select min(res) from histoire where id_user=utilisateur.id)bestscore
	from utilisateur inner join (SELECT r.id_ami 
								 FROM utilisateur u 
								 inner join relations r 
								 on u.id=r.id 
								 where u.id=:id) a 
	on utilisateur.id=a.id_ami or utilisateur.id=:id 
    where (select min(res) from histoire where id_user=utilisateur.id)is not null
    ORDER BY bestscore ASC";

	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':id', $id);
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

?>
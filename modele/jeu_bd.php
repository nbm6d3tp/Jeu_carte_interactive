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

function save_result_bd($id_user,$res){
	require ("./modele/connect.php"); 

	$sql='INSERT INTO histoire(id_user, res) values (:id_user, :res)';
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':id_user', $id_user);
		$commande->bindParam(':res', $res);

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

function get_histoire_bd($id){

}

function get_classement_bd(){

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

?>
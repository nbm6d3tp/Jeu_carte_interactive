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

// function save_result_bd($id,$resultat)

?>
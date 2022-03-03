<?php 

function verif_ident_l_bd($pseudo, $mdp,&$resultat) { 
	require ("./modele/connect.php") ; //connexion à MYSQL et définition de $pdo
	
    $mdp_encode=sha1($mdp);
	$sql="SELECT * FROM `client`  where pseudo=:pseudo and mdp=:mdp and id=1"; 
	
	try {
		$commande = $pdo->prepare($sql);// *************
		$commande->bindParam(':pseudo', $pseudo);
		$commande->bindParam(':mdp',$mdp_encode );
		$bool = $commande->execute();		
		if ($bool) $resultat = $commande->fetch(PDO::FETCH_ASSOC); //tableau d'enregistrements
		if ($resultat== null) return false; 
		else return true;
	}
	
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
	 
}

function verif_ident_e_bd($pseudo, $mdp,&$resultat) { 
	require ("./modele/connect.php") ; //connexion à MYSQL et définition de $pdo
	
    $mdp_encode=sha1($mdp);
	$sql="SELECT * FROM `client`  where pseudo=:pseudo and mdp=:mdp and id<>1"; 
	
	try {
		$commande = $pdo->prepare($sql);// *************
		$commande->bindParam(':pseudo', $pseudo);
		$commande->bindParam(':mdp',$mdp_encode );
		$bool = $commande->execute();		
		if ($bool) $resultat = $commande->fetch(PDO::FETCH_ASSOC); //tableau d'enregistrements
		if ($resultat== null) return false; 
		else return true;
	}
	
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
	 
}

function existe($username){ //verifier si le compte on veut creer (inscrire) est deja dans la bdd

	require ("./modele/connect.php");
	$sql="SELECT username FROM `utilisateur`  where username=:username";
	
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':username', $username);
		$commande->execute();
		$bool=$commande->fetch(PDO::FETCH_ASSOC);
		if($bool!=null)return true;
		else return false;
	}
	
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}

}

function inscrire_bd($name,$username,$password,&$resultat=array()) {
	require ("./modele/connect.php"); 
	$mdp_encode=sha1($password);

	$sql='INSERT INTO utilisateur(name, username, password) values (:name, :username, :password)';
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':name', $name);
		$commande->bindParam(':username', $username);
		$commande->bindParam(':password', $mdp_encode);
		$commande->execute();
		
		$sql="SELECT * FROM `utilisateur`  where username=:username";
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':username', $username);
		$bool=$commande->execute();

		if($bool)$resultat = $commande->fetch(PDO::FETCH_ASSOC);
		if ($resultat== null) return false; 
		else return true;
		}
	
	catch (PDOException $e) {
		echo utf8_encode("Echec d'inscription : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
	}


?>

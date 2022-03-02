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

function existe($pseudo){ //verifier si le compte on veut creer (inscrire) est deja dans la bdd

	require ("./modele/connect.php");
	$sql="SELECT pseudo FROM `client`  where pseudo=:pseudo";
	
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':pseudo', $pseudo);
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

function inscrire_bd($nom,$pseudo,$mdp,$email,$nomE,$adresseE,&$resultat=array()) {
	require ("./modele/connect.php"); 
	$mdp_encode=sha1($mdp);

	$sql='INSERT INTO client(nom, pseudo, mdp, email,nomE,adresseE) values (:nom, :pseudo, :mdp, :email,:nomE,:adresseE)';
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':nom', $nom);
		$commande->bindParam(':pseudo', $pseudo);
		$commande->bindParam(':mdp', $mdp_encode);
		$commande->bindParam(':email', $email);
        $commande->bindParam(':nomE', $nomE);
        $commande->bindParam(':adresseE', $adresseE);
		$commande->execute();
		
		$sql="SELECT * FROM `client`  where pseudo=:pseudo";
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':pseudo', $pseudo);
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

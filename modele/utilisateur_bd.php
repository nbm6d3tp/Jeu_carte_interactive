<?php 

function verif_ident_bd($username, $password,&$resultat) { 
	require ("./modele/connect.php") ; //connexion à MYSQL et définition de $pdo
	
    $pass_encode=sha1($password);
	$sql="SELECT * FROM `utilisateur`  where username=:username and password=:password"; 
	
	try {
		$commande = $pdo->prepare($sql);// *************
		$commande->bindParam(':username', $username);
		$commande->bindParam(':password',$pass_encode );
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

function inscrire_bd($name,$username,$password,$latitude,$longitude,&$resultat=array()) {
	require ("./modele/connect.php"); 
	$location=array();
	$location[]=$latitude;
	$location[]=$longitude;
	$json_location=json_encode($location);
	$mdp_encode=sha1($password);

	$sql='INSERT INTO utilisateur(name, username, password,location) values (:name, :username, :password,:location)';
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':name', $name);
		$commande->bindParam(':username', $username);
		$commande->bindParam(':password', $mdp_encode);
		$commande->bindParam(':location', $json_location);

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

function getFriends_bd($id,&$resultat=array()){
	require ("./modele/connect.php");
	$sql="select utilisateur.id,utilisateur.name,utilisateur.location 
	from utilisateur inner join (SELECT r.id_ami 
								 FROM utilisateur u 
								 inner join relations r 
								 on u.id=r.id 
								 where u.id=:id) a 
	on utilisateur.id=a.id_ami";
	
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

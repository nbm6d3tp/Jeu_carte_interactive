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
		return true;	
	}

}

function inscrire_bd($name,$username,$password,$latitude,$longitude,&$resultat=array()) {
	require ("./modele/connect.php"); 
	$mdp_encode=sha1($password);

	$sql='INSERT INTO utilisateur(name, username, password,latitude,longitude) values (:name, :username, :password,:latitude,:longitude)';
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':name', $name);
		$commande->bindParam(':username', $username);
		$commande->bindParam(':password', $mdp_encode);
		$commande->bindParam(':latitude', $latitude);
		$commande->bindParam(':longitude', $longitude);


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
	$sql="select utilisateur.id,utilisateur.name,utilisateur.latitude, utilisateur.longitude
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


function setLocation_bd($id,$latitude,$longitude){
	require ("./modele/connect.php"); 

	$sql='UPDATE utilisateur SET latitude = :latitude, longitude = :longitude WHERE id=:id';
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':id', $id);
 		$commande->bindParam(':latitude', $latitude);
		$commande->bindParam(':longitude', $longitude);

		$bool=$commande->execute();
		

		if($bool){
			return true;
		}
		else{
			return false;
		}
		}
	
	catch (PDOException $e) {
		echo utf8_encode("Echec d'inscription : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
}

function effaceAmi_bd($id,$id_ami){
	require ("./modele/connect.php"); 
	$sql='DELETE FROM relations WHERE id=:id and id_ami=:id_ami;';
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':id', $id);
		$commande->bindParam(':id_ami', $id_ami);

		$bool=$commande->execute();
		

		if($bool){
			return true;
		}
		else{
			return false;
		}
		}
	
	catch (PDOException $e) {
		echo utf8_encode("Echec d'efface : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}

}

function listeEtranger_bd($id,&$resultat=array()){
	require ("./modele/connect.php");

	$sql="select utilisateur.id,utilisateur.name,utilisateur.latitude,utilisateur.longitude 
	from utilisateur left join (select utilisateur.id,utilisateur.name,utilisateur.latitude, utilisateur.longitude
		from utilisateur inner join (SELECT r.id_ami 
									 FROM utilisateur u 
									 inner join relations r 
									 on u.id=r.id 
									 where u.id=:id) a 
		on utilisateur.id=a.id_ami)ami 
		on utilisateur.id=ami.id 
		WHERE ami.id IS NULL and utilisateur.id!=:id";

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

function ajouterAmi_bd($id,$id_ami){
	require ("./modele/connect.php"); 
	$sql='INSERT INTO relations(id,id_ami) VALUES(:id,:id_ami);';
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':id', $id);
		$commande->bindParam(':id_ami', $id_ami);

		$bool=$commande->execute();
		

		if($bool){
			return true;
		}
		else{
			return false;
		}
		}
	
	catch (PDOException $e) {
		echo utf8_encode("Echec d'efface : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
}

?>

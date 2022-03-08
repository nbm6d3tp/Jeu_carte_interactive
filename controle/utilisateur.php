<?php 

function ident() { 
	
	$_SESSION['profil'] = array();
	$username= isset($_POST['username'])?($_POST['username']):'';
	$password=  isset($_POST['password'])?($_POST['password']):'';
	if  ($username==''||$password==''){
		echo "Champ invalide" ;   
	}
	else {
	    require_once ("./controle/utilisateur.php");
		if  (! verif_ident($username,$password,$resultat)) {
			echo "Echec d'authentification"; 
		}
	    else { 
			unset($_SESSION['profil']);
			$_SESSION['profil']['name'] = $resultat['name'];
			$_SESSION['profil']['latitude'] = $resultat['latitude'];
			$_SESSION['profil']['longitude'] = $resultat['longitude'];
			$_SESSION['profil']['id'] = $resultat['id'];
			$_SESSION['profil']['amis'] = getFriends($resultat['id']);
			echo "Succes"; 

		}
    }	
}

function verif_ident($username,$password,&$resultat) { //fonction verifier l'identification pour le Loueur
	
	require ('./modele/utilisateur_bd.php');
	return verif_ident_bd($username,$password,$resultat);
}


function accueil() { //fonction affichier l'accueil pour le Loueur, à faire (Minh) *** 
	// $nom = $_SESSION['profil']['nom'];
	require ("./vue/utilisateur/accueil.tpl");
}


function inscrire(){ //fonction d'inscription

	$name=  isset($_POST['name'])?($_POST['name']):'';
	$username= isset($_POST['username'])?($_POST['username']):'';
	$password=  isset($_POST['password'])?($_POST['password']):'';
	$con_pass=  isset($_POST['con_password'])?($_POST['con_password']):'';
	$latitude=  isset($_POST['latitude'])?($_POST['latitude']):'';
	$longitude=  isset($_POST['longitude'])?($_POST['longitude']):'';

	$_SESSION['profil'] = array();


    if  ($name==''||$username==''||$password==''||$latitude==''||$longitude==''){
		echo "Champ invalide" ;
	}
    else if($password!=$con_pass){
        echo "Les mots de passe ne correspondent pas";
    }       
    else{
        require_once ('./modele/utilisateur_bd.php');
		if(existe($name)){
			echo 'Compte deja existe';
		}
		else{
			if(inscrire_bd($name,$username,$password,$latitude,$longitude,$resultat)){
				setcookie('id',$resultat['id'],time()+3000); //creation de cookies
				unset($_SESSION['profil']);
				$_SESSION['profil']['name'] = $resultat['name'];
				$_SESSION['profil']['latitude'] = $resultat['latitude'];
				$_SESSION['profil']['longitude'] = $resultat['longitude'];
				$_SESSION['profil']['id'] = $resultat['id'];
				$_SESSION['profil']['amis'] = getFriends($resultat['id']);
				echo "Succes"; 
				
			}
			else{
				echo "Echec d'inscription"; 
			}
		}
    
     }
    

}

function deconnecter(){ //fonction pour déconnecter
	session_destroy();
	$url = "index.php?controle=utilisateur&action=accueil";
	header ("Location:" . $url) ;
}


function getFriends($id){
	require_once ("./controle/utilisateur.php");
	getFriends_bd($id,$resultat);
	return $resultat; 	
}

?>

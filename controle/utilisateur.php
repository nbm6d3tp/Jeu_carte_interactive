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
			$_SESSION['profil']['etrangers'] = listeEtranger();
			echo "Succes"; 

		}
    }	
}


function verif_ident($username,$password,&$resultat) { //fonction verifier l'identification pour le Loueur
	
	require ('./modele/utilisateur_bd.php');
	return verif_ident_bd($username,$password,$resultat);
}


function accueil() {
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
				$_SESSION['profil']['etrangers'] = listeEtranger();

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
	require_once ("./modele/utilisateur_bd.php");
	getFriends_bd($id,$resultat);
	return $resultat; 	
}

function getSessionLatitude(){
	echo $_SESSION['profil']['latitude'];
}

function getSessionLongitude(){
	echo $_SESSION['profil']['longitude'];
}

function getSessionId(){
	echo $_SESSION['profil']['id'];
}

function setLocation(){
	$id=$_SESSION['profil']['id'];
	$latitude= isset($_GET['latitude'])?$_GET['latitude']:'';
	$longitude= isset($_GET['longitude'])?$_GET['longitude']:'';

	require_once ('./modele/utilisateur_bd.php');
	if(setLocation_bd($id,$latitude,$longitude)){
		$_SESSION['profil']['latitude'] = $latitude;
		$_SESSION['profil']['longitude'] = $longitude;
	}

}

function isSession(){
	if(isset($_SESSION['profil'])&&$_SESSION['profil']!=null){
		echo "true";
	}
	else{
		echo "false";
	}
}

function effaceAmi(){
	$id=$_SESSION['profil']['id'];
	$id_ami= isset($_GET['id_ami'])?$_GET['id_ami']:'';

	require_once ('./modele/utilisateur_bd.php');
	effaceAmi_bd($id,$id_ami);
	$_SESSION['profil']['amis']=getFriends($id);
	$_SESSION['profil']['etrangers']=listeEtranger();
}

function listeEtranger(){
	$id=$_SESSION['profil']['id'];
	require_once ('./modele/utilisateur_bd.php');
	listeEtranger_bd($id,$resultat);
	return $resultat; 	
}

function ajouterAmi(){
	$id=$_SESSION['profil']['id'];
	$id_ami= isset($_GET['id_ami'])?$_GET['id_ami']:'';

	require_once ('./modele/utilisateur_bd.php');
	ajouterAmi_bd($id,$id_ami);
	$_SESSION['profil']['amis']=getFriends($id);
	$_SESSION['profil']['etrangers']=listeEtranger();
}
?>

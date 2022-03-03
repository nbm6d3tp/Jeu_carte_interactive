<?php 

function ident() { 
	$pseudo=  isset($_POST['pseudo'])?($_POST['pseudo']):'';
	$mdp=  isset($_POST['mdp'])?($_POST['mdp']):'';
	$msg='';
	$_SESSION['profil'] = array();

	if  (count($_POST)==0)
        require ("./vue/utilisateur/ident.tpl") ;
    else {
	    require_once ("./controle/utilisateur.php");
		if  (! verif_ident($pseudo,$mdp,$resultat)) {
			$msg ="erreur de saisie";
	        require ("./vue/utilisateur/ident.tpl") ;
		}
	    else { 
            unset($_SESSION['profil']);
			$_SESSION['profil']['nom'] = $resultat['nom'];
			$_SESSION['profil']['id'] = $resultat['id'];
			$url = "index.php?controle=utilisateur&action=accueil";
			header ("Location:" . $url) ;
		}
    }	
}


function verif_ident($pseudo,$mdp,&$resultat) { //fonction verifier l'identification pour le Loueur
	require ('./modele/utilisateur_bd.php');
	return verif_ident_l_BD($pseudo,$mdp,$resultat);
}


function accueil() { //fonction affichier l'accueil pour le Loueur, à faire (Minh) *** 
	// $nom = $_SESSION['profil']['nom'];
	require ("./vue/utilisateur/accueil.tpl");
}


function inscrire(){ //fonction d'inscription

	$name=  isset($_POST['name'])?($_POST['name']):'';
	$username= isset($_POST['username'])?($_POST['username']):'';
	$password=  isset($_POST['password'])?($_POST['password']):'';
	$_SESSION['profil'] = array();


    if  ($name==''||$username==''||$password==''){
		echo "Champ invalide" ;
	}
    // else if($mdp!=$mdp_cf){
    //     echo "Les mots de passe ne correspondent pas";
    // }       
    else{
        require_once ('./modele/utilisateur_bd.php');
		if(existe($name)){
			echo 'Compte deja existe';
		}
		else{
			if(inscrire_bd($name,$username,$password,$resultat)){
				setcookie('id',$resultat['id'],time()+3000); //creation de cookies
				unset($_SESSION['profil']);
				$_SESSION['profil']['name'] = $resultat['name'];
				$_SESSION['profil']['id'] = $resultat['id'];
				echo "Succes d'inscription"; 
				
			}
			else{
				echo "Echec d'inscription"; 
			}
		}
    
     }
    

}

function deconnecter(){ //fonction pour déconnecter
	session_destroy();
	ident();
}

function infos_et_confirmer(){
	$id=isset($_GET['voiture'])?$_GET['voiture']:'';

	$voiture=array();
    require_once('./modele/voiture_bd.php');
    if(!afficher_v($id,$voiture)){
        require ("./vue/voiture/entreprise/infos_et_confirmer.tpl") ;
    }

    else{
        require ("./vue/voiture/entreprise/infos_et_confirmer.tpl") ;
    } 

	
}

function if_non_ident(){
	require("./vue/voiture/entreprise/if_non_ident.tpl");
}


function pas_droit(){
	require("./vue/utilisateur/pas_droit.tpl");
}

?>

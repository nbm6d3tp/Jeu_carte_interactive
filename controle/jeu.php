<?php

function mode_deviner() { 
	$resultat=array();
	require_once ("./modele/jeu_bd.php");
	get_objs_bd($resultat);
	require ("./vue/mode_deviner/mode_deviner_page.tpl");
}


function get_objs(){
	require_once ("./modele/jeu_bd.php");
	get_objs_bd($resultat);
	$E = json_encode($resultat);
	echo $E;
}

function save_result(){
	$id=$_SESSION['profil']['id'];
	$res= isset($_GET['res'])?$_GET['res']:'';
	$date= isset($_GET['date'])?$_GET['date']:'';

	require_once ("./modele/jeu_bd.php");
	save_result_bd($id,$res,$date);
}

function get_description(){
	$id= isset($_GET['id'])?$_GET['id']:'';
	$resultat=array();
	require_once ("./modele/jeu_bd.php");
	get_description_bd($id,$resultat);
	echo $resultat["description"];
}

function get_histoire(){
	$id=$_SESSION['profil']['id'];
	$resultat=array();
	require_once ("./modele/jeu_bd.php");
	get_histoire_bd($id,$resultat);
	$E = json_encode($resultat);
	echo $E;
}

function get_bestscore(){
	$id=$_SESSION['profil']['id'];
	require_once ("./modele/jeu_bd.php");
	get_bestscore_bd($id,$resultat);
	echo $resultat['min(res)'];
}


function get_classement(){
	$id=$_SESSION['profil']['id'];
	$resultat=array();
	require_once ("./modele/jeu_bd.php");
	get_classement_bd($id,$resultat);
	$E = json_encode($resultat);
	echo $E;
}
?>
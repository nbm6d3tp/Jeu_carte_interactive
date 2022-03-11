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
	require_once ("./modele/jeu_bd.php");
	save_result_bd($id,$res);
}

function get_description(){
	$id= isset($_GET['id'])?$_GET['id']:'';
	$resultat=array();
	require_once ("./modele/jeu_bd.php");
	get_description_bd($id,$resultat);
	echo $resultat["description"];
}
?>
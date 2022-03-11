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
	require_once ("./modele/jeu_bd.php");

}
?>
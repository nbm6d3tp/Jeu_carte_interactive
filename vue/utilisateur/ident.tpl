<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>identification</title>
</head>

<body>

<h3> Formulaire d'authentification </h3> 
<form action="index.php?controle=utilisateur&action=ident" method="post">

    <input 	name="pseudo" 	type="text" value= "<?php echo $pseudo;
											?>"
					>      Pseudo      <br/>
    <input  name="mdp"  type="Password"  value= "<?php echo $mdp;
											?>"
					>  Password    <br/> 
					
    <input type= "submit"  value="soumettre">
	
</form>

<div>
    <a href="index.php?controle=utilisateur&action=inscrire">Inscription</a>
    <br>
    <a href="index.php?controle=utilisateur&action=accueil">Retour a l'accuel</a>
</div>

<div> 
	<?php echo $msg;
	?>
</div> 

</body></html>

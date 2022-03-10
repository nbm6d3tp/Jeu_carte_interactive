<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Dialog - Modal form</title>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />
  <link rel="stylesheet" href="vue/index.css">


  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>   
  <script src="js/index.js"></script>


</head>
<body>
 
<div id="dialog-form-inscrire" title="Create new user">
  <p class="validateTips">All form fields are required.</p>
 
  <form id="form_inscrire" action="index.php?controle=utilisateur&action=inscrire" method="post">
    <fieldset>
      <label for="name">Name</label>
      <input type="text" name="name" class="text ui-widget-content ui-corner-all name">
      <label for="username">Username</label>
      <input type="text" name="username"  class="text ui-widget-content ui-corner-all username">
      <label for="password">Password</label>
      <input type="password" name="password" class="text ui-widget-content ui-corner-all password">
      <label for="con_password">Confirmation of password</label>
      <input type="password" name="con_password" class="text ui-widget-content ui-corner-all con_password">
     
      <label for="latitude">Latitude</label>
      <input type="text" name="latitude" class="text ui-widget-content ui-corner-all latitude">
      <label for="longitude">Longitude</label>
      <input type="text" name="longitude" class="text ui-widget-content ui-corner-all longitude">
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" class="sub" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
  <button id='getLoc'>Get current location</button>
</div>
 

<div id="dialog-form-connecter" title="Connecter">
  <p class="validateTips">All form fields are required.</p>
 
  <form id="form_connecter" action="index.php?controle=utilisateur&action=ident" method="post">
    <fieldset>
      <label for="username">Username</label>
      <input type="text" name="username" class="text ui-widget-content ui-corner-all username">
      <label for="password">Password</label>
      <input type="password" name="password" class="text ui-widget-content ui-corner-all password">

      <input type="submit" class="sub" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
<?php
if(isset($_SESSION['profil'])&&$_SESSION['profil']!=null){
    echo '<h3> 	Bienvenue M.'.$_SESSION['profil']['name'].'</h3>';
    echo "<button id='deconnecter'>Deconnection</button>";
    echo "<button id='getLocMap'>Positionner a votre position actuelle</button>";
    echo "<div class='liste_amis'>";
    
    foreach($_SESSION['profil']['amis'] as $cle => $ami){
      echo "<button class='ami' value='".$ami['latitude'].",".$ami['longitude']."'>".$ami['name']."</button>";
      } 
    echo"</div>";

}
else{
    echo "<button id='create-user'>Create new user</button>";
    echo "<button id='connecter'>Connection</button>";
}

?>


<div id='map'></div> 

<script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=S8d7L47mdyAG5nHG09dUnSPJjreUVPeC"></script>
<script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-routing.js?key=S8d7L47mdyAG5nHG09dUnSPJjreUVPeC"></script>
<script src="js/map.js"></script>
</body>
</html>
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Dialog - Modal form</title>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

<style>
  label, input { display:block; }
input.text { margin-bottom:12px; width:95%; padding: .4em; }
fieldset { padding:0; border:0; margin-top:25px; }
h1 { font-size: 1.2em; margin: .6em 0; }
div#users-contain { width: 350px; margin: 20px 0; }
div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
.ui-dialog .ui-state-error { padding: .3em; }
.validateTips { border: 1px solid transparent; padding: 0.3em; }
</style>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>
  $( function() {
    var dialog, form,
      name = $( "#name" ),
      username=$( "#username" ),
      password = $( "#password" ),
      allFields = $( [] ).add( name ).add( username ).add( password ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .html(t)
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function addUser() {
      $.post( $("#form_inscrire").attr("action"), 
         $("#form_inscrire :input").serializeArray(), 
         function(info){ updateTips(info); 
          tips.addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
      }
      );
      clearInput();
    }
 
    dialog = $( "#dialog-form-inscrire" ).dialog({
      autoOpen: false,
      height: 400,
      width: 350,
      modal: true,
      buttons: {
        "Create an account": addUser,
        Cancel: function() {
          tips.html("All form fields are required.");
          dialog.dialog( "close" );
        }
      },
      close: function() {
        tips.html("All form fields are required.");
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
    $("#form_inscrire").submit( function() {
    return false;
    });

    form = dialog.find( "form" ).on( "submit", addUser);
    $( "#create-user" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });
  } );

  function clearInput() {
    $("#form_inscrire :input").each( function() {
      $(this).val('');
    });
  }
  </script>
</head>
<body>
 
<div id="dialog-form-inscrire" title="Create new user">
  <p class="validateTips">All form fields are required.</p>
 
  <form id="form_inscrire" action="index.php?controle=utilisateur&action=inscrire" method="post">
    <fieldset>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
      <label for="username">Username</label>
      <input type="text" name="username" id="username"  class="text ui-widget-content ui-corner-all">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all">

      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" id="sub" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
 

<!-- 
<div id="dialog-form-connecter" title="Connecter">
  <p class="validateTips">All form fields are required.</p>
 
  <form id="form_inscrire" action="index.php?controle=utilisateur&action=inscrire" method="post">
    <fieldset>
      <label for="username">Username</label>
      <input type="text" name="username" id="username"  class="text ui-widget-content ui-corner-all">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all">

      <input type="submit" id="sub" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div> -->

<button id="create-user">Create new user</button>
<!-- <button id="connecter">Connection</button> -->

 
 
</body>
</html>
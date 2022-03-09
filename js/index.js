$( function() {

  var dialog, form,
    name = $( ".name" ),
    username=$( ".username" ),
    password = $( ".password" ),
    con_password=$('.con_password'),
    latitude=$('.latitude'),
    longitude=$('.longitude'),
    allFields = $( [] ).add( name ).add( username ).add( password ).add(con_password).add(latitude).add(longitude),
    tips = $( ".validateTips" );

  function updateTips( t ) {
    tips
      .html(t)
      .addClass( "ui-state-highlight" );
    setTimeout(function() {
      tips.removeClass( "ui-state-highlight", 1500 );
    }, 500 );
  }

function connect(){
var msg;
    $.post( $("#form_connecter").attr("action"), 
     $("#form_connecter :input").serializeArray(), 
     function(info){ 
       if(info=="Succes"){
        location.reload();
       }
       updateTips(info);

  }
  );  
  clearInput();
}


  function addUser() {
    $.post( $("#form_inscrire").attr("action"), 
       $("#form_inscrire :input").serializeArray(), 
       function(info){ 
        if(info=="Succes"){
          location.reload();
         } 
        updateTips(info); 
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
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );

        dialog.dialog( "close" );
      }
    },
    close: function() {
      tips.html("All form fields are required.");
      form[ 0 ].reset();
      allFields.removeClass( "ui-state-error" );
    }
  });


  dialog_connect = $( "#dialog-form-connecter" ).dialog({
    autoOpen: false,
    height: 400,
    width: 350,
    modal: true,
    buttons: {
      "Connection": connect,
      Cancel: function() {
        tips.html("All form fields are required.");
        form_connect[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );

        dialog_connect.dialog( "close" );
      }
    },
    close: function() {
      tips.html("All form fields are required.");
      form[ 0 ].reset();
      allFields.removeClass( "ui-state-error" );
    }
  });
 
  form = dialog.find( "form" ).on( "submit", addUser);
  form_connect = dialog_connect.find( "form" ).on( "submit", connect);

  $( "#create-user" ).button().on( "click", function() {
    dialog.dialog( "open" );
  });

  $( "#connecter" ).button().on( "click", function() {
    dialog_connect.dialog( "open" );
  });

  $( "#deconnecter" ).button().on( "click", function() {
    window.location.href = "index.php?controle=utilisateur&action=deconnecter";
  });

   $( "#getLoc" ).button().on( "click", function() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(setPosition);
      }
      else{tips.html("Geolocation non supportée par ce navigateur.");}
      }
  );

  function setPosition(position){
    latitude.val(position.coords.latitude);
    longitude.val(position.coords.longitude);
  }

} 

);


function clearInput() {
  $("form input").each( function() {
    $(this).val('');
  });
}


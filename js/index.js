$( function() {
  $("#page").removeClass("hiddenbody");
  var dialog, form,
    name = $( ".name" ),
    username=$( ".username" ),
    password = $( ".password" ),
    con_password=$('.con_password'),
    latitude=$('.latitude'),
    longitude=$('.longitude'),
    allFields = $( [] ).add( name ).add( username ).add( password ).add(con_password).add(latitude).add(longitude),
    tips = $( ".validateTips" );
    getLocation();

    function getLocation() {
      if(typeof(Storage) !== 'undefined'&&sessionStorage.getItem('latitude')==null){
        navigator.geolocation.getCurrentPosition(showPosition);
      }
    }
      function showPosition(position) { 
        sessionStorage.setItem('latitude', position.coords.latitude);
        sessionStorage.setItem('longitude', position.coords.longitude);
        location.reload(true);
      }
  function updateTips( t ) {
    tips
      .html(t)
      .addClass( "ui-state-highlight" );
    setTimeout(function() {
      tips.removeClass( "ui-state-highlight", 1500 );
    }, 500 );
  }

function connect(){
    $.post( $("#form_connecter").attr("action"), 
     $("#form_connecter :input").serializeArray(), 
     function(info){ 
       if(info=="Succes"){
         if(sessionStorage.getItem('latitude')!=null){
          var url="index.php?controle=utilisateur&action=setLocation&latitude="+sessionStorage.getItem('latitude')+"&longitude="+sessionStorage.getItem('longitude');
          $.get(url);
         }
        else{
          $.get('index.php?controle=utilisateur&action=getSessionLatitude', function (data) {
            sessionStorage.setItem('latitude',data);
          });
          $.get('index.php?controle=utilisateur&action=getSessionLongitude', function (data) {
            sessionStorage.setItem('longitude',data);
          });
        }
        location.reload(true);
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
          location.reload(true);
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
      "Créer un compte": addUser,
      Cancel: function() {
        tips.html("All form fields are required.");
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );

        dialog.dialog( "Fermer" );
      }
    },
    close: function() {
      tips.html("All form fields are required.");
      form[ 0 ].reset();
      allFields.removeClass( "ui-state-error" );
    }
  });


  $( "#classement" ).dialog({
    autoOpen: false,
    show: {
      effect: "blind",
      duration: 1000
    },
    hide: {
      effect: "explode",
      duration: 1000
    }
  });

  $( "#affiche_classement" ).button().on( "click", function() {
        var classement;
      $.ajax({
        url: 'index.php?controle=jeu&action=get_classement',
        async: false,
        dataType: 'json',
        success: function(data) {
          classement = data;
        }  
      });
      var code="<table>";
      code+="<tr><th>Prenom</th><th>Resultat</th></tr>";
      classement.forEach(element => {
        var tmp=element["bestscore"];
        var min = Math.floor(tmp/600);
        var sec = Math.floor( (tmp-min*600) / 10 );
        code+="<tr>";
          code+="<td>";
          code+=element["name"];
          code+="</td>";
          code+="<td>";
          code+=min+":"+sec;
          code+="</td>";
        code+="</tr>";
      });
      code+="</table>";
      $( "#classement" ).html(code);
        $( "#classement" ).dialog( "open" );
  });


    $( "#histoire" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });

    $( "#affiche_histoire" ).button().on( "click", function() {
      var histoire,bestscore;
      $.ajax({
        url: 'index.php?controle=jeu&action=get_histoire',
        async: false,
        dataType: 'json',
        success: function(data) {
          histoire = data;
        }
    });
    $.ajax({
      url: 'index.php?controle=jeu&action=get_bestscore',
      async: false,
      dataType: 'json',
      success: function(data) {
        bestscore = parseInt(data);
      }
  });
      var min = Math.floor(bestscore/600);
      var sec = Math.floor( (bestscore-min*600) / 10 );
      var code="<h3>Votre meilleure resultat est "+min+":"+sec+"</h3>"
      code+="<table>";
      code+="<tr><th>Resultat</th><th>Date</th></tr>";
      histoire.forEach(element => {
        var tmp=element["res"];
        min = Math.floor(tmp/600);
        sec = Math.floor( (tmp-min*600) / 10 );
        code+="<tr>";
          code+="<td>";
          code+=min+":"+sec;
          code+="</td>";
          code+="<td>";
          code+=element["date"];
          code+="</td>";
        code+="</tr>";
      });
      code+="</table>";
      $( "#histoire" ).html(code);
      $( "#histoire" ).dialog( "open" );
    });


  dialog_connect = $( "#dialog-form-connecter" ).dialog({
    autoOpen: false,
    height: 400,
    width: 350,
    modal: true,
    buttons: {
      "Connexion": connect,
      Cancel: function() {
        tips.html("All form fields are required.");
        form_connect[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );

        dialog_connect.dialog( "Fermer" );
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
    $( "#dialog-form-inscrire" ).load("vue/utilisateur/inscrire.html");
    dialog.dialog( "open" );
  });

  $( "#connecter" ).button().on( "click", function() {
    $( "#dialog-form-connecter" ).load("vue/utilisateur/connecter.html");
    dialog_connect.dialog( "open" );
  });

  $( "#deconnecter" ).button().on( "click", function() {
    sessionStorage.clear();  
    window.location.href = "index.php?controle=utilisateur&action=deconnecter";
  });

   $( "#getLoc" ).button().on( "click", function() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(setPosition);
      }
      else{tips.html("Geolocation non supportée par ce navigateur.");}
      }
  );


  $(document).on( "click",".efface_ami", function() {
      $.get('index.php?controle=utilisateur&action=effaceAmi&id_ami='+this.value);
      console.log("hello");
      $(".div_ami[value="+this.value+"]").hide();

      var $code= "<button class='etranger ui-button ui-widget ui-corner-all' data-value="+this.value+" value='"+$(this).attr('data-value')+"'>"+ $(this).parent().attr('data-value') +"</button>";
      
      $('#liste_etranger').append($code);
    }
    );

  $(document).on( "click",'.etranger', function() {
    console.log("coucou");
    $.get('index.php?controle=utilisateur&action=ajouterAmi&id_ami='+$(this).attr('data-value'));
    $(":button[value='"+this.value+"'][class='etranger ui-button ui-widget ui-corner-all']").hide();
    var $code= "<div class='div_ami' data-value='"+$(this).text()+"' value="+$(this).attr('data-value')+">";
    $code+= "<button class='ami ui-button ui-widget ui-corner-all' value='"+this.value+"'>"+$(this).text()+"</button>";
    $code+= "<button class='efface_ami ui-button ui-widget ui-corner-all' data-value='"+this.value+"' value="+$(this).attr('data-value')+"> - </button>";
    $code+= "</div>";
    $('#liste_amis').append($code);
  }
  );

  $('#jouer').button().on( "click", function() {
    window.location = "index.php?controle=jeu&action=mode_deviner";
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


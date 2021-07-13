<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Heilenergie Wunder</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/todo.css"> -->
    <!--responsive nav css skript-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
    window.jQuery || document.write('<script src="jquery/jquery-3.5.1.js"><\/script>');
  </script>

<script src="jquery/validate/jquery.validate.js"></script>
<script src="jquery/validate/additional-methods.js"></script>
<script src="jquery/validate/localization/messages_de.js"></script>
<script src="lib/js/kontakt.js"></script>
    <script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
    crossorigin="anonymous"></script>
</head>
<body>

    <noscript style="color:rgb(246, 4, 4); font-size: 1.7em;">
      <b>&lt;noscript&gt;</b> Um das Benutzererlebnis zu verbessern benötigen Sie aktives JavaScript in Ihrem Browser.
    </noscript>
<div>
 
   <img src="img/logotop.png" alt="Logo Energie Heilung">

</div>


    <div class="topnav " id="myTopnav">
 
    <a href="index.php"     <?php if( $page == 'index') echo 'class="active item"';       else echo 'class="item"'?> title="Index">Startseite</a>
    <a href="video.php"    <?php if( $page == 'video') echo 'class="active item"';       else echo 'class="item"'?> title="Video">Video</a>
    <a href="kontakt.php"   <?php if( $page == 'kontakt') echo 'class="active item"';     else echo 'class="item"'?> title="Kontakt">Kontakt</a>
    <a href="preisliste.php"<?php if( $page == 'preisliste')echo 'class="active item"';   else echo 'class="item"'?> title="Preisliste">Preisliste</a>
 

    <?php if(auth_id()!= null) : ?> 
    <a href="admin.php"<?php if( $page == 'admin')echo 'class="active item"';   else echo 'class="item"'?> title="Admin">Admin Bereich</a>
    <?php endif;?>

    <!--für nicht eingeloggte user-->
    <?php if(!auth_id()!= null) : ?> 
    <a href="login.php"     <?php if( $page == 'login') echo 'class="active item"';       else echo 'class="item"'?> title="Login"> Login</a>
    <?php endif;?>
<!--für nicht eingeloggte user ende-->


    <!--für eingeloggte user-->
    <?php if(auth_id()!= null) : ?> 
    <a href="logout.php"    <?php if( $page == 'logout') echo 'class="active item"';     else echo 'class="item"'?> title="Logout">Logout</a>
    <?php endif;?>
<!--für eingeloggte user ende-->
 
  

 
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
      </div>
      

      <!--responsive menu tab funktion-->
          
    <script>
        function myFunction() {
          var x = document.getElementById("myTopnav");
          if (x.className === "topnav") {
            x.className += " responsive";
          } else {
            x.className = "topnav";
          }
        }
        </script>  
        
        <header>
        <img style="width:100%" src="img/yoga.jpg" alt="Willkommen auf Meiner Seite"> 
    </header>

 
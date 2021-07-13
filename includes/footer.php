<footer>

      <!--footerflex div-->
      <div>

      <a href="index.php" <?php if( $page == 'index') echo 'class="active item"';   
      else echo 'class="item"'?> title="Startseite">Startseite</a> |   

      <a href="impressum.php" <?php if( $page == 'impressum') echo 'class="active item"';   
      else echo 'class="item"'?> title="Impressum">Impressum</a> | 
      
      <a href="register.php"<?php if( $page == 'register')echo 'class="active item"';   else echo 'class="item"'?> title="Register">Registrieren</a> | 
      
          <!-- admin -->
<?php if(auth_id()!= null) : ?> 
    <a href="admin.php"<?php if( $page == 'admin')echo 'class="active item"';   else echo 'class="item"'?> title="Admin">Admin Bereich</a> |   
    <?php endif;?>


       <!--für nicht eingeloggte user-->
    <?php if(!auth_id()!= null) : ?> 
    <a href="login.php"     <?php if( $page == 'login') echo 'class="active item"';       else echo 'class="item"'?> title="Login">Login</a>   
    <?php endif;?>
<!--für nicht eingeloggte user ende-->


    <!--für eingeloggte user-->
    <?php if(auth_id()!= null) : ?> 
    <a href="logout.php"    <?php if( $page == 'logout') echo 'class="active item"';     else echo 'class="item"'?> title="Logout">Logout</a>
    <?php endif;?>
<!--für eingeloggte user ende-->



  </div>
    </footer>

 </body>
</html>


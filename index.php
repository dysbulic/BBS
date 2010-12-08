<!DOCTYPE html PUBLIC
  "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Bulletin Board System</title>
    <?php include( 'header.html' ) ?>
  </head>
  <body>
    <?php if( isset( $error ) ) { ?>
      <div id="error"><?php print $error ?></div>
    <?php } ?>
    <?php if( !isset( $_SESSION['user'] ) ) { ?>
      <form action="login.php" method="post">
        <fieldset>
          <div><legend>Username:</legend><input type="text" name="username"/></div>
          <div><legend>Password:</legend><input type="password" name="password"></div>
          <div><input type="submit" name="submit" value="Login"/></div>
          <div id="register"><a href="register.php">Create An Account</a></div>
        </fieldset>
      </form>
    <?php } else { ?>
    
    <?php } ?>
  </body>
</html>

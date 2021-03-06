<!DOCTYPE html PUBLIC
  "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
  require_once( 'User.php' );
  require_once( 'util.php' );
  session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Bulletin Board System</title>
    <?php include( 'header.html' ) ?>
  </head>
  <body>
    <?php if( !isset( $_SESSION['user'] ) ) { ?>
      <p id="intro" class="ui-widget-content">Welcome to the student bulletin board. Please login to access the system.</p>
    <?php } ?>
    <?php if( isset( $error ) ) { ?>
      <div id="error"><?php print $error ?></div>
    <?php } ?>
    <?php
      $error = getvar( 'error' );
      if( isset( $error ) && $error != '' ) {
    ?>
      <div id="error"><?php print $error ?></div>
    <?php } ?>
    <?php
      if( !isset( $_SESSION['user'] ) ) {
        include( 'login_form.php' );
        include( 'registration_form.php' );
      } else {
        include( 'post_menu.php' );
        include( 'topic_list.php' );
      }
    ?>
  </body>
</html>

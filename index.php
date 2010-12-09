<!DOCTYPE html PUBLIC
  "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
require_once('User.php');
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
    <?php if( !isset( $_SESSION['user'] ) ) { ?>
      <form action="login.php" method="post">
        <fieldset class="login">
          <ul>
            <li><legend>Username</legend><input type="text" name="username"/></li>
            <li><legend>Password</legend><input type="password" name="password" class="ui-state-highlight"/></li>
            <li><input type="submit" name="submit" value="Login"/></li>
          </ul>
        </fieldset>
        <form action="register.php" method="post">
          <fieldset class="registration">
            <div><legend>Name</legend><input type="text" name="name" value="<?php print $name ?>"/></div>
            <div><legend>Username</legend><input type="text" name="username"/></div>
            <div><legend>Password</legend><input type="password" name="password"></div>
            <div><legend>E-mail</legend><input type="text" name="email" value="<?php print $email ?>"/></div>
            <div><input type="submit" name="submit" value="Register"/></div>
          </fieldset>
        </form>
      </form>
    <?php } else { ?>
      <p>Welcome <?php echo $_SESSION['user']->getName() ?></p>
      <ul>
        <li><a href="new_topic.php">New Topic</a></li>
        <li><a href="view_alltopics.php">View All Topics</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    <?php } ?>
  </body>
</html>

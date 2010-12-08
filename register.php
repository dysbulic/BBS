<?php
session_start();

require_once( "util.php" );
include "User.php";

$name = getvar( 'name' );
$email = getvar( 'email' );
$username = getvar( 'username' );
$password = getvar('password');

if( $name && $username && $password ) {
  $user = new User( $username,
                    $name,
                    $email,
                    sha1( $password ) );
  try {
    $user->save();
    $_SESSION[ 'user' ] = $user;
    header( 'Location: index.php' );
  } catch( DuplicateUserException $e ) {
    $error = 'That username is already taken.';
  }
}
?>
<!DOCTYPE html PUBLIC
  "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>New User Registration</title>
    <?php include( 'header.html' ) ?>
  </head>
  <body>
    <?php if( isset( $error ) ) { ?>
      <div id="error"><?php print $error ?></div>
    <?php } ?>
    <form action="register.php" method="post">
      <fieldset>
        <div><legend>Name:</legend><input type="text" name="name" value="<?php print $name ?>"/></div>
        <div><legend>Username:</legend><input type="text" name="username"/></div>
        <div><legend>Password:</legend><input type="password" name="password"></div>
        <div><legend>E-mail:</legend><input type="text" name="email" value="<?php print $email ?>"/></div>
        <div><input type="submit" name="submit" value="Register"/></div>
      </fieldset>
    </form>
  </body>
</html>

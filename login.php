<?php
session_start();

include "util.php";
include "User.php";

$username = getvar('username');
if($username) { // A login attempt
  try {
    $user = User::fromUsername( $username );
    $password = sha1( getvar( 'password' ) );
    if( $password == $user->getPasswordHash() ) {
      $_SESSION['user'] = $user;
      header( 'Location: index.php' );
    } else {
      $error = "Invalid password";
      require_once( 'index.php' );
    }
  } catch( UserNotFoundException $e ) {
    $error = "Unknown user";
    require_once( 'index.php' );
  }
} else {
  $redirect = getvar( 'redirect' );
  $host = $_SERVER['HTTP_HOST'];
  
  if( $_SESSION['user'] && $redirect ) {
    header("Location: http://$host/$redirect");
  } else {
    require_once( 'index.php' );
  }
}


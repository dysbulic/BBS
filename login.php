<?php
session_start();

require_once( "util.php" );
require_once( "User.php" );

$username = getvar( 'username' );
if( $username ) { // A login attempt
  try {
    $user = User::fromUsername( $username );
    $password =  getvar( 'password' );
    if( sha1( $password ) == $user->getPasswordHash() ) {
      $_SESSION['user'] = $user;
      header( 'Location: index.php' );
    } else {
      $error = 'Invalid Password';
      include( 'index.php' );
    }
  } catch( UserNotFoundException $e ) {
    $error = 'Unknown User';
    include( 'index.php' );
  }
} else {
  $redirect = getvar( 'redirect' );
  $host = $_SERVER['HTTP_HOST'];
  
  if( $_SESSION['user'] && $redirect ) {
    header( "Location: http://$host/$redirect" );
  } else {
    header( 'Location: index.php' );
  }
}


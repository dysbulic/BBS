<?php
session_start();

require_once( 'util.php' );
require_once( 'User.php' );

$name = getvar( 'name' );
$email = getvar( 'email' );
$username = getvar( 'username' );
$password = getvar( 'password' );

if( $username ) {
  if( strlen( $password ) < 6 ) {
    $error = 'Minimum Password Length: 6';
    $formtype = 'registration';
    include( 'index.php' );
  } else if( $email != '' && !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
    $error = 'Invalid E-mail Address';
    $formtype = 'registration';
    include( 'index.php' );
  } else {
    $user = new User( $username,
                      $name,
                      $email,
                      sha1( $password ) );
    try {
      $user->save();
      $_SESSION[ 'user' ] = $user;
      header( 'Location: index.php' );
    } catch( DuplicateUserException $e ) {
      $error = 'Username Already Taken';
      $formtype = 'registration';
      include( 'index.php' );
    }
  }
} else {
  $formtype = 'registration';
  include( 'index.php' );
}

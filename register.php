<?php
session_start();

require_once( 'util.php' );
require_once( 'User.php' );

$name = getvar( 'name' );
$email = getvar( 'email' );
$username = getvar( 'username' );
$password = getvar( 'password' );

if( $name && $username && $password ) {
  if( strlen( $password ) < 6 ) {
    $error = 'Minimum Password Length: 6';
    $formtype = 'registration';
    include( 'index.php' );
  } else if( $email != '' && !preg_match( '[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}', $email ) ) {
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
}

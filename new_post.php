<?php

require_once( 'User.php');
require_once( 'Post.php');
require_once( 'util.php');

session_start();

if( !$_SESSION['user'] ) {
  header( 'Location: ' . urlencode( 'index.php?error=User Not Logged In' ) );
  return;
}

$title = getvar( 'title' );
$content = getvar( 'content' );

if( $title ) {
  $newpost = new Post( $title,
                       $content,
                       $_SESSION['user'] );
  $newpost->save();
}

$isAjax = strcasecmp( getvar( 'reqtype' ), 'ajax' ) == 0;
if( !$isAjax ) {
  include( 'index.php' );
}

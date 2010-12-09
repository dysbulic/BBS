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
$parent = getvar( 'parent' );

if( $title ) {
  $post = new Post( $title,
                       $content,
                       $_SESSION['user'] );
  $post->setParent( $parent );
  $post->save();
}

$isAjax = strcasecmp( getvar( 'reqtype' ), 'ajax' ) == 0;
if( !$isAjax ) {
  include( 'index.php' );
}

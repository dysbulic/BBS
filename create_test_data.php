<?php

require_once( 'User.php' );
require_once( 'Post.php' );

for( $i = 1; $i <= 3; $i++ ) {
  $post = new Post( 'Test #' . i,
		    'Test content',
		    'test' );
  $post->save();
}


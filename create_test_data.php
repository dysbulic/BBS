<?php

for($i = 1; $i <= 3; $i++) {
  $post = new Post('Test #' . i,
		   'Test content',
		   'test');
  $post->save();
}


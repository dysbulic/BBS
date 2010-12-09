<?php
require_once( 'Post.php' );
?>
<table id="postlist">
  <tr>
    <th for="title">Title</th>
    <th>Creation Date</th>
    <th>Post Count</th>
    <th>Unread Count</th>
  </tr>
  <?php function printPost( $post, $depth = 1 ) { ?>
    <tr depth="<?php print $depth ?>">
      <td><?php print $post->getTitle() ?></td>
      <td><?php print date( 'H:i j M Y', $post->getCreationTime() ) ?></td>
      <td><?php print $post->getThread()->getCount() ?></td>
      <td><?php print $post->getThread()->getUnreadCount() ?></td>
    </tr>
    <?php
      foreach( $post->getReplies() as $child ) {
        printPost( $child, $depth + 1 );
      }
    ?>
  <?php } ?>  
  <?php
    foreach( Post::getTopics() as $post ) {
      printPost( $post );
    }
  ?>
</table>

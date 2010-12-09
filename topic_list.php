<?php
require_once( 'Post.php' );
?>
<table id="postlist">
  <tr>
    <th/>
    <th for="title">Title</th>
    <th>Creation Date</th>
    <th>Post Count</th>
    <th>Unread Count</th>
  </tr>
  <?php function printPost( $post, $depth = 1 ) { ?>
    <tr depth="<?php print $depth ?>">
      <td><a href="new_post.php?parent=<?php print $post->getId() ?>">Reply</a></td>
      <td class="title"><?php print $post->getTitle() ?></td>
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

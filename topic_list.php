<?php
require_once( 'Post.php' );
?>
<table>
  <tr>
    <th>Title</th>
    <th>Post Count</th>
    <th>Unread Count</th>
  </tr>
  <?php foreach( Post::getTopics() as $post ) { ?>
    <tr>
      <td><?php print $post->getTitle() ?></td>
      <td><?php print $post->getThread()->getCount() ?></td>
      <td><?php print $post->getThread()->getUnreadCount() ?></td>
    </tr>
  <?php } ?>
</table>

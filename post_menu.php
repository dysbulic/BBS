<?php
  require_once( 'User.php' );
  require_once( 'Post.php' );
  require_once( 'util.php' );

  session_start();

  try {
    $parent = Post::fromId( getvar( 'parent' ) );
  } catch( Exception $e ) {
  }
?>

<ul id="postmenu">
  <li><a href="logout.php">Logout <?php print $_SESSION['user']->getUsername() ?></a></li>
</ul>
<script type="text/javascript"  src="http://box1.wmd-editor.com/1/wmd.js"></script>
<form action="new_post.php" method="post">
  <?php if( isset( $parent ) ) { ?>
    <?php $title = 'RE:' . $parent->getTitle() ?>
    <input type="hidden" name="parent" value="<?php print $parent->getId() ?>"/>
  <?php } ?>
  <fieldset class="post" title="Add Post"
    <?php if( isset( $parent ) ) { ?>
      style="display: none"
    <?php } ?>
  >
    <ul>
      <li><legend for="title">Title</legend><input type="text" name="title" value="<?php print $title ?>"/></li>
      <li>
        <legend for="content">Content</legend>
        <textarea name="content"><?php print $content ?></textarea>
        <div class="wmd-preview ui-widget-content"></div>
      </li>
      <li><input type="submit" name="new" value="New Post"/></li>
      <li><input type="submit" name="cancel" value="Cancel"/></li>
    </ul>
  </fieldset>
</form>

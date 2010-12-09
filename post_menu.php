<?php
  require_once( 'User.php' );
  session_start();
?>

<script type="text/javascript"  src="http://box1.wmd-editor.com/1/wmd.js"></script>
<form action="new_post.php" method="post">
  <fieldset class="post">
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
<ul id="postmenu">
  <li><a href="new_post.php">New Thread</a></li>
  <li><a href="logout.php">Logout <?php print $_SESSION['user']->getUsername() ?></a></li>
</ul>

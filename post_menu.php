<?php
  require_once( 'User.php' );
  session_start();
?>

<form action="new_post.php" method="post">
  <fieldset class="post">
    <ul>
      <li><legend>Title</legend><input type="text" name="username" value="<?php print $username ?>"/></li>
      <li><legend>Content</legend><textarea name="content"><?php print $content ?></textarea>
      <li><input type="submit" name="submit" value="New Post"/></li>
      <li><input type="submit" name="submit" value="Cancel"/></li>
    </ul>
  </fieldset>
</form>
<ul id="postmenu">
   <li><a href="new_post.php">New Thread</a></li>
   <li><a href="logout.php">Logout <?php print $_SESSION['user']->getUsername() ?></a></li>
</ul>

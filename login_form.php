<form action="login.php" method="post">
  <fieldset class="login"
    <?php if( $formtype == 'registration' ) { ?>
      style="display: none"
      <?php } ?>
    >
    <ul>
      <li><legend>Username</legend><input type="text" name="username" value="<?php print $username ?>"/></li>
      <li><legend>Password</legend><input type="password" name="password" value="<?php print $password ?>"/></li>
      <li><input type="submit" name="submit" value="Login"/></li>
    </ul>
  </fieldset>
</form>

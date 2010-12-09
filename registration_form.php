<form action="register.php" method="post">
  <fieldset class="registration">
    <ul>
      <li><legend>Name</legend><input type="text" name="name" value="<?php print $name ?>"/></li>
      <li><legend>Username</legend><input type="text" name="username" value="<?php print $username ?>"/></li>
      <li><legend>Password</legend><input type="password" name="password" value="<?php print $password ?>"></li>
      <li><legend>E-mail</legend><input type="text" name="email" value="<?php print $email ?>"/></li>
      <li><input type="submit" name="submit" value="Register"/></li>
    </ul>
  </fieldset>
</form>

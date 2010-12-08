<?php
session_start();
#include "auth_user.inc.php";
include "conn.inc.php";
?>
<html>
<head>
     <title>Student Bulletin Board</title>
</head>
<body>
<h1>Student Bulletin Board</h1>
<br>
<?php
$query = "SELECT * FROM users WHERE username = '" . $_SESSION['user_logged']. "'
AND password = (password('" . $_SESSION['user_password'] . "'));";
$result = mysql_query($query) or die(mysql_error());

$row = mysql_fetch_array($result);
?>
Name: <?php echo $row['name']; ?><br>
<a href="new_topic.php">New Topic</a>&nbsp;|&nbsp;
<a href="view_alltopics.php">View All Topics</a>&nbsp;|&nbsp;<br><br>
<a href="Logout.php">Logout</a>
<!--<a href="update_account.php">Update Account</a>&nbsp;|&nbsp;
<a href="delete_account.php">Delete Account</a> -->
</body>
</html>
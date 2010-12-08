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
Here you can start a topic of your interest<br><br>
<?php
if ($_POST['submit'] == "addtopic")
{
     $query_insert = "INSERT INTO topic_table(topic_title,topic_author) VALUES ('" . $_POST['topicname'] . "','" . $_SESSION['user_logged'] ."');";

     $result_update = mysql_query($query_insert) or die(mysql_error());

     
?>
     <b>Your topic has been added.</b><br><br>
	 <a href="user_personal.php">Click here</a> to go to home page.<br><br>
	 <a href="Logout.php">Logout</a><br><br>
     
<?php
}
else
{
     $query = "SELECT * FROM users WHERE username = '" .
     $_SESSION['user_logged']. "' AND password = (password('" . $_SESSION['user_password'] . "'));";
     $result = mysql_query($query) or die(mysql_error());

     $row = mysql_fetch_array($result);
     //$hobbies = explode(", ", $row['hobbies'])
?>
     <form action="new_topic.php" method="post">
     Topic Name: <input type="text" name="topicname"><br><br>
     
     <input type="submit" name="submit" value="addtopic"> &nbsp; 
	 <input type="button" value="Cancel" onclick="history.go(-1);">
	 <br><br>
	 <a href="Logout.php">Logout</a>
     </form>
<?php
}
?>
</body>
</html>
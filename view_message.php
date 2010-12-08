<?php
session_start();
//include "auth_user.inc.php";
include "conn.inc.php";
?>
<html>
<head>
     <title>Beginning PHP, Apache, MySQL Web Development</title>
</head>
<body>
<h1> The messages are :</h1>
	<form action="view_message.php" method="post">
	<?php
    $data = "SELECT * FROM message_table WHERE topic_id = '" . $_POST['topic_id']. "'";
   
	// $data = mysql_query("SELECT * FROM message_table") or die(mysql_error()); 
	 Print "<table border cellpadding=3>"; 
	 //Print "<tr>";
	 //Print "<th>Message ID:</th>";
	 //Print "<th> Topic Title:</th>";
	 //Print "<th> Topic Title:</th>";
	 
	 while($info = mysql_fetch_array( $data )) 
	 { Print "<tr>"; 
	   Print " <td> Message ID </td">;
	   Print  "<td>".$info['msg_id'] . " </td>";
	   Print "<td> Message </td">;
	   Print  "<td>".$info['msg'] . " </td>";
	   Print "</tr>"; 
	   
	 } 
	   Print "</table>"; 
	 //----------------------------------
     
	?>
	</form>
   <!--  <form action="new_topic.php" method="post">
     Topic Name: <input type="text" name="topicname"><br><br>
     
     <input type="submit" name="submit" value="addtopic"> &nbsp; 
	 <input type="button" value="Cancel" onclick="history.go(-1);">
     </form>
	-->
</body>
</html>
<?php
session_start();
//include "auth_user.inc.php";
include "conn.inc.php";
?>
<html>
<head>
     <title>Student Bulletin Board</title>
</head>
<body>
<h1> Student Bulletin Board</h1>
All the topics are listed.<br><br>
	<form action="view_alltopics.php" method="post">
	<?php
    
    
	 $data = mysql_query("SELECT * FROM topic_table") or die(mysql_error()); 
	 Print "<table border cellpadding=3>"; 
	 Print "<tr>";
	 Print "<th>Topic Number:</th>";
	 Print "<th>Topic title:</th>";
	 Print "<th> Topic author:</th>";
	 
	 while($info = mysql_fetch_array( $data )) 
	 { Print "<tr>"; 
	   Print " <td>".$info['topic_id'] . "</td> ";
	   $topic_id = $info['topic_id'];
	 ?>
		<input type="hidden" name="topic_id" value="<? echo $topic_id; ?>" >
	   <?php
	   Print "<td><a href=\"view_message.php\">" .$info['topic_title'] . "</a> </td>";
	   
	   Print  "<td>".$info['topic_author'] . " </td></tr>"; 
	 } 
	   Print "</table>"; 
	 //----------------------------------
     
	?>
	<br><br>
	<a href="Logout.php">Logout</a>
	</form>
   <!--  <form action="new_topic.php" method="post">
     Topic Name: <input type="text" name="topicname"><br><br>
     
     <input type="submit" name="submit" value="addtopic"> &nbsp; 
	 <input type="button" value="Cancel" onclick="history.go(-1);">
     </form>
	-->
</body>
</html>
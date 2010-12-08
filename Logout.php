<html>
<body>

<?php  
   
if (isset($_SESSION['loggedIn'])) {  
   
	$tmp = $_SESSION['user_logged'];  
	session_destroy();  
	session_regenerate_id();  
	$_SESSION['user_logged'] = $tmp;  
}  
?> 
<center>You are logged out of the Student Bulletin Board.
<form action="Logout.php" method="post">
<center><a href="user_login.php">Click here</a> to login again.

</html>
</body>

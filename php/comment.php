
<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);

	$name = $_GET['name'];
	$comment = $_GET['comment'];
	$email = $_GET['email'];
	$con = mysql_connect('localhost', 'dcliouco_dcliou', 'dbdin13');

	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db("dcliouco_mimi", $con);

	//insert new record
	$sql = "INSERT INTO Comments (Name, Comment, Status) VALUES('$name', '$comment','pending')";
	$result = mysql_query($sql);

	//retrieve the latest record
	$sql1 = mysql_query("SELECT * FROM Comments");
	$lastRecord = mysql_num_rows($sql1);
	$sql2 = "SELECT * FROM Comments WHERE UID='" . $lastRecord . "'";
	$result2 = mysql_query($sql2);

	//send email for authentication
	$to = "dawochih.liou@gmail.com";
	$subject = "New Message from dcliou.com!";
	$message = "Hello Daw-Chih,\n\n You have one new message:\n 
				Please conform its status: \n\n 
				Message from: " . $name . "\n 
				Email: " . $email . "\n
				Message: " . $comment . " \n ";
	mail($to,$subject,$message);
	//echo "Mail Sent.";
	
	while ($row = mysql_fetch_array($result2)) {
		echo "<div>";
		echo "<table>";
		echo "<tr>";
		echo "<td>";
		echo "<p class=\"p1\">" . $row['Name'] . "</p>";
		echo "<p class=\"p2\">" . $row['Comment'] . "</p>";
		echo "</td>";
		echo "</tr>";
		echo "</table>"; 
		echo "</div>";
	}
	
	mysql_close($con);
?>
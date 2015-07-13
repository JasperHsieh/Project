<?php
$servername = "localhost";
$username = "root";
$password = "113538mysql";
$dbname = "db1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else{
	//echo "Connected successfully<br>";
}
/*
$sql = "SELECT * FROM `Users` LIMIT 0, 30 ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	while($row = $result->fetch_assoc()) {
		echo $row["Username"]."<br>";	
	}
} else {
	echo "0 results";
}
$conn->close();
*/
?>

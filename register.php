<?php
//echo "register.php <br>";
//echo $sever_name;
//echo $_POST["name"]." ".$_POST["password"]."<br>";

include "connectDB.php";

function dump_query_result($result){

	if($result->num_rows > 0){
		echo "result not empty <br>";
		while($row = $result->fetch_assoc()){
			echo $row["Username"]." ".$row["Passowrd"]."<br>";
		}
	}
	else{
		echo "resutl is empty <br>";
	}
}

$input_name = $_POST["name"];
$input_pass = $_POST["password"];

if($_POST["name"] && $_POST["password"]){

	$username = mysqli_real_escape_string($conn, $input_name);
	$password = mysqli_real_escape_string($conn, $input_pass);
	//echo $username." ".$password."<br>";	
	
	$sql = "SELECT * FROM `Users` WHERE `Username`='$username'";
	$result = mysqli_query($conn, $sql);
	//dump_query_result($result);

	$check_user = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	if($check_user != null){
		die("The username has already been used!");
	}
	if(!ctype_alnum($username)){
		die("Username contains special characters! <a href='register.html'>Back</a>");
	}
	$salt = hash("sha512", rand());
	$sql = "INSERT INTO `Users` (`Username`, `Password`, `Salt`) VALUES('$username', '$password', '$salt')";
	mysqli_query($conn, $sql);
	setcookie("c_user", $username);
	setcookie("c_salt", $salt);
	die("Your account has been created. Now logged in");

}

?>

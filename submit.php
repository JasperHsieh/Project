<?php

error_reporting(E_ALL);
//echo "submit.php<br>";

include "connectDB.php";

function dumpDB(){
	global $conn;
	$sql = "SELECT * FROM `Users` LIMIT 0, 30 ";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		echo "Database not empty<br>";
		while($row = $result->fetch_assoc()){
			echo $row["Username"]." ".$row["Password"]."<br>";
		}
	}
	else{
		echo "no data in DataBase<br>";
	}
}
//echo "Dump Database<br>";
//dumpDB();

if($_POST["name"] && $_POST["password"]){
	
	//echo "not empty<br>";
	$input_name = $_POST["name"];
	$input_pass = $_POST["password"];
	//echo "input:".$input_name." ".$input_pass."<br>";
	
	$username = mysqli_real_escape_string($conn, $input_name);
	$password = mysqli_real_escape_string($conn, $input_pass);
	//echo "username:".$username."<br>";
	//echo "password:".$password."<br>";
	
	$sql = "SELECT * FROM `Users` WHERE `Username`='$username'";
	
	if($result = mysqli_query($sql))echo "true <br>";
	
	$result = mysqli_query($conn, $sql);
	
	if($result == null)echo "result null <br>";
	
	$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	//echo "user ".$user["Username"]." ".$user["Password"]."<br>";
	
	if($user == '0') {
		die("username not exist <a href='index.html'>BACK</a>");
	}
	
	if($user['Password'] != $password) {
		die("Wrong password <a href='index.html'>BACK</a>");
	}
	
	$salt = hash("sha512", rand());
	setcookie("c_user", hash("sha512", $username));
	setcookie("c_salt", $salt);
	
	$id = $user['_id'];
	$sql = "Update `Users` SET `Salt`='$salt' WHERE `_id`='$id'";
	mysqli_query($conn, $sql);

	die("You are now logging in as $username");

}
else{
	//echo "empty";
}


?>

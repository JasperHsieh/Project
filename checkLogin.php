<?php
include "connectDB.php";
$logged = false;

//echo "checkLogin.php <br>";

if($_COOKIE["c_user"]){
	
	//echo "c_user:".$_COOKIE['c_user']."<br>";
	//echo "c_salt:".$_COOKIE['c_salt']."<br>";

	$cuser = mysqli_real_escape_string($conn, $_COOKIE['c_user']);
	$csalt = mysqli_real_escape_string($conn, $_COOKIE['c_salt']);
	
	$sql = "SELECT * FROM `Users` WHERE `Salt`='$csalt'";
	$result = mysqli_query($conn, $sql);
	if($result == null) echo "result is null <br>";
	$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if($user == null) echo " user is null <br>";
	
	//echo "cuser:".$cuser."<br>";
	//echo "username:".$user['Username']." hash:".hash("sha512", $user['Username'])."<br>";
	
		
	if($user != null){
		
		if(hash("sha512", $user['Username']) == $cuser){
			$logged = true;
		}
	}
	

}
else{
	//echo "No user cookie <br>";
}

?>

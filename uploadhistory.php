<?php

	include_once("config.php");
		


	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$nextpage="uploadhistory.php";
	include("sessioncheck.php");
	include_once("header.php");
	$sql="SELECT id FROM user_info WHERE username = '$username' AND password= '$password'";
	$result = mysqli_query($db,$sql);
	$count = mysqli_num_rows($result);
	if($count==0)return "invalid session";
	$row=$result->fetch_assoc();
	$user_id=$row["id"];
	$sql="SELECT id,datetime,program_id FROM data WHERE user_id= '$user_id' AND program_id>0";
	$result = mysqli_query($db,$sql); 

	if($username != "guest")
		include_once("history.php");
	else{
		include_once("history-guest.php");
		include_once("signinform.php");
	}
?>

	

<?php include_once("footer.php"); ?>
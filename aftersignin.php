<?php
	include_once("config.php");
	session_start();
	function signin($db){
		if(isset($_POST["username"]))$username=$_POST["username"];
		else return "username not set";
		if(isset($_POST["password"]))$password=$_POST["password"];
		else return "password not set";
		$sql="SELECT id FROM user_info WHERE username = '$username' AND password= '$password'";
		$result = mysqli_query($db,$sql);
		$count = mysqli_num_rows($result);
		if($count!=0){
			$_SESSION["username"]=$username;
			$_SESSION["password"]=$password;
			return "signin successful";
		}
		else{
			return "signin failed";
		}
	}
	$message=signin($db);
	if($message=="signin failed"){
		header('Location:signinform.php');
	}
	else if(isset($_POST["nextpage"]) & $_POST["nextpage"]!=""){
		header('Location:'.$_POST["nextpage"]);
	}
	else {
		header('Location:index.php');
	}
	
?>
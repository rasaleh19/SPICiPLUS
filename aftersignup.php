<?php
	include_once("config.php");
	session_start();
	function signup($db){
		if(isset($_POST["username"]))$username=$_POST["username"];
		else return "username not set";
		if(isset($_POST["password"]))$password=$_POST["password"];
		else return "password not set";
		if(isset($_POST["email"]))$email=$_POST["email"];
		else return "email not set";
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		// Validate e-mail
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			//echo("$email is a valid email address");
		} else {
			return "$email is not a valid email address";
		}
		$sql="SELECT id FROM user_info WHERE username = '$username'";
		$result = mysqli_query($db,$sql);
		$count = mysqli_num_rows($result);
		if($count!=0) return "username already exists";
		$sql="SELECT id FROM user_info WHERE email = '$email'";
		$result = mysqli_query($db,$sql);
		$count = mysqli_num_rows($result);
		if($count!=0) return "email already exists";
		$sql="INSERT INTO user_info (username,password,email) values ('$username','$password','$email')";
		$result = mysqli_query($db,$sql);
		if($result==false){
			return "signup failed";
		}
		else{}
		ini_set('SMTP','localhost' ); 
		ini_set('sendmail_from', 'noreply@ekngine.com');
		$msg="username = $username \n password = $password";
		mail($email,"SPICiPLUS registration",$msg);
		
		return "signup successful";
	}
	$message =signup($db);
	if($message=="signup successful"){
		header('Location:signinform.php');
	}
	else{
		header('Location:signupform.php?message='.$message);
	}
	
?>
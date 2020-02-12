<?php
	include_once("config.php");
	if(isset($_POST['username'])){
		$username=$_POST['username'];
	}else if(isset($_SESSION['username'])){
		$username=$_SESSION['username'];
	}
	else{
		include("signinform.php");
		exit;
	}
	if(isset($_POST['password'])){
		$password=$_POST['password'];
	}else if(isset($_SESSION['password'])){
		$password=$_SESSION['password'];
	}
	else{
		include("signinform.php");
		exit;
	}
	$sql="SELECT id FROM user_info WHERE username = '$username' AND password= '$password'";
	$result = mysqli_query($db,$sql);
	$count = mysqli_num_rows($result);
	if($count==0){
		include("signinform.php");
		exit;
	}
?>
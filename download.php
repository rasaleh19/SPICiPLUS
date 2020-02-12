<?php
	include_once("config.php");
	session_start();
	function download($db){
		//echo "issue";
		if(isset($_SESSION["username"]))$username=$_SESSION["username"];
		else return "username not set";
		if(isset($_SESSION["password"]))$password=$_SESSION["password"];
		else return "password not set";
		$sql="SELECT id FROM user_info WHERE username = '$username' AND password= '$password'";
		$result = mysqli_query($db,$sql);
		$count = mysqli_num_rows($result);
		if($count==0)return "invalid session";
		$row=$result->fetch_assoc();
		$user_id=$row["id"];
		if(isset($_GET["dl"]))$dl=$_GET["dl"];
		else return "no file is selected";
		if(isset($_GET["type"]))$type=$_GET["type"];
		else return "no type is selected";
		if($type=="in")$sql="SELECT info FROM c_input WHERE data_id=$dl ORDER BY id";
		else /*if($type=="1")*/$sql="SELECT info FROM c_output WHERE data_id=$dl AND program_id=".$type." ORDER BY id";
		$result = mysqli_query($db,$sql);
		//echo 'issue';
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment;filename=$dl"."_"."$type.txt");
		while($row=$result->fetch_assoc()){
			echo $row['info'];
		}
	}
	$message=download($db);
	//echo $message;
?>
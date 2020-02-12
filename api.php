<?php
	include_once("config.php");
	session_start();
	function cluster_size_calculation($db,$data_id,$program_id,$lines){
		$t=array();
		$t[0]=0;
		$t[1]=0;
		$t[2]=0;
		$t[3]=0;
		$t[4]=0;
		$t[5]=0;
		foreach($lines as $lin){
			if(strcmp(trim($lin),"")!=0){
				$c=count(split("[ \t]",$lin));
				if($c<5){
					$t[0]++;
				}
				else if($c<10){
					$t[1]++;
				}
				else if($c<16){
					$t[2]++;
				}
				else if($c<26){
					$t[3]++;
				}
				else if($c<41){
					$t[4]++;
				}
				else{
					$t[5]++;
				}
			}
		}
		for($i=0;$i<6;$i++){
			$sql="INSERT INTO cluster_size(data_id,program_id,cluster_size_type_id,count) VALUES ( $data_id , $program_id , ".($i+1)." , ".$t[$i]." )";
			mysqli_query($db,$sql);
		}
	}
	function single_calculation($db,$data_id,$program_id,$contents){
		$lines=split("[\r\n]",$contents);
		$cluster_count=count($lines);
		cluster_size_calculation($db,$data_id,$program_id,$lines);
		$sql="INSERT INTO cluster_count(data_id,program_id,count) VALUES ( $data_id , $program_id , $cluster_count )";
		mysqli_query($db,$sql);
		
		$arr=str_split($contents,2048); // partial 2048 insertion
		foreach($arr as $v){
			$v2=mysqli_real_escape_string($db,$v);
			$sql="INSERT INTO c_output(data_id,program_id,info) VALUES ( $data_id , $program_id ,'$v2')";
			$result = mysqli_query($db,$sql);
		}
	}
	function single_program_run($db,$data_id,$inputfilename,$outputfilename,$type){
		switch($type){
			case 1:
			case 2:
			case 3:
				$program_name='S'.$type.'.exe';
				shell_exec($program_name.' '.$inputfilename.' '.$outputfilename);
				$outputfilecontents=file_get_contents($outputfilename);
				single_calculation($db,$data_id,$type,$outputfilecontents);
				break;
			case 4:
				shell_exec("java -jar cluster_one.jar ".$inputfilename.">".$outputfilename);
				$outputfilecontents=file_get_contents($outputfilename);
				single_calculation($db,$data_id,4,$outputfilecontents);
				break;
			case 5:
				shell_exec("java -jar mgclusjar.jar -f ".$inputfilename);
				$outputfilecontents=file_get_contents("mgclus.out.".$inputfilename."_D0");
				single_calculation($db,$data_id,5,$outputfilecontents);
				unlink("mgclus.out.".$inputfilename."_D0");
				break;
			case 6:
				shell_exec("perl formatInputfile.pl ".$inputfilename." ecc");
				shell_exec("java -jar WPNCA.jar ID_".$inputfilename." proteinID_".$inputfilename." ".$outputfilename." 0.3 2");
				$temp=file_get_contents($outputfilename);
				$temp1 = split("Complex",$temp);
				$temp3="";
				foreach($temp1 as $temp2){
					$temp4=str_replace("\n"," ",$temp2);
					$temp5=split(" ",$temp4);
					$temp3=$temp3.implode(" ",array_slice($temp5,2));
					$temp3=$temp3."\n";
				}
				single_calculation($db,$data_id,6,$temp3);
				unlink("ID_".$inputfilename);
				unlink("proteinID_".$inputfilename);
				break;
			case 7:
				shell_exec('spici.exe -i '.$inputfilename.' -o '.$outputfilename."_sp");
				$outputfilecontents=file_get_contents($outputfilename."_sp");
				single_calculation($db,$data_id,7,$outputfilecontents);
				unlink($outputfilename."_sp");
				break;
		}
	}
	function upload($db){

		if(isset($_POST["username"]))
			$_SESSION["username"]=$_POST["username"];
		else
			$_SESSION["username"] = '***';		//replace *** with username

		if(isset($_POST["password"]))
			$_SESSION["password"]=$_POST["password"];
		else
			$_SESSION["password"] = '***';	//replace *** with password

		
		//$_SESSION["password"] = 'apitest';
		//$_POST["view"] = 2;
		
		if(isset($_SESSION["username"]))$username=$_SESSION["username"];
		else return "username not set";
		if(isset($_SESSION["password"]))$password=$_SESSION["password"];
		else return "password not set";
		//echo $username;
		$sql="SELECT id FROM user_info WHERE username = '$username' AND password= '$password'";
		$result = mysqli_query($db,$sql);
		$count = mysqli_num_rows($result);
		if($count==0)return "invalid session";
		$row=$result->fetch_assoc();
		$user_id=$row["id"];
		if(isset($_POST["cprogram"]))$cprogram=$_POST["cprogram"];
		//else return "C program not set";
		if($_POST['input_method']=="file"){
			//echo $_POST['input_method'];
			//echo $FILES["data"]["tmp_name"];
			if(isset($_FILES['data'])){
				//echo 'Issue here';
				$data=file_get_contents($_FILES["data"]["tmp_name"]);
				//echo $data;
			}
			else{ return "file not set";}
		}
		else{
			$data=file_get_contents($_POST['url']);
		}
		/*file_put_contents("test",$data);
		$data2=split("[\r\n]",$data);
		$data4="";
		foreach($data2 as $data3){
			$data5=split("[ \t]",$data3);
			if(isset($data5[2]))if($data5[2]=="0")continue;
			$data4=$data4."\n".$data3;
		}
		
		$data=trim($data4);*/
		if(isset($_POST["cprogram"])){
			$sql="SELECT id from program_info WHERE id=$cprogram";
			$result = mysqli_query($db,$sql);
			$count = mysqli_num_rows($result);
			//echo ''.$count;
			if($count==0){ echo 'issue'; return "invalid C program";}
		}
		//echo "here!";
		$inputfilename=date('Y-m-d-H-i-s');
		$data=trim(preg_replace('/\t+/',' ',$data));
		file_put_contents($inputfilename,$data);
		file_put_contents("tt.txt",$data);
		$edges=substr_count( $data, "\n" );
		$ed=split("\n",$data);
		$a=array();
		foreach($ed as $e){
			$ee=split(" ",$e);
			if(count($ee)>2)array_push($a,trim($ee[0]),trim($ee[1]));
		}
		$vertices=count(array_unique($a));
		$program_id=isset($_POST['cprogram'])?$_POST['cprogram']:0;
		$sql="INSERT INTO data(user_id,program_id,edges,vertices) VALUES ($user_id,$program_id,$edges,$vertices)";
		$result = mysqli_query($db,$sql);
		$data_id=mysqli_insert_id($db);
		$arr=str_split($data,2048);
		foreach($arr as $v){
			$v2=mysqli_real_escape_string($db,$v);
			$sql="INSERT INTO c_input(data_id,info) VALUES ('$data_id','$v2')";
			$result = mysqli_query($db,$sql);
		}
		
		
		$outputfilename=date('y-m-d-H-i-s');
		if(isset($_POST['cprogram'])){
			single_program_run($db,$data_id,$inputfilename,$outputfilename,$_POST['cprogram']);
		}
		else{
			for($i=1;$i<=7;$i++){
				single_program_run($db,$data_id,$inputfilename,$outputfilename,$i);
			}
		}
		/*
		for($i=1;$i<=3;$i++){
			if($i==1)continue;
			if($i==2)continue;
			if($i==3)continue;
			$program_name='S'.$i.'.exe';
			shell_exec($program_name.' '.$inputfilename.' '.$outputfilename);
			$outputfilecontents=file_get_contents($outputfilename);
			single_calculation($db,$data_id,$i,$outputfilecontents);
		}
		
		//Cluster-One Begins
		shell_exec("java -jar cluster_one.jar ".$inputfilename.">".$outputfilename);
		$outputfilecontents=file_get_contents($outputfilename);
		single_calculation($db,$data_id,4,$outputfilecontents);
		//Cluster-One ends
		
		//mgclus Begins
		shell_exec("java -jar mgclusjar.jar -f ".$inputfilename);
		$outputfilecontents=file_get_contents("mgclus.out.".$inputfilename."_D0");
		single_calculation($db,$data_id,5,$outputfilecontents);
		unlink("mgclus.out.".$inputfilename."_D0");
		//mgclus Ends
		/*
		//WPNCA Begins
		shell_exec("perl formatInputfile.pl ".$inputfilename." ecc");
		shell_exec("java -jar WPNCA.jar ID_".$inputfilename." proteinID_".$inputfilename." ".$outputfilename." 0.3 2");
		$temp=file_get_contents($outputfilename);
		$temp1 = split("Complex",$temp);
		$temp3="";
		foreach($temp1 as $temp2){
			$temp4=str_replace("\n"," ",$temp2);
			$temp5=split(" ",$temp4);
			$temp3=$temp3.implode(" ",array_slice($temp5,2));
			$temp3=$temp3."\n";
		}
		single_calculation($db,$data_id,6,$temp3);
		unlink("ID_".$inputfilename);
		unlink("proteinID_".$inputfilename);
		//WPNCA ends
		
	*/
		//spici begins
		/*shell_exec('spici.exe -i '.$inputfilename.' -o '.$outputfilename."_sp");
		$outputfilecontents=file_get_contents($outputfilename."_sp");
		single_calculation($db,$data_id,7,$outputfilecontents);
		//spici ends*/
		
		unlink($inputfilename);
		unlink($outputfilename);
		// if(isset($_POST["view"]) && isset($_POST["cprogram"])){
		// 	$header="Location:".$_POST['view']."view.php?c_input_id=".$data_id."&type=".$_POST['cprogram'];
		// }
		// if(isset($_POST["view"]) && isset($_POST["cprogram"])){
		// 	$header="Location:"."download.php?dl=".$data_id."&type=".$_POST['cprogram'];
		// }
		// else{
		// 	$header="Location:comparison3.php?data_id=".$data_id;
		// }
		$dl=$data_id;
		$type = $_POST['cprogram'];
		download($db, $dl, $type);
		//header($header);
	}

	function download($db, $dl, $type){
		//echo $type;
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
		// if(isset($_GET["dl"]))$dl=$_GET["dl"];
		// else return "no file is selected";
		// if(isset($_GET["type"]))$type=$_GET["type"];
		// else return "no type is selected";
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

	$message=upload($db);
	
?>
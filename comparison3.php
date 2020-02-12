<?php

	include_once("config.php");
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$nextpage="comparison3.php";
	include("sessioncheck.php");
	include_once("header.php");
	$sql="SELECT id FROM user_info WHERE username = '$username' AND password= '$password'";
	$result = mysqli_query($db,$sql);
	$count = mysqli_num_rows($result);
	if($count==0)return "invalid session";
	$row=$result->fetch_assoc();
	$user_id=$row["id"];
	$sql="SELECT id,datetime FROM data WHERE user_id= '$user_id'";
	$result = mysqli_query($db,$sql); 
	$programs=mysqli_query($db,"SELECT * FROM program_info ORDER BY id");
	$did=$_GET['data_id'];
	$cluster_counts=mysqli_query($db,"SELECT SUM(count) AS count FROM cluster_size WHERE data_id=".$did." GROUP BY program_id ORDER BY program_id");
	$cluster_size_types=mysqli_query($db,"SELECT * FROM cluster_size_type");
?>
<div class="container">
<div class="row">
<div class="col-md-12">
	<div class="table-responsive text-center" style="max-height:495px ;margin-bottom:20px;">
		<h1>Comparison</h1>
		<table class="table table-striped table-hover table-bordered" >
			<thead>
				<tr class="success">
					<th></th>
					<?php foreach($programs as $program) { ?>
					<th><?php echo $program["name"]?></th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>Cluster Count</th>
					<?php foreach($cluster_counts as $cluster_count) { ?>
					<td><?php echo $cluster_count["count"];?></td>
					<?php } ?>
				</tr>
				<?php
					foreach($cluster_size_types as $cluster_size_type){
						$cluster_sizes=mysqli_query($db,"SELECT * FROM cluster_size WHERE data_id=".$did." AND cluster_size_type_id=".$cluster_size_type["id"]);
				?>
				<tr>
					<th><?php echo $cluster_size_type["min"]."-".$cluster_size_type["max"]?></th>
				<?php
					foreach($cluster_sizes as $cluster_size){
				?>
					<td><?php echo $cluster_size["count"]?></td>
				<?php
					}
				?>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div></div></div>
<?php include_once("footer.php"); ?>
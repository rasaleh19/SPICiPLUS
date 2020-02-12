<?php
	include_once("config.php");
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if(isset($_GET["data_id"]) && isset($_GET["program_id"])){
		$result=mysqli_query($db,"SELECT SUM(count) AS count FROM cluster_size WHERE data_id=".$_GET["data_id"]." AND program_id=".$_GET["program_id"]);
		$row=mysqli_fetch_assoc($result);
		$cluster_count=$row["count"];
		$sql="SELECT count FROM cluster_size WHERE data_id=".$_GET["data_id"]." AND program_id=".$_GET["program_id"]." ORDER BY cluster_size_type_id";
		$cluster_sizes=mysqli_query($db,$sql);
		$cluster_size_types=mysqli_query($db,"SELECT * FROM cluster_size_type");
		$sql="SELECT edges,vertices FROM data WHERE id=".$_GET["data_id"];
		$result=mysqli_query($db,$sql);
		$row=mysqli_fetch_assoc($result);
		$edges=$row["edges"];
		$vertices=$row["vertices"];
	}
	else{
		return;
	}
?>

<div class="table-responsive text-center">
<table class="table table-striped table-hover table-bordered">
	<thead>
		<tr class="success">
			<th>Edges</th>
			<th>vertices</th>
			<th>Cluster Count</th>
		<?php foreach($cluster_size_types as $cluster_size_type){?>
			<th><?php echo $cluster_size_type["min"]."-".$cluster_size_type["max"];?></th>
		<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $edges;?></td>
			<td><?php echo $vertices;?></td>
			<td><?php echo $cluster_count;?></td>
		<?php foreach($cluster_sizes as $cluster_size){?>
			<td><?php echo $cluster_size["count"];?></td>
		<?php } ?>
		</tr>
	<tbody>
</table>
</div>
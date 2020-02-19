<div class="container">
<div class="row">


<div class="col-md-12" id="upload-history">

  	<h2>Upload history</h2>

  	<div class="table-responsive text-center" style="max-height:495px ;margin-bottom:20px;">

	<table class="table table-striped table-hover table-bordered" >
	<thead>
	<tr class="success">
	
	<th rowspan="2" style="text-align:center;padding-bottom:30px;">Upload time</th>
	<th rowspan="2" style="text-align:center;padding-bottom:30px;">Input Graph</th>
	<th rowspan="2" style="text-align:center;padding-bottom:30px;">Clustering Algorithm</th>
	<th rowspan="2" style="text-align:center;padding-bottom:30px;">Clustered Graph</th>
	<th rowspan="2" style="text-align:center;padding-bottom:30px;">Alchemy</th>
	<th rowspan="2" style="text-align:center;padding-bottom:30px;">Vis</th>
	<!-- <th colspan="3">program 2</th>
	<th colspan="3">program 3</th> -->
	</tr>

	<tr class="success">

<?php	

	
	echo '</tr></thead><tbody>';

	while($row=$result->fetch_assoc()){
		echo '<tr>';
		echo '<td>'.$row["datetime"].'</td>';
		$programs=mysqli_query($db,"SELECT * FROM program_info WHERE id=".$row["program_id"]);
		echo '<td><a href=download.php?dl='.$row["id"].'&type=in>Download</a></td>';
		foreach($programs as $program){
			echo '<td>'.$program["name"].'</td>';
			echo '<td><a href=download.php?dl='.$row["id"].'&type='.$program["id"].'>Download</a></td>';
			echo '<td ><a href=alchemyview.php?c_input_id='.$row["id"].'&type='.$program["id"].'>View</a></td>';
			echo '<td><a href=visview.php?c_input_id='.$row["id"].'&type='.$program["id"].'>View</a></td>';
			//break;
		}
		echo '</tr>';
	}
?>
	</tbody>
	</table>
	</div>

</div></div></div>
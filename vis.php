<?php
	include_once("config.php");
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$nextpage="vis.php";
	include("sessioncheck.php");
	include_once("header.php");
?>

<div class="container">

	<div class="row vis-page-first-row">	


		<div class="col-md-4 col-md-offset-2">
			<img class="img-responsive" src="images/vis2.jpg">
		</div>

		<div class="col-md-4">
			<div class="vis-caption">
				<p><h2>Vis</h2> Vis was built so that developers could easily get up and running with graph visualization applications, without much over head. Minimal code is actually required to generate Alchemy.js graphs with most projects. </p>
			</div>
		</div>

	</div>

	<div class="row vis-page-second-row">

		<div class="col-md-8 col-md-offset-2">

			<?php include_once("uploadform.php"); ?>

		</div> <!-- col-md-8 col-md-offset-2-->

	</div>

</div>



<?php include_once("footer.php"); ?>
<?php
	include_once("config.php");
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$nextpage="comparison.php";
	include("sessioncheck.php");
	include_once("header.php");
?>

<br>
<br>

<div class="container">

	<div class="row">	

		<div class="col-md-6">

			

			<div class="text-center">
				<p><h2>Alchemy.js</h2>Alchemy was built so that developers could easily get up and running with graph visualization applications, without much over head. Minimal code is actually required to generate Alchemy.js graphs with most projects. Most customization customization of the application takes place by overriding default configurations, Most customization of the application takes place by overriding default configurations, rather than direct implementation via JavaScript.</p>
			</div>

		</div>

		<div class="col-md-6">

			

			<div class="text-center">
				<p><h2>Vis.js</h2>Vis.js was built so that developers could easily get up and running with graph visualization applications, without much over head. Minimal code is actually required to generate Alchemy.js graphs with most projects. Most customization of the application takes place by overriding default configurations,js graphs with most projects. Most customization of the application takes place by overriding default configurations, rather than direct implementation via JavaScript.</p>
		  	</div>
		</div>

	</div>

</div> <!-- container -->

<br>
<br>
<br>
<br>


<?php include_once("footer.php"); ?>

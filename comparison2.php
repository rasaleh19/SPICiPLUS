<?php
	include_once("config.php");
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$nextpage="comparison2.php";
	include("sessioncheck.php");
	include_once("header.php");
?>
<div class="container">

	<div class="row alchemy-page-second-row">

		<div class="col-md-8 col-md-offset-2">

			<?php include_once("compareform.php"); ?>
			
		</div>


	</div>

</div>
<?php include_once("footer.php"); ?>
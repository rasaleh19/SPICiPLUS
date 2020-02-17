<?php
	include_once("config.php");
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
?>
<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SPICiPLUS</title>

		<!-- All css files -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/alchemy.min.css" rel="stylesheet"/>
		<link href="css/vis.min.css" rel="stylesheet" type="text/css"/>
		<link href="css/1.css" rel="stylesheet" type="text/css">
		<link href="style.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.16/d3.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.11.2/lodash.min.js"></script>

		<script src="js/alchemy.min.js"></script>
		<script src="js/vis.min.js" type="text/javascript"></script>
		
		<script src="js/visdata.js"></script>
		<script src="js/visdraw.js"></script>
		
		<script src="js/1.js" type="text/javascript"></script>			
		
	</head>
	<body>

		<header>
			<div class="container">
			  <div class="row">
			    <div class="col-md-12 top-bar">
			    	<ul class="nav navbar-nav">
						<?php if(isset($_SESSION['username']) && isset($_SESSION['password'])){ 
						/*if(isset($_GET['c_input_id']) && isset($_GET['type'])){ $cid=$_GET['c_input_id'];$type=$_GET['type'];
						echo '<li><a href="alchemyview.php?c_input_id=$cid&type=$type">Alchemy View</a></li>';
						echo '<li><a href="visview.php?c_input_id=$cid&type=$type">Vis View</a></li>'; }*/
						echo '<li><a href="signout.php">Log Out</a></li>';
						echo "<li><a>";
						echo $_SESSION["username"];
						echo " &nbsp;| </a></li>";
						}else{ ?>
						<li><a href="signupform.php">Register</a></li>
						<li><a href="signinform.php">Login &nbsp;| </a></li>
						<?php } ?>
					</ul>
			    </div>
			  </div>
			  </div>
			</div>
			<div class="container">
			  <div class="row">
			    <div class="col-md-4 header">
			    	<a href="index.php"><img src="images/logo.png"></a>
			    </div>
			  </div>
			    <div class="col-md-8">

			    </div>
			  </div>
			</div>
		</header>

		<nav class="navbar navbar-default navbar-static">
		   <div class="container">
			<div class="row">
		      <!-- Brand and toggle get grouped for better mobile display -->
		      <div class="navbar-header">
		        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		          <span class="sr-only">Toggle navigation</span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </button>
		        <a class="navbar-brand visible-xs" href="#">Title</a>
		      </div>

		      <!-- Collect the nav links, forms, and other content for toggling -->
		      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

		        <ul class="nav navbar-nav">
					<li><a href="index.php">Home</a></li>
					<li><a href="visualisation.php">Visualisation</a></li>
					<!--li><a href="vis.php">Vis</a></li-->
					<!--li><a href="comparison.php">Alchemy Vs Vis</a></li-->
					<li><a href="comparison2.php">Comparison</a></li>
					<li><a href="uploadhistory.php">Upload History</a></li>
					<li><a href="help.php">Help</a></li>
		        </ul>

		      </div><!-- /.navbar-collapse -->
			  
			</div><!-- /.row -->
		   </div><!-- /.container-fluid -->
		</nav>


	 

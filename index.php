<?php include_once("header.php"); ?>

<!-- ==============  start slider  ========== -->
		
<div class="home-slider">

		<div id="myCarousel" class="carousel slide" data-ride="carousel">

		 <!-- Wrapper for slides -->
		 <div class="carousel-inner" role="listbox">
		  
			<div class="item active">   

				<img class="img-responsive" src="images/slider-1.jpg">
			    <div class="carousel-caption">
					<h3>Vis</h3>
					<p>Vis offers exquisite graphical interface</p>
			    </div>

			</div>

			<div class="item">   

				<img class="img-responsive" src="images/slider-2.jpg">
			    <div class="carousel-caption">
					<h3>Alchemy</h3>
					<p>Alchemy offers exquisite graphical interface</p>
			    </div>

			</div>

			
		 </div><!-- carousel-inner -->

			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
			</ol>

			<!-- Left and right controls -->
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left slider-left-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right slider-right-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a> 
		  
		</div><!-- .carousel -->
</div><!-- home-slider -->


<!-- ========================  end slider =======================   -->


<?php include_once("content.php"); ?>

<?php include_once("footer.php"); ?>

<?php
session_start();
if(isset($_GET['action']))
{
    if($_GET['action']=='log_out')
    {
        unset($_SESSION['username']);
    }
}
require_once("includes/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>MerryGoRound! Begin your journey</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="assets/css/imports.css" media="screen">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
		<link rel="stylesheet" href="assets/css/owl-carousel.css" media="screen">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="home">

		<div id="top"></div>

		<!-- Navigation (main menu)
		================================================== -->
		<?php include("includes/navigation.php"); ?>

		<!-- Hero Section
		================================================== -->
		<section class="hero hero-overlap" style="background-image: url('assets/images/hero-1.jpg');">
			<div class="bg-overlay">
				<div class="container">
					<div class="intro-wrap">
						<h1 class="intro-title">Where the Journey Begins</h1>
						<div class="intro-text"> Discover your next great adventure, <a href="signup.php">become an explorer</a> to get started!</div>
					</div>
				</div>
			</div>
		</section>


		<!-- Featured Destinations
		================================================== -->
		<section class="featured-destinations">
			<div class="container">
				<div class="cards overlap">

					<!-- Section Title -->
					<div class="title-row">
						<h3 class="title-entry">Featured Destinations</h3>
						<a href="destinations-list.php" class="btn btn-primary btn-xs">Find More &nbsp; <i class="fa fa-angle-right"></i></a>
					</div>

					<!-- Cards Row -->
					<div class="row">
                        <?php
                        $query="select city.city_id,city.city_name,city.pic_url,city.state_id,state.state_name from city inner join state where city.state_id=state.state_id ORDER BY RAND() LIMIT 4"; //query for sql
                        $result=mysqli_query($db,$query);
       
                        if(!$result){
                        die("Database query failed");}
                        
                        while($row=mysqli_fetch_assoc($result)){
                            echo'<div class="col-md-3 col-sm-6 col-xs-12">
							<article class="card">
								<a href="destination-sub-page.php?city_id='.$row['city_id'].'" class="featured-image" style="background-image: url(\'assets/images/'.$row['pic_url'].'\')">
									<div class="featured-img-inner"></div>
								</a>
								<div class="card-details">
									<h4 class="card-title"><a href="destination-sub-page.php?city_id='.$row['city_id'].'">'.$row['city_name'].'</a></h4>
									<div class="meta-details clearfix">
										<ul class="hierarchy">
											<li class="symbol"><i class="fa fa-map-marker"></i></li>
											<li><a href="destination-parent.php?state_id='.$row['state_id'].'">'.$row['state_name'].'</a></li>
										</ul>
									</div>
								</div>
							</article>
						</div>';}
                        ?>


					</div> <!-- /.row -->
				</div>
			</div>
		</section>


		<!-- Home Page Search Section
		================================================== -->
		<!--<section class="regular">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-4">
						<figure style="text-align:center">
							<img src="assets/images/newlogo.png" alt="MerryGo!" width="200" height="200">
						</figure>
					</div>
					<div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-0">

						<div class="col-md-12 col-lg-10 col-lg-offset-1">
							<h3 style="text-align: center;">Be more than just another traveler when you go around with <em>MerryGoRound!</em></h3>
						</div>
						<div class="col-sm-12">
							<form class="big-search">
								<input type="text" placeholder="Find Your Next Destination...">
								<button type="submit"><span class="glyphicon glyphicon-search"></span></button>
							</form>
						</div>

					</div>
				</div> <!-- /.row -->
			<!--</div> <!-- /.container -->
		<!--</section> -->


		<!-- Home Page Accordion Section
		================================================== -->
		<section class="regular background">
			<div class="container">
				<div class="row">

					<h3 class="hidden">Destination Categories</h3>

					<div class="col-md-6 col-lg-4">
						<article class="card accordion-card">
							<header>
								<h3 class="section-title">Adventure Seekers</h3>
								<p>With endless hiking trails, these destinations will satisfy the wildest explorers!</p>
							</header>
							<div class="accordion-panel">
								<div class="panel-group" id="accordion-1" role="tablist" aria-multiselectable="true">
									<!-- Guide Panel -->
									<div class="panel panel-default" style="background-image: url('assets/images/delhi2.jpg');">
										<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
											<div class="panel-body">
												<div class="read-more">Find more <i class="fa fa-arrow-right"></i></div>
												<a href="destinations-list.php"><div class="spacer"></div></a>
											</div>
										</div>
										<a data-toggle="collapse" data-parent="#accordion-1" href="index.php#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											<div class="panel-heading" role="tab" id="headingOne">
												<div class="panel-icon">
													<i class="fa fa-map-marker"></i>
												</div>
												<h4 class="panel-title">New Delhi, Delhi</h4>
												<ul class="hierarchy">
													<li>India</li>
												</ul>
											</div>
										</a>
									</div>
									<!-- Guide Panel -->
									<div class="panel panel-default" style="background-image: url('assets/images/mumbai2.jpg');">
										<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
											<div class="panel-body">
												<div class="read-more">Find more <i class="fa fa-arrow-right"></i></div>
												<a href="destinations-list.php"><div class="spacer"></div></a>
											</div>
										</div>
										<a data-toggle="collapse" data-parent="#accordion-1" href="index.php#collapseThree" aria-expanded="true" aria-controls="collapseThree">
											<div class="panel-heading" role="tab" id="headingThree">
												<div class="panel-icon">
													<i class="fa fa-map-marker"></i>
												</div>
												<h4 class="panel-title">Mumbai, Maharashtra</h4>
												<ul class="hierarchy">
													<li>India</li>
												</ul>
											</div>
										</a>
									</div>
									<!-- Guide Panel -->
									<div class="panel panel-default" style="background-image: url('assets/images/kolkata2.jpg');">
										<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
											<div class="panel-body">
												<div class="read-more">Find more <i class="fa fa-arrow-right"></i></div>
												<a href="destinations-list.php"><div class="spacer"></div></a>
											</div>
										</div>
										<a data-toggle="collapse" data-parent="#accordion-1" href="index.php#collapseFour" aria-expanded="true" aria-controls="collapseFour">
											<div class="panel-heading" role="tab" id="headingFour">
												<div class="panel-icon">
													<i class="fa fa-map-marker"></i>
												</div>
												<h4 class="panel-title">Kolkata, West Bengal</h4>
												<ul class="hierarchy">
													<li>India</li>
												</ul>
											</div>
										</a>
									</div>
								</div>
							</div>
							<footer><a href="destinations.php">Find More &nbsp; <i class="fa fa-arrow-right"></i></a></footer>
						</article> <!-- /.accordion-card -->
					</div>

					<div class="col-md-6 col-lg-4">
						<article class="card accordion-card">
							<header>
								<h3 class="section-title">Monuments</h3>
								<p>Monuments are for the living, not the dead. Life's a monument!</p>
							</header>
							<div class="accordion-panel">
								<div class="panel-group" id="accordion-2" role="tablist" aria-multiselectable="true">
									<!-- Guide Panel -->
									<div class="panel panel-default" style="background-image: url('assets/images/mumbai3.jpg');">
										<div id="collapseOne-2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
											<div class="panel-body">
												<div class="read-more">Find more <i class="fa fa-arrow-right"></i></div>
												<a href="destinations-list.php"><div class="spacer"></div></a>
											</div>
										</div>
										<a data-toggle="collapse" data-parent="#accordion-2" href="index.php#collapseOne-2" aria-expanded="true" aria-controls="collapseOne-2">
											<div class="panel-heading" role="tab" id="headingOne-2">
												<div class="panel-icon">
													<i class="fa fa-map-marker"></i>
												</div>
												<h4 class="panel-title">Mumbai, Maharashtra</h4>
												<ul class="hierarchy">
													<li>India</li>
												</ul>
											</div>
										</a>
									</div>
									<!-- Guide Panel -->
									<div class="panel panel-default" style="background-image: url('assets/images/delhi3.jpg');">
										<div id="collapseTwo-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo-2">
											<div class="panel-body">
												<div class="read-more">Find more <i class="fa fa-arrow-right"></i></div>
												<a href="destinations-list.php"><div class="spacer"></div></a>
											</div>
										</div>
										<a data-toggle="collapse" data-parent="#accordion-2" href="index.php#collapseTwo-2" aria-expanded="true" aria-controls="collapseTwo-2">
											<div class="panel-heading" role="tab" id="headingTwo-2">
												<div class="panel-icon">
													<i class="fa fa-map-marker"></i>
												</div>
												<h4 class="panel-title">New Delhi, Delhi</h4>
												<ul class="hierarchy">
													<li>India</li>
												</ul>
											</div>
										</a>
									</div>
									<!-- Guide Panel -->
									<div class="panel panel-default" style="background-image: url('assets/images/hyderabad1.jpg');">
										<div id="collapseThree-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
											<div class="panel-body">
												<div class="read-more">Find more <i class="fa fa-arrow-right"></i></div>
												<a href="destinations-list.php"><div class="spacer"></div></a>
											</div>
										</div>
										<a data-toggle="collapse" data-parent="#accordion-2" href="index.php#collapseThree-2" aria-expanded="true" aria-controls="collapseThree-2">
											<div class="panel-heading" role="tab" id="headingThree-2">
												<div class="panel-icon">
													<i class="fa fa-map-marker"></i>
												</div>
												<h4 class="panel-title">Hyderabad, Telangana</h4>
												<ul class="hierarchy">
													<li>India</li>
												</ul>
											</div>
										</a>
									</div>
								</div>
							</div>
							<footer><a href="destinations.php">Find More &nbsp; <i class="fa fa-arrow-right"></i></a></footer>
						</article> <!-- /.accordion-card -->
					</div>

					<div class="col-md-12 col-lg-4">
						<article class="card accordion-card">
							<header>
								<h3 class="section-title">Nature and Parks</h3>
								<p>Love nature to find beauty everywhere.A journey to explore yourself</p>
							</header>
							<div class="accordion-panel">
								<div class="panel-group" id="accordion-3" role="tablist" aria-multiselectable="true">
									<!-- Guide Panel -->
									<div class="panel panel-default" style="background-image: url('assets/images/kolkata3.jpg');">
										<div id="collapseOne-3" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
											<div class="panel-body">
												<div class="read-more">Find more <i class="fa fa-arrow-right"></i></div>
												<a href="destinations-list.php"><div class="spacer"></div></a>
											</div>
										</div>
										<a data-toggle="collapse" data-parent="#accordion-3" href="index.php#collapseOne-3" aria-expanded="true" aria-controls="collapseOne-3">
											<div class="panel-heading" role="tab" id="headingOne-3">
												<div class="panel-icon">
													<i class="fa fa-map-marker"></i>
												</div>
												<h4 class="panel-title">Kolkata, West Bengal</h4>
												<ul class="hierarchy">
													<li>India</li>
												</ul>
											</div>
										</a>
									</div>
									<!-- Guide Panel -->
									<div class="panel panel-default" style="background-image: url('assets/images/delhi4.jpg');">
										<div id="collapseThree-3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
											<div class="panel-body">
												<div class="read-more">Find more <i class="fa fa-arrow-right"></i></div>
												<a href="destinations-list.php"><div class="spacer"></div></a>
											</div>
										</div>
										<a data-toggle="collapse" data-parent="#accordion-3" href="index.php#collapseThree-3" aria-expanded="true" aria-controls="collapseThree-3">
											<div class="panel-heading" role="tab" id="headingThree-3">
												<div class="panel-icon">
													<i class="fa fa-map-marker"></i>
												</div>
												<h4 class="panel-title">New Delhi, Delhi</h4>
												<ul class="hierarchy">
													<li>India</li>
												</ul>
											</div>
										</a>
									</div>
									<!-- Guide Panel -->
									<div class="panel panel-default" style="background-image: url('assets/images/mumbai3.jpg');">
										<div id="collapseFour-3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
											<div class="panel-body">
												<div class="read-more">Find more <i class="fa fa-arrow-right"></i></div>
												<a href="destinations-list.php"><div class="spacer"></div></a>
											</div>
										</div>
										<a data-toggle="collapse" data-parent="#accordion-3" href="index.php#collapseFour-3" aria-expanded="true" aria-controls="collapseFour-3">
											<div class="panel-heading" role="tab" id="headingFour-3">
												<div class="panel-icon">
													<i class="fa fa-map-marker"></i>
												</div>
												<h4 class="panel-title">Mumbai, Maharashtra</h4>
												<ul class="hierarchy">
													<li>India</li>
												</ul>
											</div>
										</a>
									</div>
								</div>
							</div>
							<footer><a href="destinations.php">Find More &nbsp; <i class="fa fa-arrow-right"></i></a></footer>
						</article> <!-- /.accordion-card -->
					</div>

		        </div>
		    </div>
		</section>


		<!-- Full Width Carousel
		================================================== -->

		<section class="featured-slider">

			<h3 class="hidden">Highlights</h3>

			<div class="featured-carousel">
				<div class="item">
					<div class="bg-img" style="background-image: url('assets/images/delhi.jpg')"></div>
					<div class="color-hue"></div>
					<div class="container">
						<div class="row">
							<div class="col-sm-12 col-md-6 col-md-offset-6">
								<article>
									<h3>New Delhi, Delhi</h3>
									<p class="lead">New Delhi or 'Dilli' is home to several world heritage sites....</p>
									<a href="destination-sub-page.php?city_id=1" class="btn btn-primary">Read More &nbsp; <i class="fa fa-angle-right"></i></a>
								</article>
							</div>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="bg-img" style="background-image: url('assets/images/mumbai.jpg')"></div>
					<div class="color-hue"></div>
					<div class="container">
						<div class="row">
							<div class="col-sm-12 col-md-6 col-md-offset-6">
								<article>
									<h3>Mumbai, Maharashtra</h3>
									<p class="lead">Mumbai,the home of Indian cinema...</p>
									<a href="destination-sub-page.php?city_id=2" class="btn btn-primary">Read More &nbsp; <i class="fa fa-angle-right"></i></a>
								</article>
							</div>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="bg-img" style="background-image: url('assets/images/hyderabad.jpg')"></div>
					<div class="color-hue"></div>
					<div class="container">
						<div class="row">
							<div class="col-sm-12 col-md-6 col-md-offset-6">
								<article>
									<h3>Hyderabad, Telangana</h3>
									<p class="lead">Explore the most livable city of India...</p>
									<a href="destination-sub-page.php?city_id=4" class="btn btn-primary">Read More &nbsp; <i class="fa fa-angle-right"></i></a>
								</article>
							</div>
						</div>
					</div>
				</div>

				<div class="item">
					<div class="bg-img" style="background-image: url('assets/images/kolkata.jpg')"></div>
					<div class="color-hue"></div>
					<div class="container">
						<div class="row">
							<div class="col-sm-12 col-md-6 col-md-offset-6">
								<article>
									<h3>Kolkata, West Bengal</h3>
									<p class="lead">Located in eastern India, between the Himalayas and the Bay of Bengal. Known to be the home of Bengal Tiger...</p>
									<a href="destination-sub-page.php?city_id=3" class="btn btn-primary">Read More &nbsp; <i class="fa fa-angle-right"></i></a>
								</article>
							</div>
						</div>
					</div>
				</div>

			</div>
		</section>


		<!-- Blog Posts
		================================================== -->

		<section class="regular blog-posts">
			<div class="container">

				<!-- Section Title -->
				<div class="title-row">
					<h3 class="title-entry">Stories</h3>
					<a href="stories.php" class="btn btn-primary btn-xs">Find More &nbsp; <i class="fa fa-angle-right"></i></a>
				</div>

				<div class="row">

					 <?php
                        $query="select * from story"; //query for sql
                        $stories=mysqli_query($db,$query);
                        while($story=mysqli_fetch_assoc($stories)){
						echo'<div class="col-lg-3 col-md-4 col-sm-6">
							<article class="postg-living tag-memories tag-planning tag-route tag-tips tag-trip">
								<div class="card">
									<header class="entry-header">
										<a href="story.php?story_id='.$story['story_id'].'" rel="bookmark">
											<div class="entry-thumbnail" style="background-image: url(\'assets/images/'.$story['story_pic'].'\'")"> <img width="600" height="800" title="" alt="" src="assets/images/blog-placeholder-vertical.png"></div>
											<h2 class="entry-title">'.$story['story_title'].'</h2>
										</a>
									</header>
									<footer class="entry-meta clearfix"> <span class="byline"><i class="fa fa-user"></i> <span class="author vcard"><a href="author.html" title="Posts by '.$story['username'].'" rel="author">'.$story['username'].'</a></span></span> <span class="posted-on">'.$story['date'].'</span> </footer>
								</div>
							</article>
						</div>';}
                        ?>
				</div>
			</div>
		</section>


		<!-- Footer
		================================================== -->
		<?php include("includes/footer.php"); ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/owl.carousel.min.js"></script>
		<script src="assets/js/custom.js"></script>
	</body>
</html>
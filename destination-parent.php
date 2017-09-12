<?php
session_start();
function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;}

if(isset($_GET['state_id']))
{
    $_SESSION['state_id']=$_GET['state_id'];}
else{
    if(!isset($_SESSION['state_id']))
    {redirect_to("index.php");}
}

    if(!isset($_SESSION['username']))
{redirect_to("login.php?action=login&continueTo=".htmlspecialchars($_SERVER['PHP_SELF'])."?state_id=".$_GET['state_id']);}
 


require_once("includes/connection.php");

$query="select * from state where state_id='{$_SESSION['state_id']}'"; //query for sql
        $result=mysqli_query($db,$query);
$query_1="select city_id,city_name,pic_url from city where state_id='{$_SESSION['state_id']}'ORDER BY RAND() LIMIT 2"; //query for sql
        $result_1=mysqli_query($db,$query_1);
       
        if(!$result&&!result_1){
    die("Database query failed");}
else
{$row=mysqli_fetch_assoc($result);
 }
?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Destination</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="assets/css/imports.css" media="screen">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="destination destination-home">

		<div id="top"></div>

		<!-- Navigation (main menu)
		================================================== -->
		<?php include("includes/navigation.php"); ?>

		<!-- Hero Section
		================================================== -->
		<section class="hero destination-header" style="background-image: url('assets/images/<?=$row['pic_url']?>');">
			<div class="bg-overlay">
				<div class="container">
					<div class="intro-wrap">
						<h1 class="intro-title"><?=$row['state_name'];?></h1>
						<!-- <div class="intro-text">
							<p>And more text below if you need it...</p>
						</div> -->
						<ul class="breadcrumbs">
							<!-- <li class="no-arrow"><a href="#" class="destination-context-menu"><i class="fa fa-ellipsis-v"></i><a></li> -->
							<li class="no-arrow"><i class="icon fa fa-map-marker"></i></li>
							<li><a href=""><?=$row['state_name'];?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</section>


		<!-- Sub Navigation
		================================================== -->
		<div class="sub-nav">
			<div class="navbar navbar-inverse affix-top" id="SubMenu" style="top: 74px;">
				<div class="container">
					<div class="navbar-header">
						<a href="javascript:void(0)" class="navbar-brand scrollTop"><i class="fa fa-fw fa-map-marker"></i> <?=$row['state_name'];?></a>
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-sub">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<!-- Sub Nav Links -->
					<nav class="navbar-collapse collapse" id="navbar-sub">
						<ul class="nav navbar-nav navbar-left">
							<li><a href="destinations-list.php?state_id=<?=$row['state_id'];?>">Places</a></li>                           <!--refer -->
							<li><a href="">Booking</a></li>                           <!--refer -->
						</ul>
						<!--<ul class="nav navbar-nav navbar-right">
							<li><a href="destination-parent.html#"><i class="fa fa-fw fa-heart-o"></i></a></li>
							<li class="dropdown show-on-hover">
								<a href="destination-parent.html#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-share-alt"></i></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="https://facebook.com/"><i class="fa fa-fw fa-facebook-official"></i> Facebook</a></li>
									<li><a href="https://twitter.com/"><i class="fa fa-fw fa-twitter"></i> Twitter</a></li>
									<li><a href="https://plus.google.com/"><i class="fa fa-fw fa-google-plus"></i> Google +</a></li>
									<li><a href="https://instagram.com/"><i class="fa fa-fw fa-instagram"></i> Instagram</a></li>
								</ul>
							</li>
							<li><a href="destination-parent.php#" data-toggle="tooltip" title="Download in PDF format."><i class="fa fa-fw fa-file-pdf-o"></i></a></li>
							<li><a href="destination-parent.php#" data-toggle="tooltip" title="Print and take with you!"><i class="fa fa-fw fa-print"></i></a></li>
						</ul>-->
					</nav>
				</div>
			</div>
		</div>


		<!-- Main Section
		================================================== -->

		<section class="main">
			<div class="container">

				<h3 class="hidden">Destination</h3>

				<div class="row">
					<div class="col-sm-12 col-fixed-content">
						<div class="intro">
							<!--p class="lead">North America consists of three large nations and one large island territory: Canada, United States of America, Mexico and Greenland.</p>-->
							<div class="entry-content">
								<p><?php echo $row['state_desc'] ?> </p>
							</div>
						</div>
						<section class="narrow places">
							<div class="title-row">
								<h3 class="title-entry">Popular Cities in <?=$row['state_name'];?> </h3> <a href="destinations-list.php?state_id=<?=$row['state_id'];?>" class="btn btn-primary btn-xs">Find More &nbsp; <i class="fa fa-angle-right"></i></a></div>
							
                            <?php 
                            while($row_1=mysqli_fetch_assoc($result_1))
                               { 
                                echo'<div class="col-sm-6">
									<article class="place-box card">
										<a href="destination-sub-page.php?city_id='.$row_1['city_id'].'" class="place-link">
											<header>
												<h3 class="entry-title"><i class="fa fa-map-marker"></i>
                                                    '.$row_1['city_name'].'</h3> </header>
											<div class="entry-thumbnail"> <img width="960" height="540" src="assets/images/'.$row_1['pic_url'].'" class="attachment-place wp-post-image" alt=""></div>
										</a>
									</article>
								</div>';} ?>
                                
                                
                                
							
						</section>
                        
                        
                        <section class="narrow places">
							<div class="title-row">
                                <br><br><br><br>
								<h3 class="title-entry">Booking</h3> <a href="" class="btn btn-primary btn-xs">Find More &nbsp; <i class="fa fa-angle-right"></i></a></div>
						</section>
                        
                        
					</div>
					<div class="col-sm-12 col-fixed-sidebar">
						<div class="sidebar-padder">
							<aside id="text-2" class="widget widget_text">
								<div class="textwidget"><img src="assets/images/sidebar-ad.jpg" width="300" height="600" alt="my travel agency" title="Find out where you belong."></div>
							</aside>
							<aside class="widget widget_nav_menu">
								<h3 class="widget-title">Top Destinations</h3>
								<div class="menu-top-destinations-container">
									<ul id="menu-top-destinations" class="menu">
										<li class="menu-item">
											<a href="destination-parent.php?state_id=1">New Delhi, Delhi</a>
										</li>
										<li class="menu-item">
											<a href="destination-parent.php?state_id=3">Mumbai, Maharashtra</a>
										</li>
										<li class="menu-item">
											<a href="destination-parent.php?state_id=2">Kolkata, West Bengal</a>
										</li>
										<li class="menu-item">
											<a href="destination-parent.php?state_id=4">Hyderabad, Telangana</a>
										</li>
									</ul>
								</div>
							</aside>
						</div>
					</div>
				</div>
			</div>
		</section>


		
            <?php
mysqli_close($db);
?>

<!-- Footer
		================================================== -->
		<?php include("includes/footer.php"); ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/custom.js"></script>
	</body>
</html>
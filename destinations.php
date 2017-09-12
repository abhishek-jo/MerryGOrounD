<?php
session_start();
function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;}
if(!isset($_SESSION['username']))
{redirect_to("login.php?action=login&continueTo=".htmlspecialchars($_SERVER['PHP_SELF']));}
 
require_once("includes/connection.php");

$query="select * from state"; //query for sql
        $result=mysqli_query($db,$query);
       
        if(!$result){
    die("Database query failed");}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Places|MerryGoRound</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="assets/css/imports.css" media="screen">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="destination destinations-list">

		<div id="top"></div>
        <!-- Navigation (main menu)
		================================================== -->
		<?php include("includes/navigation.php"); ?>
        
		<!-- Hero Section
		================================================== -->
		<section class="hero small-hero" style="background-image:url('assets/images/hero-1.jpg');">
			<div class="bg-overlay">
				<div class="container" style="">
					<div class="intro-wrap">
						<h1 class="intro-title">Destinations</h1>
					</div>
				</div>
			</div>
		</section>


		<!-- Main Section
		================================================== -->
		<section class="main container">
			<div class="places">

				<h3 class="hidden">Places</h3>
                <div class="row">
					
                <?php
                while($row=mysqli_fetch_assoc($result)){
				echo '<div class="col-sm-4">
						<article class="place-box card">
							<a href="destination-parent.php?state_id='.$row['state_id'].'" class="place-link">
								<header>
									<h3 class="entry-title"><i class="fa fa-map-marker"></i>'.$row['state_name'].'</h3> </header>
								<div class="entry-thumbnail"> <img width="960" height="540" alt="" title="" src="assets/images/'.$row['pic_url'].'"></div>
							</a>
						</article>
					</div>';
                             } ?>
                    <?php
                    mysqli_close($db);
                    ?>
										
				</div>
			</div>
		</section>



		<!-- Footer
		================================================== -->
		<?php include("includes/footer.php"); ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/custom.js"></script>
	</body>
</html>
<?php
session_start();
function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;}
require_once("includes/connection.php");
if(!isset($_SESSION['username']))
{redirect_to("login.php?action=login");}

if(isset($_GET['state_id']))
{
    $_SESSION['state_id']=$_GET['state_id'];
}
else
{
    $_SESSION['state_id']='*';
}



$query="select state.state_id,state.state_name,city.city_id,city.city_name,city.pic_url from state inner join city on state.state_id=city.state_id";

if($_SESSION['state_id']!='*')
{$query.=" where state.state_id={$_SESSION['state_id']}"; }

$result=mysqli_query($db,$query);
       
        if(!$result){
    die("Database query failed");}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Destination | MerryGoRound</title>
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
                        <h1 class="intro-title">
                            <?php if($_SESSION['state_id']=='*') {echo'Featured Cities
                            </h1>
						<div class="intro-text">
							<div class="taxonomy-description">
								<p>The most stunning and beautiful places in the world to take photos.</p>
							</div>
						</div>';} else{$find_state_query="select state_name,witty_comment from state where state_id={$_SESSION['state_id']}";$find_state_result=mysqli_query($db,$find_state_query); if(!$find_state_result){
    die("Database query failed");}$find_state=mysqli_fetch_assoc($find_state_result);echo' '.$find_state['state_name'].'</h1>
						<div class="intro-text">
							<div class="taxonomy-description">
								<p>'.$find_state['witty_comment'].'</p>
							</div>
						</div>';}?>
					</div>
				</div>
			</div>
		</section>


		<!-- Main Section
		================================================== -->
		<section class="main">
			<div class="container">

				<h3 class="hidden">Places</h3>

				<div class="places">

					<div class="row">
						 <?php
                while($row=mysqli_fetch_assoc($result)){
				echo '<div class="col-sm-4">
						<article class="place-box card">
							<a href="destination-sub-page.php?city_id='.$row['city_id'].'" class="place-link">
								<header>
									<h3 class="entry-title"><i class="fa fa-map-marker"></i>'.$row['city_name'].', '.$row['state_name'].'</h3> </header>
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
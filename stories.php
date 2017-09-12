<?php 
require_once("includes/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Blog | GoExplore! Travel Website Template</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="assets/css/imports.css" media="screen">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="blog">

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
						<h1 class="intro-title">Stories <?php if(isset($_GET['city_id'])){$city_id=mysqli_real_escape_string($db,$_GET['city_id']);
                        $findCityQuery="select city_name from city where city_id={$city_id}";
                            $findResult=mysqli_query($db,$findCityQuery);
                            if(!$findResult){die("Failure:database");}
                            $city=mysqli_fetch_assoc($findResult);
                            echo": ";echo $city['city_name']; } 
                            else{
                                if(isset($_GET['state_id'])){$state_id=mysqli_real_escape_string($db,$_GET['state_id']);
                        $findStateQuery="select state_name from state where state_id={$state_id}";
                            $findResult=mysqli_query($db,$findStateQuery);
                            if(!$findResult){die("Failure:database");}
                            $state=mysqli_fetch_assoc($findResult);
                            echo": ";echo $state['state_name']; } 
                            }
                            ?></h1>
					</div>
				</div>
			</div>
		</section>


		<!-- Blog Posts
		================================================== -->

		<section class="main container">

			<h2 class="text-center page-title hidden">News Articles &amp; Blogs</h2>
			<!-- <hr class="small"></hr> -->

			<div class="row blog-posts">
				<div id="content" class="col-lg-12">
					<div class="row">
                        <?php
                        $query="select * from story";
                        if(isset($_GET['city_id'])){
                            $query.=" where city_id={$_GET['city_id']}";
                        }else{
                            if(isset($_GET['state_id'])){
                            $query.=" where state_id={$_GET['state_id']}";
                        }
                        }
                            
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
<?php
session_start();
require_once("includes/connection.php");
$fail=true;
if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($db,$_POST['name']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $message=mysqli_real_escape_string($db,$_POST['message']);
    $query="INSERT INTO `contactus`(`name`, `email`, `message`) VALUES ('{$name}','{$email}','{$message}')";
    $result=mysqli_query($db,$query);
    if(!$result){
        die("connection Failed");
    }else{$fail=false;}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Contact | GoExplore! Travel Website Template</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="assets/css/imports.css" media="screen">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="contact" <?PHP if($fail==false){ echo"onLoad=\"$('#myModal').modal('show');\"";}?>>

		<div id="top"></div>

		<!-- Navigation (main menu)
		================================================== -->
		<?php include("includes/navigation.php"); ?>

		<!-- Hero Section
		================================================== -->

		<section class="hero large-hero" style="background-image:url('assets/images/hero-2.jpg');">
			<div class="bg-overlay">
				<div class="container">
					<div class="intro-wrap">
						<h1 class="intro-title hidden">Contact Us</h1>
					</div>
				</div>
			</div>
		</section>


		<!-- Main Section
		================================================== -->

		<section class="main container">
			<div class="row">

				<h3 class="hidden">Contact Details</h3>

				<div class="col-lg-8 col-lg-offset-2">
					<article id="post-333" class="post-333 page type-page status-publish has-post-thumbnail hentry">
						<div class="entry-content">
							<div style="text-align:center">
								<h2>Get in touch with us.</h2>
								<p class="lead">Looking for something or have destination suggestions?
									<br>Tell us about it!</p>
								<div class="row">
									<ul class="list-inline">
										<li><a href="https://www.facebook.com/" target="_blank" class="text-muted"><i class="fa fa-facebook fa-fw fa-2x"></i></a></li>
										<li><a href="https://plus.google.com/" target="_blank" class="text-muted"><i class="fa fa-google-plus fa-fw fa-2x"></i></a></li>
										<li><a href="https://twitter.com/" target="_blank" class="text-muted"><i class="fa fa-twitter fa-fw fa-2x"></i></a></li>
										<li><a href="https://instagram.com/" class="text-muted"><i class="fa fa-instagram fa-fw fa-2x"></i></a></li>
									</ul>
								</div>
								<hr class="small">
								<div style="width: 600px; text-align: left; margin: 0 auto;">
									<form enctype="multipart/form-data" method="post" action="#">
										<!--<p>Fields marked with an <span class="text-warning">*</span> are required</p>-->

										<div class="form-group">
											<input id="name_field" type="text" name="name" placeholder="Name *" class="form-control" value="" required>
											<!--<label for="name_field">Please enter your name.</label>-->
										</div>
										<div class="form-group">
											<input id="email_field" name="email" type="text" placeholder="Email *" class="form-control" value="" required>
											<!--<label for="email_field">Please enter your email address.</label>-->
										</div>
										<div class="form-group" >
											<textarea name="message" placeholder="Message *" id="comment_field" class="form-control" rows="3" required></textarea>
											<!--<label for="comment_field">Please enter your email address.</label>-->
										</div>

										<input type="submit" name="submit" class="display-block" style="margin: 0 auto;" value="Send Message">
									</form>
								</div>
							</div>
						</div>
					</article>
				</div>
			</div>
		</section>
        
        <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Thanks for Reaching out !</h4>
        </div>
           <img alt="Visiting place" class="size-large" height="100" style="float:right;margin-right:20px"  src="assets/images/newlogo.png" width="110">
        <div class="modal-body">
          <p>We got your message,<br>Keep going round and round with MerryGoRound</p>
        </div>
        <div class="modal-footer">
          <button type="button" onClick="document.location.href='index.php'"class="btn btn-default" data-dismiss="modal">Okay</button>
        </div>
      </div>
      
    </div>
  </div>


		<!-- Footer
		================================================== -->
		<?php include("includes/footer.php"); ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/custom.js"></script>
	</body>
</html>
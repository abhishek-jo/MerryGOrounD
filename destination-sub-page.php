<?php
session_start();
function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;}
if(isset($_GET['city_id']))
{
    $_SESSION['city_id']=$_GET['city_id'];}
else
{if(!isset($_SESSION['city_id']))
{
    redirect_to("index.php");
}}
    if(!isset($_SESSION['username']))
{redirect_to("login.php?action=login&continueTo=destination-sub-page.php?city_id={$_SESSION['username']}");}

require_once("includes/connection.php");

$failed=false;$available=false;$itId=null;$foundcity=null;
if(isset($_POST['submit'])) {
    $insertionDate=date('Y-m-d',strtotime($_POST['date']));
    $validationQuery="select * from itinerary where username='{$_SESSION['username']}'";
    $valResult=mysqli_query($db,$validationQuery);
    if(!$valResult){die("die noob die!");}
    while($check=mysqli_fetch_assoc($valResult)){
        if($check['itDate']==$insertionDate){
            $available=true;
            $itId=$check['it_id'];
            if($check['city_id']!=$_SESSION['city_id']){
                $failed=true;
                break;
            }
        }
    }
    if($failed==true)
    {
        $failquery="select city_id from itinerary where itDate='{$insertionDate}'LIMIT 1";
        $failresult=mysqli_query($db,$failquery);
        if(!$failresult){
            die("i'm sorry to say! you suck");
        }else{
            $fail=mysqli_fetch_assoc($failresult);
            $findCityQuery="select city_name,pic_url from city where city_id='{$fail['city_id']}'";
            $findCityResult=mysqli_query($db,$findCityQuery);
            if(!$findCityResult){
                die("i'm sorry to say! you suck");
            }else{
                $findcity=mysqli_fetch_assoc($findCityResult);
                $foundcity=$findcity['city_name'];
                $foundcity_pic=$findcity['pic_url'];
            }
        }
        
    }
    if($available==false){
$preItQuery="INSERT INTO `itinerary`(`username`, `city_id`, `itDate`) VALUES";
    $preItQuery.="('{$_SESSION['username']}','{$_SESSION['city_id']}','{$insertionDate}')";
   
$preItStatus=mysqli_query($db,$preItQuery);
    if(!$preItStatus)
    {die("preItQuery Failed");}
    else
    {$itId = mysqli_insert_id($db);}}
    
    if($failed==false){
    $it_insertionQuery="INSERT INTO `itinerary_content`(`attraction_id`, `it_id`, `con_start`, `con_end`) VALUES('{$_POST['att_id']}','{$itId}','{$_POST['start']}','{$_POST['end']}')";
    $itInsertionStatus=mysqli_query($db,$it_insertionQuery);
    if(!$itInsertionStatus)
    {die("Itenerary insertion failed");}
    else{redirect_to('destination-sub-page.php');}}
}

$cityQuery="SELECT city.city_id,city.city_name,city.description,city.pic_url,city.state_id,state.state_name FROM city INNER JOIN state WHERE city.state_id=state.state_id AND city_id='{$_SESSION['city_id']}'";
$city_details=mysqli_query($db,$cityQuery);
if(!$city_details)
{die("database query failed");}

$city=mysqli_fetch_assoc($city_details);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>MerryGoRound! Begin your journey</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/stylesheetsnip.css" media="screen">
		<link rel="stylesheet" href="assets/css/imports.css" media="screen">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
		<link rel="stylesheet" href="assets/css/owl-carousel.css" media="screen">
        
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesomenew.min.css">
        
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="home" <?PHP if($failed==true){ echo"onLoad=\"$('#myModalerror').modal('show');\"";}?> >
      

		<div id="top"></div>

		<!-- Navigation (main menu)
		================================================== -->
		<?php include("includes/navigation.php"); ?>

		<!-- Hero Section
				================================================== -->
		<section class="hero large-hero destination-header" style="background-image: url('assets/images/<?=$city['pic_url']?>');">
			<div class="bg-overlay">
				<div class="container">
					<div class="intro-wrap">
						<h1 class="intro-title"><?=$city['city_name']?></h1>
						<!-- <div class="intro-text">
									<p>And more text below if you need it...</p>
								</div> -->
						<ul class="breadcrumbs">
							<!-- <li class="no-arrow"><a href="#" class="destination-context-menu"><i class="fa fa-ellipsis-v"></i><a></li> -->
							<li class="no-arrow"><i class="icon fa fa-map-marker"></i></li>
							<li><a href="destination-parent.php?state_id=<?=$city['state_id']?>"><?=$city['state_name']?></a></li>
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
						<a href="javascript:void(0)" class="navbar-brand scrollTop"><i class="fa fa-fw fa-map-marker"></i> <?=$city['city_name'].', ',$city['state_name']?></a>
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
							<li>
								<a href="#" onclick="$('#myModalit').modal('show');" >Show Itinerary</a>
							</li>
							<!--<li class="dropdown show-on-hover">
								<a href="directory-category.html" class="dropdown-toggle" data-toggle="dropdown">Things to do<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="directory-category.html">Food &amp; Drinks</a></li>
									<li><a href="directory-category.html">Attractions</a></li>
									<li><a href="directory-category.html">Services</a></li>
									<li><a href="directory-category.html">Activities</a></li>
									<li><a href="directory-category.html">Shopping</a></li>
									<li><a href="directory-category.html">Nightlife</a></li>
									<li><a href="directory-category.html">Tours</a></li>
								</ul>
							</li>-->
							<li><a href="stories.php?city_id=<?=$_SESSION['city_id']?>">Articles</a></li>
						</ul>
						<!--<ul class="nav navbar-nav navbar-right">
							<li><a href="destination-sub-page.html#"><i class="fa fa-fw fa-heart-o"></i></a></li>
							<li class="dropdown show-on-hover">
								<a href="destination-sub-page.html#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-share-alt"></i></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="destination-sub-page.html#"><i class="fa fa-fw fa-facebook-official"></i> Facebook</a></li>
									<li><a href="destination-sub-page.html#"><i class="fa fa-fw fa-twitter"></i> Twitter</a></li>
									<li><a href="destination-sub-page.html#"><i class="fa fa-fw fa-google-plus"></i> Google +</a></li>
									<li><a href="destination-sub-page.html#"><i class="fa fa-fw fa-pinterest"></i> Pinterest</a></li>
									<li><a href="destination-sub-page.html#"><i class="fa fa-fw fa-instagram"></i> Instagram</a></li>
									<li><a href="destination-sub-page.html#"><i class="fa fa-fw fa-envelope"></i> Email</a></li>
								</ul>
							</li>
							<li><a href="destination-sub-page.html#" data-toggle="tooltip" title="Download in PDF format."><i class="fa fa-fw fa-file-pdf-o"></i></a></li>
							<li><a href="destination-sub-page.html#" data-toggle="tooltip" title="Print and take with you!"><i class="fa fa-fw fa-print"></i></a></li>
						</ul>-->
					</nav>
				</div>
			</div>
		</div>
		<!-- /.sub-nav -->


		<!-- Main Section
				================================================== -->

		<section class="main">
			<div class="container">

				<h3 class="hidden">Destination</h3>

				<div class="row">
					<div class="col-sm-12 col-fixed-content">
						<div class="intro">
							<p class="lead"><?=$city['city_name']?> is a major city in India</p>

							<div class="entry-content">
								<div class="wp-caption alignright pull-right" style="width: 310px;">
									<!--<img alt="San Francisco Sky Line" class="size-large" height="200" src="assets/images/image-in-content-1.jpg" width="300">-->

									<p class="wp-caption-text">Delhi Sky Line
									</p>
								</div>

								<p><?=$city['description']?>
								</p>

								<!--<p>With a mild climate including cool, wet winters and dry summers, for the most part you can expect the high’s in the upper 50s, 60s or low 70s. It’s almost never warmer than 73, never colder than 50. The nights are chilly so carry a light jacket.</p>-->
							</div>
						</div>


						<section class="narrow directory">
							<div class="title-row">
								<h3 class="title-entry" id="thingstodo">Things to do</h3>
							<!--	<a class="btn btn-primary btn-xs" href="directory-category.html">Find More &nbsp; <i class="fa fa-angle-right"></i></a>-->
                            </div></section>

                            
<div class="container">
<div class="row">
    
    
    
    <?php
    $query="select * from attraction INNER JOIN attraction_category where attraction.category_id=attraction_category.category_id and city_id={$_SESSION['city_id']}";
    $attraction_result=mysqli_query($db,$query);
    if(!$attraction_result){
        die("attraction query failed");
    }
    while($attraction=mysqli_fetch_assoc($attraction_result)){
    echo'<div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box">
                <div >
                 <img alt="" class="attachment-place wp-post-image" height="540" src="assets/images/'.$attraction['pic_url'].'" width="960" >
                </div>
                <div class="product-desc">
                    <strong class="text-muted">'.$attraction['category_name'].'</strong>
                    <a href="#" data-toggle="modal" data-target="#myModal'.$attraction['attraction_id'].'" class="product-name"> '.$attraction['attraction_name'].'</a>

                    <div>
                        '.$attraction['dsc'].'
                    </div>
                    <div class="m-t text-righ" style="margin-top:20px">
                        
                        
                        <button class="btn btn-xs btn-outline btn-primary" onclick="bridge_data('.$attraction['attraction_id'].',\''.$attraction['attraction_name'].'\')" data-toggle="modal" data-target="#myModalnew">Add to itinerary <i class="fa fa-long-arrow-right"></i> </a>
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
  <div class="modal fade" id="myModal'.$attraction['attraction_id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" id="myModalLabel">More About <b>'.$attraction['attraction_name'].'</b></h4>
                    </div>
                <div class="modal-body">
                    <center>
                    <img src="assets/images/'.$attraction['pic_url'].'" name="aboutme" width="300" height="300" border="0" class="img-circle"></a>
                    <br><br>
                    <h3 class="media-heading">'.$attraction['attraction_name'].' <small>'.$city['city_name'].'</small></h3><br><br>
                     <span><strong>Activities : </strong></span>
                        <span class="label label-success">Sight-seeing</span>
                        <span class="label label-primary">Shopping</span>
                        <span class="label label-success">Food</span>
                    <hr>
                    <center>
                    <!----<p class="text-left"><strong>History: </strong>
                       </p>
                    <br>---->
                         <p class="text-left"><strong>Description: </strong>
                      '.$attraction['description'].'</p>
                        <br>
                    </center>
                </div>
                <div class="modal-footer">
                    <center>
                    <button type="button" class="btn btn-default" data-dismiss="modal">I\'ve heard enough about '.$attraction['attraction_name'].'</button>
                    </center>
                </div>
            </div>
        </div>
    </div>';}     
    
    
    ?>

    <script>
    function bridge_data(att_id,att_name){
        document.getElementById('att_name').innerHTML =att_name;
        document.getElementById('att_id').value=att_id; 
    }
        function getDate(){
      document.getElementById('dateSelected').value=$('#selectedDate').val();}
       
    </script> 
    
    
   <!--itinerary-->
    <div class="modal fade" id="myModalnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-left:-40px">
     <!--   <div class="modal-dialog"> -->
            <div class="container bootstrap snippet">
    <section id="news" class="white-bg padding-top-bottom">
    	<div class="container bootstrap snippet">
			<div class="timeline">
				
                
          <?php
                
                $left_Right=1;
                $visit=1;
                
                $query1="select * from itinerary where city_id={$_SESSION['city_id']} AND username='{$_SESSION['username']}' ORDER BY itDate";
                $result1=mysqli_query($db,$query1);
                if(!$result1)
                {die("WHat a noob");}
                while($daysSelected=mysqli_fetch_assoc($result1)){
                      $left_Right=1;
                    echo'<div class="date-title">
                    <span><strong>'.$daysSelected['itDate'].'</strong></span>
                        
				</div>
				<div class="row">';
                $query2="select * from itinerary_content where it_id={$daysSelected['it_id']} ORDER BY con_start";
                $result2=mysqli_query($db,$query2);
                    
                if(!$result2)
                {die("WHat a SuperNoob");}
                    
                    while($itinerary=mysqli_fetch_assoc($result2)){
                        $query3="select attraction_name from attraction where attraction_id={$itinerary['attraction_id']}";
                            $att=mysqli_query($db,$query3);
                        if(!$att){die("Beta tumse na ho payega");}
                            $att_name=mysqli_fetch_assoc($att);
                        echo'<!--It contntent starts here--> 
                   <div class="col-sm-6 news-item ';echo($left_Right%2==0 ? 'right':'left');
                       echo'">
						<div class="news-content">
							
                            <div class="date">
                                
								<p>'.$visit.'</p>
								<small>Visit</small>
							</div>
							
                            <h2 class="news-title" >'.$att_name['attraction_name'].'</h2>
							
							<a class="read-more" href="">Time</a><br>
                            <p>Start : '.$itinerary['con_start'].'</p>
                            <p>End &nbsp&nbsp&nbsp:'.$itinerary['con_end'].'</p>
                            
						</div>
					</div>
                    <!--it content ends here-->';
                       $left_Right++; 
                        $visit++;
                    }
                    echo'</div>';    
                }
                ?>
                      
			
            
                
                
                <div class="date-title">
                    <form class="form-group" action="#" method="get" onchange="getDate()">
                    <span><strong><input type="date"  id="selectedDate" style="color:black" required></strong></span>
                        </form>
				</div>
				<div class="row">
					                 
                   
                   
                   <div class="col-sm-6 news-item left">
						<div class="news-content">
							
                            <div class="date">
                                
								<!--<p><?php //echo $visit; $visit++;?></p>-->
								<small>Visit</small>
							</div>
							
                            <h2 class="news-title" ><span id="att_name"></span></h2>
							
							<a class="read-more" href="">Time</a><br>
                            <form action="destination-sub-page.php" method="post" class="form-group">
                             <input class="form-control" type="time" name="start" placeholder="start" style="color:black" required>
                              <input class="form-control" type="time" name="end" placeholder="end"style="color:black" required> 
                                <input type="hidden" id="att_id" name="att_id">
                                <input type="hidden" id="dateSelected" name="date">
                               
                            <input type="submit" name="submit" value="Save">
                             </form>
                            <button type="button" class="btn btn-xs btn-outline btn-primary" data-dismiss="modal" >cancel</button>
                            
						</div>
					</div>       
				</div>
                
                
                
			</div>
		</div>
	</section>
</div>				                                                      
      <!--  </div> -->
    </div>

    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hey <?=$_SESSION['username']?></h4>
        </div>
        <div class="modal-body">
          <p>You are visiting <?=$foundcity?> on <?=$insertionDate?>.<br>Please choose another Date</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    
    
    
  <div class="modal fade" id="myModalerror" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hey <?=$_SESSION['username']?> !</h4>
        </div>
           <img alt="Visiting place" class="size-large" height="100" style="float:right;margin-right:50px"  src="assets/images/<?=$foundcity_pic?>" width="200">
        <div class="modal-body">
          <p>You are visiting <?=$foundcity?> on <?=$insertionDate?>.<br> Choose another Date</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  

					</div>

					
				</div>
			</div>
                </div></div>
		</section> 
        
        
        
        <!--itinerary-->
    <div class="modal fade" id="myModalit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-left:-40px">
     <!--   <div class="modal-dialog"> -->
            <div class="container bootstrap snippet">
    <section id="news" class="white-bg padding-top-bottom">
    	<div class="container bootstrap snippet">
			<div class="timeline">
				
                
          <?php
                
                $left_Right=1;
                $visit=1;
                
                $query1="select * from itinerary where city_id={$_SESSION['city_id']} AND username='{$_SESSION['username']}' ORDER BY itDate";
                $result1=mysqli_query($db,$query1);
                if(!$result1)
                {die("WHat a noob");}
                while($daysSelected=mysqli_fetch_assoc($result1)){
                      $left_Right=1;
                    echo'<div class="date-title">
                    <span><strong>'.$daysSelected['itDate'].'</strong></span>
                        
				</div>
				<div class="row">';
                $query2="select * from itinerary_content where it_id={$daysSelected['it_id']} ORDER BY con_start";
                $result2=mysqli_query($db,$query2);
                    
                if(!$result2)
                {die("WHat a SuperNoob");}
                    
                    while($itinerary=mysqli_fetch_assoc($result2)){
                        $query3="select attraction_name from attraction where attraction_id={$itinerary['attraction_id']}";
                            $att=mysqli_query($db,$query3);
                        if(!$att){die("Beta tumse na ho payega");}
                            $att_name=mysqli_fetch_assoc($att);
                        echo'<!--It contntent starts here--> 
                   <div class="col-sm-6 news-item ';echo($left_Right%2==0 ? 'right':'left');
                       echo'">
						<div class="news-content">
							
                            <div class="date">
                                
								<p>'.$visit.'</p>
								<small>Visit</small>
							</div>
							
                            <h2 class="news-title" >'.$att_name['attraction_name'].'</h2>
							
							<a class="read-more" href="">Time</a><br>
                            <p>Start : '.$itinerary['con_start'].'</p>
                            <p>End &nbsp&nbsp&nbsp:'.$itinerary['con_end'].'</p>
                            
						</div>
					</div>
                    <!--it content ends here-->';
                       $left_Right++; 
                        $visit++;
                    }
                    echo'</div>';    
                }
                ?>
                </div>
		</div>
	</section>
</div>				                                                      
      <!--  </div> -->
    </div>
        
        
        
        
        
        
        


		<!-- Footer
		================================================== -->
		<?php include("includes/footer.php"); ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/custom.js"></script>
                <script src="assets/js/timepick.min.js"></script>
	</body>
</html>
<!--
-->
<?php
session_start();
$_SESSION['mode']='Train';
$db =mysqli_connect("localhost","merry_cms","comearound","merrygoround");
if(mysqli_connect_errno()){
    die("database connection failed" .mysqli_connect_error()."(".mysqli_connect_errno().")");
}
function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;}
if(isset($_GET['mode'])&&isset($_SESSION['username']))
{$_SESSION['mode']=$_GET['mode'];}
else
{redirect_to("login.php?action=login");}
?>
<!DOCTYPE html>
<html>
<head>
	<title> <?php if($_SESSION["mode"]=="train"){echo "Train";}else{echo "Flight";} ?> Ticket Booking</title>
	<link rel="stylesheet" href="css/booking.css">
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Flight Ticket Booking MerryGoRound" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<style><?php if($_SESSION["mode"]=="flight"){echo "body {
	background:url('assets/images/1.jpg') no-repeat 0px 0px;
	background-size: cover;
	font-family: 'Open Sans', sans-serif;
	background-attachment: fixed;
    background-position: center;
}";}
        else
        {echo "body {
	background:url('images/thumb-1920-295883.jpg') no-repeat 0px 0px;
	background-size: cover;
	font-family: 'Open Sans', sans-serif;
	background-attachment: fixed;
    background-position: center;
}h1{color:black;}";
            }?></style>	
<body>
    <?php
     if(isset($_POST['submit'])) {
         $dep_date=$_POST['dep_date'];
    $dep_date=date('Y-m-d',strtotime($dep_date));
         //Converts date to 'yyyy-mm-dd' acceptable to mysql
         if(isset($_POST["ret_date"]))
         {
         $ret_date=$_POST['ret_date'];
    $ret_date=date('Y-m-d',strtotime($ret_date));
         $query="INSERT INTO `booking_details`(`dep_city`, `des_city`, `dep_date`, `ret_date`, `mode`, `class`, `adults`, `child`, `username`)
         VALUES
         ('{$_POST["dep_city"]}','{$_POST["des_city"]}','{$dep_date}','{$ret_date}','{$_SESSION["mode"]}','{$_POST["class"]}',{$_POST["adult"]},{$_POST["child"]},'{$_SESSION["username"]}')";}
         else
         {$query="INSERT INTO `booking_details`(`dep_city`, `des_city`, `dep_date`, `mode`, `class`, `adults`, `child`, `username`)
         VALUES
         ('{$_POST["dep_city"]}','{$_POST["des_city"]}','{$dep_date}','{$_SESSION["mode"]}','{$_POST["class"]}',{$_POST["adult"]},{$_POST["child"]},'{$_SESSION["username"]}')";}
         
          $result=mysqli_query($db,$query);
        if($result){redirect_to("index.php");}
         else
         {die("Database query failed. ".mysqli_error($db));}}
    
    
    ?>
	<h1 style="font-family:Modern">Book Your <?php if($_SESSION["mode"]=="train"){echo "Train";}else{echo "Flight";} ?> With Us</h1>
    <br />
    <!--<p style="text-align:center; color:white" font face="Modern" size="5">Whether you are jetting off for pleasure or travelling for</p>
    <p style="text-align:center; color:white" font face="Modern" size="5">business, we offer flight deals for the best destinations in</p>
    <p style="text-align:center; color:white" font face="Modern" size="5">India. Find your destination fare and get ready to explore.</p>--->
    <br />
	<div class="main-agileinfo">
		<div class="sap_tabs">			
			<div id="horizontalTab">
				<ul class="resp-tabs-list">
					<li class="resp-tab-item"><span>Round Trip</span></li>
					<li class="resp-tab-item"><span>One way</span></li>
									
				</ul>	
				<div class="clearfix"> </div>	
				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content roundtrip">
                        
                        
                        
                        
						<form action="#" method="post" >
							<div class="from">
								<h3>From</h3>
								<input type="text" name="dep_city" class="city1" placeholder="Type Departure City" required="">
							</div>
							<div class="to">
								<h3>To</h3>
								<input type="text" name="des_city" class="city2" placeholder="Type Destination City" required="">
							</div>
							<div class="clear"></div>
							<div class="date">
								<div class="depart">
									<h3>Depart</h3>
									<input  id="datepicker" name="dep_date" type="text" value="mm/dd/yyyy" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
								</div>
								<div class="return">
									<h3>Return</h3>
									<input  id="datepicker1" name="ret_date" type="text" value="mm/dd/yyyy" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
								</div>
								<div class="clear"></div>
							</div>
                            <?php if($_SESSION["mode"]=="flight"){echo '<div class="class">
								<h3>Class</h3>
								<select name="class" id="w3_country1" onchange="change_country(this.value)" class="frm-field required">
									<option value="Economy">Economy</option>  
									<option value="Premium Economy">Premium Economy</option>   
									<option value="Business">Business</option>   
									<option value="First class">First class</option>   						
								</select>

							</div>';}else{echo '<div class="class">
								<h3>Class</h3>
								<select name="class" id="w3_country1" onchange="change_country(this.value)" class="frm-field required">
									<option value="General">General</option>  
									<option value="Third Class">Third Class</option>   
									<option value="Second Class">Second Class</option>   
									<option value="First class">First class</option>   						
								</select>

							</div>';} ?>
							
                            
							
							
								<div class="adults">
									<h3>Adult:(12+ yrs)</h3>
                                    <input type="number" name="adult" value="1" min="1" max="5" >
									
								</div>
								<div class="child">
									<h3>Child:(2-11 yrs)</h3>
                                    <input type="number" name="child" value="0" min="0" max="5" >
							</div>
							<div class="clear"></div>
							<input type="submit" name="submit" value="Book <?php if($_SESSION["mode"]=="train"){echo "Train";}else{echo "Flight";} ?>">
						</form>						
					</div>		
					<div class="tab-1 resp-tab-content oneway">
                        
                        
                        
                        
						<form action="#" method="post">
							<div class="from">
								<h3>From</h3>
                                <input type="text" name="dep_city" class="city1" placeholder="Type Departure City" required="">
							</div>
							<div class="to">
								<h3>To</h3>
								<input type="text" name="des_city" class="city2" placeholder="Type Destination City" required="">
							</div>
							<div class="clear"></div>
							<div class="date">
								<div class="depart">
									<h3>Depart</h3>
									<input class="date" id="datepicker2" name="dep_date" type="text" value="mm/dd/yyyy" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
									
								</div>
							</div>
							<?php if($_SESSION["mode"]=="flight"){echo '<div class="class">
								<h3>Class</h3>
								<select name="class" id="w3_country1" onchange="change_country(this.value)" class="frm-field required">
									<option value="Economy">Economy</option>  
									<option value="Premium Economy">Premium Economy</option>   
									<option value="Business">Business</option>   
									<option value="First class">First class</option>   						
								</select>

							</div>';}else{echo '<div class="class">
								<h3>Class</h3>
								<select name="class" id="w3_country1" onchange="change_country(this.value)" class="frm-field required">
									<option value="General">General</option>  
									<option value="Third Class">Third Class</option>   
									<option value="Second Class">Second Class</option>   
									<option value="First class">First class</option>   						
								</select>

							</div>';} ?>

							<div class="clear"></div>
							
								<div class="adults">
									<h3>Adult:(12+ yrs)</h3>
									<input type="number" name="adult" value="1" min="1" max="5" >
								</div>
								<div class="child">
									<h3>Child:(2-11 yrs)</h3>
									<input type="number" name="child" value="0" min="0" max="5" >
								</div>
								<div class="clear"></div>
							
							<div class="clear"></div>
							<input type="submit" name="submit" value="Book <?php if($_SESSION["mode"]=="train"){echo "Train";}else{echo "Flight";} ?>">
						</form>	
								
					</div>
                    
	<div class="footer-w3l">
		<p class="agileinfo"> &copy; 2017 Merry Go Round . All Rights Reserved </p>
	</div>
					
	<!--script for portfolio-->
		<script src="js/jquery.min1.js"> </script>
		<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#horizontalTab').easyResponsiveTabs({
					type: 'default', //Types: default, vertical, accordion           
					width: 'auto', //auto or any width like 600px
					fit: true   // 100% fit in a container
				});
			});		
		</script>
		<!--//script for portfolio-->
				<!-- Calendar -->
				<link rel="stylesheet" href="css/jquery-ui.css" />
				<script src="js/jquery-ui.js"></script>
				  <script>
						  $(function() {
							$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
						  });
				  </script>
			<!-- //Calendar -->
			<!--quantity-->
									<script>
									$('.value-plus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
										divUpd.text(newVal);
									});

									$('.value-minus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
										if(newVal>=1) divUpd.text(newVal);
									});
									</script>
								<!--//quantity-->
						<!--load more-->
								<script>
	$(document).ready(function () {
		size_li = $("#myList li").size();
		x=1;
		$('#myList li:lt('+x+')').show();
		$('#loadMore').click(function () {
			x= (x+1 <= size_li) ? x+1 : size_li;
			$('#myList li:lt('+x+')').show();
		});
		$('#showLess').click(function () {
			x=(x-1<0) ? 1 : x-1;
			$('#myList li').not(':lt('+x+')').hide();
		});
	});
</script>
<!-- //load-more -->



</body>
</html>
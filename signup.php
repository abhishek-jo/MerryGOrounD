<?php
session_start();
function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;}
require_once("includes/connection.php");
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Merry Go Round|Sign Up</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  
     <link rel="stylesheet" href="css/signup.css">

  
</head>

<body>
    
    <?php
     $flag=false;
    if(isset($_POST['submit'])) {
		// form was submitted
		$username = $_POST["username"];
		$password = $_POST["password"];
        
        if($_POST["password"]!=$_POST["cpass"])
        {$message="Password do not match";}
        else{
        
        $query="select * from user"; //query for sql
        $result=mysqli_query($db,$query);
       
        if(!$result){
    die("Database query failed");}
       
     while($row=mysqli_fetch_assoc($result))
        {
          if ($username ==$row["username"]) {
              $message="Username not available";
                  $flag=true;
                    mysqli_free_result($result);
              break;
		} 	  
        }
    if($flag==false){
    $query="INSERT INTO user (username,password,phone,fname,lname) values ('{$username}','{$password}',{$_POST["phone"]},'{$_POST["fname"]}','{$_POST["lname"]}')";
        $result=mysqli_query($db,$query);
        if($result){
             $_SESSION["username"]=$username;
			redirect_to("index.php");
        }
        else
        {die("Database query failed. ".mysqli_error($db));}
    }
		
	}}
   
    else{$message="";$username="";}
    ?>
  <!-- multistep form -->
    
<form id="msform" method="post" action="signup.php">
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Account Setup</li>
    <li>Personal Details</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Create your account</h2>
    <h3 class="fs-subtitle" style="color:red;"><?=$message?></h3>
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required/>
    <input type="password" name="cpass" placeholder="Confirm Password" required/>
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Personal Details</h2>
    <h3 class="fs-subtitle"></h3>
    <input type="text" name="fname" placeholder="First Name" required/>
    <input type="text" name="lname" placeholder="Last Name" required/>
    <input type="number" name="phone" placeholder="Phone" required/>
    
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="submit" name="submit" class="action-button" value="Submit" />
  </fieldset>
</form>
    
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>

    <script src="js/signup.js"></script>

</body>
    <?php
mysqli_close($db);
?>
</html>

<?php
session_start();
function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;}
require_once("includes/connection.php");

$query="select * from user"; //query for sql
$result=mysqli_query($db,$query);//result will be a special kind of object called a "resource" which will contain all the rows in the query

//testing query error, query is right even if there are no rows returned(just checking for syntax error)
if(!$result){
    die("Database query failed");}

$flag=false;
if(isset($_POST['submit'])) {
		// form was submitted
		$username = $_POST["username"];
		$password = $_POST["password"];
        while($row=mysqli_fetch_assoc($result))
        {
          if ($username ==$row["username"]  && $password == $row["password"]) {
			// successful login
              $_SESSION["username"]=$row["username"];
              if(isset($_GET['continueTo']))
			redirect_to($_GET['continueTo']);
              redirect_to("index.php");
		} 	  
        }
    if($flag==false){
    $message = "Username/Password not valid";}
		
	}else
{if(isset($_GET['action'])&&$_GET['action']=='login') {
        $username = "";
		$message = "* Please Login to continue.";
	}  
     else{
         $username = "";
		$message = ""; 
     }}
         
?><!DOCTYPE html>
<html lang="en" class="cover">
	<head>
		<meta charset="utf-8">
		<title>Log In | Merry Go Round</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="assets/css/imports.css" media="screen">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login">

		<div id="login">
			<h1><a href="index.php" title="MerryGoRound"><img src="assets/images/merry.png" alt="MerryGoRound" style="margin-left:30%;max-height:200px; width:auto; max-width:100%;"></a></h1>
			<form id="loginform" action="#" method="post">
                <p><label for="message" style="color:red;"><?=$message?><br></label></p>   
				<p>
					<label for="user_login">Username<br>
					<input type="text" name="username" id="user_login" class="input" value="<?php echo htmlspecialchars($username); ?>" placeholder="username" size="20" required></label>
				</p>

				<p>
					<label for="user_pass">Password<br>
					<input type="password" name="password" id="user_pass" class="input" value="" size="20" placeholder="password" required></label>
				</p>

				<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label></p>

				<p class="submit">
					<input type="submit" name="submit" id="submit" class="button button-primary button-large" value="Log In">
				</p>
    <?php
mysqli_close($db);
?>

			</form>
		</div> <!-- /login -->
        <!-- Footer
		================================================== -->
		<?php include("includes/footer.php"); ?>
	</body>
</html>

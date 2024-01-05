<?php
include "connect.php";
session_start();
if(isset($_POST{"Submit"}))
{
	$_SESSION['mobilenumber']=$_POST["mobilenumber"];
	$password=$_POST["Password"];
	$sql="Select Password from register where mobile_number='{$_POST['mobilenumber']}'";
	$sql2=mysqli_query($con,$sql);
	$sql2=mysqli_fetch_assoc($sql2);
	$errors=array();
	if(empty($_POST['mobilenumber']) OR empty($password))
	{
		array_push($errors,"All fields are required");
	}
	if(empty($sql2))
	{
		array_push($errors,"Username invalid");
	}
	if(count($errors)>0)
    {
        foreach($errors as $error)
        {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
	else{
		echo "<script>document.location='landingpage.php'</script>";
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
    <link rel="shortcut icon" href="images/favicon.jpg" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">		
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">
		<style>
			.forgotpassword a{
				color:white;
				text-decoration:none;
				padding: 40px;
			}
		</style>
	</head>
	<body>

		<!-- Login form-->
		<div class="wrapper" style="background-image: url('images/pollution.jpg');">
			<div class="inner" >
				<form method="post">
					<h3>Login Page</h3>
					<div class="form-wrapper">
						<input type="text" name="mobilenumber" placeholder="Mobile number" class="form-control">
					</div>
					<div class="form-wrapper">
						<input type="password" name="Password" placeholder="Password" class="form-control" >
					</div>
					<div class="forgotpassword">
    					<a href="forgotpassword.php">Forgot password</a>
					</div>
					<button name="Submit">Login
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
					
					
				</form>
			</div>
		</div>
		
		<!-- Login form-->
	</body>
</html>
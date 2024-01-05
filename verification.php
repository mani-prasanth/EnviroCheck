<?php
include "connect.php";
session_start();
if(isset($_POST["Submit"]))
{
    $otp1=$_POST['emailotp'];
    $email=$_SESSION['email'];
    $errors=array();
    $sql="SELECT otp from emailotp where otp='$otp1'";
    $sql1=mysqli_query($con,$sql);
    $run1=mysqli_fetch_assoc($sql1);
    if($run1['otp']===$otp1)
    {
        echo "<script>document.location='landingpage.php'</script>";
    }
    else{
        array_push($errors,"invalid otp");
    }
    if(count($errors)>0)
    {
        foreach($errors as $error)
        {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.jpg" >
	</head>

	<body>

		<div class="wrapper" style="background-image: url('images/pollution.jpg');">
			<div class="inner" >
				
				<form method="post">
                <h3>OTP sent to registered email</h3>
					<div class="form-wrapper">
						<input type="text" placeholder="enter otp" name="emailotp" class="form-control">
					</div>
					<button style="background-color: #ffbf00;" name="Submit" class="color-change-btn" >Register
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
				</form>
			</div>
		</div>
		
	</body>
</html>
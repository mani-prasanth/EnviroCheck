<?php
include "connect.php";
session_start();
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);
if(isset($_POST{"Submit"}))
{
	$mailid=$_POST['mail'];
    $sql="SELECT Password from register where Emailid='{$mailid}'";
    $sql1=mysqli_query($con,$sql);
	$sql2=mysqli_fetch_assoc($sql1);
	$mess="Your password for envirocheck login is ".$sql2['Password'];
	if(empty($sql2['Password']))
	{
		$error='Email id not registered';
		echo "<div class='alert alert-danger'>$error</div>";
	}else
	{
		try
		{
        $mail->isSMTP();
        
        //Email host 

        $mail->Host       = 'smtp.gmail.com'; // Specify your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'maniprasanthchanduvenkata@gmail.com'; // SMTP username
        $mail->Password   = 'iiaj kwiu nznp cfoz'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption
        $mail->Port       = 587; // TCP port to connect to
        $mail->SMTPDebug = 2;

	//Recipients
	$mail->setFrom('maniprasanthchanduvenkata@gmail.com', 'maniprasanth');
	$mail->addAddress($mailid, 'prasanth');

	// Content
	$mail->isHTML(true);
	// $mail->Subject = 'Test Email';
	$mail->Body    = $mess;

	$mail->send();
        echo "<script>document.location='loginpage.php'</script>";
    	}
		catch (Exception $e) {
			echo "Error sending email: {$mail->ErrorInfo}";
		} 
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
	</head>
	<body>

		<!-- Login form-->
		<div class="wrapper" style="background-image: url('images/pollution.jpg');">
			<div class="inner" >
				<form method="post">
					<h3>Enter mail id</h3>
					<div class="form-wrapper">
						<input type="text" name="mail" placeholder="mail" class="form-control">
					</div>
					<button name="Submit">Submit
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
					
					
				</form>
			</div>
		</div>
		
		<!-- Login form-->
	</body>
</html>
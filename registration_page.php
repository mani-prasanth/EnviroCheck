<?php
include "connect.php";
session_start();
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);
if(isset($_POST["Submit"])){
    $fullname=$_POST["Full_name"];
    $_SESSION['username']=$_POST["Username"];
    $username=$_POST["Username"];
    $dob=$_POST["Date_of_Birth"];
    $_SESSION['email']=$_POST["Email_Address"];
	$email=$_POST["Email_Address"];
	$_SESSION['mobilenumber']=$_POST["mobile_number"];
	$mobilenumber=$_POST["mobile_number"];
    $password=$_POST["Password"];
    $repeatpassword=$_POST["repeat_password"];
    $aadhar=$_POST["Aadhar_number"];
	$emailotp=rand(1000,10000);
    $errors=array();
    if(empty($_POST["Full_name"]) OR empty($_POST["Username"]) OR empty($dob) OR empty($email) OR empty($mobilenumber) OR empty($password) OR empty($repeatpassword) OR empty($aadhar))
    {
        array_push($errors,"All fields are required");
    }
    if(!filter_var($_POST["Email_Address"],FILTER_VALIDATE_EMAIL))
    {
        array_push($errors,"Email not valid");
    }
    if(strlen($password)<8)
    {
        array_push($errors,"password length should be atleast 8");
    }
	if(strlen($_POST["mobile_number"])!=10)
	{
		array_push($errors,"mobile number should have 10 digits");
	}
    if($password!=$repeatpassword)
    {
        array_push($errors,"Passwords doesnot match");
    }
	if(strlen($aadhar)!=12)
	{
		array_push($errors,"aadhar should have be 12 digits");
	}
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
	$mail->addAddress($email, 'prasanth');

	// Content
	$mail->isHTML(true);
	// $mail->Subject = 'Test Email';
	$mes='Your otp for envirocheck login is '.$emailotp;
	$mail->Body    = $mes;

	$mail->send();
	if(count($errors)>0)
    {
        foreach($errors as $error)
        {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
    else{
		$sql1="INSERT INTO register(Fullname,Username,Dateofbirth,mobile_number,Emailid,Password,confirmpassword,Aadharnumber) VALUES ('$fullname','$username','$dob','$mobilenumber','$email','$password','$repeatpassword','$aadhar')";
		$sql2=mysqli_query($con,$sql1);
		$sql3="INSERT INTO emailotp(mailid,otp,status) VALUES ('$email','$emailotp','1')";
		$sql4=mysqli_query($con,$sql3);
        echo "<script>document.location='verification.php'</script>";
    }    
	}
	catch (Exception $e) {
        echo "Error sending email: {$mail->ErrorInfo}";
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>RegistrationForm</title>
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
					<h3>Signup Page</h3>
					<div class="form-wrapper">
						<input type="text" placeholder="Full Name" name="Full name" class="form-control">
					</div>
					<div class="form-wrapper">
						<input type="text" placeholder="Username" name="Username" class="form-control">
						<i class="zmdi zmdi-account"></i>
					</div>
					<div class="form-wrapper">
						<input type="date" placeholder="Date of Birth" name="Date of Birth" class="form-control">
						<i class="fa-regular fa-calendar-days"></i>
					</div>
					<div class="form-wrapper">
						<input type="text" placeholder="Email Address" name="Email Address" class="form-control">
						<i class="zmdi zmdi-email"></i>
					</div>
					<div class="form-wrapper">
						<input type="text" placeholder="mobile number" name="mobile_number" class="form-control">
						<i class="zmdi zmdi-phone"></i>
					</div>
					
					<div class="form-wrapper">
						<input type="password" placeholder="Password" name="Password" class="form-control" >
					</div>
					<div class="form-wrapper" >
						<input type="password" placeholder="Confirm Password" name="repeat password" class="form-control" >
					</div>
					<div class="form-wrapper">
						<input type="text" placeholder="Aadhar number" name="Aadhar number" class="form-control">
					</div>
					<button style="background-color: #ffbf00;" name="Submit" class="color-change-btn" id="register" >Register
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
				</form>
			</div>
		</div>
		
	</body>
</html>
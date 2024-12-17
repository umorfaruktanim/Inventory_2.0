<?php 
require 'PHPmailer/Exception.php';
require 'PHPmailer/PHPMailer.php';
require 'PHPmailer/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();
if(isset($_SESSION['email'])){
$idd = $_SESSION['id'];


$id = $_GET['id'];
$sql = "SELECT * FROM user WHERE id=$id";
include('dbcon.php');
$run = mysqli_query($con,$sql);
$data = mysqli_fetch_assoc($run);
$sql2= "UPDATE user SET status = 1 WHERE id=$id";
$run2= mysqli_query($con,$sql2);
if($run2){

//Load Composer's autoloader


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'lmsman369@gmail.com';                     //SMTP username
    $mail->Password   = 'bfrz pmto fxbe cyln';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('lmsman369@gmail.com', 'Inventory System 2.0');
    $mail->addAddress($data['email'] , $data['name']);     //Add a recipient
    


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'IS 2.0 Registration Approval Report';
    $mail->Body    = '<p style="color: green; font-weight:bold; font-size: 22px;">Congratulations!!</p><p>Your registration request has been approved, you can now login to our website<br><br>Your user id is: ' . $data['email'] . ' <br>Your Password is:  ' . $data['password'] . ' </p><br><br><br><br> <p>Thanks And Best Regurds<br>LMS System<br>01756569753';


  $mail->send();
    echo "<script>
    		   window.alert('Approved & Confirmation Mail send to User');
	           window.open('u_request.php','_self');
	        </script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
}else{
    header('location: ../login.php');
}
?>
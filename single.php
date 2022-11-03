<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require "./PHPMailer/src/PHPMailer.php";
require  "./PHPMailer/src/SMTP.php";

$pass=' ';
$user=" ";

if(isset($_POST['send'])){

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth=true;
$mail->Username=$user;
$mail->Password=$pass;
$mail->SMTPSecure="ssl";
$mail->Port=465;
$mail->setFrom("kelvingithu019@gmail.com");
$mail->addAddress($_POST['mail']);
$mail->isHTML(true);

$mail->Subject=$_POST['subject'];

$mail->Body=$_POST['message'];
$mail->send();
}

// $token = rand( 99999,11111);

// echo $token;

?>
<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

 require "./PHPMailer/src/Exception.php";
 require "./PHPMailer/src/SMTP.php";
 require "./PHPMailer/src/PHPMailer.php";
$pass=' ';  //Enter  your  smtp password
$user=" ";  //enter your  smtp password
if(isset($_POST['send'])){
$email    =$_POST['mail'];
$subject  =$_POST['subject'];
$attachments =$_FILES['attachments']['name'];
$mails =explode("," , $_POST['mails']);
$message  =$_POST['message'];
$Sname=$_POST['Sname'];


//  die();
$mail = new PHPMailer(true);
try{
$mail->isSMTP();
$mail->Host="smtp.gmail.com";
$mail->SMTPAuth=true;
$mail->Username=$user;
$mail->Password=$pass;
$mail->Port="465";
$mail->SMTPSecure="ssl";
// Sender Settings

$mail->setFrom($email,$Sname);



// RECEPIENTS  EMAILS
for($i=0;$i<count($mails);$i++){
   $mail->addAddress($mails[$i]);
}
// foreach($email as $mailme){
//    $mail->addAddress($mailme);
// }
// ATTACHMENTS 

for($i =0 ; $i < count($attachments) ;$i++){
    $file_tmp = $_FILES['attachments']["tmp_name"][$i];
    $file_name = $_FILES['attachments']["name"][$i];
    $moved = move_uploaded_file($file_tmp,'uploads/'.$file_name);
  
    
$mail->addAttachment("uploads/".$file_name);
// Subject
$mail->Subject=$subject;
// body

$mail->Body=$message;

$mail->send();


echo "Emails sent succefully";

}
}
catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


}


?>

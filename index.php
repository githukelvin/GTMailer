
<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

 require "./PHPMailer/src/Exception.php";
 require "./PHPMailer/src/SMTP.php";
 require "./PHPMailer/src/PHPMailer.php";

 $pass=' ';
 $user=" ";

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mailer</title>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <div class="preloader">
        <div class="spin1">
           <div class="sp1">
           </div>
        </div>
        <div class="spin2">
           <div class="sp2">

           </div>
        </div>
    </div>
    <form method="POST" action="single.php">
        <div class="container">
            <h1>SINGLE MAIL MAILER</h1>
           <div class="div">
            Email
                <input type="email" name="mail">
           </div>
           <div class="div">
            Subject
                <input type="subject" name="subject">
           </div>
           <div class="div">
            Message
                <input type="message"  name="message">
           </div>

            <input type="submit" name="send" value="Send">

          </div>

          
    </form>


    <form action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="post">
    <div class="container">
        <h1>BULK MAILER </h1>
        <div class="div">
            Sender Name
            <input type="text" name="Sname">
           </div>
           <div class="div">
            Email address
            <input type="email" name="mail">
           </div>
           <div class="div">
            Subject
                <input type="subject" name="subject">
           </div>
           <div class="div">
            Attachment
                <input type="file"   name="attachments[]" accept="application/pdf, application/vnd.ms-excel, image/png,image/jpg,image/jpeg,image/gif"  multiple>
           </div>

           <div class="div">
            Email Addresses
                <textarea type="text" name="mails" rows="10" cols="50" name="mails" placeholder="abc@gamil.com," placeholder="abc@gamil.com," placeholder="abc@gamil.com,"></textarea>
           </div>
          
           <div class="div">
            Message
                <input type="message"  name="message">
           </div>

            <input type="submit" name="send" value="Send">

          </div>
    </form>

    

    <script src="./index.js"></script>
</body>
</html>
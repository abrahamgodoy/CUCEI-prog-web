<?php
require 'phpmailer/class.phpmailer.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();

$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;  // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465; 
$mail->Username = 'mtv000@gmail.com';  
$mail->Password = '4xzzud3m';        


//Set who the message is to be sent from
$mail->SetFrom('direccion@cucei.udg.mx', 'Dirección CUCEI');
//Set who the message is to be sent to
$mail->AddAddress('al_xsnake@hotmail.com', 'Juan Alejandro');
//Set the subject line
$mail->Subject = 'probando phpmailer';
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
$mail->MsgHTML('este es el contenido');
//Attach an image file
//$mail->AddAttachment('images/phpmailer-mini.gif');

//Send the message, check for errors
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
?>


<?php
/*
 *  CONFIGURE EVERYTHING HERE
 */

// get PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/Exception.php";
require_once "PHPMailer/OAuth.php";
require_once "PHPMailer/POP3.php";
require_once "PHPMailer/SMTP.php";

$mail = new PHPMailer;

// setting SMTP Server
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name
$mail->Host = "piyaman.idweb.host";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password
$mail->Username = "admin@zakariawahyu.com";
$mail->Password = "@bobokaja123";
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "ssl";
//Set TCP port to connect to
$mail->Port = 465;

// message that will be displayed when everything is OK :)
$okMessage = 'Your message successfully submitted. Thank you, I will get back to you soon!';

// If something goes wrong, we will display this message.
$errorMessage = 'There was an error while submitting the form. Please try again later';

$mail->From = "admin@zakariawahyu.com";
$mail->FromName = $_POST['InputName'];
$mail->addAddress('zakarianur6@gmail.com', 'Zakaria Wahyu Nur Utomo');
$mail->isHTML(true);

$mail->Subject = $_POST['InputSubject'];
$mail->Body    = "<i>From : ".$_POST['InputEmail']."</i><br><i>Message : ".$_POST['InputMessage']."</i>";

if (!$mail->send()) {
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
} else{
    $responseArray = array('type' => 'success', 'message' => $okMessage);
}

// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
// else just display the message
else {
    echo $responseArray['message'];
}

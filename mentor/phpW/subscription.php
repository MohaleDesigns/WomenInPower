<?php
// Information to be modified
$to_email = "info@intenca.co.za"; // email address to which the form data will be sent
$subject = "Newsletter Subscription"; // subject of the email that is sent
$thanks_page = "index.html"; // path to the thank you page following successful form submission
$contact_page = "index.html"; // path to the HTML contact page where the form appears
$headers = 'From: webmaster@intenca.co.za' . "\r\n" .
    'Reply-To: info@intenca.co.za' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$ema = strip_tags($_POST["email"]);

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: <' .$ema. '>' . "\r\n";
$headers .= "Reply-To: ".$ema."\r\n";

$email_body = 
	"<strong>I would like to recieve the Newsletters: </strong>" . $ema . "<br />";	

// Assuming there's no error, send the email and redirect to Thank You page
if( mail($to_email, $subject, $email_body, $headers) ) {
	header("Location: ../thankyou.html");
	exit();
	} 
	else {
		header("Location: error.html");
	exit();
}
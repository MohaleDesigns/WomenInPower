<?php

$to_email = "fmamabolo@gmail.com"; // email address to which the form data will be sent
//$to_email = "dithetogroup@gmail.com"; // email address to which the form data will be sent
$subject = "RSVP: Work Place Master Class."; // subject of the email that is sent
$subject2 = "Copy of your RSVP: Work Place Master Class";
$headers = 'From: webmaster@dithetogroup.co.za' . "\r\n" .
    'Reply-To: info@dithetogroup.co.za' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$headers2 = 'From: webmaster@dithetogroup.co.za' . "\r\n" .
'Reply-To: info@dithetogroup.co.za' . "\r\n" .
'X-Mailer: PHP/' . phpversion();

$servername = "localhost";
$username = "dithetog_broodie_rsvp";
$password = "Bok@ngD!eth3to";
$dbname = "dithetog_broodie_rsvp";

$form_data = [];

$firstname = strip_tags($_POST["firstname"]);
$lastname = strip_tags($_POST["lastname"]);
$email = strip_tags($_POST["email"]);
$cell = strip_tags($_POST['cell']);
$address = strip_tags($_POST['address']);
$company  = strip_tags($_POST['company']);
$province = strip_tags($_POST['province']);
$industry = strip_tags($_POST['industry']);

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: <' .$email. '>' . "\r\n";
$headers .= "Reply-To: ".$email."\r\n";

$headers2  = 'MIME-Version: 1.0' . "\r\n";
$headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers2 .= 'From: <' .$to_email. '>' . "\r\n";
$headers2 .= "Reply-To: ".$to_email."\r\n";

$email_body = 
	"<strong>Title: </strong>"  . $firstname . "<br />
	<strong>Name: </strong>"  . $lastname . "<br />
	<strong>Email: </strong>" . $email . "<br />	
	<strong>Contacts: </strong>" . $cell . "<br />
	<strong>Surname: </strong>"  . $address . "<br />
	<strong>Contacts: </strong>" . $company . "<br />
	<strong>Contacts: </strong>" . $province . "<br />
	<strong>Date of Birth: </strong>" . $industry;	

mail($email, $subject2, $email_body, $headers2);

// Assuming there's no error, send the email and redirect to Thank You page
if( mail($to_email, $subject, $email_body, $headers) ) {

	$firstname = $_REQUEST['firstname'];
	$lastname =  $_REQUEST['lastname'];
	$email = $_REQUEST['email'];
	$cell = $_REQUEST['cell'];
	$address = $_REQUEST['address'];
	$company = $_REQUEST['company'];
	$province = $_REQUEST['province'];
	$industry = $_REQUEST['industry'];
	
	// Create connection
	$conn = new mysqli($servername, 
		$username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " 
			. $conn->connect_error);
	}
	
	$sql = "INSERT INTO masterclass VALUES
	('$firstname', '$lastname', '$email', '$cell', '$address', '$company', '$province',  '$industry')";

/*
	if ($conn->query($sql) === TRUE) {
		echo "record inserted successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	*/
	$form_data['success'] = true;

}

if($conn->query($sql) === TRUE)	
	$form_data['success'] = true;
else
	$form_data['success'] = false;

echo json_encode($form_data);
return;
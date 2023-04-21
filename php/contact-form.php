<?php
// Information to be modified
$to_email = "kabelo@dithetogroup.co.za"; // email address to which the form data will be sent
//$to_email = "mathipa87@gmail.com"; // email address to which the form data will be sent
$subject = "2023 Mentee Application"; // subject of the email that is sent
$subject2 = "Copy of your 2023 Mentee Application";
$headers = 'From: admin@wipa.co.za' . "\r\n" .
    'Reply-To: admin@wipa.co.za' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$headers2 = 'From: admin@wipa.co.za' . "\r\n" .
'Reply-To: admin@wipa.co.za' . "\r\n" .
'X-Mailer: PHP/' . phpversion();

$servername = "localhost";
$username = "dithetog_clientsubmission";
$password = "D!eth3t0ClientS3b$$";
$dbname = "dithetog_form_submissions";

$name = strip_tags($_POST["name"]);
$surname = strip_tags($_POST["surname"]);
$contact_number = strip_tags($_POST["contact_number"]);
$age = strip_tags($_POST["age"]);
$email = strip_tags($_POST["email"]);
$occupation = strip_tags($_POST["occupation"]);
$nature_work = strip_tags($_POST["nature_work"]);
$goals_ambitions = strip_tags($_POST["goals_ambitions"]);
$expected_results = strip_tags($_POST["expected_results"]);
$ideal_mentor = strip_tags($_POST["ideal_mentor"]);

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: <' .$email. '>' . "\r\n";
$headers .= "Reply-To: ".$email."\r\n";

$headers2  = 'MIME-Version: 1.0' . "\r\n";
$headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers2 .= 'From: <' .$to_email. '>' . "\r\n";
$headers2 .= "Reply-To: ".$to_email."\r\n";

$email_body = 
	"<strong>Name: </strong><br />"  . $name . "<br /><br />
	<strong>Surname: </strong><br />"  . $surname . "<br /><br />
	<strong>Contact Number: </strong><br />" . $contact_number . "<br /><br />
	<strong>Age: </strong><br />" . $age . "<br /><br />
	<strong>Email Address: </strong><br />" . $email . "<br /><br />
	<strong>Occupation: </strong><br />" . $occupation . "<br /><br />
	<strong>Describe nature of your work/studies/business: </strong><br />" . $nature_work . "<br /><br />
	<strong>Goals and Ambition: </strong><br />" . $goals_ambitions . "<br /><br />
	<strong>Expected results from the mentorship: </strong><br />" . $expected_results . "<br /><br />
	<strong>Describe your Ideal mentor: </strong><br />" . $ideal_mentor;	

mail($email, $subject2, $email_body, $headers2);

// Assuming there's no error, send the email and redirect to Thank You page
if( mail($to_email, $subject, $email_body, $headers) ) {

	$name = $_REQUEST['name'];
	$surname = $_REQUEST['surname'];
	$contact_number = $_REQUEST['contact_number'];
	$age = $_REQUEST['age'];
	$email = $_REQUEST['email'];
	$occupation  = $_REQUEST['occupation'];
	$nature_work = $_REQUEST['nature_work'];
	$goals_ambitions = $_REQUEST['goals_ambitions'];
	$expected_results = $_REQUEST['expected_results'];
	$ideal_mentor = $_REQUEST['ideal_mentor'];
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " 
			. $conn->connect_error);
	}

	$sql = "INSERT INTO womaninpowerApplications VALUES
		('$name', '$surname', '$contact_number', '$age', '$email', '$occupation', '$nature_work', '$goals_ambitions', '$expected_results', '$ideal_mentor')";
	
	if ($conn->query($sql) === TRUE) {
		echo "record inserted successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	header("Location: ../thank-you.html");
	exit();
	} 
	else {
		header("Location: ../error.html");
	exit();
}
<?php

$url = 'https://api.sendgrid.com/';
$user = 'azure_6cd3595481d441773874cb0aadd2ae8a@azure.com';
$pass = '1tccontactform!';

// Values from contact form_message
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$company = $_POST['company'];
$message = $_POST['message'];

$fields = array('name' => 'Name', 'company' => 'Company', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message');

$emailText = "You have new message from Travelers Capital Contact Form\n=============================\n";
foreach ($_POST as $key => $value) {

    if (isset($fields[$key])) {
        $emailText .= "$fields[$key]: $value\n";
    }
}

$emailHTML = "<h1>New Message from Travelers Capital Form:</h1>";
foreach ($_POST as $key => $value) {

    if (isset($fields[$key])) {
        $emailHTML .= "<p><strong>$fields[$key]:</strong> $value</p>";
    }
}

$params = array(
    'api_user'  => $user,
    'api_key'   => $pass,
    'to'        => 'me@ryanmurray.ca',
    'subject'   => 'Travelers Capital Contact Form',
    'html'      => $emailHTML,
    'text'      => $emailText,
    'from'      => 'info@travelerscapital.ca',
  );


$request =  $url.'api/mail.send.json';

// Generate curl request
$session = curl_init($request);
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
// Tell PHP not to use SSLv3 (instead opting for TLS)
curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
$response = curl_exec($session);
curl_close($session);

// print everything out
print_r($response);

?>

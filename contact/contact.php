<?php

// require ReCaptcha class
require('recaptcha-master/src/autoload.php');

// SendGrid account details
$url = 'https://api.sendgrid.com/';
$user = 'ENTER SENDGRID USERNAME HERE'; // Enter your SendGrid username
$pass = 'ENTER PASSWORD HERE';  // Enter your SendGrid password

// Values from contact form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$company = $_POST['company'];
$message = $_POST['message'];

// Set success and error messages
$okMessage = 'Your message was sent successfully. Thank you, we will get back to you soon!';
$errorMessage = 'There was an error while submitting the form. Please try again later';

// Google ReCaptcha secret key
$recaptchaSecret = '6LclYkAUAAAAAOz31P0DZPAoakjYQU7fr8SlA39o';

// Array variable name => text to appear in the email
$fields = array('name' => 'Name', 'company' => 'Company', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message');

// Send Email
try {
  if (!empty($_POST)) {

    // Validate ReCaptch, if something is wrong, throw exception
    if (!isset($_POST['g-recaptcha-response'])) {
      throw new \Exception('ReCaptch is not set.');
    }

    // Validating ReCaptcha field
    $recaptcha = new \ReCaptcha\ReCaptcha($recaptchaSecret, new \ReCaptcha\RequestMethod\CurlPost());
    $response = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

    if (!$response->isSuccess()) {
        throw new \Exception('ReCaptcha was not validated.');
    }

    // Everything went well, begin composing email

    // Plain text version of email
    $emailText = "You have new message from Travelers Capital Contact Form\n=============================\n";
    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    // HTML version of email
    $emailHTML = "<h1>New Message from Travelers Capital Form:</h1>";
    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailHTML .= "<p><strong>$fields[$key]:</strong> $value</p>";
        }
    }

    $params = array(
      'api_user'  => $user,
      'api_key'   => $pass,
      'to'        => 'info@travelerscapital.com'
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

    // Send response back to html
    $responseArray = array('type' => 'success', 'message' => $okMessage);
  }
}

catch (\Exception $e) {
  $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['message'];
}

?>

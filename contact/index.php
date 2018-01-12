<?php

require_once "recaptchalib.php";

if (isset($_POST["submit"])) {
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$company = $_POST['company'];
$message = $_POST['message'];

$from = 'Travelers Capital Contact Form';
$to = 'me@ryanmurray.ca';
$subject = "Message from $name via Travelers Capital Contact Form";

$body = "From: $name\nE-mail: $email\nPhone Number: $number\nCompany: $company\n\nMessage:\n$message";

// Check if name has been entered
if (!$_POST['name']) {
	$errName = 'Please enter your name';
}

// Check if email has been entered and is valid
if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	$errEmail = 'Please enter a valid email address';
}

//Check if message has been entered
if (!$_POST['message']) {
	$errMessage = 'Please enter your message';
}

//Check if reCAPTCHA had been checked
if(isset($_POST['g-recaptcha-response'])){
  $captcha=$_POST['g-recaptcha-response'];
}
if(!$captcha){
  $captchaAlert = '<div class="alert alert-danger">Please check the captcha form.</div>';
  exit;
}

$secretKey = "6LclYkAUAAAAAOz31P0DZPAoakjYQU7fr8SlA39o";
$ip = $_SERVER['REMOTE_ADDR'];
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
$responseKeys = json_decode($response,true);
if(intval($responseKeys["success"]) !== 1) {
  $captchaAlert = '<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
} else {
  // If there are no errors, send the email
  if (!$errName && !$errEmail && !$errMessage) {
  	if (mail ($to, $subject, $body, $from)) {
  		$result = '<div class="alert alert-success"><strong>Thank You!</strong> We will be in touch</div>';
  	} else {
  		$result = '<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
  	}
  }
}

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- FAVICONS -->
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/manifest.json">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#ef3e33">
    <link rel="shortcut icon" href="/favicon/favicon.ico">
    <meta name="msapplication-config" content="/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <title>Contact Us | Travelers Capital</title>
    <meta name="Copyright" content="Travelers Capital Corporation" />
    <meta name="description" content="Based out of Vancouver, BC, Travelers Capital is ready to service clients across the country. Contact us today." />
    <link rel="canonical" href="https://www.travelerscapital.com/contact" />

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="/dist/css/style.min.css">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">

    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body>

    <!-- ////  NAVIGATION  //// -->
    <nav class="navbar navbar-toggleable-sm navbar-inverse navbar-bg fixed-top">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="icon-nav">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand" href="/"></a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="/">Home</a>
          <a class="nav-item nav-link" href="/services">Services</a>
          <a class="nav-item nav-link" href="/team">Team</a>
          <a class="nav-item nav-link" href="/transactions">Transactions</a>
          <a class="nav-item nav-link active" href="/contact">Contact</a>
        </div>
      </div>
    </nav>

    <!-- ////  SECTION 1  //// -->
    <section id="contact--section-1" class="jumbotron jumbotron-fluid">
      <div class="container">
        <div class="row justify-content-start">
          <div class="col-md-8 text-left">
            <h1 class="text-uppercase text-white">How can we help?</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- ////  SECTION 2  //// -->
    <section class="container my-6">
      <div class="row justify-content-center">
        <div class="col-md-10 col-xl-8 text-center">
          <h3 class="text-uppercase mt-2">As a leading provider of mid-market financing solutions, Travelers Capital stands ready to support the growth of your company.</h3>
        </div>
      </div>
    </section>

    <!-- ////  SECTION 3  //// -->
    <section class="container mb-6">
      <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4 mb-3">

          <div class="row mb-3 justify-content-center">
            <div class="col">
              <div class="row">
                <div class="col-12 col-md-1 text-center text-md-left icon-sm-sizeup">
                  <span class="icon icon-address"></span>
                </div>
                <div class="col-12 col-md-11 text-center text-md-left text-sm-sizeup">
                  <a href="https://goo.gl/maps/kJp9otJwSGx" target="_blank">
                    Suite 400
                    <br />4180 Lougheed Hwy
                    <br />Burnaby, BC V5C 6A7
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="row mb-3 justify-content-center">
            <div class="col">
              <div class="row">
                <div class="col-12 col-md-1 text-center text-md-left icon-sm-sizeup">
                  <span class="icon icon-email"></span>
                </div>
                <div class="col-12 col-md-11 text-center text-md-left text-sm-sizeup">
                  <!-- <a href="mailto:info@travelerscapital.com" target="_top"> -->
                    info@travelerscapital.com
                  <!-- </a> -->
                </div>
              </div>
            </div>
          </div>

          <div class="row mb-3 justify-content-center">
            <div class="col">
              <div class="row">
                <div class="col-12 col-md-1 text-center text-md-left icon-sm-sizeup">
                  <span class="icon icon-phone"></span>
                </div>
                <div class="col-12 col-md-11 text-center text-md-left text-sm-sizeup">
                  <a href="tel:1-844-211-8866" target="_top">1.844.211.8866</a>
                </div>
              </div>
            </div>
          </div>

          <div class="row hidden-md-up">
            <div class="col">
                <hr />
            </div>
          </div>
        </div>

        <div class="col-md-7 col-lg-6">
          <p class="text-center text-md-left">Please contact us to see how Travelers Capital can put its solutions to work for your business.</p>
          <form role="form" method="post" action="" id="contact-form">
            <div class="form-group">
              <label for="InputName">Name</label>
              <input type="text" class="form-control" id="InputName" name="name" aria-describedby="EnterName" value="<?php echo htmlspecialchars($_POST['name']); ?>" required>
              <?php echo "<p class='text-danger'>$errName</p>";?>
            </div>
            <div class="form-group">
              <label for="InputEmail">E-mail Address</label>
              <input type="text" class="form-control" id="InputEmail" name="email" aria-describedby="EnterEmail" value="<?php echo htmlspecialchars($_POST['email']); ?>" required>
              <?php echo "<p class='text-danger'>$errEmail</p>";?>
            </div>
            <div class="form-group">
              <label for="InputNumber">Phone Number</label>
              <input type="text" class="form-control" id="InputNumber" name="number" aria-describedby="EnterNumber" value="<?php echo htmlspecialchars($_POST['number']); ?>">
            </div>
            <div class="form-group">
              <label for="InputCompany">Your Company</label>
              <input type="text" class="form-control" id="InputCompany" name="company" aria-describedby="EnterCompany" value="<?php echo htmlspecialchars($_POST['company']); ?>">
            </div>
            <div class="form-group">
              <label for="InputMessage">Message</label>
              <textarea class="form-control" id="InputMessage" name="message" rows="4" required><?php echo htmlspecialchars($_POST['message']); ?></textarea>
              <?php echo "<p class='text-danger'>$errMessage</p>";?>
            </div>
            <div class="form-group">
              <div class="g-recaptcha" data-sitekey="6LclYkAUAAAAALpdS88KfjO5QTONkC8TyzgtxWxO"></div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <button id="submit" name="submit" type="submit" class="btn btn-outline-primary-icon"><span class="align-middle">Submit</span>
                    <svg class="icon" viewBox="0 0 24 24">
                      <g>
                        <polygon points="4.008 18.714 20 11.857 4.008 5 4 10.333 15.429 11.857 4 13.381"/>
                      </g>
                    </svg>
                  </button>
                </div>
                <div class="form-group">
                  <?php echo $result; ?>
                  <?php echo $captchaAlert; ?>
                </div>
              </div>
            </div>
          </form>
        </div>

      </div>
    </section>

    <!-- ////  FOOTER  //// -->
    <footer>
      <div class="fluid-container">
        <div class="container py-5">

          <div class="row mb-3">
            <div class="col-12 col-md-6 offset-md-3 text-center">
              <a class="footer-brand" href="/"></a>
              <p class="mt-3">Travelers Capital is a unit of Travelers Financial Group, a leading provider of equipment financing solutions since 1986.</p>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <hr />
              <div class="nav flex-column flex-sm-row justify-content-center text-center">
                <a class="nav-link" href="/services">Services</a>
                <a class="nav-link" href="/team">Team</a>
                <a class="nav-link" href="/transactions">Transactions</a>
                <a class="nav-link" href="/contact">Contact</a>
              </div>
              <hr />
              <div class="nav flex-column flex-sm-row justify-content-center text-center">
                <a class="nav-link" href="tel:1-844-211-8866">
                  <svg class="icon" width="24px" height="24px" viewBox="0 0 32 32">
                    <g>
                      <path d="M7.63111111,14.1177778 C9.87111111,18.52 13.48,22.1133333 17.8822222,24.3688889 L21.3044444,20.9466667 C21.7244444,20.5266667 22.3466667,20.3866667 22.8911111,20.5733333 C24.6333333,21.1488889 26.5155556,21.46 28.4444444,21.46 C29.3,21.46 30,22.16 30,23.0155556 L30,28.4444444 C30,29.3 29.3,30 28.4444444,30 C13.8377778,30 2,18.1622222 2,3.55555556 C2,2.7 2.7,2 3.55555556,2 L9,2 C9.85555556,2 10.5555556,2.7 10.5555556,3.55555556 C10.5555556,5.5 10.8666667,7.36666667 11.4422222,9.10888889 C11.6133333,9.65333333 11.4888889,10.26 11.0533333,10.6955556 L7.63111111,14.1177778 L7.63111111,14.1177778 Z"></path>
                    </g>
                  </svg>
                  1.844.211.8866
                </a>
                <a class="nav-link" href="mailto:info@travelerscapital.com">
                  <svg class="icon" width="24px" height="24px" viewBox="0 0 32 32">
                    <g>
                      <path d="M30,7.42227113 L16,15 L2,7.42227113 L2,6 L30,6 L30,7.42227113 Z M30,9.64737283 L30,26 L2,26 L2,9.64737283 L15.375305,16.7808688 C15.7405236,17.0730437 16.2594764,17.0730437 16.624695,16.7808688 L30,9.64737283 Z"></path>
                    </g>
                  </svg>
                  info@travelerscapital.com
                </a>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="fluid-container copyright">
        <div class="container">
          <div class="row">
            <div class="col text-center">
              <p class="text-white my-3">Copyright &copy; 2018 Travelers Capital Corporation</p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="/dist/js/custom.js"></script>
  </body>
</html>

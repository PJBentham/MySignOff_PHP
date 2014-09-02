<?php 
include("assets/includes/data.php");
include("register/secure/db_connect.php");
include("register/secure/functions.php");
include("assets/php/functions.php");
require_once('assets/php/phpmailer/PHPMailer-master/class.phpmailer.php');
// function redirect() {
//     header('Location: http://www.mysignoff.co.uk/home/index.php');
// }
sec_session_start(); // Our custom secure way of starting a php session.
// if(login_check($mysqli) == true) { 
// 	redirect();
// } else {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<!-- Just testing git -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Sign Off - Online Sign Off Solution</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-theme.css" rel="stylesheet">
	<link href="../assets/css/style.css" rel="stylesheet">
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-53558267-1', 'auto');
	  ga('send', 'pageview');
	</script>
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script src="register/js/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>

	<script src="assets/js/bootstrap.min.js"></script>
	<script src="register/js/bootstrap.min.js"></script>

	<script src="register/secure/sha512.js"></script>
	<script src="register/secure/forms.js"></script>
  </head>
<?php  
  	include("assets/includes/header.php");  
?>
<body>
	<div id="header">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h2 class="subtitle">The fastest, simplest &amp; greenest solution for returning on site sign-off documents!</h2>
					<h5 class="subtitle">Do you require a timesheet, job completion certificate or delivery notification to be completed as part of the service you offer?</h5>
					<h5 class="subtitle">Is a physical signature a part of this requirement?</h5>
					<h5 class="subtitle">Mysignoff.co.uk can help you achieve this by giving your members of staff a portal to log into on their smart phone / tablet, complete a form &amp; pass their device to your customer for a real signature! <a href="http://mysignoff.co.uk/example">(See example here)</a></h5>
					<h5 class="subtitle">Once the form is submitted it gets translated onto a PDF document and emailed to whomever you choose (more than one email possible).  <a href="http://www.mysignoff.co.uk/example/exampledb.php">It can also be uploaded to a database which can be sorted by date, location, job number etc...</a></h5>
					<h5 class="subtitle">There are many huge benefits to your business:</h5>
					<ul class="page1list">
						<li><p>Fast! - No need to wait for your employee to return a signed paper document</p></li>
						<li><p>Simple! - No convoluted processes to go through, complete a form, sign , submit... that's it.</p></li>
						<li><p>Green! - Allowing the full sign off process to be paperless</p></li>
						<li><p>Digital! - Need to send on the document? no need to scan in a paper sheet as you already have a pdf copy you can send.</p></li>
	        			<li><p>Mobile! - Available on most smart phones / tablets with a modern browser.</p></li>
					</ul>
					<h5 class="subtitle">If you're interested in saving your business time &amp; money, enter your email below and we will be in touch very soon to see how we can help you best achieve an online sign off.</h5>
					<form class="form-inline signup" role="form" method="POST">
					  	<div class="form-group">
					    	<input type="email" class="form-control" name="interestemail" placeholder="Enter your email address">
					  	</div>
					  	<button type="submit" class="btn btn-theme">Request Details</button>
					</form>					
					<?php				  	
					  	checkMail($_POST["interestemail"]);
					?>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-offset-1">
                    <form action="register/secure/process_login.php" method="post" name="login_form" class="form-horizontal">
                        <div class="control-group">
                            <div class="controls">
	                            <label class="control-label" for="inputEmail">Email</label>
	                            <input type="text" id="email" name="email"placeholder="Email">
	                        	<label class="control-label" for="inputPassword">Password</label>
	                          	<input type="password" name="password" id="password" placeholder="Password">
	                          	<input type="hidden" name="p" id="p" value="">
	                          	<br>
	                          	<div style="padding-top:15px;" class="row">
									<div class="col-lg-6 col-lg-offset-8">
		                        		<button type="submit" class="btn" onclick="formhash(this.form, this.form.password);">Sign in</button>
        	                    <!-- if login failed show this -->
                               
            		        </div>
                		</div>
            		</form>
        		</div>
			</div>		
		</div>	
	</div>
</body>	
</html>

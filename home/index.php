<?php
include("../assets/includes/data.php");
include ("../register/secure/db_connect.php");
include ("../register/secure/functions.php");
sec_session_start(); // Our custom secure way of starting a php session.
if(login_check($mysqli) == true) { 
$user = $_SESSION['username'];
?>
<?php
include("../assets/includes/header.php");
?>
<body>
	<div class="container">
			<div class="row">
				<div class="col-lg-6 ">
					<h2 style="padding-top: 80px; color: SlateGray;">Your projects:</h2>
					<?php
						getProjects($user);
					?>
</body> 
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
<?php } else {
   echo 'You are not authorized to access this page, please login. <br/>';
}
;?>
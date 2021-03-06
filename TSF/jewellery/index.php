<?php
include("../../assets/includes/data.php");
include ("../../register/secure/db_connect.php");
include ("../../register/secure/functions.php");
sec_session_start(); // Our custom secure way of starting a php session.
if(login_check($mysqli) == true) { 
	$user = $_SESSION['username'];
  $url = 'TSF/jewellery/index.php';
	if(checkValidProjectMember($user, $url) == true) {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/img/favicon.png">
    <title>My Sign Off - Online Sign Off Solution</title>
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">
  	<link href="../../assets/css/bootstrap-theme.css" rel="stylesheet">
    <link href="../../assets/css/style.css" rel="stylesheet">
  </head>
  <header>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://mysignoff.co.uk">My Sign Off (BETA)</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
            <li><a href="http://mysignoff.co.uk">Home</a></li>
            <?php 
              if(isset($_SESSION['username'])){
                echo "<li><a href='../../register/logout.php'>Logout</a></li>";
              }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </header>  
<body>
	<div class="col-lg-6 col-lg-offset-3" style="padding-top: 75px; max-width: 900px;">
		<table class="table sortable table-striped table-responsive table-hover table-bordered" >
    <tr>
      <th>File</th>
      <th>Location</th>
      <th>Job Number</th>
      <th>PO Number</th>
      <th>Date</th>
      <th>Name</th>
      <th>Photo</th>
    </tr>
    <?php
      getSignOffs($items);
    ?>    	
		</table>
	</div>	
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/sorttable.js"></script>
</body>	
</html>
<?php 
	} else {
	   echo 'You are not authorized to access this page, please login. <br/>';
	}
} else {
   echo 'You are not authorized to access this page, please login. <br/>';
}
;?>

	
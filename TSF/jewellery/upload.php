<?php 
header("Access-Control-Allow-Origin: *");
include("../../assets/includes/data.php");
include ("../../register/secure/db_connect.php");
include ("../../register/secure/functions.php");
sec_session_start(); // Our custom secure way of starting a php session.
if(login_check($mysqli) == true) { 
  $user = $_SESSION['username'];
  $url = 'TSF/jewellery/upload.php';
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
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <title>My Sign Off - Online Sign Off Solution</title>
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">
  	<link href="../../assets/css/bootstrap-theme.css" rel="stylesheet">
    <link href="../../assets/css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script type="text/javascript">
	$(document).ready(function(){
		$('#file1').bind('change', function() {
			if(this.files[0].size > 550000)
	    	alert('This file is too big, reduce the quality on your camera and try again.');
		});
	});
	</script>
	<script type="text/javascript">
	function _(el){
	  return document.getElementById(el);
	}
	function uploadFile(){
	  var form = _("form1"); 
	  var file = _("file1").files[0];
	  //alert(file.name+" | "+file.size+" | "+file.type);
	  var formdata = new FormData(form);
	  formdata.append("file1", file);
	  var ajax = new XMLHttpRequest();
	  ajax.upload.addEventListener("progress", progressHandler, false);
	  ajax.addEventListener("load", completeHandler, false);
	  //ajax.open("POST", "file_upload_parser.php");
	  ajax.open("POST", "../../assets/php/actiontest.php", true);
	  ajax.send(formdata);
	}
	function progressHandler(event){
	  var percent = (event.loaded / event.total) * 100;
	  _("progressBar").value = Math.round(percent);
	}
	function completeHandler(event){
	  _("progressBar").value = 0;
	}
	</script>
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
	<link href="../../assets/css/form.css" rel="stylesheet">
<body>	
	<div id="body1">
		<?php 
			if(isset($_GET["sub"]) && $_GET["sub"] == 1){
				echo "<h1 style='color: #196619; text-align: center;'>Your last form was submitted succesfully!</h1>";
			};
		?>
		<header><img src=""><p>Example Company<br>Job Completion Certificate</p></header>
		<form method="post" action="../../assets/php/actiontest.php" id="form1" name='mainForm' enctype="multipart/form-data" OnSubmit="return CheckForm()">
		<input type="text" id="Customer "name="Customer" placeholder="Customer" required/><br>
		<input type="text" name="Location" placeholder="Job Location" required/><br>
		<input type="text" name="PNumber" placeholder="PO Number (if known...)" required/><br>
		<input type="text" name="JNumber" placeholder="Job Number (if known...)" required/><br>
		<input type="text" id="Date1" name="Date1" placeholder="Date" required/><br>
		<input type="text" name="Receipt" placeholder="Value of Receipt" required/><br><br>
		<p>I confirm that the above job has been completed to my satisfaction and Example Company are authorised to raise their final invoice.</p><br>
		<p>Signed for on behalf of Customer: </p>
	    <div id="signature-pad" class="m-signature-pad">
	    	<canvas id="signatureCanvas"></canvas>
	    </div>
	    <input type="hidden" name="signature" id="signature" value=""/>
	    <a data-action="clear" href="#" id="clearButton">Clear Signature Box</a>
		<input type="text" name="Name" placeholder="Print Name" required/><br>
		<input type="text" name="Position" placeholder="Position in Company" required/><br>
		<input type="text" id="Date2" name="Date2" placeholder="Date of Signature" required/>
		<p>Please attach a photo of the completed works (max file size 500kb):</p>
		<input type="file" name="file1" id="file1"><br>
		<!--<input type="file" name="file2" id="file2"><br>
		<input type="file" name="file3" id="file3"><br>-->
		<input type="button" value="Upload File" onclick="uploadFile()">
		<progress id="progressBar" value="0" max="100" style="width:100%;"></progress>
		<!--<input type="submit" id="submit" />-->		
		</form>	
	</div>
</body>	
	<script src="../../assets/js/signature_pad.js"></script>
	<script src="../../assets/js/form.js"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
</html>
<?php 
	} else {
	   echo 'You are not authorized to access this page, please login. <br/>';
	}
} else {
   echo 'You are not authorized to access this page, please login. <br/>';
}
;?>

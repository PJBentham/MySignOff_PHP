<?php 
header("Access-Control-Allow-Origin: *");
include("../../assets/includes/data.php");
include ("../../register/secure/db_connect.php");
include ("../../register/secure/functions.php");
sec_session_start(); // Our custom secure way of starting a php session.
if(login_check($mysqli) == true) { 
  $user = $_SESSION['username'];
  $url = 'TSF/freezer/upload.php';
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
	function _(el){
	  return document.getElementById(el);
	}
	function uploadFile(){
	  var form = _("form1"); 
	  var file = _("file1").files[0];
	  var formdata = new FormData(form);
	  formdata.append("file1", file);
	  var ajax = new XMLHttpRequest();
	  ajax.upload.addEventListener("progress", progressHandler, false);
	  ajax.addEventListener("load", completeHandler, false);
	  ajax.open("POST", "../../assets/php/actionfreezer.php", true);
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
		<header><img src="http://www.q-cumber.co.uk/wp-content/uploads/2014/02/tesco_logo_transparent.png"><h4>Quality Scorecard for Installation Projects</h4></header>
		<form method="post" action="../../assets/php/actionfreezer.php" id="form1" name='mainForm' enctype="multipart/form-data">
		<!--<input type="hidden" id="ProjectName" name="ProjectName" placeholder="Project Name" value="Click and Collect"/><br>-->
		<input type="text" id="Date1" name="Date1" placeholder="Completion Date" required/><br>
		<input type="text" name="StoreNumber" placeholder="Store Number" required/><br>
		<input type="textarea" name="FitterComments" placeholder="Fitter Comments... State how many shelves only recieved T-Rails"/><br>
		<p>Confirm that the 'equipment left behind' checklist has been completed (take a photo of the kit in its left location. Email the photo to markrobinson@tsf.uk.com).</p>
		<input type="radio" value="True" name="eqlb"><p id="radiobutton">True </p><br />
		<input type="radio" value="False" name="eqlb"><p id="radiobutton">False </p><br />
		<input type="textarea" name="eqlbcom" placeholder="Equipment Comments..."/><br>
		<hr>
		<h4>The following is to be completed by the store manager / supervisor on duty:</h4>
		<p>A re-visit is required to resolve outstanding issues (If a Revisit is required Scorecard automatic Red)</p>
		<input type="radio" value="True" name="revisit"><p id="radiobutton">True </p><br />
		<input type="radio" value="False" name="revisit"><p id="radiobutton">False </p><br />
		<input type="textarea" name="reviscom" placeholder="Comments..."/><br>
		<p>Store handed back fit for trade, with no snags reported (If False, please record snags in comments), i.e. all waste/materials cleared from site, fixtures clean and ready for merchandising, the area is fit for trade</p>
		<input type="radio" value="True" name="fittrade"><p id="radiobutton">True </p><br />
		<input type="radio" value="False" name="fittrade"><p id="radiobutton">False </p><br />
		<input type="textarea" name="fitcom" placeholder="Comments..."/><br>
		<p>The Permit To Work and Visitor Sign-In Book has been completed?</p>
		<input type="radio" value="True" name="permit"><p id="radiobutton">True </p><br />
		<input type="radio" value="False" name="permit"><p id="radiobutton">False </p><br />
		<input type="textarea" name="permitcom" placeholder="Comments..."/><br>
		<p>The supplier / fitter was suitablly dressed, polite, worked professionally at all times and there was no unplanned disruption to the store.</p>
		<input type="radio" value="True" name="dressed"><p id="radiobutton">True </p><br />
		<input type="radio" value="False" name="dressed"><p id="radiobutton">False </p><br />
		<input type="textarea" name="dressedcom" placeholder="Comments..."/><br>
		<p>Disruption signage displayed on hoarding (if not applicable, mark as True):</p>
		<input type="radio" value="True" name="disruption"><p id="radiobutton">True </p><br />
		<input type="radio" value="False" name="disruption"><p id="radiobutton">False </p><br />
		<input type="textarea" name="disruptioncom" placeholder="Comments..."/><br>
		<p>The supplier contacted the store to arrange a time and the fitter arrived at the agreed time</p>
		<input type="radio" value="True" name="called"><p id="radiobutton">True </p><br />
		<input type="radio" value="False" name="called"><p id="radiobutton">False </p><br />
		<input type="textarea" name="calledcom" placeholder="Comments..."/><br>
		<p>The completed work reflects the 'What Good Looks Like' photograph? (if WGLL photograph not available, you agreed the work has been delivered to an acceptable standard)</p>
		<input type="radio" value="True" name="wgll"><p id="radiobutton">True </p><br />
		<input type="radio" value="False" name="wgll"><p id="radiobutton">False </p><br />
		<input type="textarea" name="wgllcom" placeholder="Comments..."/><br>
		<p>The store received a Workplan prior to installation about this project. Or, you were visited to inform you of the works and given accurate information.</p>
		<input type="radio" value="True" name="workplan"><p id="radiobutton">True </p><br />
		<input type="radio" value="False" name="workplan"><p id="radiobutton">False </p><br />
		<input type="textarea" name="workplancom" placeholder="Comments..."/><br>
		<p>Any outstanding next steps from the pre-visit were completed. (If no tasks required, then mark True)</p>
		<input type="radio" value="True" name="complete"><p id="radiobutton">True </p><br />
		<input type="radio" value="False" name="complete"><p id="radiobutton">False</p><br />
		<input type="textarea" name="completecom" placeholder="Comments..."/><br>
		<p>The store recieved and is in possesion of the spares Frozen Pushers kit parts, provided by the installer.</p>
		<input type="radio" value="True" name="spares"><p id="radiobutton">True </p><br />
		<input type="radio" value="False" name="spares"><p id="radiobutton">False</p><br />
		<input type="textarea" name="sparescom" placeholder="Comments..."/><br>
		<p>Please confirm you are the Store Champion for this project</p>
		<input type="radio" value="True" name="champion"><p id="radiobutton">True </p><br />
		<input type="radio" value="False" name="champion"><p id="radiobutton">False</p><br />
		<input type="textarea" name="championcom" placeholder="Comments..."/><br>
		<p>Every shelf has had T-rails installed, including discretionary and clearance mods</p>
		<input type="radio" value="True" name="trails"><p id="radiobutton">True </p><br />
		<input type="radio" value="False" name="trails"><p id="radiobutton">False</p><br />
		<input type="textarea" name="trailscom" placeholder="Comments..."/><br>
		<p>General Comments:</p>
		<input type="textarea" name="GeneralComments" placeholder="Your Comments..."/><br>
		<input type="text" name="Name" placeholder="Managers Name" required/><br>
		<p>Signature: </p>
	    <div id="signature-pad" class="m-signature-pad">
	    	<canvas id="signatureCanvas"></canvas>
	    </div>
	    <input type="hidden" name="signature" id="signature" value=""/>
	    <a data-action="clear" href="#" id="clearButton">Clear Signature Box</a>
		<input type="text" name="JobTitle" placeholder="Job Title" required/><br>
		<input type="text" id="Date2" name="Date2" placeholder="Date of Signature" required/>
		<p>Job Score:</p>
		<input type="radio" value="Green" name="Trafficlight"><p id="radiobutton" style="color: green;">Green</p><br />
		<input type="radio" value="Red" name="Trafficlight"><p id="radiobutton" style="color: red;">Red</p><br />
		<p>Please attach a photo of the completed works:</p>
		<input type="file" name="file1" id="file1"><br>
		<input type="button" value="Upload File" onclick="uploadFile()">
		<progress id="progressBar" value="0" max="100" style="width:100%;"></progress>
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
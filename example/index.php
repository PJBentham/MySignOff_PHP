<?php
	include("../assets/includes/header.php");
?>
<link href="../assets/css/form.css" rel="stylesheet">
<body>
	<div id="body1">
		<header><img src=""><p>Example Company<br>Job Completion Certificate</p></header>
		<form action="../assets/php/action.php" method="post" name='mainForm' enctype="multipart/form-data" OnSubmit="return CheckForm()">
		<input type="text" name="Customer" placeholder="Customer" required/><br>
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
		<!--<p>Please attached 3 photo's of the completed works: </p>
		<input type="file" name="file1" id="file1"><br>
		<input type="file" name="file2" id="file2"><br>
		<input type="file" name="file3" id="file3"><br>-->
		<p><input type="submit" /></p>
		</form>
	</div>
	<script src="../assets/js/signature_pad.js"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
	<script type='text/javascript' src="../assets/js/form.js"></script>
	</body>
</html>

<?php
include("../assets/includes/data.php");
include ("secure/db_connect.php");
include ("secure/functions.php");
sec_session_start(); // Our custom secure way of starting a php session.
if(login_check($mysqli) == true) { 
  if($_SESSION['username'] == 'PaulTSF'){
?>
<?php
  	include("../assets/includes/header.php");  
?>
  <body>
  	<p>Registration Form</p>
      <div class="row">
          <div style="padding-top: 100px; padding-left: 40px;" class="col-sm-3 col-sm-offset-3">
           <form action="secure/sec_reg.php" method="post" name="registration_form" class="form-horizontal">
            <div class="control-group">
              <label class="control-label" for="inputUser">Username</label>
              <div class="controls">
                <input type="text" id="username" name="username"placeholder="Username">
            </div>
            <div class="control-group">
              <label class="control-label" for="inputEmail">Email</label>
              <div class="controls">
                <input type="text" id="email" name="email"placeholder="Email">
            </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputPassword">Password</label>
          <div class="controls">
            <input type="password" name="password" id="password" placeholder="Password">
            <input type="hidden" name="p" id="p" value="">
        </div>
    </div>
    <div style="padding-top: 20px;" class="control-group">
      <div class="controls">
          <button type="submit" class="btn" onclick="formhash(this.form, this.form.password, this.form.p);">Register</button>
                           
      </div>
  </div>
  </form>
  </div>
  </div>
  </div>
  <script src="js/jquery-1.8.2.min.js"></script>
  <script src="http: code.jquery.com/jquery-latest.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="secure/sha512.js"></script>
  <script src="secure/forms.js"></script>
  <?php 
    } else {
      echo "<p>invalid</p>";
    };
  } else {
    echo "<p>invalid</p>";
  };
  ?>
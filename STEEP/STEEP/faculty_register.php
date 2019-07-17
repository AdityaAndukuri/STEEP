<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
	<script>
	  function ValidateEmail(email_input) {
		var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
		if (!reg.test(email_input.value)) {
			alert("You have entered an invalid email address!");
			email_input.value = "";
			return false;
		}

		else {
			return true;
		}
	}
	function validatePhone(phone_input) {
		var reg = /^[6-9]{1}[0-9]{9}$/
		if (reg.test(phone_input.value)) {
			return true;
		} else {
			alert("Enter valid mobile number!!");
			phone_input.value = "";
			return false;
		}
	}
	function passwordValidation(password_input) { //8 to 20 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character
		if (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/
				.test(password_input.value)) {
			return true;
		} else {
			alert("Invalid password!");
			password_input.value="";
			return false;
		}
	}
	function validateid(p_id) {
		var reg = /^[0-9]{4}$/
		if (reg.test(p_id.value)) {
			return true;
		} else {
			p_id.value = "";
			alert("Enter valid id");
			return false;
		}
	}

	</script>
</head>
<body>
<div class="title">
		<h2>S.T.E.E.P</h2>
	</div>
	<div class="topnav">
	<a href="login.php">Home</a> 
		<a class="active" href=#>Sign-up</a> 
		
		    
	</div>

  <div class="header_reg">
  	<h2> Faculty Registration</h2>
  </div>
	
  <form method="post" class="form_reg" action="faculty_register.php">
  	<?php include('errors_faculty.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="fusername" value="<?php echo $fusername; ?>" placeholder="Enter Username"required>
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="femail" value="<?php echo $femail; ?>" placeholder=" Enter Emailid" onchange="ValidateEmail(this)" required>
  	</div>
		<div class="input-group">
  	  <label>ID</label>
  	  <input type="text" name="fid"
						 value="<?php echo $fid; ?>" placeholder="Eg:1961"
								onchange="validateid(this)"
							required>
  	</div>
		<div class="input-group">
  	  <label>Gender</label>
			<select name="fgender" value="<?php echo $fgender; ?>" required>
								<option value="male">Male</option>
								<option value="female"> Female </option>
								<option value="other"> Other </option>
								
						</select>
  	</div>
		<div class="input-group">
  	  <label>Date of Birth</label>
  	  <input type="date" value="<?php echo $fdob_str; ?>" name="fdob" required>
  	</div>
		<div class="input-group">
  	  <label>Phone No</label>
  	  <input type="tel" name="fphone"
						placeholder=" Enter phone number" value="<?php echo $fphone; ?>" onchange="validatePhone(this)"
						required>
</div>
		<div class="input-group">
  	  <label>Department</label>
  	  <select name="fdepartment" value="<?php echo $fdepartment; ?>" required>
								<option value="CSE"> CSE </option>
								<option value="IT"> IT </option>
								<option value="ECE"> ECE </option>
								<option value="EEE"> EEE </option>
								<option value="MECH"> MECH </option>
								<option value="CIVIL"> CIVIL </option>
						</select>
  	</div>
       <div class="input-group">
           <label>Designation</label>
           <select name="frole"  value="<?php echo $frole; ?>" required>
								<option value="Hod">HOD</option>
								<option value="Professor">Professor</option>
								<option value="Associate Professor">Associate Professor</option>
								<option value="Assistant Professor">Assistant Professor</option>
								<option value="Lab Incharge">Lab Incharge</option>
								<option value="Other">Other</option>
						</select>
        </div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="fpassword_1" placeholder="Enter Password"
							onchange="passwordValidation(this)" required>
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="fpassword_2" placeholder="Re-Enter Password"
							onchange="passwordValidation(this)" required>
		</div>
		<div class="input-group">
	<button type="reset" class="resetbtn" name="Reset">Reset</button>
	<button type="submit" class="submitbtn" name="reg_faculty">Sign-up</button>
</div>
	 <div class="input-group">
  	<p>
  		<br><br>Already a member? <a href="login.php">Sign in</a>
		</p>
</div>
  </form>
</body>
</html>
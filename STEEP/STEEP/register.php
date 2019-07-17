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
	function validateRoll(roll_input) {
		var reg = /^1602-[0-9]{2}-7[0-9]{2}-[0-9]{3}$/
		if (!reg.test(roll_input.value)) {
			alert("Invalid Roll Number");
			roll_input.value = "";
			return false;
		} else {
			true;
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
  	<h2> Student Registration</h2>
  </div>
	
  <form method="post" class="form_reg"  action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Enter Username"required>
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>" placeholder=" Enter Emailid" onchange="ValidateEmail(this)" required>
  	</div>
		<div class="input-group">
  	  <label>Roll No</label>
  	  <input type="text" name="roll"
							placeholder=" eg:1602-16-733-001" value="<?php echo $roll; ?>" onchange="validateRoll(this)"
							required>
  	</div>
		<div class="input-group">
  	  <label>Gender</label>
			<select name="gender" value="<?php echo $gender; ?>" required>
								<option value="male">Male</option>
								<option value="female"> Female </option>
								<option value="other"> Other </option>
								
						</select>
  	</div>
		<div class="input-group">
  	  <label>Date of Birth</label>
  	  <input type="date" value="<?php echo $dob_str; ?>" name="dob" required>
  	</div>
		<div class="input-group">
  	  <label>Phone No</label>
  	  <input type="tel" name="phone"
						placeholder=" Enter phone number" value="<?php echo $phone; ?>" onchange="validatePhone(this)"
						required>
  	</div>
		<div class="input-group">
  	  <label>Date of Admission</label>
  	  <input type="date" name="doa" value="<?php echo $doa_str; ?>" required>
  	</div>
		<div class="input-group">
  	  <label>Year</label>
  	  <select name="year" value="<?php echo $year; ?>" required>
								<option value="1"> 1</option>
								<option value="2"> 2 </option>
								<option value="3"> 3 </option>
								<option value="4"> 4 </option>
						</select>
  	</div>
		<div class="input-group">
  	  <label>Stream</label>
  	  <select name="stream" value="<?php echo $stream; ?>" required>
								<option value="CSE"> CSE </option>
								<option value="IT"> IT </option>
								<option value="ECE"> ECE </option>
								<option value="EEE"> EEE </option>
								<option value="MECH"> MECH </option>
								<option value="CIVIL"> CIVIL </option>
						</select>
  	</div>
  	<div class="input-group">
  	  <label>Section</label>
  	  <select name="section" value="<?php echo $section; ?>" required>
								<option value="A"> A </option>
								<option value="B"> B </option>
						</select>
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1" placeholder="Enter Password"
							onchange="passwordValidation(this)" required>
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2" placeholder="Re-Enter Password"
							onchange="passwordValidation(this)" required>
		</div>
		<div class="input-group">
	<button type="reset" class="resetbtn" name="Reset">Reset</button>
	<button type="submit" class="submitbtn" name="reg_user">Sign-up</button>
</div>
	 <div class="input-group">
  	<p>
  		<br><br>Already a member? <a href="login.php">Sign in</a>
		</p>
</div>
  </form>
</body>
</html>
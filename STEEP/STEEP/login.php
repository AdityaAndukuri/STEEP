<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="title">
		<h2>S.T.E.E.P</h2>
	</div>
	<div class="topnav">
		<a class="active" href="index.php">Home</a> 
		
		    
	</div>

<div class="split left">
<div class="centered">
  <div class="header">
  	<h2>Student Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="submitbtn" name="login_student">Login</button>
  	</div>
  	<p>
  		<br><br>Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
  </div>
</div>
<div class="split right">
<div class="centered">
  <div class="header">
  	<h2> Faculty Login</h2>
  </div>
  <form method="post" action="login.php">
  	<?php include('errors_faculty.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="fusername" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="fpassword">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="submitbtn" name="login_faculty">Login</button>
  	</div>
  	<p>
		<br><br>	Not yet a member? <a href="faculty_register.php">Sign up</a>
  	</p>
  </form>
</div>
</div>  
</body>
</html>

<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php include('server_add_course.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
      function validateid(c_id) {
		var reg = /^[0-9]{4}$/
		if (reg.test(c_id.value)) {
			return true;
		} else {
			c_id.value = "";
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
        <a href="index_faculty.php">Home</a> 
        <a class="active" href="#">Add Course</a>	
		<?php  if (isset($_SESSION['username'])) : ?>
        <a style="float:right;"   href="index_faculty.php?logout='1'">Sign-out</a>
        <a style="float:right;" href="#">Welcome <?php echo $_SESSION['username']; ?>!!</a>
		<?php endif ?>
	</div>
    <div class="header_reg">
  	<h2>Create Course</h2>
  </div>
	
  <form method="post" class="form_reg" action="Add_Course.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Course Name</label>
  	  <input type="text" name="c_name" value="<?php echo $c_name; ?>" placeholder="Enter Course Name"required>
  	</div>
  	<div class="input-group">
  	  <label>Course ID</label>
  	  <input type="text" name="c_id" value="<?php echo $c_id; ?>" placeholder="eg: C01" pattern="C[0-9]{1,2,3,4,5,6,7,8,9}" onchange="Validateid(this)" required>
</div>
		<div class="input-group">
  	  <label>Start Date</label>
        <input type="date" value="<?php echo $c_start; ?>" name="c_start" required>
</div>
<div class="input-group">
  	  <label>End Date</label>
        <input type="date" value="<?php echo $c_end; ?>" name="c_end" required>
</div>
 <legend><center><h3>Add Students</h3></center>  </legend>
 <div class="input-group">
  	  <label>Year</label>
  	  <select name="c_year" value="<?php echo $c_year; ?>" required>
								<option value="1"> 1</option>
								<option value="2"> 2 </option>
								<option value="3"> 3 </option>
								<option value="4"> 4 </option>
						</select>
  	</div>
		<div class="input-group">
  	  <label>Stream</label>
  	  <select name="c_stream" value="<?php echo $c_stream; ?>" required>
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
  	  <select name="c_section" value="<?php echo $c_section; ?>" required>
								<option value="A"> A </option>
								<option value="B"> B </option>
						</select>
	<div class="input-group">
		<button type="submit" style="float:left;" class="submitbtn" name="add_course">Add Course</button>	
</div>
  
		</div>
	</form>
		
</body>
</html>
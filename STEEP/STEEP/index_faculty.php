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
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="title">
		<h2>S.T.E.E.P</h2>
	</div>
	<div class="topnav">
		<a class="active" href=#>Home</a> 	
		<a href="Add_Course.php">Add Course</a>
		<?php  if (isset($_SESSION['username'])) : ?>
		
		<a style="float:right;"   href="index_faculty.php?logout='1'">Sign-out</a>
		<a style="float:right;" href="#">Welcome <?php echo $_SESSION['username']; ?>!!</a>
		<?php endif ?>
	</div>
<!--<div class="header">
	<h2>Home Page</h2>
</div> -->
<!--<div class="content">-->
  	<!-- notification message -->
  	<!--<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>-->

    <!-- logged in user information -->
    <!--<?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index_faculty.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?> -->
</div>
<div class="album py-5 ">
        <div class="container">
				<div class="row">
<?php
$db = mysqli_connect('localhost', 'root', '', 'steep') or die(mysqli_error());
$fid = $_SESSION['faculty_id'];
$course_query = "SELECT * FROM course WHERE faculty_id='$fid'";
	$result = mysqli_query($db, $course_query);
	while($course = mysqli_fetch_assoc($result))
	{
		$Today = date('Y-m-d');
    $Today=date('Y-m-d', strtotime($Today));
//echo $paymentDate; // echos today! 
$start = date('Y-m-d', strtotime($course['c_start']));
$end = date('Y-m-d', strtotime($course['c_end']));
		?>
   <!--<div class="container">
		
		<form	 style="max-width: 65rem; margin:30px; position: static; border-radius: 10px; " action="course.php" method="post">
		<?php  if ($Today>=$start && $Today<=$end): ?>
		 <div class="card	 text-white bg-success mb-3" style="	  position: static;">
		 <?php  endif ?>
		 <?php  if ($Today<$start) : ?>
		 <div class="card	 text-white bg-primary mb-3" style="	  position: static;">
		 <?php  endif ?>
		 <?php  if  ($Today>$end) : ?>
		 <div class="card	 text-white bg-danger mb-3" style="	  position: static;">
		 <?php  endif ?>
  <div class="card-header"><center><h3><b><?php echo $course['c_name']; ?></b></h3></center></div>
  <div class="card-body">
    <h5 class="card-title">Course ID: <?php echo $course['c_id']; ?></h5>
		<p class="card-text">Year: <?php echo $course['c_year']; ?><br>Stream: <?php echo $course['c_stream']; ?><br>Section: <?php echo $course['c_section']; ?></p>
		<input type="hidden" value="<?php echo $course['c_id']; ?>">
	</div>
	<input class="btn btn-danger" type="submit" value="Launch Course">
	</div>
	</div>
	</div>
	</form>

	</div>
	-->
	
	<div class="col-md-4" style="	  position: static;">
	<?php  if ($Today>=$start && $Today<=$end): ?>
		 <div class="card mb-4 box-shadow	 text-white bg-success mb-3" style="	  position: static;">
		 <?php  endif ?>
		 <?php  if ($Today<$start) : ?>
		 <div class="card mb-4 box-shadow	 text-white bg-primary mb-3" style="	  position: static;">
		 <?php  endif ?>
		 <?php  if  ($Today>$end) : ?>
		 <div class="card mb-4 box-shadow	 text-white bg-danger mb-3" style="	  position: static;">
		 <?php  endif ?>
              <!--<div class="card mb-4 box-shadow">-->
							<div class="card-header"><center><h3><b><?php echo $course['c_name']; ?></b></h3></center></div>
							<div class="card-body">
							<h5 class="card-title">Course ID: <?php echo $course['c_id']; ?></h5>
							<p class="card-text">Year: <?php echo $course['c_year']; ?><br>Stream: <?php echo $course['c_stream']; ?><br>Section: <?php echo $course['c_section']; ?></p>
							<div class="d-flex justify-content-between align-items-center">
                    <!--<div class="btn-group">-->
										<form	 style=" padding:0px;  border-radius:10px; position: static; " action="course_assignment1.php" method="get">
										<fieldset style="border:none; ">
										<input type="hidden" name="c_id" value="<?php echo $course['c_id']; ?>" >
										<input style="background-color:black; width:100%;" type="submit" class="btn btn-primary"  value="Launch Course" style="width:100%;">
	</fieldset>
                  	</form>
                    
                  </div>
                </div>
              </div>
						</div>


    <?php
	}
	mysqli_close($db);
?>
</div>
</div>
</div>
</body>
</html>
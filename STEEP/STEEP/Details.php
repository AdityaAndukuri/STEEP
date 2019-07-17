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
  $c_name = "";
$c_id    = $_GET['c_id'];
$c_start = "";
$c_end="";
$c_start_str="";
$c_end_str="";
$c_year="";
$c_stream="";
$c_section="";
$errors=array();
$db = mysqli_connect('localhost', 'root', '', 'steep') or die(mysqli_error());
$course_check_query = "SELECT * FROM course WHERE c_id='$c_id'  LIMIT 1";
  $result = mysqli_query($db, $course_check_query);
  $course = mysqli_fetch_assoc($result);
  if ($course) { // if course exists
     $c_name = $course['c_name'];
     $c_id = $course['c_id'];
     $c_start_str = $course['c_start'];
     $c_end_str = $course['c_end'];
     $c_year = $course['c_year'];
     $c_stream = $course['c_stream'];
     $c_section = $course['c_section'];

  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function validateid(p_id) {
		var reg = /^C[0-9]{1,2,3,4,5,6,7,8,9,10}$/
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
        <a href="index_faculty.php">Home</a> 
        <a href="Add_Course.php">Add Course</a>	
		<?php  if (isset($_SESSION['username'])) : ?>
        <a style="float:right;"   href="index_faculty.php?logout='1'">Sign-out</a>
        <a style="float:right;" href="#">Welcome <?php echo $_SESSION['username']; ?>!!</a>
		<?php endif ?>
</div>
<div class="row">
<div class="leftcolumn">
  <div class="sidenav">
  <a  href="course_assignment1.php?c_id=<?php echo $c_id; ?>">Assignments</a>
  <a href="course_quiz1.php?c_id=<?php echo $c_id; ?>">Quizzes</a>
  <!-- <a href="#clients">Notifications</a> -->
  <a   class='sideactive' href="#">Details</a>
  </div> 
</div>
<div class="rightcolumn">
    <div class="container-fluid" style="width:80%; border-radius=5px; margin-left:-15px;">
  
<div class="header_reg">
  	<h2>Course Details</h2>
  </div>
	
  <form method="post" class="form_reg" action="#">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Course Name</label>
  	  <input type="text" name="c_name" value="<?php echo $c_name; ?>" placeholder="Enter Course Name" readonly>
  	</div>
  	<div class="input-group">
  	  <label>Course ID</label>
  	  <input type="text" name="c_id" value="<?php echo $c_id; ?>" placeholder="eg: C01" onchange="Validateid(this)" readonly>
</div>
		<div class="input-group">
  	  <label>Start Date</label>
        <input type="date" value="<?php echo $c_start_str; ?>" name="c_start" readonly>
</div>
<div class="input-group">
  	  <label>End Date</label>
        <input type="date" value="<?php echo $c_end_str; ?>" name="c_end" readonly>
</div>
 <legend><center><h3>Students</h3></center>  </legend>
 <div class="input-group">
  	  <label>Year</label>
  	  <input type="text" value="<?php echo $c_year?>" readonly>
  	</div>
		<div class="input-group">
  	  <label>Stream</label>
        <input type="text" value="<?php echo $c_stream?>" readonly>
    </div>
  	<div class="input-group">
  	  <label>Section</label>
        <input type="text" value="<?php echo $c_section?>" readonly>
</div>
	</form>
</div>
</div>	
</body>
</html>
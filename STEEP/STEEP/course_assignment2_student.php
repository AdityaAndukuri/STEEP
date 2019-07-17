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
  if(isset($_GET['c_id']))
  $c_id = $_GET['c_id'];
  else
  $c_id = $_POST['c_id'];
$a_id = $c_id."_2";
$question = "";
$due = "";
  $errors = array(); 
?>

<html>
<head>
<title>Home</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="title">
		<h2>S.T.E.E.P</h2>
</div>
<div class="topnav">
        <a href="index.php">Home</a> 
		<?php  if (isset($_SESSION['username'])) : ?>
        <a style="float:right;"   href="index.php?logout='1'">Sign-out</a>
        <a style="float:right;" href="#">Welcome <?php echo $_SESSION['username']; ?>!!</a>
		<?php endif ?>
</div>
<div class="row">
<div class="leftcolumn">
  <div class="sidenav">
  <a class="sideactive" href="#about">Assignments</a>
  <a href="course_quiz1_student.php?c_id=<?php echo $c_id; ?>">Quizzes</a>
  <!-- <a href="#clients">Notifications</a> -->
  <a href="Details_student.php?c_id=<?php echo $c_id; ?>">Details</a></div> 
</div>
<div class="rightcolumn">
<div class="topnav" style="width:36%; border-radius:10px;">
<a  href="course_assignment1_student.php?c_id=<?php echo $c_id; ?>">Assignment 1</a>
        <a class='active' href='#'>Assignment 2</a>
        <a href="course_assignment3_student.php?c_id=<?php echo $c_id; ?>">Assignment 3</a>
</div>
<?php


$roll = $_SESSION['student_id'];
$db = mysqli_connect('localhost', 'root', '', 'steep') or die(mysqli_error());
$user_check_query = "SELECT * FROM assignment_submissions WHERE roll='$roll' and c_id='$c_id' and a_id='$a_id' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if ($user) { // if user exists
    
      array_push($errors, "solution already submitted, new submisiion will overwrite the existing one");
    
  }

if(isset($_POST['submit_assignment_btn']))
{
    $file_name=$_POST['file_name'];
    $file = $_FILES['file']['name'];
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $validExt = array ('pdf', 'txt', 'doc', 'docx', 'ppt' , 'zip');
    if (empty($file)) {
echo "<script>alert('Attach a file');</script>";
    }
    else if ($_FILES['file']['size'] <= 0 || $_FILES['file']['size'] > 30720000 )
    {
echo "<script>alert('file size is not proper');</script>";
    }
    else if (!in_array($ext, $validExt)){
        echo "<script>alert('Not a valid file');</script>";

    }
    else {
        $folder  = 'allfiles/';
        $fileext = strtolower(pathinfo($file, PATHINFO_EXTENSION) );
        $notefile = rand(1000 , 1000000) .'.'.$fileext;
        if(move_uploaded_file($_FILES['file']['tmp_name'], $folder.$notefile)) {
            $user_check_query = "SELECT * FROM assignment_submissions WHERE roll='$roll' and c_id='$c_id' and a_id='$a_id' LIMIT 1";
            $result = mysqli_query($db, $user_check_query);
            $user = mysqli_fetch_assoc($result);
            if ($user) { // if user exists
                $delete_query = "DELETE FROM assignment_submissions WHERE roll='$roll' and c_id='$c_id' and a_id='$a_id'";
                $result_afterdelete = mysqli_query($db, $delete_query);
    
     // array_push($errors, "solution already submitted, new submisiion will overwrite the existing one");
    
               }
            $query = "INSERT INTO assignment_submissions(c_id, a_id, roll, file_type, file, file_name) VALUES ('$c_id' , '$a_id' , '$roll' , '$fileext'  , '$notefile', '$file_name')";
            $result = mysqli_query($db , $query) or die(mysqli_error($db));
            if (mysqli_affected_rows($db) > 0) {
                echo "<script> alert('Assignment uploaded successfully.');
                 window.location.href='course_assignment2_student.php?c_id=$c_id';</script>";
            }
            else {
                "<script> alert('Error while uploading..try again');</script>";
            }
        }
    }
}

$assignment_check_query = "SELECT * FROM assignments WHERE c_id='$c_id' AND id='$a_id' LIMIT 1";
$result = mysqli_query($db, $assignment_check_query);
$assignment = mysqli_fetch_assoc($result);
if($assignment)
{
  //has to be implemented
  $question = $assignment['question'];
  $due = $assignment['due'];
  $Today = date('Y-m-d');
    $Today=date('Y-m-d', strtotime($Today));
//echo $paymentDate; // echos today! 
$conduct = date('Y-m-d', strtotime($due));
if($Today<=$conduct)
    {
  ?>
  <br>
  <div class="container-fluid" style="width:80%; border-radius=5px; margin-left:-15px;">
  <form action="#" method="POST"  style="border-radius:5px;">
        <fieldset>
        <div class="form-group">
                <label for="Due Date">Due Date</label>
                <input type="date" class="form-control" name="due" value="<?php echo $due; ?>" readonly>
        </div>
            <div class="form-group">
            <input type="hidden" name="c_id" value="<?php echo $c_id; ?>" >
                <label for="content">Question</label>
                <textarea class="form-control" name="question" rows="6" readonly><?php echo $question; ?></textarea>
</div>
        </form>

</div>
<div class="container-fluid" style="width:80%; border-radius=5px; margin-left:-15px;">
  <form action="course_assignment2_student.php" method="POST"  style="border-radius:5px;" enctype="multipart/form-data">
        <fieldset>
        <div class="form-group">
		<label for="post_title">Name of the Solution</label>
		<input type="text" name="file_name" class="form-control" placeholder="Eg: Assignment 1 solution File"  value = "<?php if(isset($_POST['submit_assignment_btn'])) {
            echo $file_name; } ?>" required="">
    </div>
    <?php include('errors.php'); ?>
        <div class="form-group">
            
                <label for="Due Date">Upload Solution</label>
                <font color="brown"> (allowed file type: 'pdf','doc','ppt','txt','zip' | allowed maximum size: 30 mb ) </font>
                <br>
                <input type="file"  name="file" required>
        </div>
            <div class="form-group">
            <input type="hidden" name="c_id" value="<?php echo $c_id; ?>" >
            <input type="submit" class="btn btn-danger" name="submit_assignment_btn" value="Submit Assignment">
</div>
        </form>

</div>

<?php  
 }
 else{
     $quiz_check_query1 = "SELECT * FROM assignment_submissions WHERE c_id='$c_id' AND a_id='$a_id' AND roll='$roll' LIMIT 1";
 $result1 = mysqli_query($db, $quiz_check_query1);
 $quiz1 = mysqli_fetch_assoc($result1);
 if($quiz1)
 {
      ?>
<br>
  <div  class="no_error" class="container-fluid" style="width:80%; border-radius=5px; margin-left:-15px;">
     <p ><h2><center>Secured Score: <?php echo $quiz1['marks']; ?> !!!</center></h2>
      </div>

      <?php
 }
 else{
     ?>
<br>
  <div  class="error" class="container-fluid" style="width:80%; border-radius=5px; margin-left:-15px;">
     <p ><h2><center>Failed to submit the Assignment</center></h2>
      </div>
     
     <?php
 }
 }

}
else{
?>
  <br>
    <div  class="error" class="container-fluid" style="width:80%; border-radius=5px; margin-left:-15px;">
       <p ><h2><center>Not Yet Posted!!!</center></h2>
        </div>
        
        
<?php
}
mysqli_close($db);
?>
</div>
</div>



</body>
</html>
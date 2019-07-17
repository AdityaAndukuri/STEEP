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
$a_id = $c_id."_3";
$question = "";
$due = "";
$marks="";
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
  <a class="sideactive" href="#">Assignments</a>
  <a href="course_quiz1.php?c_id=<?php echo $c_id; ?>">Quizzes</a>
  <!-- <a href="#clients">Notifications</a> -->
  <a href="Details.php?c_id=<?php echo $c_id; ?>">Details</a>
  
  </div> 
</div>
<div class="rightcolumn">
<div class="topnav" style="width:36%; border-radius:10px;">
       <a  href="course_assignment1.php?c_id=<?php echo $c_id; ?>">Assignment 1</a>
        <a href="course_assignment2.php?c_id=<?php echo $c_id; ?>">Assignment 2</a>
        <a class='active' href='#'>Assignment 3</a>
</div>
<?php


$db = mysqli_connect('localhost', 'root', '', 'steep') or die(mysqli_error());
if (isset($_GET['approve'])) {
  $assignment_approve = mysqli_real_escape_string($db,$_GET['approve']);
  function prompt($prompt_msg){
    echo("<script type='text/javascript'> var answer = (prompt('".$prompt_msg."')); </script>");

    $answer = "<script type='text/javascript'> document.write(answer); </script>";
    $_SESSION['assignment_marks']=$answer;

    return($answer);
}

//program
// if(!isset($_SESSION['assignment_marks']))
// {
// $prompt_msg = "Please enter the marks.";
// $marks2 = prompt($prompt_msg);
// $marks = $_SESSION['assignment_marks'];
// echo "<script>window.location.href='course_assignment1.php?marks=5&?approve=$assignment_approve&?c_id=$c_id';</script>";
// }
// else
// {
// //echo var_dump($marks2)."<br>";
// $marks = $_SESSION['assignment_marks'];
$marks=$_GET['marks'];
  $approve_query = "UPDATE assignment_submissions set marks='$marks', status='Approved' WHERE file_id='$assignment_approve'";
  $run_approve_query = mysqli_query($db, $approve_query) or die (mysqli_error($db));
  if (mysqli_affected_rows($db) > 0) {
      echo "<script>alert('Assignment approved successfully');
      window.location.href='course_assignment3.php?c_id=$c_id';</script>";
  }
  else {
  // echo "<script>alert('error occured.try again!');</script>";   
  }
  
  }

if(isset($_POST['post_assignment_btn']))
{
  $question = mysqli_real_escape_string($db, $_POST['question']);
  $due_str = mysqli_real_escape_string($db, $_POST['due']);
  $due = date('Y-m-d',strtotime($_POST['due']));
  $query = "INSERT INTO assignments (c_id, id, question, due) 
  			  VALUES('$c_id', '$a_id', '$question', '$due')";
      try{ $res=mysqli_query($db, $query);
        if($res)
{
  ;
}
else
{
    echo "error";
}
      }
      catch(Exception $e){

           array_push($errors, ""+e);
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
<div class="table-responsive">
<br>
<div class="content" class="container-fluid" style="border-radius:5px; width:80%;" >
            <table class="table table-bordered table-striped table-hover">


            <thead>
                    <tr>
                    <th>Roll NO</th>
                        <th>Solution Name</th>
                        <th>Format</th>
                        <th>Submitted on</th>
                        <th>Status</th>
                        <th>Download</th>
                        <th>Marks</th>
                        <th>Approve</th>
                        
                    </tr>
                </thead>
                <tbody>

                 <?php

$query = "SELECT * FROM assignment_submissions WHERE c_id='$c_id' AND a_id='$a_id' ORDER BY submit_date DESC";
$run_query = mysqli_query($db, $query) or die(mysqli_error($db));
if (mysqli_num_rows($run_query) > 0) {
while ($row = mysqli_fetch_array($run_query)) {
    $file_id = $row['file_id'];
    $file_name = $row['file_name'];
    $file_type = $row['file_type'];
    $file_date = $row['submit_date'];
    $roll = $row['roll'];
    $file_status = $row['status'];
    $marks = $row['marks'];
    $file = $row['file'];

    echo "<tr>";
    echo "<td>$roll</td>";
    echo "<td>$file_name</td>";
    echo "<td>$file_type</td>";
    echo "<td>$file_date</td>";
    echo "<td>$file_status</td>";
    echo "<td><a href='allfiles/$file' target='_blank' style='color:green'>Download </a></td>";
    if(strcmp($file_status,'Approved')!=0)
    {  ?>
      <form action="course_assignment1.php"  method='get'> <fieldset><td><input type='number' name='marks' min='0' max='5' step='0.5' required></td>
      <td><input type='hidden' name='approve' value="<?php echo $file_id; ?>"> <input type='hidden' name='c_id' value="<?php echo $c_id; ?>"><input type='submit' style='float:left;' class="btn btn-danger" name='app_button' value='Approve'></td></fieldset></form>
     <?php
    }
    else{
      echo "<td>$marks</td>";
      echo "<td>Approved</td>";
    }
    
    echo "</tr>";

}
}
?>


                </tbody>
            </table>
</div>  
</div>
<?php  
}
else{
?>
  <br>
    <div class="container-fluid" style="width:80%; border-radius=5px; margin-left:-15px;">
        <form action="course_assignment3.php" method="POST" style="border-radius:5px;">
        <fieldset>
        <div class="form-group">
                <label for="Due Date">Due Date</label>
                <input type="date" class="form-control" name="due" placeholder="Enter Due Date" required>
        </div>
            <div class="form-group">
            <input type="hidden" name="c_id" value="<?php echo $c_id; ?>" >
                <label for="content">Question</label>
                <textarea class="form-control" id="content" name="question" rows="6" required></textarea>
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-danger" name="post_assignment_btn" value="Post Assignment">
            </div>
        </form>
        </div>
        
        
<?php
}
mysqli_close($db);
?>
</div>
</div>



</body>
</html>
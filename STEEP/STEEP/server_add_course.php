<?php

// initializing variables
$c_name = "";
$c_id    = "";
$c_start = "";
$c_end="";
$c_start_str="";
$c_end_str="";
$c_year="";
$c_stream="";
$c_section="";
$errors = array(); 
$f_id = $f_id = $_SESSION['faculty_id'];

/*if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
 }
   echo "Connected successfully";
*/

// REGISTER USER
if (isset($_POST['add_course'])) {
    // connect to the database
$db = mysqli_connect('localhost', 'root', '', 'steep') or die(mysqli_error());

  // receive all input values from the form
  $c_name = mysqli_real_escape_string($db, $_POST['c_name']);
  $c_id = mysqli_real_escape_string($db, $_POST['c_id']);
  $c_start_str = mysqli_real_escape_string($db, $_POST['c_start']);
  $c_end_str = mysqli_real_escape_string($db, $_POST['c_end']);
  $c_start = date('Y-m-d',strtotime($_POST['c_start']));
  $c_end        = date('Y-m-d',strtotime($_POST['c_end']));
  $c_year_str = mysqli_real_escape_string($db, $_POST['c_year']);
  $c_year = (int)$_POST['c_year'];
  $c_stream = mysqli_real_escape_string($db, $_POST['c_stream']);
  $c_section = mysqli_real_escape_string($db, $_POST['c_section']);
  

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $course_check_query = "SELECT * FROM course WHERE c_id='$c_id' OR c_name='$c_name' LIMIT 1";
  $result = mysqli_query($db, $course_check_query);
  $course = mysqli_fetch_assoc($result);
  if ($course) { // if user exists
    if ($course['c_name'] === $c_name) {
      array_push($errors, "Coursename already exists");
    }
 
    if ($course['c_id'] === $c_id) {
        array_push($errors, "Course Id already exists");
      }

  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO course(c_name, c_id, c_start, c_end, c_year, c_stream, c_section, faculty_id) 
  			  VALUES('$c_name', '$c_id', '$c_start', '$c_end', $c_year,'$c_stream','$c_section','$f_id')";
      try{ $res=mysqli_query($db, $query);
        if($res)
{
  ;
}
else
{
    array_push($errors, "ERROR: Could not able to execute $query. " . mysqli_error($db));

}
$query_students = "SELECT * FROM students WHERE year='$c_year' AND stream='$c_stream' AND section='$c_section'";
$result_students = mysqli_query($db, $query_students);
while($row = mysqli_fetch_assoc($result_students)) {
  $roll = $row['roll'];
  $query_takes = "INSERT INTO student_takes_course(c_id, s_roll)
                  VALUES('$c_id','$roll')";
 $res_students=mysqli_query($db, $query_takes);
 if($res_students)
{
;
}
else
{
array_push($errors, "ERROR: Could not able to execute $query_takes. " . mysqli_error($db));

}
  
}

      }
      catch(Exception $e){

           array_push($errors, ""+e);
      }

  }
  mysqli_close($db);
}
 
  ?>
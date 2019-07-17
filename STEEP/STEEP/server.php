<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$roll = "";
$gender= "";
$dob = "";
$phone = "";
$doa = "";
$year = "";
$stream = "";
$section = "";
$dob_str="";
$doa_str="";
$errors = array(); 
$errors_fac = array();

/*if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
 }
   echo "Connected successfully";
*/

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'steep') or die(mysqli_error());

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $roll = mysqli_real_escape_string($db, $_POST['roll']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  $dob_str = mysqli_real_escape_string($db, $_POST['dob']);
  $dob        = date('Y-m-d',strtotime($_POST['dob']));
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $doa_str = mysqli_real_escape_string($db, $_POST['doa']);
  $doa        = date('Y-m-d',strtotime($_POST['doa']));
  $year = (int)$_POST['year'];
  $stream = mysqli_real_escape_string($db, $_POST['stream']);
  $section = mysqli_real_escape_string($db, $_POST['section']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
 /* if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }*/
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM students WHERE roll='$roll' OR username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
 
    if ($user['roll'] === $roll) {
        array_push($errors, "Roll no already exists");
      }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO students (username, email, roll, gender, dob, phone, doa, year, stream, section, password) 
  			  VALUES('$username', '$email', '$roll', '$gender', '$dob','$phone','$doa', $year,'$stream','$section', '$password')";
      try{ $res=mysqli_query($db, $query);
        if($res)
{
  ;
}
else
{
    array_push($errors, "ERROR: Could not able to execute $query. " . mysqli_error($db));

}
      }
      catch(Exception $e){

           array_push($errors, ""+e);
      }
      if (count($errors) == 0)
      {
        $_SESSION['student_id']=$roll;
    	$_SESSION['username'] = $username;
  	    $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
      }
  }
  mysqli_close($db);
}
// LOGIN USER
if (isset($_POST['login_student'])) {
    // connect to the database
$db = mysqli_connect('localhost', 'root', '', 'steep') or die(mysqli_error());

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM students WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $student_user = mysqli_fetch_assoc($results);
          $_SESSION['student_id']=$student_user['roll'];
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
    mysqli_close($db);
  }
  

  // initializing variables
$fusername = "";
$femail    = "";
$fid = "";
$fgender= "";
$fdob = "";
$fphone = "";
$fdepartment = "";
$fdob_str="";
$fdoa_str="";
$frole = "";


/*if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
 }
   echo "Connected successfully";
*/

// REGISTER USER
if (isset($_POST['reg_faculty'])) {
    // connect to the database
$db = mysqli_connect('localhost', 'root', '', 'steep') or die(mysqli_error());

  // receive all input values from the form
  $fusername = mysqli_real_escape_string($db, $_POST['fusername']);
  $femail = mysqli_real_escape_string($db, $_POST['femail']);
  $fid = mysqli_real_escape_string($db, $_POST['fid']);
  $fgender = mysqli_real_escape_string($db, $_POST['fgender']);
  $fdob_str = mysqli_real_escape_string($db, $_POST['fdob']);
  $fdob        = date('Y-m-d',strtotime($_POST['fdob']));
  $fphone = mysqli_real_escape_string($db, $_POST['fphone']);
  $fdepartment = mysqli_real_escape_string($db, $_POST['fdepartment']);
  $frole = mysqli_real_escape_string($db, $_POST['frole']);
  $fpassword_1 = mysqli_real_escape_string($db, $_POST['fpassword_1']);
  $fpassword_2 = mysqli_real_escape_string($db, $_POST['fpassword_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
 /* if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }*/
  if ($fpassword_1 != $fpassword_2) {
	array_push($errors_fac, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM faculty WHERE id='$fid' OR username='$fusername' OR email='$femail' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if ($user) { // if user exists
    if ($user['username'] === $fusername) {
      array_push($errors_fac, "Username already exists");
    }
 
    if ($user['id'] === $fid) {
        array_push($errors_fac, "Id already exists");
      }

    if ($user['email'] === $femail) {
      array_push($errors_fac, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors_fac) == 0) {
  	$password = md5($fpassword_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO faculty (username, email, id, gender, dob, phone, department, role, password) 
  			  VALUES('$fusername', '$femail', '$fid', '$fgender', '$fdob','$fphone','$fdepartment','$frole', '$password')";
      try{ $res=mysqli_query($db, $query);
        if($res)
{
  ;
}
else
{
    array_push($errors_fac, "ERROR: Could not able to execute $query. " . mysqli_error($db));

}
      }
      catch(Exception $e){

           array_push($errors_fac, ""+e);
      }
      if (count($errors_fac) == 0)
      {
        $_SESSION['faculty_id']=$fid;
    	$_SESSION['username'] = $fusername;
  	    $_SESSION['success'] = "You are now logged in";
        header('location: index_faculty.php');
      }
  }
  mysqli_close($db);
}
// LOGIN USER
if (isset($_POST['login_faculty'])) {
    // connect to the database
$db = mysqli_connect('localhost', 'root', '', 'steep') or die(mysqli_error());

    $username = mysqli_real_escape_string($db, $_POST['fusername']);
    $password = mysqli_real_escape_string($db, $_POST['fpassword']);
  
    if (empty($username)) {
        array_push($errors_fac, "Username is required");
    }
    if (empty($password)) {
        array_push($errors_fac, "Password is required");
    }
  
    if (count($errors_fac) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM faculty WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $user = mysqli_fetch_assoc($results);
          $_SESSION['faculty_id']=$user['id'];
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: index_faculty.php');
        }else {
            array_push($errors_fac, "Wrong username/password combination");
        }
    
    }
    mysqli_close($db);
  }


  ?>
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
$a_id = $c_id."_1";
$due = "";
$errors = array(); 
class Question
{
    public $question;
    public $choice1;
    public $choice2;
    public $choice3;
    public $choice4;
    public $correct;

    function __construct($question, $ch1, $ch2, $ch3, $ch4, $corr)
    {
        $this->question = $question;
        $this->choice1 = $ch1;
        $this->choice2 = $ch2;
        $this->choice3 = $ch3;
        $this->choice4 = $ch4;
        $this->correct = $corr;
    }
}



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
        <a style="float:right;"   href="index_faculty.php?logout='1'">Sign-out</a>
        <a style="float:right;" href="#">Welcome <?php echo $_SESSION['username']; ?>!!</a>
		<?php endif ?>
</div>
<div class="row">
<div class="leftcolumn">
  <div class="sidenav">
  <a  href="course_assignment1_student.php?c_id=<?php echo $c_id; ?>">Assignments</a>
  <a class="sideactive" href="#">Quizzes</a>
  <!-- <a href="#clients">Notifications</a> -->
  <a href="Details_student.php?c_id=<?php echo $c_id; ?>">Details</a>
  </div> 
</div>
<div class="rightcolumn">
<div class="topnav" style="width:21%; border-radius:10px;">
       <a  class='active' href='#'> Quiz 1</a>
        <a href="course_quiz2_student.php?c_id=<?php echo $c_id; ?>">Quiz 2</a>
        <a href="course_quiz3_student.php?c_id=<?php echo $c_id; ?>">Quiz 3</a>
</div>
<?php


$db = mysqli_connect('localhost', 'root', '', 'steep') or die(mysqli_error());
$roll = $_SESSION['student_id'];
$user_check_query = "SELECT * FROM quiz_submissions WHERE roll='$roll' and c_id='$c_id' and a_id='$a_id' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if ($user) { // if user exists
      $marks = $user['marks'];
      array_push($errors, "Quiz already submitted.<br> Max Score: $marks");
    
  }

 if(isset($_POST['submit_quiz_btn']))
{
    
    $questions = array();
    $user_check_query = "SELECT * FROM quiz_submissions WHERE roll='$roll' and c_id='$c_id' and a_id='$a_id' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    $prev_score = 0;
    if ($user) { // if user exists
        $delete_query = "DELETE FROM quiz_submissions WHERE roll='$roll' and c_id='$c_id' and a_id='$a_id'";
        $result_afterdelete = mysqli_query($db, $delete_query);
        $prev_score = $user['marks'];
// array_push($errors, "solution already submitted, new submisiion will overwrite the existing one");

       }
   
    for($i=1;$i<11;$i++)
    {
        $q = new Question($_POST['question_'.$i], $_POST['choice_'.$i.'_1'], $_POST['choice_'.$i.'_2'], $_POST['choice_'.$i.'_3'],$_POST['choice_'.$i.'_4'],$_POST['correct_'.$i]);
        array_push($questions,$q);

    }
   $count = 0;
  for($i=0;$i<10;$i++)
    {
        $question = $questions[$i]->question;
        $choice1 = $questions[$i]->choice1;
        $choice2 = $questions[$i]->choice2;
        $choice3 = $questions[$i]->choice3;
        $choice4 = $questions[$i]->choice4;
        $correct = $questions[$i]->correct;
        $answer = $_POST['answer_'.($i+1)];
        if($correct == $answer)
        {
            $count++;
        }


    }
    $max = 0;
    //echo "<script>alert('Quiz Created successfully');</script>";
    if($count>$prev_score)
    $max=$count;
    else
    $max=$prev_score;
    $query = "INSERT INTO quiz_submissions(c_id, a_id, roll, marks) VALUES ('$c_id' , '$a_id' , '$roll' , '$max')";
    $result = mysqli_query($db , $query) or die(mysqli_error($db));
    if (mysqli_affected_rows($db) > 0) {
        echo "<script> alert('Quiz submitted successfully, Current Score:  $count, Max Score: $max');
                 window.location.href='course_quiz1_student.php?c_id=$c_id';</script>";
                }
    else {
        "<script> alert('Error while uploading..try again');</script>";
    }

}

$quiz_check_query = "SELECT * FROM quizzes WHERE c_id='$c_id' AND id='$a_id' LIMIT 1";
$result = mysqli_query($db, $quiz_check_query);
$quiz = mysqli_fetch_assoc($result);
if($quiz)
{
  //has to be implemented
  $due = $quiz['due'];
  $Today = date('Y-m-d');
    $Today=date('Y-m-d', strtotime($Today));
//echo $paymentDate; // echos today! 
$conduct = date('Y-m-d', strtotime($due));
if($conduct==$Today)
{
?>
  
  <br>
    <div class="container-fluid" style="width:80%; border-radius:5px; margin-left:-15px;">
    <div style="width:65%; border-radius=5px; margin-left:-30px;">
    <?php include('errors.php'); ?>
    <br>

</div>
    <div  class="no_error" style="width:40%; border-radius=5px; margin-left:0px;" >
       <p ><h4><center>Questions</center></h4>
        </div>
     <form action="course_quiz1_student.php" method="POST" style="border-radius:5px;">
        <fieldset>
        <input type="hidden" name="c_id" value="<?php echo $c_id; ?>" >
        
        <div class="container-fluid" style="width:80%; margin-left:-15px;">
        <!-- <div class="form-group">
                <b><label for="Due Date">Conduction Date</label></b>
                <input type="date" class="form-control" name="due" value="<?php echo $due; ?>" readonly>
        </div> -->
        </div>
        


           <?php

           for($i=1;$i<11;$i++)
           {
               $question = $quiz['question_'.$i];
               $choice1 = $quiz['choice_'.$i.'_1'];
               $choice2 = $quiz['choice_'.$i.'_2'];
               $choice3 = $quiz['choice_'.$i.'_3'];
               $choice4 = $quiz['choice_'.$i.'_4'];
               $correct = $quiz['correct_'.$i];
            ?>
            <br>
            <br>
            <input type="hidden" name="correct_<?php echo $i; ?>" value="<?php echo $correct; ?>">
            <div class="form-group">
            
                <label for="content"><b>Question <?php echo $i; ?></b></label>
                
                <textarea class="form-control"  style="color:black;" qid="content" name="question_<?php echo $i; ?>" rows="4" readonly><?php echo $question; ?></textarea>
            </div>
            <div class="form-group">
                <br>
                <input type='radio'class="form-control" style="float:left; width:5%;"   name="answer_<?php echo $i; ?>" value='a' required/>
                <textarea class="form-control" style="float:right; width:95%;" id="content" name="choice_<?php echo $i; ?>_1" rows="1" value="<?php echo $choice1; ?>" readonly><?php echo $choice1; ?></textarea>
            </div>
            <div class="form-group">
            <br>
            <br>
                <input type='radio'class="form-control" style="float:left; width:5%;"   name="answer_<?php echo $i; ?>" value='b' required/>
                
    
                <textarea class="form-control" style="float:right; width:95%;" id="content" name="choice_<?php echo $i; ?>_2" rows="1"  readonly><?php echo $choice2; ?></textarea>
            </div>
            <div class="form-group">
            <br>
            <br>
                <input type='radio'class="form-control" style="float:left; width:5%;"   name="answer_<?php echo $i; ?>" value='c' required/>
                
                
                <textarea class="form-control" style="float:right; width:95%;" id="content" name="choice_<?php echo $i; ?>_3" rows="1" value="<?php echo $choice3; ?>" readonly><?php echo $choice1; ?></textarea>
            </div>
            <div class="form-group">
            <br>
            <br>
                <input type='radio'class="form-control" style="float:left; width:5%;"   name="answer_<?php echo $i; ?>" value='d' required/>
                
                
                <textarea class="form-control" style="float:right; width:95%;" id="content" name="choice_<?php echo $i; ?>_4" rows="1" value="<?php echo $choice4; ?>" readonly><?php echo $choice4; ?></textarea>
            </div>
            
         <?php
           }
           
           
               ?>
<br>
       <br>
            <div class="form-group">
            <input type="submit" class="btn btn-danger" name="submit_quiz_btn" value="Submit Quiz">
            
            </div>
        </form> 
        				
        </div>
  


         <?php   }

else{
    if($Today<$conduct)
    {
    ?>
    <br>
     <div  class="error" class="container-fluid" style="width:80%; border-radius=5px; margin-left:-15px;">
        <p ><h2><center>Conduction Date: <?php echo $conduct; ?> !!!</center></h2>
         </div> 
         <?php
   }
   else{
    $quiz_check_query1 = "SELECT * FROM quiz_submissions WHERE c_id='$c_id' AND a_id='$a_id' AND roll='$roll' LIMIT 1";
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
        <p ><h2><center>Failed to attempt the Quiz</center></h2>
         </div>
        
        <?php
    }
    
   }
}
         
         

        ?>
       

<?php    
}
else{
    ?>
    <br>
      <div  class="error" class="container-fluid" style="width:80%; border-radius=5px; margin-left:-15px;">
         <p ><h2><center>Not Yet Created!!!</center></h2>
          </div>        
<?php
}
mysqli_close($db);
?>
</div>
</div>



</body>
</html>
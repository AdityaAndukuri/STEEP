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
$due = "";

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
  <a class="sideactive" href="#">Quizzes</a>
  <!-- <a href="#clients">Notifications</a> -->
  <a href="Details.php?c_id=<?php echo $c_id; ?>">Details</a>
  </div> 
</div>
<div class="rightcolumn">
<div class="topnav" style="width:21%; border-radius:10px;">
      
        <a href="course_quiz1.php?c_id=<?php echo $c_id; ?>">Quiz 1</a>
        <a href="course_quiz2.php?c_id=<?php echo $c_id; ?>">Quiz 2</a>
        <a  class='active' href='#'> Quiz 3</a>
</div>
<br>

<?php


$db = mysqli_connect('localhost', 'root', '', 'steep') or die(mysqli_error());
 if(isset($_POST['post_quiz_btn']))
{
    $due_str = mysqli_real_escape_string($db, $_POST['due']);
    $due = date('Y-m-d',strtotime($_POST['due']));
    $questions = array();
    for($i=1;$i<11;$i++)
    {
        $q = new Question($_POST['question_'.$i], $_POST['choice_'.$i.'_1'], $_POST['choice_'.$i.'_2'], $_POST['choice_'.$i.'_3'],$_POST['choice_'.$i.'_4'],$_POST['correct_'.$i]);
        array_push($questions,$q);

    }

    $query = "INSERT INTO quizzes (c_id, id,  due) 
  			  VALUES('$c_id', '$a_id', '$due')";
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
      for($i=0;$i<10;$i++)
    {
        $question = $questions[$i]->question;
        $choice1 = $questions[$i]->choice1;
        $choice2 = $questions[$i]->choice2;
        $choice3 = $questions[$i]->choice3;
        $choice4 = $questions[$i]->choice4;
        $correct = $questions[$i]->correct;
        $quiz_questions_query = "UPDATE quizzes set question_".($i+1)."='$question',choice_".($i+1)."_1='$choice1',choice_".($i+1)."_2='$choice2',choice_".($i+1)."_3='$choice3',choice_".($i+1)."_4='$choice4',correct_".($i+1)."='$correct'  WHERE c_id='$c_id' AND id='$a_id'";
        $run_query = mysqli_query($db, $quiz_questions_query) or die (mysqli_error($db));
        // if (mysqli_affected_rows($db) > 0 && $i==0) {
        //     echo "<script>alert('Quiz Created successfully');</script>";
        // }
        // else {
        //  echo "<script>alert('error occured.try again!');</script>";   
        // }

    }
    echo "<script>alert('Quiz Created successfully');</script>";
 

}

$quiz_check_query = "SELECT * FROM quizzes WHERE c_id='$c_id' AND id='$a_id' LIMIT 1";
$result = mysqli_query($db, $quiz_check_query);
$quiz = mysqli_fetch_assoc($result);
if($quiz)
{
  //has to be implemented
  $due = $quiz['due'];
?>
  <div class="topnav" style="width:30%; border-radius:10px;">
       <a  class='active'  href='#'> Created Quiz</a>
       <a href='course_quiz3_sub.php?c_id=<?php echo $c_id; ?>' style="float:right;"> Submissions Received</a>
</div>
  <br>
    <div class="container-fluid" style="width:80%; border-radius:5px; margin-left:-15px;">
    <div  class="no_error" style="width:40%; border-radius=5px; margin-left:0px;" >
       <p ><h4><center>Questions</center></h4>
        </div>
     <form action="#" method="POST" style="border-radius:5px;">
        <fieldset>
        <input type="hidden" name="c_id" value="<?php echo $c_id; ?>" >
        <div class="container-fluid" style="width:80%; margin-left:-15px;">
        <div class="form-group">
                <b><label for="Due Date">Conduction Date</label></b>
                <input type="date" class="form-control" name="due" value="<?php echo $due; ?>" readonly>
        </div>
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
            <div class="form-group">
            
                <label for="content"><b>Question <?php echo $i; ?></b></label>
                <textarea class="form-control"  style="color:black;" qid="content" name="question_<?php echo $i; ?>" rows="4" readonly><?php echo $question; ?></textarea>
            </div>
            <div class="form-group">
            
                <label for="content">Choice 1</label>
                <textarea class="form-control" id="content" name="choice_<?php echo $i; ?>_1" rows="1" value="<?php echo $choice1; ?>" readonly><?php echo $choice1; ?></textarea>
            </div>
            <div class="form-group">
            
                <label for="content">Choice 2</label>
                <textarea class="form-control" id="content" name="choice_<?php echo $i; ?>_2" rows="1"  readonly><?php echo $choice2; ?></textarea>
            </div>
            <div class="form-group">
            
                <label for="content">Choice 3</label>
                <textarea class="form-control" id="content" name="choice_<?php echo $i; ?>_3" rows="1" value="<?php echo $choice3; ?>" readonly><?php echo $choice1; ?></textarea>
            </div>
            <div class="form-group">
            
                <label for="content">Choice 4</label>
                <textarea class="form-control" id="content" name="choice_<?php echo $i; ?>_4" rows="1" value="<?php echo $choice4; ?>" readonly><?php echo $choice4; ?></textarea>
            </div>
            <div class="form-group">
                <label for="Correct Option"><b>Correct Answer: </b></label>
                <input type='text' style="color:green; width:5%; text-align:center;"  class="no_error" class="form-control" name="correct_<?php echo $i; ?>" value="<?php echo $correct; ?>" readonly>
                        
            </div>
         <?php
           }

        ?>
       
            <!-- <div class="form-group">
            <input type="submit" class="btn btn-danger" name="post_quiz_btn" value="Create Quiz">
            
            </div> -->
        </form> 
        				
        </div>
  

<?php    
}
else{
?>
  <br>
    <div class="container-fluid" style="width:80%; border-radius:5px; margin-left:-15px;">
    <div  class="error" style="width:40%; border-radius=5px; margin-left:0px;" >
       <p ><h4><center>Add QUIZ</center></h4>
        </div>
     <form action="course_quiz3.php" method="POST" style="border-radius:5px;">
        <fieldset>
        <input type="hidden" name="c_id" value="<?php echo $c_id; ?>" >
        <div class="container-fluid" style="width:80%; margin-left:-15px;">
        <div class="form-group">
                <b><label for="Due Date">Conduction Date</label></b>
                <input type="date" class="form-control" name="due" placeholder="Enter Due Date" required>
        </div>
        </div>
        


           <?php

           for($i=1;$i<11;$i++)
           {
            ?>
            <br>
            <br>
            <div class="form-group">
            
                <label for="content"><b>Question <?php echo $i; ?></b></label>
                <textarea class="form-control" id="content" name="question_<?php echo $i; ?>" rows="4" required></textarea>
            </div>
            <div class="form-group">
            
                <label for="content">Choice 1</label>
                <textarea class="form-control" id="content" name="choice_<?php echo $i; ?>_1" rows="1" required></textarea>
            </div>
            <div class="form-group">
            
                <label for="content">Choice 2</label>
                <textarea class="form-control" id="content" name="choice_<?php echo $i; ?>_2" rows="1" required></textarea>
            </div>
            <div class="form-group">
            
                <label for="content">Choice 3</label>
                <textarea class="form-control" id="content" name="choice_<?php echo $i; ?>_3" rows="1" required></textarea>
            </div>
            <div class="form-group">
            
                <label for="content">Choice 4</label>
                <textarea class="form-control" id="content" name="choice_<?php echo $i; ?>_4" rows="1" required></textarea>
            </div>
            <div class="form-group">
                <label for="Correct Option"><b>Correct Answer</b></label>
                <select class="form-control" name="correct_<?php echo $i; ?>" required>
                        <option value="a">Choice #1 </option>
                        <option value="b">Choice #2</option>
                        <option value="c">Choice #3</option>
                        <option value="d">Choice #4</option>
                    </select>
            </div>
         <?php
           }

        ?>
       
            <div class="form-group">
            <input type="submit" class="btn btn-danger" name="post_quiz_btn" value="Create Quiz">
            
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
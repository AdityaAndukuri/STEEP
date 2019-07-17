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
       
        <a href="course_quiz1.php?c_id=<?php echo $c_id; ?>">Quiz 2</a>
        <a  class='active' href='#'> Quiz 2</a>
        <a href="course_quiz3.php?c_id=<?php echo $c_id; ?>">Quiz 3</a>
</div>
<br>
<div class="topnav" style="width:30%; border-radius:10px;">
       <a href='course_quiz2.php?c_id=<?php echo $c_id; ?>' href='#'> Created Quiz</a>
       <a class='active' style="float:right; color:white;"> Submissions Received</a>
</div>
<?php


$db = mysqli_connect('localhost', 'root', '', 'steep') or die(mysqli_error());
 

$quiz_check_query = "SELECT * FROM quizzes WHERE c_id='$c_id' AND id='$a_id' LIMIT 1";
$result = mysqli_query($db, $quiz_check_query);
$quiz = mysqli_fetch_assoc($result);
if($quiz)
{
  //has to be implemented
  $due = $quiz['due'];
?>
  
  <br>
  
<div class="table-responsive">
<form action="" method="post" style="border-radius:10px; width:60%; float:left;">
            <table class="table table-bordered table-striped table-hover">


            <thead>
                    <tr>
                    <th>Roll NO</th>
                        <th>Submitted on</th>
                        <th>Marks</th>
                        
                    </tr>
                </thead>
                <tbody>

                 <?php

$query = "SELECT * FROM quiz_submissions WHERE c_id='$c_id' AND a_id='$a_id' ORDER BY submit_date DESC";
$run_query = mysqli_query($db, $query) or die(mysqli_error($db));
if (mysqli_num_rows($run_query) > 0) {
while ($row = mysqli_fetch_array($run_query)) {
   
    $file_date = $row['submit_date'];
    $roll = $row['roll'];
   
    $marks = $row['marks'];
   

    echo "<tr>";
    echo "<td>$roll</td>";
    echo "<td>$file_date</td>";
    echo "<td>$marks</td>";
    echo "</tr>";

}
}
?>


                </tbody>
            </table>
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
     <form action="course_quiz1.php" method="POST" style="border-radius:5px;">
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
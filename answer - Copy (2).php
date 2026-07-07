<?php
session_start();
include('./_Partial Components/User.php');
include('./_Partial Components/Method.php');
include('./_Partial Components/Database.php');
include('./_Partial Components/Format.php');
$ans = new User();
$exm = new Method();
$answer = $ans->answer($_POST);

if(!isset($_SESSION['Username'])){
    header('Location: sign_in.php');
}

if(isset($_GET['id'])){
   
    $Subject_ID = $_GET['id'];
    $subjectByTime = $exm->getSubject($Subject_ID);
    $rowQuiz = $subjectByTime->fetch_assoc();
}
else{
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Answer </title>

	   	<meta name="viewport" content=" width=device-width, initial-scale=1" />
   	 	<link rel = "Stylesheet" type = "text/css" href = "./CSS/signin-style.css"/>
   		<link rel = "Stylesheet" type = "text/css" href = "./CSS/Online_Quiz_style.css"/>
  		<link href ="./css/bootstrap.min.css" rel=" stylesheet" />
    	<link href ="./css/bootstrap.css" rel=" stylesheet" />
 	    <link rel="stylesheet" href="./css/animated.css">
	    <link rel="icon" type="image/png" href="img/Graduation Cap_48px.png">
  		<link rel="stylesheet" href="css/font-awesome.css">
   
       <script src="./js/jquery.js" type="text/javascript" ></script>
       <script src = "./js/OnlineQuiz.js"></script>
       <script src = ".js/faPrint.js"></script>

   <script type="text/javascript">
   $(document).ready(function(){
   		$('#printAnswer').click(function(){
   			var mode = 'iframe';
   			var close = mode == 'popup';
   			var options = {mode:mode, popClose:close};
   			$('#tblAnswer').printArea(options);
   		});
   });
   </script>

   <script type="text/javascript">
   		function PrintResult(el){
   			var restorepage = document.body.innerHTML;
   			var PrintResult = document.getElementById(el).innerHTML;
   			document.body.innerHTML = PrintResult;
   			window.print();
   		}
   </script>
</head>
<body onload = "ResultTimeout()">
    <?php 
        $total_question = $answer['right']+$answer['wrong']+$answer['no_answer'];
        $attempt_question = $total_question - $answer['no_answer'];
    ?>
        <?php
     if(isset($_SESSION['Username'])){ 
                $Username = $_SESSION['Username'];
                $UsersByUsername = $exm->getUsersByUsername($Username);
                $rows = $UsersByUsername->fetch_array();
               $profile_img = $rows['Image'];
           }
            ?>
        <div class="col-md-6" id = "answer-form">
       <div class="card shadow-lg mt-5">
    <div class="card-header bg-primary text-white">
        <h3>Exam Result</h3>
    </div>

    <div class="card-body">

        <div class="text-center mb-4">

            <img
                src="./img/_ProfilePicture/<?= htmlspecialchars($profile_img) ?>"
                class="rounded-circle"
                width="150"
                height="150">

            <h4 class="mt-3">
                <?= htmlspecialchars($rows['Full_Name']) ?>
            </h4>

        </div>

        <div class="row">

            <div class="col-md-6">
                <p><strong>Subject:</strong>
                    <?= htmlspecialchars($rowQuiz['Subject']) ?>
                </p>

                <p><strong>Teacher:</strong>
                    <?= htmlspecialchars($rowQuiz['Teacher_Name']) ?>
                </p>
            </div>

            <div class="col-md-6">
                <p><strong>Total Questions:</strong>
                    <?= $total_question ?>
                </p>

                <p><strong>Attempted:</strong>
                    <?= $attempt_question ?>
                </p>
            </div>

        </div>

        <hr>

        <div class="row text-center">

            <div class="col">
                <h2 class="text-success">
                    <?= $answer['right'] ?>
                </h2>
                <p>Correct</p>
            </div>

            <div class="col">
                <h2 class="text-danger">
                    <?= $answer['wrong'] ?>
                </h2>
                <p>Wrong</p>
            </div>

            <div class="col">
                <h2 class="text-warning">
                    <?= $answer['no_answer'] ?>
                </h2>
                <p>Not Answered</p>
            </div>

        </div>

        <hr>

        <div class="text-center">

            <h1 class="display-4">
                <?= $percent ?>%
            </h1>

            <span class="badge bg-success fs-5">
                Grade <?= $grade ?>
            </span>

            <h4 class="mt-3">
                <?= $message ?>
            </h4>

        </div>

    </div>
</div>
            </div>
                
            <div class="col-md-6" id = "answer-form">
                <div class="row">
                    <div class="col-md-6">
                        <a href="#" id = "">
                        <button type = "button" value = "Print" class = "button-start-the-quiz" style="width: 100%" onclick="PrintResult('answer-form');" id = "printAwer"> Print Result 
                        </button> </a>
                    </div>
                    <div class="col-md-6">
                        <a href="Exam.php?id=<?php echo $Subject_ID = $_GET['id'];?>">
                        <button type = "button" value = "Start again!" class = "button-start-the-quiz" style="width: 100%" > Start again! 
                        </button> </a>
                    </div>
                </div>
                 
        </div>
        <div class="col-sm-9" style = "display: none;">
            <form class="form-horizontal" method="POST">
              <div class="form-group">
                <label for="inputEmail3" style="text-align: left;" class="col-sm-3 control-label"> User ID </label>
                <div class="col-sm-9">
                  <input type="text" style="color: black;"value = "<?php echo $rows['User_ID'];?>" class="form-control" id="User_ID" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" style="text-align: left;" class="col-sm-3 control-label"> Total No Of Question </label>
                <div class="col-sm-9">
                  <input type="text" style="color: black;"value = "<?php echo $total_question; ?>" class="form-control" id="TotalNumberOfQuestion" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" style="text-align: left;" class="col-sm-3 control-label"> Username </label>
                <div class="col-sm-9">
                  <input type="text" style="color: black;"value = "<?php echo $rows['Username'];?>" class="form-control" id="Username" placeholder="1stAnswer">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" style="text-align: left;" class="col-sm-3 control-label"> Teacher </label>
                <div class="col-sm-9">
                  <input type="text" style="color: black;" value = " <?php echo $rowQuiz['Teacher_Name'];?>" class="form-control" id="Teacher" placeholder="2nd Answer">
                </div>
              </div>
                <div class="form-group">
                <label for="inputPassword3" style="text-align: left;" class="col-sm-3 control-label"> Subject </label>
                <div class="col-sm-9">
                  <input type="text" style="color: black;" value = "<?php echo $rowQuiz['Subject'];?>" class="form-control" id="Subject" placeholder="3rd Answer">
                </div>
              </div>
                <div class="form-group">
                <label for="inputPassword3" style="text-align: left;" class="col-sm-3 control-label"> Credit Hours </label>
                <div class="col-sm-9">
                  <input type="text" style="color: black;" value = "<?php echo $rowQuiz['Credit_Hours'];?>" class="form-control" id="Credit_Hours" placeholder="4th Answer">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" style="text-align: left;" class="col-sm-3 control-label"> Attempted Answer </label>
                <div class="col-sm-9">
                  <input type="text" style="color: black;" value = "<?php echo $attempt_question; ?>" class="form-control" id="Attempted_Answer" placeholder="4th Answer">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" style="text-align: left;" class="col-sm-3 control-label"> Correct Answer </label>
                <div class="col-sm-9">
                  <input type="text" style="color: black;" value = "<?php echo $answer['right'];?>" class="form-control" id="Correct_Answer" placeholder="4th Answer">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" style="text-align: left;" class="col-sm-3 control-label"> Wrong Answer </label>
                <div class="col-sm-9">
                  <input type="text" style="color: black;" value = "<?php echo $answer['wrong'];?>" class="form-control" id="Wrong_Answer" placeholder="4th Answer">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" style="text-align: left;" class="col-sm-3 control-label"> No Answer </label>
                <div class="col-sm-9">
                  <input type="text" style="color: black;" value = "<?php echo $answer['no_answer'];?>" class="form-control" id="No_Answer" placeholder="4th Answer">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" style="text-align: left;" class="col-sm-3 control-label"> Result </label>
                <div class="col-sm-9">
                  <input type="text" style="color: black;" value = "<?php if(!$answer['right']){echo '0';
                    }
                    else{
                        $percent = floor(($answer['right']*100)/($total_question));
                    echo $percent;  
                    }
                    
                ?>" class="form-control" id="Result" placeholder="4th Answer">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="button" class="btn " id = "btn-add-result" > Save Result </button>
                  <span id="span-valid" class="span-validation"></span> 
                </div>
              </div>
            </form>
        </div>
        </div>
    </body>
</html>
	

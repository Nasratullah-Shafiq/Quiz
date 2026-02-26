<?php
include('./_Partial Components/User.php');
include('./_Partial Components/Exam.php');
include('./_Partial Components/Database.php');
include('./_Partial Components/Format.php');
$answ = new User();
$exm = new Exam();
session_start();
$answers = $answ->answer($_POST);

if(!isset($_SESSION['Username'])){
    header('Location: sign in.php');
}
if(isset($_GET['id'])){
    $Subject_ID = $_GET['id'];
    $subjectByTime = $exm->getSubject($Subject_ID);
    $row = $subjectByTime->fetch_assoc();
}
else{
    header('Location: indexDr.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Answer </title>
        <meta http-equiv="content-type" content="text/html; charset = UTF8"/>
        <meta charset="utf-8">
	   	<meta name="viewport" content=" width=device-width, initial-scale=1" />
   	 	<link href = "../CSS/signin-style.css" rel = "Stylesheet" type = "text/css"/>
   		<link href = "../CSS/Online_Quiz_style.css" rel = "Stylesheet" type = "text/css"/>
  		<link href ="../CSS/bootstrap.min.css" rel=" stylesheet" />
    	<link href ="../CSS/bootstrap.css" rel=" stylesheet" />
 	    <link href="../CSS/animated.css" rel="stylesheet">
	    <link href="../img/Graduation Cap_48px.png" rel="icon" type="image/png">
  		<link href="../CSS/font-awesome.css" rel="stylesheet">

	   <script src="../js/bootstrap.min.js"></script>
	   <script src="../js/bootstrap.js"></script>
	   
	   <script src="../js/jquery.js" type="text/javascript" ></script>
	   <script src = "../js/main.js"></script>
	   <script src = "..js/faPrint.js"></script>
       <script src = "./js/TimeOut.js"></script>
       <script src = "./../js/OnlineQuiz.js"></script>

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
<body onload = "ResultTimeout()" class="all-dari-content"> 
	<center>
		<h2> شما موفقانه امتحان <?php echo $row['Subject']?> را سپری نمودید </h2>
	</center>
	<?php 
		$total_question = $answers['right']+$answers['wrong']+$answers['no_answer'];
		$attempt_question = $total_question - $answers['no_answer'];
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
		<table class="table table-bordered" >
                <thead>
                    
                    <tr>
                        <th class = "tr-text-right"> <?php echo "<img alt=''width='130px' height = '120px' src='../img/_ProfilePicture/$profile_img' style = 'margin-top: -5px; margin-bottom: -5px;' />"; ?> </th>
                        <th class = "tr-text-right"> عکس پروفایل </th>
                    </tr>
                    <tr>
                        <th class = "tr-text-right"> <?php echo $total_question; ?> </th>
                        <th class = "tr-text-right"> مجموعه سوالات </th>
                    </tr>
                    <tr>
                        <th class = "tr-text-right"> <?php echo $rows['Full_Name'];?> </th>
                        <th class = "tr-text-right"> اسم محصل </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $row['Subject'];?> </td>
                        <th class = "tr-text-right"> مضمون </th>
                    </tr>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $row['Teacher_Name'];?> </td>
                        <th class = "tr-text-right"> استاد </th>
                    </tr>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $row['Credit_Hours'];?> </td>
                        <th class = "tr-text-right"> کریدیت </th>
                    </tr>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $attempt_question; ?></td>
                        <th class = "tr-text-right"> سوال که جواب داده اید </th>
                    </tr>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $answers['right'];?> </td>
                        <th class = "tr-text-right"> سوال که درست جواب داده اید </th> 
                    </tr>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $answers['wrong'];?> </td>
                        <th class = "tr-text-right"> سوال که اشتباه جواب داده اید </th>
                    </tr>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $answers['no_answer'];?> </td>
                        <th class = "tr-text-right"> سوال که هیچ جواب نداده اید </th>
                    </tr>
                    <tr>
                        <td class = "tr-text-right"> <?php 
                        	if(!$answers['right']){
                        		echo '0'."%";
                        	}
                        	else{
                        		$percent = floor(($answers['right']*100)/($total_question));
                        	echo $percent."%";	
                        	}
                        	
                        ?> </td>
                        <th class = "tr-text-right"> فیصدی نمرات </th>
                    </tr>
                    <tr>
                    	<?php 
                    	if(!$answers['right']){
                        		echo "<h3 class = 'tr-text-right' style = 'color: red;'> متاسفانه شما بی نتیجه شدید  </h3>";
                        	}
                        	else{
                        		if(($answers['right']*100)/($total_question)==0){
                    		echo "<h1 class = 'tr-text-right' style = 'color: red;'> متاسفانه شما بی نتیجه شدید </h1>";
                    	}
                    	elseif(($answers['right']*100)/($total_question)>=75 && ($answers['right']*100)/($total_question)<85){
                    		echo "<h1 class = 'tr-text-right' style = 'color: green;'> شما گرید C اخذ نمودید </h1>";
                    	}
                    	elseif(($answers['right']*100)/($total_question)>=85 && ($answers['right']*100)/($total_question)<90){
                    		echo "<h1 class = 'tr-text-right' style = 'color: green;'> شما درجه عالی گرید B اخذ نمودید </h1>";
                    	}
                    	elseif(($answers['right']*100)/($total_question)>=90 && ($answers['right']*100)/($total_question)<=100){
                    		echo "<h1 class = 'tr-text-right' style = 'color: green;'>اخذ نمودید A شما درجه اعلی گرید </h1>";
                    	}
                    	else{
                    		echo "<h1 class = 'tr-text-right'> شما کامیاب شدید </h1>";
                    	}
                        	}
                    	?>
                    </tr>
                </tbody> 
                </table>
            </div>
            	
            <div class="col-md-6" id = "answer-form">
                <div class="row">
                    <div class="col-md-6">
                        <a href="Exam.php?id=<?php echo $subject_ID = $_GET['id'];?>">
                        <button type = "button" value = "Start again!" class = "button-start-the-quiz-dr pull-right" style = "width: 100%"> دوباره آغاز شود 
                        </button> </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" id = "">
                            <button type = "button" value = "Print" class = "button-start-the-quiz-dr pull-right" style="width: 100%" onclick="PrintResult('answer-form');" id = "printAwer"> نتیجه چاپ شود 
                        </button> </a>
                    </div>
                </div>
            </div>
            <div class="col-md-9" style="text-align: right; display: none;">
                
                    <form class="form-horizontal" action = "" method = "POST">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="inputEmail3" style="text-align: left;" class="col-sm-3 control-label"> User ID </label>
                                <div class="col-sm-9">
                                  <input type="text" style="color: black;"value = "<?php echo $rows['User_ID'];?>" class="form-control" id="User_ID" placeholder="">
                                </div>
                              </div>
                            <label for="inputEmail3" class="col-sm-2 pull-right"> مجموعه سوالات </label>
                            <div class="col-sm-10">
                                <input type="text" value = "<?php echo $total_question; ?>" style = "color: black"  class="form-control tr-text-right" id="TotalNumberOfQuestion" placeholder=" مجموعه سوالات ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 pull-right"> اسم یوزر </label>
                            <div class="col-sm-10">
                                <input type="text" value = "<?php echo $rows['Username'];?>" style = "color: black"  class="form-control tr-text-right" id="Username" placeholder=" اسم یوزر ">
                            </div>
                        </div>
						<div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 pull-right"> مضمون </label>
                            <div class="col-sm-10">
                                <input type="text" value = "<?php echo $row['Subject'];?>" style = "color: black"  class="form-control tr-text-right pull-left" id="Subject" placeholder="مضمون">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 pull-right"> کریدیت</label>
                            <div class="col-sm-10">
                                <input type="text" value = "<?php echo $row['Credit_Hours'];?>" style = "color: black"  class="form-control tr-text-right pull-left" id="Credit_Hours" placeholder="کریدیت">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 pull-right"> استاد </label>
                            <div class="col-sm-10">
                                <input type="text" value = "<?php echo $row['Teacher_Name'];?>" style = "color: black"  class="form-control tr-text-right pull-left" id="Teacher" placeholder="استاد">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 pull-right"> سوال که جواب داده اید </label>
                            <div class="col-sm-10">
                                <input type="text" value = "<?php echo $attempt_question; ?>" style = "color: black"  class="form-control tr-text-right pull-left" id="Attempted_Answer"  placeholder="سوال که جواب داده اید">
                            </div>
                        </div>
						<div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 pull-right"> سوال که درست جواب داده اید </label>
                            <div class="col-sm-10">
                                <input type="text" value = "<?php echo $answers['right'];?>" style = "color: black"  class="form-control tr-text-right pull-left" id="Correct_Answer" placeholder="سوال که درست جواب داده اید">
                            </div>
                        </div>
						<div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 pull-right"> سوال که اشتباه جواب داده اید </label>
                            <div class="col-sm-10">
                                <input type="text" value = "<?php echo $answers['wrong'];?>" style = "color: black"  class="form-control tr-text-right pull-left" id="Wrong_Answer"  placeholder="سوال که اشتباه جواب داده اید">
                            </div>
                        </div>
						<div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 pull-right"> سوال که جواب نداده اید </label>
                            <div class="col-sm-10">
                                <input type="text" value = "<?php echo $answers['no_answer'];?>" style = "color: black"  class="form-control tr-text-right pull-left" id="No_Answer"  placeholder="سوال که جواب نداده اید">
                            </div>
                        </div>
						<div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 pull-right"> نتیجه شما </label>
                            <div class="col-sm-10">
                                <input type="text" value = "<?php 
                        	if(!$answers['right']){
                        		echo '0';
                        	}
                        	else{
                        		$percent = floor(($answers['right']*100)/($total_question));
                        	echo $percent;	
                        	}
                        	
                        ?>" style = "color: black" class="form-control tr-text-right pull-left" id="Result"  placeholder="نتیجه شما">
                            </div>
                        </div>
					
                        <div class="form-group">

                            <div class="col-sm-10">
                                
                                <button type="button" class="button-start-the-quiz-dr" id = "btn-add-result" name = "submit"> نتیجه ثبت شود</button>
                                <span id="span-valid" class="span-validation"></span>
                            </div>
                    </form>
                </div>
	</body>
</html>
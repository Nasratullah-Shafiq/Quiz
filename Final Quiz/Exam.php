<?php

include('./_Partial Components/Header.php');


if (isset($_GET['id'])) {
    $Subject_ID = $_GET['id'];
    $question = $exm->getQuestion($Subject_ID);
}
else{
    header('Location: index.php');
}
?>
<?php if(isset($_SESSION['Username'])){ 
    $Username = $_SESSION['Username'];
    $UsersByUsername = $exm->getUsersByUsername($Username);
    $row = $UsersByUsername->fetch_assoc();
    if($row['Status']=='0'){
       header('Location: index.php');
    }}?>
<div class="jumbotron" id = "jbt" style="background-image: url('./img/IBPS-Banne.jpg'); background-size: cover;">
        <div class="container">
            <div id="details" class="animated fadeInUp">
                <h1> ONLINE <span> QUIZ </span> SYSTEM </h1>
                <p class = "paragraph">Test Your Intellect</p>
            </div>
        </div>
    </div>
        <!-- BEGIN DIV FOR CONTAINING ALL OBJECTS IN EXAM PAGE  -->
    	<div class="container">
    		<!-- BEGIN DIV FOR CONTAINING NAVIGATION AND QUESTIONS  -->
    		<div class="row">

            <!-- BEGIN DIV FOR CONTAINING NAVIGATION OF SUBJECTS -->
    		<div class="col-md-3" id="sam"> 
    			<?php
    				include('./_Partial Components/Navigation.php');
    			?>
    		</div>
            <!-- END OF DIV CONTAINING NAVIGATION OF SUBJECTS -->
            <?php
                if(isset($_GET['id'])){
                    $subjectByTime = $exm->getSubject($Subject_ID);
                    $row = $subjectByTime->fetch_assoc();
                }
                else{
                    header('Location: index.php');
                }
           
            ?>
            <!-- BEGIN SCRIPT FOR TIME LEFT COUNT DOWN TIMER -->
            <script type = "text/javascript">
                    var timeLeft=<?php echo $row['Time']*60;?>;
            </script>
            <!--  END OF SCRIPT FOR TIME LEFT COUNT DOWN TIMER  -->
    		<div class="col-md-9">

                <!-- BEGIN DIV FOR SUBJECT AND TIME LEFT -->
                <div calss="row">
				<div class = "col-sm-9">
                    <p class = "page-heading"> 
                    <?php echo $row['Subject'].' Quiz';?>
                    </p>
                </div>
                <!-- END OF DIV FOR QUESTIONS HEADING-->

                <!-- BEGIN DIV FOR TIMER COUNT DOWN -->
                <div class="col-sm-3">
                    <div class = "col-sm-6" id = "Time-left">
                        <h5> Time left: </h5>
                        
                    </div>
                    <div class = "col-sm-6" id = "Time">
                    </div>
                </div>
                </div>
                <!-- END OF DIV SUBJECT AND TIME LEFT -->
                <div class = "col-sm-5 paragraph" id = "msg"></div>
                <!-- END OF DIV FOR TIMER COUNT DOWN -->
                
                <!-- BEGIN DIV FOR SHOWING QUESTIONS-->
                <div class = "col-lg-12">
                <div class = "col-md-12" id = "attention" >
                    <p class = "paragraph"> Pay attention once you select the answer it will lock. 
                         after the answer get locked you won't be able to change answer</p>
                </div>
                <?php 
                /* THROUGH THE FOLLOWING FORM THE QUESTIONS IS BEING SUBMITED TO QuizAnswer.php WHICH THE RESULT IS BEING SHOWN  */
                //$id = $row['Subject_ID']; ?>
                <!-- BEGIN FROM CONTAINS ALL QUESTIONS -->
                
                <form method = "POST" action = "QuizAnswer.php?id=<?php echo $row['Subject_ID']?>" id = "QuizAnswer">
                <?php 
                    $i=1;
                    $a=0;
                    $count = mysqli_query($con, "SELECT * from Question where Subject_ID = '$Subject_ID' and Language = 'English'");  
                    $c = mysqli_num_rows($count);
                    $rand = rand(0, $c);
                    $get = mysqli_query($con,"SELECT * from Question where Subject_ID = '$Subject_ID' and Question_ID>'$rand' limit 12");
                    
                    if(mysqli_num_rows($get)>0){
                   
                    while($row=mysqli_fetch_array($get)){?>
                    
                    <table class="table">
                <thead>
                    <tr>
                        <th> <?php echo 'Q'.$i.':';?> <?php echo $row['Question'];?> </th>
                    </tr>
                </thead>
                <tbody>
                <?php if(isset($row['Answer0'])){ ?>
                    <tr>
                        <td>&nbsp;1 &nbsp;<input type="radio" id = "<?php echo 'AnsZero'.$a;?>" value = "0"  name = "question[<?php echo $row['Question_ID']; ?>]">&nbsp;<?php echo $row['Answer0'];?></td>
                    </tr>
                <?php }?>
                <?php if(isset($row['Answer1'])){ ?>
                    <tr>
                        <td>&nbsp;2 &nbsp;<input type="radio" id = "<?php echo 'AnsOne'.$a;?>" value = "1" name = "question[<?php echo $row['Question_ID']; ?>]" >&nbsp;<?php echo $row['Answer1'];?></td> 
                    </tr>
                <?php }?>
                <?php if(isset($row['Answer2'])){ ?>
                    <tr>
                        <td>&nbsp;3 &nbsp;<input type="radio" id = "<?php echo 'AnsTwo'.$a;?>" value = "2" name = "question[<?php echo $row['Question_ID']; ?>]">&nbsp;<?php echo $row['Answer2'];?></td>
                    </tr>
                <?php }?>
                <?php if(isset($row['Answer3'])){ ?>
                    <tr>
                        <td>&nbsp;4 &nbsp;<input type="radio" id = "<?php echo 'AnsThree'.$a;?>" value = "3" name = "question[<?php echo $row['Question_ID']; ?>]">&nbsp;<?php echo $row['Answer3'];?></td>
                    </tr>
                <?php }?>
                    <tr style = "display: none;">
                        <td> <input type="radio" checked="checked" style = "display: none;" value = "No_Attempt" name = "question[<?php echo $row['Question_ID']; ?>]"/></td>
                    </tr>
                </tbody> 
                </table>
                <?php $i++; $a++;}} 
                else{
                	echo "<br>";
                    echo "<br>";
                    echo "<br>";
                    echo '<div class="alert alert-danger" role="alert"> Opps!... No Questions available for this subject</div>';
                    echo "<br>";
                    }
                   
                    ?>
                <input type = "submit" value = "Submit Quiz" class = "button-start-the-quiz"/>
				</form>
                <!-- END OF FORM CONTAINING QUESTIONS -->
                </div>
                <!-- END OF DIV CONTAINING QUESTIONS -->
                </div>
                <!-- END OF DIV FOR CONTAINING NAVIGATION AND QUESTIONS  -->
    		</div>
            <!-- END OF DIV CONTAINING ALL OBJECTS -->
    	</div>
        <div id = "topBtn"><i class = "fa fa-arrow-up" ></i></div>
<?php
include('./_Partial Components/Footer.php');
?>

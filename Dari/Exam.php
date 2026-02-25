<?php

include('./_Partial Components/Header.php');

 if(!isset($_SESSION['Username'])){
     header('Location: sign in.php');
 }
    $Subject_ID = $_GET['id'];
    $subjectByTime = $exm->getSubject($Subject_ID);
    $row = $subjectByTime->fetch_assoc();

    if(isset($_GET['id'])){
        $Question = $exm->getQuestions($Subject_ID);
    }
    ?>
<?php if(isset($_SESSION['Username'])){ 
    $Username = $_SESSION['Username'];
    $UsersByUsername = $exm->getUsersByUsername($Username);
    $row = $UsersByUsername->fetch_assoc();
    if($row['Status']=='0'){
       header('Location: index.php');
    }}?>
    <div class="jumbotron" id = "jbt" style="background-image: url('../img/IBPS-Banner12.jpg'); background-size: cover;">
        <div class="container">
            <div id="detailsDr" class="animated fadeInLeft">
                <h1> سیستم <span> امتحان دهی </span> آنلاین </h1>
                <p class = "paragraphDr">ذکاوت خود را امتحان کنید</p>
            </div>
        </div>
    </div>
        <!--================================================================ 
            BEGIN CONTAINER DIV FOR CONTAINING ALL OBJECTS IN EXAM PAGE  
        =================================================================-->
    	<div class="container">
    		<!-- ===========================================================
                BEGIN DIV FOR CONTAINING NAVIGATION AND QUESTIONS  
            =============================================================-->
    		<div class="row">
            <!-- ===========================================================
                BEGIN of div for showing Navigation in Exam page  
            =============================================================-->
            <?php 
                $subjectByTime = $exm->getSubject($Subject_ID);
                $row = $subjectByTime->fetch_assoc();
            ?>
            <script type = "text/javascript">
                    var timeLeft=<?php echo $row['Time']*60;?>;       
            </script>
            <!-- ===========================================================
                BEGIN DIV FOR CONTAINING NAVIGATION OF SUBJECTS 
            =============================================================-->
                <div class="col-md-3" id = "nav-exam-dr" style="float: right;"> 
                    <?php
                        include('./_Partial Components/Navigation.php');
                    ?>
                </div>
            <!-- ===========================================================
                END OF DIV CONTAINING NAVIGATION OF SUBJECTS 
            =============================================================-->
            <!-- ===========================================================
                BEGIN DIV FOR CONAINING QUESTIONS
            =============================================================-->
    		<div class="col-md-9" id = "div-exam-dr">

            <!-- ===========================================================
                BEGIN DIV FOR QUESTIONS HEADING
            ==============================================================-->
                <div calss="row">
                <div class="col-sm-3">
                    <div class = "col-sm-6" id = "Time-left" style="float: right;">
                        <h5> زمان </h5>
                        
                    </div>
                    <div class = "col-sm-6" id = "Time">
                    </div>
                </div>

				<div class = "col-sm-9">
                    <p class = "page-headingDr"> 
                    <?php 
                     if (isset($_GET['id'])) {
						$Subject_ID = $_GET['id'];
						$subjectByTime = $exm->getSubject($Subject_ID);
						$row = $subjectByTime->fetch_assoc();
					 }
                    ?>
                    <?php echo 'امتحان '.$row['Subject'];?>
                    </p>
                </div>
                <!-- ===================================================
                    END OF DIV FOR QUESTIONS HEADING
                =====================================================-->

                <!--==========================================================
                    BEGIN DIV FOR TIMER COUNT DOWN 
                ============================================================-->
                
                </div>
                <div class = "col-sm-12" style="text-align: right;" id = "msg">
                    
                </div>
                <!-- =========================================
                    END OF DIV FOR TIMER COUNT DOWN 
                ============================================-->

                <!-- ===========================================
                    BEGIN DIV FOR SHOWING QUESTIONS
                =============================================-->
                <div class = "col-lg-12">
                <div class = "col-md-12" id = "attention" >
                    <p class = "paragraphDr"> توجه نمایید وقتیکه سوال را انتخاب نمایید دیگر نمی توانید آنرا تغیر دهید</p>
                </div>

                <?php 
                /* ======================================================================
                    THROUGH THE FOLLOWING FORM THE QUESTIONS IS BEING SUBMITED TO 
                    QuizAnswer.php WHICH THE RESULT IS BEING SHOWN  
                =========================================================================*/
                $id = $row['Subject_ID']; ?>
                <!-- ==================================================
                    BEGIN FROM CONTAINS ALL QUESTIONS 
                ====================================================-->
                <form method = "POST" action = "QuizAnswer.php?id=<?php echo $Subject_ID = $_GET['id'];?>" id = "QuizAnswer">
                    <?php 
                    $i=1;
                    $a=0;
                    if(!$Question){
						echo "<br>";
						echo "<br>";
						echo "<div class='alert alert-danger text-right' role='alert' style = 'font-size: 16px;'> برای این مضمون سوال وجود ندارد </div>";
                    }
                    else{

                        if($Question->num_rows>0){
                           
                        while($row = $Question->fetch_assoc()){?>
                    <table class="table tr-text-right" style="font-size: 18px;" >
                <thead>
                    <tr>
                        <th class="tr-text-right"> <?php echo ' سوال '.$i.': ';?> <?php echo $row['Question'];?> </th>
                    </tr>
                </thead>
                <tbody>
                <?php if(isset($row['Answer0'])){ ?>
                    <tr>
                        <td> &nbsp;<?php echo $row['Answer0'];?> &nbsp; <input type="radio" id = "<?php echo 'AnsZero'.$a;?>" value = "0"  name = "<?php echo $row['Question_ID']; ?>"></td>
                    </tr>
                <?php }?>
                <?php if(isset($row['Answer1'])){ ?>
                    <tr>
                        <td><?php echo $row['Answer1'];?> &nbsp; <input type="radio" id = "<?php echo 'AnsOne'.$a;?>" value = "1" name = "<?php echo $row['Question_ID']; ?>" ></td> 
                    </tr>
                <?php }?>
                <?php if(isset($row['Answer2'])){ ?>
                    <tr>
                        <td><?php echo $row['Answer2'];?> &nbsp;<input type="radio" id = "<?php echo 'AnsTwo'.$a;?>" value = "2" name = "<?php echo $row['Question_ID']; ?>"></td>
                    </tr>
                <?php }?>
                <?php if(isset($row['Answer3'])){ ?>
                    <tr>
                        <td><?php echo $row['Answer3'];?> &nbsp;<input type="radio" id = "<?php echo 'AnsThree'.$a;?>" value = "3" name = "<?php echo $row['Question_ID']; ?>"></td>
                    </tr>
                <?php }?>
                    <tr style = "display: none;">
                        <td> <input type="radio" checked="checked" style = "display: none;" value = "No_Attempt" name = "<?php echo $row['Question_ID']; ?>"/></td>
                    </tr>
                </tbody> 
                </table>
                <?php $i++; $a++;}} 
                else{
					echo "<br>";
					echo "<br>";
                    echo "<div class='alert alert-danger text-right' role='alert' style = 'font-size: 16px;'> برای این مضمون سوال وجود ندارد </div>";
                    echo "<br>";
                    }
                    }
                    ?>
                <!-- <input style = "float: right; width: 35%; font-size: 19px;" type = "submit" value = "ثبت شود" class = "btn btn-info"/>
				 -->
                 <input style="float: right;" type = "submit" value = "ثبت شود" class = "button-start-the-quiz-dr"/>
                
                 </form>
                <!-- ======================================
                    END OF FORM CONTAINING QUESTIONS 
                =========================================-->
                
                <!-- =======================================
                    END OF FORM CONTAINING QUESTIONS 
                =========================================-->
                </div>
                <!-- =======================================
                    END OF DIV CONTAINING QUESTIONS 
                =========================================-->
                </div>
                <!-- =====================================================
                    END OF DIV FOR CONTAINING NAVIGATION AND QUESTIONS  
                =======================================================-->
    		</div>
            <!-- ========================================================
                END OF DIV CONTAINING ALL OBJECTS 
            ===========================================================-->
<?php
include('./_Partial Components/Footer.php');
?>
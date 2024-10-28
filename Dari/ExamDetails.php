<?php

include('./_Partial Components/Header.php');
include('../_Partial Components/User.php');

?>
 <?php

//$total = $exm->getTotalRows();

 $ans = new User();
 if (isset($_GET['id'])) {
 	$Subject_ID = $_GET['id'];
    $subjectByTime = $exm->getSubjec($Subject_ID);
    $row = $subjectByTime->fetch_assoc();
 }

?>

<?php if(isset($_SESSION['Username'])){ 
    $Username = $_SESSION['Username'];
    $UsersByUsername = $exm->getUsersByUsername($Username);
    $row = $UsersByUsername->fetch_assoc();
    if($row['Status']=='0'){
       header('Location: index.php');
}}
// else{
//     header('Location: sign in.php');
// }
?>
<div class="jumbotron" id = "jbtdr">
        <div class="container">
            <div id="detailsDr" class="animated fadeInLeft">
                <h1> سیستم <span> امتحان دهی </span> آنلاین </h1>
                <p class = "paragraphDr">ذکاوت خود را امتحان کنید</p>
            </div>
        </div>
    </div>
        <!-- div for containing all objects in Exam page-->
    	<div class="container">
    		<div class="row">

            
                <!-- div for containing navigation of subject. Navigation.php is located in 
            _Partial Components folder   -->
                <div class="col-md-3" style="float: right;"> 
                <?php
                    include('./_Partial Components/Navigation.php');
                ?>
            
                </div>
            <!-- end of div for showing Navigation in Exam page  -->
    		<div class="col-md-9" style="float: left;">

            <!-- div for Question heading-->
				<div class = "col-sm-12" style = "text-align: right;">
                    
                    <p class = "page-headingDr"> 
                    <?php 
                     if (isset($_GET['id'])) {
                     	$Subject_ID = $_GET['id'];
                        $subjectByTime = $exm->getSubject($Subject_ID);
                        $row = $subjectByTime->fetch_assoc();
                     }
                    ?>
                    <?php echo ' امتحان '.$row['Subject']; ?>
                    </p>
                </div>
                <!-- end of div for Question heading-->

                <!-- div for showing Questions in Exam page-->
                <div class = "col-lg-12">
				<div class = "line"> </div>
				<p class="paragraphDr"> شما می توانید ذکاوت خود را در مضمون <?php echo $row['Subject'] .' امتحان کنید.';?> </p>

				<div class = "line"> </div>
				<p class = "page-headingDr"> در مورد امتحان</p>
				<p class="paragraphDr"> <?php echo ' امتحان '.$row['Subject']; ?> شامل  <?php
				$Subject_ID = $_GET['id'];
               $result = mysqli_query($con, "select * from Question where Subject_ID='$Subject_ID'");
               $total = mysqli_num_rows($result);
                if(!$total<0){
                        echo '0';
                    }
                    else{
                        echo $total;
                        } ?>

                        سوال برای وقت  
                        <?PHP
                        $time = $row['Time']; 
                        $mnt = floor($time/60);

                            if($time>0 && $time<60){
                                echo $time.' ثانیه';
                            }
                            else{
                                
                                echo $mnt.' دقیقه ';
                            }
                        ?> می باشد</p>
				<p class="paragraphDr"> این امتحان یک امتحان رسمی می باشد که شما می توانید مهارت های موجود در امتحان <?php echo $row['Subject']; ?> را معلوم کنید </p>
				<p class = "page-headingDr"> نمرات امتحان </p>
				<p class="paragraphDr"> با انتخاب نمودن هر جواب درست شما 1 نمره اخذ می کنید که در اخیر نمرات شما نشان داده می شود که بلند ترین نمره هم <?php //echo $total;?> می باشد . </p>
				<p class = "page-headingDr"> !امتحان آغاز شود </p>
				<a href = "Exam.php?id=<?php echo $Subject_ID = $_GET['id'];?>"> 
                <input type = "button" value = "امتحان آغاز شود" class = "button-start-the-quiz-dr" style="float: right; height: 45px;"/>
                </a>
                
                </div>
                <!-- end of div for showing Questions in Exam page-->
                </div>
    		</div>
            <!-- end of div for containing all objects in Exam page-->
    	</div>
<?php
include('./_Partial Components/Footer.php');
?>
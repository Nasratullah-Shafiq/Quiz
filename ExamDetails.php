<?php

include('./_Partial Components/Header.php');
include('./_Partial Components/User.php');

$ans = new User();

    $Subject_ID = $_GET['id'];
	// $total = $exm->getTotalRowsOfSubject($Subject_ID);
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
            <div id="details" class="animated zoomInDown">
                <h1> ONLINE <span> QUIZ </span> SYSTEM </h1>
                <p class = "paragraph">Test Your Intellect</p>
            </div>
        </div>
    </div>
        <!-- ===================================================
           	BEGIN DIV FOR CONTAINING OF ALL ELEMENTS IN BODY
        =====================================================-->
    	<div class="container">
    		<div class="row">

            <!-- ===================================================
               	BEGIN NAVIGATION OF SUBJECTS
            =====================================================-->
    		<div class="col-md-3"> 
    			<?php
    				include('./_Partial Components/Navigation.php');
    			?>
    		</div>
            <!-- ===================================================
                END OF NAVIGATION OF SUBJECTS
            =====================================================-->
    		<div class="col-md-9">

        	    <!--====================================================
                	BEGIN OF DIV FOR QUESTION HEADING
                =====================================================-->
				<div class = "col-sm-9">
                    <p class = "page-heading">
	                <?php 
		            if (isset($_GET['id'])) {
					 	$Subject_ID = $_GET['id'];
					    $subjectByTime = $exm->getSubject($Subject_ID);
					    $row = $subjectByTime->fetch_assoc();
					    echo $row['Subject'].' Quiz';
					}
					else{
	                    header('Location: index.php');
					}
	                ?>
                    </p>
                </div>
                <!-- ===================================================
                	END OF DIV FOR QUESTION HEADING
                =====================================================-->

                <!-- ===================================================
                	BEGIN DIV FOR QUESTION DETAILS
                =====================================================-->
                <div class = "col-lg-12">
				<div class = "line"> </div>
                <h1><?php //echo $_POST['Cat'];?></h1>
				<p class="paragraph"> Here you can test your <?php echo $row['Subject']; ?> skills </p>

				<div class = "line"> </div>
				<p class = "page-heading"> The Test </p>
				<!--====================================================
                	BEGIN PARAGRAPH FOR TOTAL QUESTION AND TIME
                =====================================================-->
				<p class="paragraph"> The test contains <?php 
                   $Subject_ID = $_GET['id'];
                   $result = mysqli_query($con, "select * from Question where Subject_ID='$Subject_ID'");
                   $total = mysqli_num_rows($result);
                if($total<=0){
                       echo '0';
                    }
                    if($total>0){
                        echo $total;
                        } ?> 
                         <?php
                            $time = $row['Time'];
                       
                        ?>
                        questions for time limit of 
                        <?PHP 
                        $mnt = floor($time/60);

                            if($time>0 && $time<60){
                                echo $time.' Minutes';
                            }
                            else{
                                
                                echo $mnt.' Minutes ';
                            }
                        ?> </p>
                        <!-- ===================================================
                			END OF PARAGRAPH FOR TIME AND TOTAL QUESTIONS
                		=====================================================-->
				<p class="paragraph"> The test is an official test, it's just a nice way to see how much you know, or don't know, about <?php echo $row['Subject']; ?></p>
				<p class = "page-heading"> Count Your score </p>
				<p class="paragraph"> You will get 1 point for each correct answer. At the end of the Quiz, your total score will be displayed. 
				Maximum score is <?php echo $total; ?> points..</p>
				<p class = "page-heading"> Start the Quiz! </p>
				<a href = "Exam.php?id=<?php echo $Subject_ID = $_GET['id'];?>"> 
				<button type="button" class = "button-start-the-quiz"name="btnStartTheQuiz" class="signin">Start the Quiz 
				</button> </a>
                <?php 
                $id = $row['Subject_ID']; ?>
                
                </div>
                <!-- ===================================================
                	END OF QUESTION DETAILS DIV
                =====================================================-->
                </div>
    		</div>
            <!-- ===============================================================
            	END OF DIV FOR CONTAINING ALL OBJECTS IN EXAM DETAILS PAGE
            ================================================================= -->
    	</div>
<?php
include('./_Partial Components/Footer.php');
?>
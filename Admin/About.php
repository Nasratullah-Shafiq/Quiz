
<?php include('./_Partial Components/Header.php');

?>
<?php $Teacher = $exm->getTeacher();

 ?>
    <div class="containe">
    	<div class="row" id="row">
            <div class="left-side-bar">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                 <?php include('./_Partial Components/Navigation.php');?>
                <!-- END SIDEBAR -->
            </div>
            <div class="right-side-bar">
            
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <div class="row">
            <div calss = "col-md-9">
                <h1 style = "color: #2C3E50"> <i class = "fa fa-graduation-cap"> </i> <small> About ONLINE QUIZ </small></h1><hr>
                <ol class="breadcrumb">
                    <li style="color: #5C9BD1"><a href=""> <i class = "fa fa-tachometer"></i> Dashboard </a></li>
                    <li class = ""> <a href="#"> <i class = "fa fa-graduation-cap"></i> About </a></li>
                </ol>
            </div>
            	<div class="col-md-9">
                    <h1 id="text-index-page"> About Online Quiz</h1>
                Online Quiz Portal is the best mode to track the students' capabilities
                and test them in high levels to act their best in the next attack. ONLINE
                QUIZ portal not only looking into the down marks of students. 
                but also assisting the students and educational institute transcend 
                geographical boundries and time restrains in the chore of constant
                evaluation of pupil of functioning. The online Quiz Provides intensive 
                tools to administrator. monitor and grade Quizez online. ONLINE QUIZ is
                primary want for college, Universities, Teachers, Professors, Employess       
                or any one you want to allow to secure content.
    			</div>
<!-- END QUICK SIDEBAR -->
			</div>             	   	  
		</div>
	</div>
</div>

<?php 
include('./_Partial Components/Footer.php');
?>
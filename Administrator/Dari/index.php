<?php

include('./_Partial Components/Header.php');
$totalQuestions = $exm->getAllQuestions();
$totalSubjects = $exm->getAllSubjects();
$totalTeachers = $exm->getAllTeachers();
$totalUsers = $exm->getAllUsers();
$totalContacts = $exm->getAllContacts();

$Username = $_SESSION['Username'];
    $UsersByUsername = $exm->getUsersByUsername($Username);
    $row = $UsersByUsername->fetch_assoc();
    if($row['Role_ID']=='2'){
        header('Location: ../sign in.php');
    }
if(!isset($_SESSION['Username'])){
   header('Location: ../sign in.php');
}

?>

    <div class="container-fluid">
    	<div class="row" id="r">
            <div class="left-side-bar pull-right">
                <!-- BEGIN SIDEBAR -->
                <?php include('./_Partial Components/Navigation.php');?>
                <!-- END SIDEBAR -->
            </div>
            <div class="right-side-bar">
                <div class = "col-md-12" style = "text-align: right;">
                    <h1 style = "color: #2C3E50" class="text-right">  دشبورد  <small> بازدید آمار  <i class = "fa fa-tachometer"> </i></small></h1><hr>
                    <ol class="breadcrumb" class = "text-right">

                        <li class = "activ">  <a href="Add-Questions.php">  <i class = "fa fa-question"></i> اضافه کردن سوالات </a></li>
                        <li><a href="index.php"> صفحه اصلی <i class = "fa fa-tachometer"></i>  </a></li>
                    </ol>
                </div>

                <!-- BEGIN DIV WITH FOURE DIV PANEL FOR SHOWING STATISTICS OF DATA-->
                
                <div class = "row tab-boxes">

                <!--  BEGIN FISRT THEM PANEL FOR SHOWING OF DATA  -->
                    <div class="col-md-6 col-lg-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                               <div class = "row">
                                    <div class="col-xs-3 panel-top">
                                        <i class = "fa fa-question fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="text-right huge"> <?php 

                                        if(!$totalQuestions){
                                            echo "0";
                                        }
                                        else{
                                            $totalQues = $totalQuestions->num_rows;
                                            echo $totalQues;
                                        }
                                         ?></div>
                                        <div class="text-right"> سوالات </div>
                                    </div>
                               </div>
                            </div>
                            <a href="Manage-Questions.php">
                                <div class="panel-footer">
                                    <span class = "pull-right"> بازدید تمام سوالات</span>
                                    <span class = "pull-left"> <i class = "fa fa-arrow-circle-left"></i></span>
                                    <div class = "clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--  END OF FISRT THEM PANEL FOR SHOWING OF DATA  -->

                    <!--  BEGIN SECOND THEM PANEL FOR SHOWING OF DATA  -->
                    <div class="col-md-6 col-lg-3">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                               <div class = "row">
                                    <div class="col-xs-3 panel-top">
                                        <i class = "fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="text-right huge"> <?php 
                                        if(!$totalUsers){
                                            echo "0";
                                        }
                                        else{
                                            $ttlUsers = $totalUsers->num_rows;
                                            echo $ttlUsers;  
                                        }
                                         ?> </div>
                                        <div class="text-right"> يوزر </div>
                                    </div>
                               </div>
                            </div>
                            <a href="Manage-Users.php">
                                <div class="panel-footer">
                                    <span class = "pull-right"> باز دید تمام یوزر ها</span>
                                    <span class = "pull-left"> <i class = "fa fa-arrow-circle-left"></i></span>
                                    <div class = "clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--  END OF SECOND THEM PANEL FOR SHOWING OF DATA  -->

                    <!--  BEGIN THIRD THEM PANEL FOR SHOWING OF DATA  -->
                    <div class="col-md-6 col-lg-3">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                               <div class = "row">
                                    <div class="col-xs-3 panel-top">
                                        <i class = "fa fa-book fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="text-right huge"> <?php 
                                        if(!$totalSubjects){
                                            echo "0"; 
                                        }
                                        else{
                                            $totalSub = $totalSubjects->num_rows;
                                            echo $totalSub;
                                        }
                                        ?> </div>
                                        <div class="text-right"> مضامین </div>
                                    </div>
                               </div>
                            </div>
                            <a href="Manage-Subject.php">
                                <div class="panel-footer">
                                    <span class = "pull-right"> بازدید تمام مضامین</span>
                                    <span class = "pull-left"> <i class = "fa fa-arrow-circle-left"></i></span>
                                    <div class = "clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--  END OF THIRD THEM PANEL FOR SHOWING OF DATA  -->

                    <!--  BEGIN FOURTH THEM PANEL FOR SHOWING OF DATA  -->
                    <div class="col-md-6 col-lg-3">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                               <div class = "row">
                                    <div class="col-xs-3 panel-top">
                                        <i class = "fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="text-right huge"> <?php 
                                        if(!$totalTeachers){
                                            echo "0";
                                        }
                                        else{
                                            $totlTech = $totalTeachers->num_rows;
                                            echo $totlTech;
                                        }
                                         ?> </div>
                                        <div class="text-right"> اساتید </div>
                                    </div>
                               </div>
                            </div>
                            <a href="Manage-Teacher.php">
                                <div class="panel-footer">
                                    <span class = "pull-right"> بازدید تمام اساتید</span>
                                    <span class = "pull-left"> <i class = "fa fa-arrow-circle-left"></i></span>
                                    <div class = "clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--  END OF FOURTH THEM PANEL FOR SHOWING OF DATA  -->
                </div> 

            
    <!-- END QUICK SIDEBAR -->
        </div> 
                	   	  
    </div>
</div>
<script>
        $(".set > a").click(function(event){
            event.preventDefault();
        });

        $(document).ready(function(){

            $(".set > a").on("click", function(){
                if($(this).hasClass("active")){
                    $(this).removeClass("active");
                    $(this).siblings('.content').slideUp(500);
                    $(".set > a i").removeClass("fa-angle-down").addClass("fa-angle-left");
                }
                else{
                    $(".set > a i").removeClass("fa-angle-down").addClass("fa-angle-left");
                    $(this).find("i").removeClass("fa-angle-left").addClass("fa-angle-down");
                    $(".set > a").removeClass("active");
                    $(this).addClass("active");
                    $('.content').slideUp(500);
                    $(this).siblings('.content').slideDown(500);
                }
            });

</script>
<?php 
include('./_Partial Components/Footer.php');
?>
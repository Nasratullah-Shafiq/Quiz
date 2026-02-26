<?php

include('./_Partial Components/Header.php');

?>
<?php

if(!isset($_SESSION['Username'])){
    header('Location: sign in.php');
}

if(isset($_SESSION['Username'])){
    $Username = $_SESSION['Username'];
    $QuizResult = $exm->getQuizResult($Username);
}
else{
    header('Location: sign in.php');
}
if(isset($_SESSION['Username'])){
    $Username = $_SESSION['Username'];
    $UsersByUsername = $exm->getUsersByUsername($Username);
    $img_check = "select * from Users where Username = '$Username'";
    $img_run = mysqli_query($con, $img_check);
    $img_row = mysqli_fetch_array($img_run);
    $chk_img = $img_row['Image'];
}
else{
    header("location: index.php");
}
?>
<div class="jumbotron" id = "jbtdr">
        <div class="container">
            <div id="detailsDr" class="animated fadeInLeft">
                <h1> سیستم <span> امتحان دهی </span> آنلاین </h1>
                <p class = "paragraphDr">ذکاوت خود را امتحان کنید</p>
            </div>
        </div>
    </div>
    	<div class="container">

    		<div class="row">
    		<div class="col-sm-3" style="float: right;">
				<nav class="nav-profile text-right"> 
					<a href="Profile.php">  دیدن پروفایل <i class='fa fa-user'></i> </a>
					<a href="Edit-Profile.php"> تغیر دادن پروفایل <i class='fa fa-pencil'></i></a>
					<a class = "active" href="QuizHistory.php"> بازدید امتحانات <i class='fa fa-list'></i></a>
					<a href="change-pass.php"> تبدیل نمودن رمز <i class='fa fa-lock'></i></a>
					<a href="logout.php"> خاموش شود <i class='fa fa-power-off'></i> </a>
					
				</nav>
			</div> 
    		<div class="col-md-9" id = "QuizResult">
                 <?php 

                    if(!$QuizResult){
						echo '<div class="alert alert-danger text-right" role="alert" style = "font-size: 16px;"> شما در امتحان اشتراک نکردید </div>';
                    }
                    else{

                    if($QuizResult->num_rows>0){
                           
                    ?>
                    
                <table class="table table-stripped table-hover table-bordered pull-right" style="text-align: right">
                    <thead>
                        <tr>
                            <th class = "text-right"> حذف نتیجه </th>
                            <th class = "text-right"> بازدید نتیجه </th>
                            <th class = "text-right"> تاریخ </th>
                            <th class = "text-right"> نتیجه </th>
                            <th class = "text-right"> اشتباه  </th>
                            <th class = "text-right"> درست </th>
                            <th class = "text-right"> مضمون </th>
                            <th class = "text-right"> استاد </th>
                            <th class = "text-right"> اسم </th>
                            <th class = "text-right"> مجموعه سوالات </th>
                        </tr>
                    </thead>
                <?php 
                $i=0;
                while($rows = $QuizResult->fetch_assoc()){ ?>
                    <tr>
                        <td> <a onclick="return confirm('are you sure you want to delete')" href="DeleteHistory.php?del=<?php echo $rows['Result_ID'];?>" style="color: #D05454;"  data-toggle="tooltip" data-placement="top" title="Delete Quiz Result"> حذف <i class = "fa fa-times"></i> </a> </td>
                        <td> <a href = "ViewResult.php?id=<?php echo $rows['Result_ID'];?>" style="color: #32C5D2;"> بازدید نتیجه </td>
                        <td> <?php echo $rows['Submit_Date'];?> </td>
                        <td> <?php echo $rows['Result'].' %';?> </td>
                        <td> <?php echo $rows['Wrong_Answer'];?> </td>
                        <td> <?php echo $rows['Correct_Answer']?> </td>
                        <td> <?php echo $rows['Subject'];?> </td>
                        <td> <?php echo $rows['Teacher'];?> </td>
                        <td> <?php echo $rows['Username'];?> </td> 
                        <td> <?php echo $rows['TotalNumberOfQuestion'];?> </td>
                    </tr>
                
                <?php $i++; }
                } 
                else{
                    echo '<div class="alert alert-danger text-right" role="alert" style = "font-size: 16px;"> امتحان وجود ندارد </div>';
                    echo "<br>";
                    }
                    }
                  
                    ?>
                    </table>
            <!-- END CONTENT BODY -->
            </div>    
    		</div>
    	</div>
<?php
    include('./_Partial Components/Footer.php');
?>
    
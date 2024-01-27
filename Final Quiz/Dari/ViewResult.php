<?php

include('./_Partial Components/Header.php');

?>
<?php

if(!isset($_SESSION['Username'])){
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
// else{
//     header("location: index.php");
// }
if(isset($_GET['id'])){
    $Result_ID = $_GET['id'];
    $QuizByResult = $exm->getQuizResultByID($Result_ID);
    $row = $QuizByResult->fetch_assoc();
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
                        <a href="QuizHistory.php"> بازدید امتحانات <i class='fa fa-list'></i></a>
                        <a href="change-pass.php"> تبدیل نمودن رمز <i class='fa fa-lock'></i></a>
                        <a href="logout.php"> خاموش شود <i class='fa fa-power-off'></i> </a>
                        
                    </nav>
                </div> 
    		   <div class="col-md-6" id = "answer-form">
        <table class="table table-bordered" >
                <thead>
                    
                    <tr>
                        <th class = "tr-text-right"> <?php echo "<img alt=''width='130px' height = '120px' src='../img/_ProfilePicture/$profile_img' style = 'margin-top: -5px; margin-bottom: -5px;' />"; ?> </th>
                        <th class = "tr-text-right"> عکس پروفایل </th>
                    </tr>
                    <tr>
                        <th class = "tr-text-right"> <?php echo $row['TotalNumberOfQuestion']; ?> </th>
                        <th class = "tr-text-right"> مجموعه سوالات </th>
                    </tr>
                    <tr>
                        <th class = "tr-text-right"> <?php echo $row['Username'];?> </th>
                        <th class = "tr-text-right"> اسم محصل </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $row['Subject'];?> </td>
                        <th class = "tr-text-right"> مضمون </th>
                    </tr>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $row['Teacher'];?> </td>
                        <th class = "tr-text-right"> استاد </th>
                    </tr>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $row['Credit_Hours'];?> </td>
                        <th class = "tr-text-right"> کریدیت </th>
                    </tr>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $row['Attempted_Answer']; ?></td>
                        <th class = "tr-text-right"> سوال که جواب داده اید </th>
                    </tr>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $row['Correct_Answer'];?> </td>
                        <th class = "tr-text-right"> سوال که درست جواب داده اید </th> 
                    </tr>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $row['Wrong_Answer'];?> </td>
                        <th class = "tr-text-right"> سوال که اشتباه جواب داده اید </th>
                    </tr>
                    <tr>
                        <td class = "tr-text-right"> <?php echo $row['No_Answer'];?> </td>
                        <th class = "tr-text-right"> سوال که هیچ جواب نداده اید </th>
                    </tr>
                    <tr>
                        <td class="text-right"> <?php echo $row['Result'].' %';?></td>
                        <th class = "tr-text-right"> فیصدی نمرات </th>
                    </tr>
                </tbody> 
                </table>
            </div>
    		</div>
    	</div>
<?php
    include('./_Partial Components/Footer.php');
?>
    
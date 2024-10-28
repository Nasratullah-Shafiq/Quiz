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
                        <a class = "active" href="Profile.php">  بازدید پروفایل <i class='fa fa-user'></i> </a>
                        <a href="Edit-Profile.php"> تغیر دادن پروفایل <i class='fa fa-pencil'></i></a>
                        <a href="QuizHistory.php"> بازدید امتحانات <i class='fa fa-list'></i></a>
                        <a href="change-pass.php"> تبدیل نمودن رمز <i class='fa fa-lock'></i></a>
                        <a href="logout.php"> خاموش شود <i class='fa fa-power-off'></i> </a>
                        
                    </nav>
                </div> 
    		    <div class="col-md-9" style="float: left;">
				<form method = "POST" >
                  <?php 
                    $UsersByUsername = $exm->getUsersByUsername($Username);
                    if(!$UsersByUsername){
                        echo "<h2> No Users Table exist! </h2>";
                    }
                    else{

                    if($UsersByUsername->num_rows>0){
                        $result = $UsersByUsername->fetch_array();
                    ?>
                <table class="table tr-text-right" style="padding-bottom: 300px; border: none;">
                    <tbody>
                        <tr style="border: none;">
                            <td>  </td>
                            <td> <?php echo "<img src='../img/_ProfilePicture/$chk_img' alt='' class='img-cicle' width='150px' height='140px'/>";?> </td>
                            
                        </tr>
                        <tr>
                            <td> <?php echo $result['User_ID'];?></td>
                            <th class = "tr-text-right"> آی دی نمبر </th>
                        </tr>
                        <tr>
                            <td> <?php echo $result['Full_Name']; ?> </td>
                            <th class = "tr-text-right"> اسم مکمل </th>
                        </tr>
                        <tr>
                            <td> <?php echo $result['Username']; ?> </td>
                            <th class = "tr-text-right"> اسم یوزر </th>
                        </tr>
                        <tr>
                            <td> <?php echo $result['Email']; ?> </td>
                            <th class = "tr-text-right"> ایمیل </th>
                        </tr>
                        <tr>
                            <td> <?php echo $result['Gender']; ?> </td>
                            <th class = "tr-text-right"> جنسیت </th>
                        </tr>
                        <tr>
                            <td> <?php echo $result['Phone_No']; ?> </td>
                            <th class = "tr-text-right"> شماره تماس </th>
                        </tr>
                    </tbody>
                    </table>
                    <?php } 
                else{
                    echo "<h2> No Users Available ! </h2> ";
                    echo "<br>";
                    }
                    }
                    ?>
              </form>

				</div>
    		</div>
    	</div>
<?php
    include('./_Partial Components/Footer.php');
?>
    
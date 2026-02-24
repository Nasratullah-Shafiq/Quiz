<?php

include('./_Partial Components/Header.php');

?>
<?php

if(!isset($_SESSION['Username'])){
    header('Location: sign in.php');
}

$Username = $_SESSION['Username'];
if(isset($_SESSION['Username'])){
    $Username = $_SESSION['Username'];
    $UsersByUsername = $exm->getUsersByUsername($Username);
    $row = $UsersByUsername->fetch_assoc();
    $chk_img = $row['Image'];
}
else{
    header("location: index.php");
}
?>
<?php
if(isset($_POST['submit'])){

    $Full_Name = mysqli_real_escape_string($con, $_POST['Full_Name']);
    $Username = mysqli_real_escape_string($con, $_POST['Username']);
    $Email = mysqli_real_escape_string($con, $_POST['Email']);
    $Gender = mysqli_real_escape_string($con, $_POST['Gender']);
    $Phone_No = mysqli_real_escape_string($con, $_POST['Phone_No']);
    $Image = $_FILES['Image']['name'];
    $Image_tmp = $_FILES['Image']['tmp_name'];

    if(empty($Image)){
        $Image = $chk_img;
    }

    if(empty($Full_Name) or empty($Username) or empty($Email) or empty($Gender) or empty($Phone_No)or empty($Image)){

        $error = "تمام خانه ها پر شود";
    }
    else{
        $update_query = "UPDATE `Users` SET `Full_Name` = '$Full_Name', `Username` = '$Username', `Email` = '$Email', `Gender` = '$Gender', `Phone_No` = '$Phone_No', `Image` = '$Image' WHERE `users`.`Username` = '$Username'";
        
        if(mysqli_query($con, $update_query)){
            $msg = "عملیه موفقانه اجرا شد";
            header("refresh:2; url=Edit-Profile.php");
            if(!empty($Image)){
                move_uploaded_file($Image_tmp, "../img/_ProfilePicture/$Image");
            }
        }
        else{
            $error = "عمیله موفقانه اجرا نشد.";
        }
    }
}
                    
?>
<?php
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
<div class="jumbotron" id = "jbtdr" >
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
                        <a class = "active" href="Edit-Profile.php"> تغیر دادن پروفایل <i class='fa fa-pencil'></i></a>
                        <a href="QuizHistory.php"> بازدید امتحانات <i class='fa fa-list'></i></a>
                        <a href="change-pass.php"> تبدیل نمودن رمز <i class='fa fa-lock'></i></a>
                        <a href="logout.php"> خاموش شود <i class='fa fa-power-off'></i> </a>
                        
                    </nav>
                </div> 
    		    <div class="col-md-9 text-right">
				<form class="form-horizontal" action = "" method = "POST"  enctype="multipart/form-data">
                  <?php 
                    $UsersByUsername = $exm->getUsersByUsername($Username);
                    if(!$UsersByUsername){
                        echo "<div class='alert alert-danger text-right' role='alert' style = 'font-size: 16px;'> یبل یوزر وجود ندارد  </div>";
                        
                    }
                    else{

                    if($UsersByUsername->num_rows>0){
                        $result = $UsersByUsername->fetch_array();
                    ?>
                <table class="table" style="padding-bottom: 300px;">
                    <tbody>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 pull-right"> عکس پروفایل </label>
                            <div class="col-sm-9">
                              <?php echo "<img src='../img/_ProfilePicture/$chk_img' alt='' class='img-cicle' width='150px' height='130px'/>";?>
                            </div>
                            
                        </div>
                        
                    </tbody>
                    </table>
                    <?php } 
                else{
                    echo "<br>";
                    echo "<br>";
                    echo "<div class='alert alert-danger text-right' role='alert' style = 'font-size: 16px;'> وزر وجود ندارد ! </div>";
                    echo "<br>";
                    }
                    }
                    ?>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <?php 
                                    if (isset($error)) {
                                        echo "<div class='alert alert-danger text-right' role='alert' style = 'font-size: 16px;'> $error </div>";
                                    }
                                    else if (isset($msg)) {
                                        echo "<div class='alert alert-success text-right' role='alert' style = 'font-size: 16px;'> $msg </div>";
                                    }
                                ?>  
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 pull-right"> اسم مکمل </label>
                            <div class="col-sm-9">
                              <input type="text" value="<?php echo $result['Full_Name']; ?>" id = "Full_Name" name = "Full_Name" class="form-control text-right" placeholder="  اسم مکمل">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 pull-right"> اسم یوزر</label>
                            <div class="col-sm-9">
                              <input type="text" value="<?php echo $result['Username']; ?>" id = "Username" name = "Username" class="form-control text-right" placeholder="  اسم یوزر">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 pull-right"> ایمیل آدرس </label>
                            <div class="col-sm-9">
                              <input type="text" value="<?php echo $result['Email']; ?>" id = "Email" name = "Email" class="form-control text-right" placeholder="  ایمیل آدرس">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 pull-right"> جنسیت </label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo $result['Gender']; ?>" id = "Gender" name="Gender" class="form-control text-right"  placeholder="  جنسیت">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 pull-right"> شماره تماس </label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo $result['Phone_No']; ?>" id = "Phone_No" class="form-control text-right" name="Phone_No" placeholder="  شماره تماس">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <label for = "image"> عکس پروفایل</label> 
                            </div>
                            <div class="col-sm-offset-6 col-sm-9">
                                <input type="file" id="Image" name = "Image">  
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <button type="submit" class="button-start-the-quiz" name="submit"> اجرا شود</button>
                                <span id="span-valid" class="span-validation"></span> 
                            </div>
                        </div>
                    </form>
				</div>
    		</div>
    	</div>
<?php
    include('./_Partial Components/Footer.php');
?>
    
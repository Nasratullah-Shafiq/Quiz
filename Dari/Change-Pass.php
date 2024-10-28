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
    $row = $UsersByUsername->fetch_assoc();
    $chk_img = $row['Image'];
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
                        <a href="QuizHistory.php"> بازدید امتحانات <i class='fa fa-list'></i></a>
                        <a class = "active" href="change-pass.php"> تبدیل نمودن رمز <i class='fa fa-lock'></i></a>
                        <a href="logout.php"> خاموش شود <i class='fa fa-power-off'></i> </a>
                        
                    </nav>
                </div> 
    		    <div class="col-md-9 text-right">
                <form class="form-horizontal" action = "" method = "POST">
                  <?php 
                    $UsersByUsername = $exm->getUsersByUsername($Username);
                    if(!$UsersByUsername){
                        echo "<h2> تیبل یوزر وجود ندارد </h2>";
                    }
                    else{

                    if($UsersByUsername->num_rows>0){
                        $result = $UsersByUsername->fetch_array();
                    ?>
                <table class="table" style="padding-bottom: 300px;">
                    <tbody>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <?php echo "<img src='../img/_ProfilePicture/$chk_img' alt='' class='img-cicle' width='150px' height='130px'/>";?>
                            </div>
                        </div>
                    </tbody>
                    </table>
                    <?php } 
                else{
                    echo "<h2> یوزر وجود ندارد </h2> ";
                    echo "<br>";
                    }
                    }
                    ?>
                        <input type="text" style = "display: none;" value="<?php echo $result['User_ID']; ?>" class="form-control" id = "User_ID" name="User_ID" >
                        <div class="form-group">
                            <label for="inputEmail3" style="float: right;" class="col-sm-2 "> اسم مکمل </label>
                            <div class="col-sm-10">
                              <input type="text" value="<?php echo $result['Full_Name']; ?>" class="form-control  text-right" id = "Full_Name" name="Full_Name" placeholder= "   اسم مکمل">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 pull-right"> رمز </label>
                            <div class="col-sm-10">
                              <input type="password" value="<?php ?>"class="form-control  text-right" name="Pass" id = "Password" placeholder="  تبدیل نمودن رمز">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">

                                <button type="submit" class="button-start-the-quiz" name="submit" id = "btn-update-password"> رمز تبدیل شود </button>
                            </div>
                            <div class="col-sm-10" style="height: 20px;">

                            </div>
                            <div class = "col-sm-10">
                                <span id="span-valid" style = "font-size: 18px;" class="span-validation"></span>
                            </div>
                        </div>
                    </form>
				</div>
    		</div>
    	</div>
<?php
    include('./_Partial Components/Footer.php');
?>
    
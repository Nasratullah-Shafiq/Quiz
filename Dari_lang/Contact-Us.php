<?php

include('./_Partial Components/Header.php');

?>

<?php 
if(!isset($_SESSION['Username'])){ 
    header('Location: sign in.php');
}
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
<?php 

if(isset($_POST['submit'])){
    $Full_Name = mysqli_real_escape_string($con, $_POST['Full_Name']);
    $Email = mysqli_real_escape_string($con, $_POST['Email']);
    $Phone_No = mysqli_real_escape_string($con, $_POST['Phone_No']);
    $Message = mysqli_real_escape_string($con, $_POST['Message']);
    
    $chk_msg = "select * from Contact_Us where Message = '$Message'";
    $chk_run_msg = mysqli_query($con, $chk_msg);

    if(empty($Full_Name) or empty($Email) or empty($Phone_No) or empty($Email) or empty($Message)){
        $error = "تمام خانه ها باید پر شود";
		//$error = '<div class="alert alert-danger text-right" role="alert" style = "font-size: 16px;"> تمام خانه ها باید پر شود </div>';
        
    }
    else if(mysqli_num_rows($chk_run_msg)>0){
        $error = "این پیام موجود است کوشش کنید پیام دیگر بنویسید";
    }
    else{
        $insert_query = "insert into Contact_Us(Full_Name, Email, Phone_No, Message, Language) values('$Full_Name', '$Email', '$Phone_No', '$Message', 'Dari')";
        if(mysqli_query($con, $insert_query)){
            $msg = "پیام موفقانه ارسال شد";
        }
        else{
		
            $error = "پیام ارسال نشد";
        }
    }
}
?>
   
    	<div class="container">
    		<div class="row">
                <div calss = "col-md-12">
                    <h2 class="tr-text-right" style = "padding-right: 15px;">با ما به تماس شوید</h2>
                </div>
                <div class="col-md-3">
                    
                </div>
            
    		<div class="col-md-9" style="text-align: right;">
    			
                    <form class="form-horizontal" action = "" method = "POST">
                        <div class="form-group">
                            <label for="Full_Name" class="col-sm-2 pull-right"> اسم مکمل </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control tr-text-right" id="Full_Name" name = "Full_Name" placeholder=" اسم مکمل ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Email" class="col-sm-2 pull-right"> ایمیل آدرس </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control tr-text-right" id="Email" name = "Email" placeholder=" ایمیل آدرس ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Phone_No" class="col-sm-2 pull-right"> شماره تماس </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control tr-text-right pull-left" id="Phone_No" name = "Phone_No" placeholder="شماره تماس">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Message" class="col-sm-2 pull-right"> پیغام شما </label>
                            <div class="col-sm-10">
                                <textarea id="Message" col="30" rows="5" class="form-control tr-text-right" name="Message" placeholder="پیغام شما در اینجا"> </textarea>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-sm-10">
                                
                                <button type="submit" class="button-start-the-quiz-dr" id = "" name = "submit"> پیام ارسال شود</button>
                                
                            </div>
                        </div>
						<div class="form-group">
                            <div class="col-sm-10">
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
                    </form>
				</div>
				<div class="col-sm-10">
					
				</div>
    		</div>
    	</div>
<?php 
include('./_Partial Components/Footer.php');
?>
    
<?php

include('./_Partial Components/Header.php');

?>
<div class="jumbotron" id = "jbt" style="background-image: url('./img/IBPS-Banne.jpg'); background-size: cover;">
        <div class="container">
            <div id="details" class="animated fadeInLeft">
                <h1> CONTACT <span> US </span>  </h1>
                <p class = "paragraph">Tell us any suggestion</p>
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
        $error = "All fields required";
        
    }
    else if(mysqli_num_rows($chk_run_msg)>0){
        $error = "Message Already exist try new one";
    }
    else{
        $insert_query = "insert into Contact_Us(Full_Name, Email, Phone_No, Message, Language) values('$Full_Name', '$Email', '$Phone_No', '$Message', 'English')";
        if(mysqli_query($con, $insert_query)){
            $msg = "Message send Successfully";

        }
        else{
            $error = "Message not sent";
        }
    }
}
?>
    	<div class="container">
    		<div class="row">
            <div class = "col-sm-12">
                <p style="font-size: 16px;"> Suggest, complain and any idea you have about online quiz contact with ONLINE QUIZ </p>                
            </div>
    		<div class="col-md-9">
				<form action="" method = "POST">
                    <div class="form-group">
                            <?php 
                                if (isset($error)) {
                                    echo "<div class='alert alert-danger' role='alert' style = 'font-size: 16px;'> $error </div>";
                                }
                                else if (isset($msg)) {
                                    echo "<div class='alert alert-success' role='alert' style = 'font-size: 16px;'> $msg </div>";
                                }
                            ?>  
                    </div>
                    <div class="form-group">
                        <label for="ful-name"> Full Name </label>
                        <input type="text" id="Full_Name" name = "Full_Name" class="form-control" placeholder="full Name">
                    </div>

                    <div class="form-group">
                        <label for="Email"> Email </label>
                        <input type="text" id="Email" class="form-control" name = "Email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="ful-name"> Phone No </label>
                        <input type="text" id="Phone_No" class="form-control" name = "Phone_No" placeholder="Phone No">
                    </div>

                    <div class="form-group">
                        <label for="Message"> Message </label>
                        <textarea id="Message" col="30" rows="5" class="form-control" name="Message" placeholder="your message here..."> </textarea>
                    </div>
                    <input type="submit" name="submit" class="button-start-the-quiz" value="Send Message" id = "btn-send-messe">
                    <div class="form-group" style = "padding-top: 20px; font-size: 16px;">
                        <span id="span-valid" class="span-validation"></span>  
                    </div>

                </form>

				</div>
    		</div>
    	</div>
<?php
include('./_Partial Components/Footer.php');
?>    
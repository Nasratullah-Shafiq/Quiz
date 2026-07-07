<?php

include('./_Partial Components/Header.php');

?>
<div class="jumbotron" id = "jbt" style="background-image: url('./assets/img/IBPS-Banne.jpg'); background-size: cover;">
        <div class="container">
            <div id="details" class="animated fadeInLeft">
                <h1>
                    <?= $lang['contact_us']; ?>
                </h1>

                <p class="paragraph">
                    <?= $lang['contact_suggestion']; ?>
                </p>
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
				<form action="" method="POST">

                    <?php
                        if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                        } elseif (isset($msg)) {
                            echo '<div class="alert alert-success">' . $msg . '</div>';
                        }
                    ?>

                    <!-- Full Name -->
                    <div class="row mb-3">
                        <label for="Full_Name" class="col-sm-3 col-form-label">
                            Full Name
                        </label>
                        <div class="col-sm-9">
                            <input type="text"
                                class="form-control"
                                id="Full_Name"
                                name="Full_Name"
                                placeholder="Enter Full Name">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="row mb-3">
                        <label for="Email" class="col-sm-3 col-form-label">
                            Email
                        </label>
                        <div class="col-sm-9">
                            <input type="email"
                                class="form-control"
                                id="Email"
                                name="Email"
                                placeholder="Enter Email">
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="row mb-3">
                        <label for="Phone_No" class="col-sm-3 col-form-label">
                            Phone No
                        </label>
                        <div class="col-sm-9">
                            <input type="text"
                                class="form-control"
                                id="Phone_No"
                                name="Phone_No"
                                placeholder="Enter Phone Number">
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="row mb-3">
                        <label for="Message" class="col-sm-3 col-form-label">
                            Message
                        </label>
                        <div class="col-sm-9">
                            <textarea class="form-control"
                                    id="Message"
                                    name="Message"
                                    rows="5"
                                    placeholder="Your message here..."></textarea>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="row">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" name="submit" class="btn btn-primary">
                                Send Message
                            </button>

                            <div class="mt-3">
                                <span id="span-valid"></span>
                            </div>
                        </div>
                    </div>

                </form>
			</div>
    	</div>
    </div>
<?php
include('./_Partial Components/Footer.php');
?>    
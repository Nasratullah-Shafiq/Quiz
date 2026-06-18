<?php

include('./_Partial Components/Header.php');

?>

<?php
if(isset($_POST['submit'])){

    $Full_Name = mysqli_real_escape_string($db->link, $_POST['Full_Name']);
    $Username = mysqli_real_escape_string($db->link, $_POST['Username']);
    $Email = mysqli_real_escape_string($db->link, $_POST['Email']);
    $Gender = mysqli_real_escape_string($db->link, $_POST['Gender']);
    $Phone_No = mysqli_real_escape_string($db->link, $_POST['Phone_No']);
    $Image = $_FILES['Image']['name'];
    $Image_tmp = $_FILES['Image']['tmp_name'];

    if(empty($Image)){
        $Image = $chk_img;
    }

    if(empty($Full_Name) or empty($Username) or empty($Email) or empty($Gender) or empty($Phone_No)or empty($Image)){

        $error = "All fields are required*";
    }
    else{
        $update_query = "UPDATE `Users` SET `Full_Name` = '$Full_Name', `Username` = '$Username', `Email` = '$Email', `Gender` = '$Gender', `Phone_No` = '$Phone_No', `Image` = '$Image' WHERE `users`.`Username` = '$Username'";
        
        if(mysqli_query($db->link, $update_query)){
            $msg = "profile has been updated";
            header("refresh:2; url=EditProfile.php");
            if(!empty($Image)){
                move_uploaded_file($Image_tmp, "assets/img/_ProfilePicture/$Image");
            }
        }
        else{
            $error = "Profile has not been updated";
        }
    }
}
?>
<?php
    include('./_Partial Components/profile_nav.php');
?>   		
    		    <div class="col-md-7">
				<form class="form-horizontal" action = "" method = "POST"  enctype="multipart/form-data">
                  <?php 
                    $UsersByUsername = $exm->getUsersByUsername($Username);
                    if(!$UsersByUsername){
                        echo "<br>";
                        echo "<br>";
                        echo '<div class="alert alert-danger" role="alert"> Opps!... No Users Available </div>';
                        echo "<br>";
                    }
                    else{

                    if($UsersByUsername->num_rows>0){
                        $result = $UsersByUsername->fetch_array();
                    ?>
                <table class="table" style="padding-bottom: 300px;">
                    <tbody>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 lable"> Profile Picutre </label>
                            <div class="col-sm-9">
                              <?php echo "<img src='assets/img/_ProfilePicture/$chk_img' alt='' class='img-cicle' width='150px' height='130px'/>";?>
                            </div>
                        </div>
                        
                    </tbody>
                    </table>
                    <?php } 
                else{
                    echo "<br>";
                    echo "<br>";
                    echo '<div class="alert alert-danger" role="alert"> Opps!... No Users Available </div>';
                    echo "<br>";
                    }
                    }
                    ?>
                        <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-12 text-right">
                            
                            <?php 
                                if (isset($error)) {
                                    echo "<div class='alert alert-danger' role='alert' style = 'font-size: 16px;'> $error </div>";
                                }
                                else if (isset($msg)) {
                                    echo "<div class='alert alert-success' role='alert' style = 'font-size: 16px;'> $msg </div>";
                                }
                            ?>  
                        </div>
                        </div>  
                        <div class="form-group">
                            <label for="Full Name" class="col-sm-3 lable"><?= $lang['full_name']; ?></label>
                            <div class="col-sm-9">
                              <input type="text" value="<?php echo $result['Full_Name']; ?>" id = "Full_Name" name = "Full_Name" class="form-control" placeholder="Full Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Username" class="col-sm-3 lable"> <?= $lang['username']; ?></label>
                            <div class="col-sm-9">
                              <input type="text" value="<?php echo $result['Username']; ?>" id = "Username" name = "Username" class="form-control" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Email" class="col-sm-3 lable"> <?= $lang['email']; ?></label>
                            <div class="col-sm-9">
                              <input type="text" value="<?php echo $result['Email']; ?>" id = "Email" name = "Email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Gender" class="col-sm-3 lable"> <?= $lang['gender']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo $result['Gender']; ?>" id = "Gender" name="Gender" class="form-control"  placeholder="Gender">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Phone_No" class="col-sm-3 lable"> <?= $lang['phone_no']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo $result['Phone_No']; ?>" id = "Phone_No" class="form-control" name="Phone_No" placeholder="Phone No">
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <label for = "image"> <?= $lang['profile_picture']; ?></label>
                            <input type="file" id="Image" name = "Image">  
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="button-start-the-quiz" name="submit"> <?= $lang['update_profile']; ?></button>
                                <span id="span-valid" class="span-validation"></span> 
                            </div>
                        </div>
                    </form>


                    <form method="POST" id="Student_Form">

<div class="container">

    <div class="row mb-3 align-items-center">

        <label class="col-md-3 col-form-label">
            Student ID
        </label>

        <div class="col-md-9">
            <input type="text" class="form-control" name="St_ID" id="St_ID" placeholder="Student ID">
        </div>

    </div>

    <div class="row mb-3 align-items-center">

        <label class="col-md-3 col-form-label">
            Name
        </label>

        <div class="col-md-9">
            <input type="text" class="form-control" name="Full_Name" id="Full_Name" placeholder="Student Name">
        </div>

    </div>

    <div class="row mb-3 align-items-center">

        <label class="col-md-3 col-form-label">
            Father Name
        </label>

        <div class="col-md-9">
            <input type="text" class="form-control" name="Father_Name" id="Father_Name" placeholder="Father Name">
        </div>

    </div>

    <div class="row mb-3 align-items-center">

        <label class="col-md-3 col-form-label">
            Marks
        </label>

        <div class="col-md-9">
            <input type="text" class="form-control" name="Marks" id="Marks" placeholder="Marks">
        </div>

    </div>

    <div class="row mb-3 align-items-center">

        <label class="col-md-3 col-form-label">
            Grade
        </label>

        <div class="col-md-9">
            <input type="text" class="form-control" name="Grade" id="Grade" placeholder="Grade">
        </div>

    </div>

    <div class="row mb-3 align-items-center">

        <label class="col-md-3 col-form-label">
            Phone No
        </label>

        <div class="col-md-9">
            <input type="text" class="form-control" name="Phone_No" id="Phone_No" placeholder="Phone Number">
        </div>

    </div>

    <!-- BOOK SELECT -->
 

    <!-- BUTTON -->
    <div class="row mt-4">

        <div class="col-md-12 text-end">

            <input type="hidden" name="action" id="action">

            <input type="submit"
                   name="button_action"
                   class="btn btn-primary px-4"
                   id="button_action"
                   value="Register Student">

            <span id="span-val" class="text-danger ms-3"></span>

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
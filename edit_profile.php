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
                         <form method="POST" enctype="multipart/form-data">

<div class="container">

    <!-- PROFILE IMAGE + ALERTS -->
    <div class="row mb-4">

        <div class="col-md-3 text-center">

            <?php 
            $UsersByUsername = $exm->getUsersByUsername($Username);

            if(!$UsersByUsername){
                echo '<div class="alert alert-danger">Opps!... No Users Available</div>';
            }
            else if($UsersByUsername->num_rows > 0){
                $result = $UsersByUsername->fetch_assoc();
            ?>

                <img src="assets/img/_ProfilePicture/<?= htmlspecialchars($result['Image']) ?>"
                     class="rounded-circle shadow"
                     width="150"
                     height="150"
                     alt="Profile">

            <?php } ?>

        </div>

        <div class="col-md-9">

            <?php 
                if(isset($error)){
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                } elseif(isset($msg)){
                    echo '<div class="alert alert-success">'.$msg.'</div>';
                }
            ?>

        </div>

    </div>

    <!-- FULL NAME -->
    <div class="row mb-3 align-items-center">

        <label class="col-md-3 col-form-label">
            <?= $lang['full_name']; ?>
        </label>

        <div class="col-md-9">
            <input type="text"
                   name="Full_Name"
                   id="Full_Name"
                   class="form-control"
                   value="<?= htmlspecialchars($result['Full_Name']) ?>"
                   placeholder="Full Name">
        </div>

    </div>

    <!-- USERNAME -->
    <div class="row mb-3 align-items-center">

        <label class="col-md-3 col-form-label">
            <?= $lang['username']; ?>
        </label>

        <div class="col-md-9">
            <input type="text"
                   name="Username"
                   id="Username"
                   class="form-control"
                   value="<?= htmlspecialchars($result['Username']) ?>"
                   placeholder="Username">
        </div>

    </div>

    <!-- EMAIL -->
    <div class="row mb-3 align-items-center">

        <label class="col-md-3 col-form-label">
            <?= $lang['email']; ?>
        </label>

        <div class="col-md-9">
            <input type="email"
                   name="Email"
                   id="Email"
                   class="form-control"
                   value="<?= htmlspecialchars($result['Email']) ?>"
                   placeholder="Email">
        </div>

    </div>

    <!-- GENDER -->
    <div class="row mb-3 align-items-center">

        <label class="col-md-3 col-form-label">
            <?= $lang['gender']; ?>
        </label>

        <div class="col-md-9">
            <input type="text"
                   name="Gender"
                   id="Gender"
                   class="form-control"
                   value="<?= htmlspecialchars($result['Gender']) ?>"
                   placeholder="Gender">
        </div>

    </div>

    <!-- PHONE -->
    <div class="row mb-3 align-items-center">

        <label class="col-md-3 col-form-label">
            <?= $lang['phone_no']; ?>
        </label>

        <div class="col-md-9">
            <input type="text"
                   name="Phone_No"
                   id="Phone_No"
                   class="form-control"
                   value="<?= htmlspecialchars($result['Phone_No']) ?>"
                   placeholder="Phone No">
        </div>

    </div>

    <!-- IMAGE UPLOAD -->
    <div class="row mb-4 align-items-center">

        <label class="col-md-3 col-form-label">
            <?= $lang['profile_picture']; ?>
        </label>

        <div class="col-md-9">
            <input type="file"
                   name="Image"
                   id="Image"
                   class="form-control">
        </div>

    </div>

    <!-- BUTTON -->
    <div class="row">

        <div class="col-md-12 text-end">

            <button type="submit"
                    name="submit"
                    class="btn btn-primary px-4">

                <?= $lang['update_profile']; ?>

            </button>

            <span id="span-valid" class="ms-3 text-danger"></span>

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
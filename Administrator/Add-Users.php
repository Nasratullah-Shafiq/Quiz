
<?php 

include('./_Partial Components/Header.php');
include('../_Partial Components/Conn.php');

?>
<?php 
            if(isset($_POST['submit'])){
                $Full_Name = mysqli_real_escape_string($con, $_POST['Full_Name']);
                $Username = mysqli_real_escape_string($con, $_POST['Username']);
                $Username_trim = preg_replace('/\s+/','', $Username);
                $Password = mysqli_real_escape_string($con,  md5($_POST['Password']));
                $Email = mysqli_real_escape_string($con, $_POST['Email']);
                $Gender = mysqli_real_escape_string($con, $_POST['Gender']);
                $Phone_No = mysqli_real_escape_string($con, $_POST['Phone_No']);
                $Role_ID = mysqli_real_escape_string($con, $_POST['Role_ID']);
                $Image = $_FILES['image']['name'];
                $Image_tmp = $_FILES['image']['tmp_name'];

                $chk_user = "select * from Users where Username = '$Username'";
                $chk_run_user = mysqli_query($con, $chk_user);

                $chk_email = "select * from Users where Email = '$Email'";
                $chk_run_email = mysqli_query($con, $chk_email);

                if(empty($Full_Name) or empty($Username) or empty($Password) or empty($Email) or empty($Gender) or empty($Phone_No) or empty($Image)){
                    $error = "All fields required";
                    
                }
                else if($Username != $Username_trim){
                    $error = "Username Should not contain any spaces";
                }
                else if(mysqli_num_rows($chk_run_user)>0){
                    $error = "Username Already exist try new one";
                }
                else if(mysqli_num_rows($chk_run_email)>0){
                    $error_email = "Email Already exist try new one";
                 }
                else{
                    $insert_query = "insert into Users(Full_Name, Username, Password, Email, Language, Gender, Phone_No, Image, Role_ID) values('$Full_Name', '$Username', '$Password', '$Email', 'English', '$Gender', '$Phone_No', '$Image', '$Role_ID')";
                    if(mysqli_query($con, $insert_query)){
                        move_uploaded_file($Image_tmp, "../img/_ProfilePicture/$Image");
                        $msg = "Registration Successfull";

                    }
                    else{
                        $error = "User Not Registred";
                    }
                }
            }
        ?>
    <div class="containe">
    	<div class="row" id="row">
            <div class="left-side-bar">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                 <?php include('./_Partial Components/Navigation.php');?>
                <!-- END SIDEBAR -->
            </div>
            <div class="right-side-bar">
            
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <div class="row">
            <div calss = "col-md-9">
                <h1 style = "color: #2C3E50"> <i class = "fa fa-user-plus"> </i> <small> Create User </small></h1><hr>
                <ol class="breadcrumb">
                    <li style="color: #5C9BD1"><a href="index.php"> <i class = "fa fa-tachometer"></i> Dashboard </a></li>
                    <li class = ""> <a href="Manage-Users.php"> <i class = "fa fa-user"></i> Manage Users </a></li>
                </ol>
            </div>
            <?php 
                    if (isset($error)) {
                        echo "<span style = 'color: red; font-size: 15px;' class = 'pull-right'> $error </span>";
                    }
                    else if (isset($msg)) {
                        echo "<span style = 'color: green;' class = 'pull-right'> $msg </span>";
                    }
                    
                ?> 

            <div class="col-md-9">
                    <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="Full Name" class="col-sm-2">Full Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="Full_Name" placeholder="Frist Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="Username" class="col-sm-2">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="Username" placeholder="Username">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="Password" class="col-sm-2"> Password </label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="Password" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2"> Email </label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="Email" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                          <label for="Language" class="col-sm-2"> Language </label>
                            <div class="col-sm-10">
                              <select name="Language" class="form-control">
                                <option value="English"> English </option>
                                <option value="Dari"> Dari </option>
                              </select>
                            </div>
                        </div>
                      <div class="form-group">
                          <label for="Gender" class="col-sm-2"> Gender </label>
                            <div class="col-sm-10">
                              <select name="Gender" class="form-control">
                                <option value="Male"> Male </option>
                                <option value="Female"> Femal </option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Phone No" class="col-sm-2"> Phone No </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="Phone_No" placeholder="Phone No">
                            </div>
                        </div>
                      <div class="form-group">
                          <label for="Role" class="col-sm-2"> Role </label>
                            <div class="col-sm-10">
                              <select name="Role_ID" class="form-control">
                                <option value="2"> Standard </option>
                                <option value="1"> Administrator </option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Profile Picture" class="col-sm-2"> Profile Picture </label>
                            <div class="col-sm-10">
                                <input type="file" id="image" name = "image">
                            </div>
                        </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name = "submit" class="button-start-the-quiz" id = "create-user">Create User</button>
                            <span id="span-va" class="span-validation"></span>  
                        </div>
                      </div>
                    </form>
                </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
    
    
    <!-- END QUICK SIDEBAR -->
</div> 
                	   	  
    		</div>
    	</div>
    </div>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<?php 
include('./_Partial Components/Footer.php');
?>
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
 <div class="jumbotron" id = "jbt" style="background-image: url('./img/IBPS-Banne.jpg'); background-size: cover;">
        <div class="container">
            <div id="details" class="animated fadeInLeft">
                <h1> ONLINE <span> QUIZ </span> SYSTEM </h1>
                <p class = "paragraph">Test Your Intellect</p>
            </div>
        </div>
    </div>
    	<div class="container">
    		<div class="row">
                <div class="col-sm-3">
                    <nav class="nav-profile"> 
                        <a class = "active" href="Profile.php"> <i class='fa fa-user'></i> View Profile </a>
                        <a href="EditProfile.php"> <i class='fa fa-pencil'></i> Edit Profile</a>
                        <a href="QuizHistory.php"> <i class='fa fa-list'></i> View Quiz History</a>
                        <a href="change-pass.php"> <i class='fa fa-lock'></i> Change Password</a>
                        <a href="logout.php"> <i class='fa fa-power-off'></i> Logout </a>
                        
                    </nav>
                </div>    		
    		    <div class="col-md-6">
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
                <table class="table" style="padding-bottom: 300px;">
                    <tbody>
                        <tr>
                        <td> <?php echo "<img src='img/_ProfilePicture/$chk_img' alt='' class='img-cicle' width='150px' height='130px'/>";?> </td>
                    </tr>
                        <tr>
                            <th> ID </th>
                            <td> <?php echo $result['User_ID'];?></td>
                        </tr>
                        <tr>
                            <th> Full Name </th>
                            <td> <?php echo $result['Full_Name']; ?> </td>
                        </tr>
                        <tr>
                            <th> Username </th>
                            <td> <?php echo $result['Username']; ?> </td>
                        </tr>
                        <tr>
                            <th> Email </th>
                            <td> <?php echo $result['Email']; ?> </td>
                        </tr>
                        <tr>
                            <th> Gender </th>
                            <td> <?php echo $result['Gender']; ?> </td>
                        </tr>
                        <tr>
                            <th> Phone No </th>
                            <td> <?php echo $result['Phone_No']; ?> </td>
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
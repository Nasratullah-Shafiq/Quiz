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

if(isset($_GET['id'])){
    $Result_ID = $_GET['id'];
    $QuizByResult = $exm->getQuizResultByID($Result_ID);
    $row = $QuizByResult->fetch_assoc();
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
                        <a href="Profile.php"> <i class='fa fa-user'></i> View Profile </a>
                        <a href="EditProfile.php"> <i class='fa fa-pencil'></i> Edit Profile</a>
                        <a href="QuizHistory.php"> <i class='fa fa-list'></i> View Quiz History</a>
                        <a href="change-pass.php"> <i class='fa fa-lock'></i> Change Password</a>
                        <a href="logout.php"> <i class='fa fa-power-off'></i> Logout </a>
                        
                    </nav>
                </div>    		
    		    <?php
                         if(isset($_SESSION['Username'])){ 
                            $Username = $_SESSION['Username'];
                            $UsersByUsername = $exm->getUsersByUsername($Username);
                            $rows = $UsersByUsername->fetch_array();
                            $profile_img = $rows['Image'];
                       }
                        ?>
        <div class="col-md-6" id = "answer-for">
        <table class="table" >
                <thead>
                    <tr>  
                        <th> Profile Picture </th>
                        <th> <?php echo "<img alt=''width='150px' height = '120px' src='./img/_ProfilePicture/$profile_img' style = 'margin-top: -5px; margin-bottom: -5px;' />"; ?> </th>
                    </tr>
                    <tr>
                        <th> Total Number of Questions </th>
                        <th> <?php echo $row['TotalNumberOfQuestion'] ?> </th>
                    </tr>
                    <tr>
                        <th> Your Name </th>
                        <th> <?php echo $row['Username'];?> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th> Teacher </th>
                        <td> <?php echo $row['Teacher'];?> </td>
                    </tr>
                    <tr>
                        <th> Subject </th>
                        <td> <?php echo $row['Subject'];?> </td>
                    </tr>
                    <tr>
                        <th> Credit Hour </th>
                        <td> <?php echo $row['Credit_Hours'];?> </td>
                    </tr>
                    <tr>
                        <th> Attempted Answers </th>
                        <td> <?php echo $row['Attempted_Answer'] ?></td>
                    </tr>
                    <tr>    
                        <th> Correct Answers </th>
                        <td> <?php echo $row['Correct_Answer'];?> </td> 
                    </tr>
                    <tr>
                        <th> Wrong Answers </th>
                        <td> <?php echo $row['Wrong_Answer'];?> </td>
                    </tr>
                    <tr>
                        <th> No Answered </th>
                        <td> <?php echo $row['No_Answer'];?> </td>
                    </tr>
                    <tr>
                        <th> Your Result </th>
                        <td> <?php echo $row['Result'].' %';?></td>
                    </tr>
                    
                </tbody> 
                </table>
            </div>
    		</div>
    	</div>
<?php 
include('./_Partial Components/Footer.php');
?>    
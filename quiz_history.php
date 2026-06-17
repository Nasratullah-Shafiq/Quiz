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

if(isset($_SESSION['Username'])){
    $Username = $_SESSION['Username'];
    $QuizResult = $exm->getQuizResult($Username);
}
else{
    header('Location: sign in.php');
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
                        <a class = "active" href="QuizHistory.php"> <i class='fa fa-list'></i> View Quiz History</a>
                        <a href="change-pass.php"> <i class='fa fa-lock'></i> Change Password</a>
                        <a href="logout.php"> <i class='fa fa-power-off'></i> Logout </a>
                        
                    </nav>
                </div>    		
    		    <div class="col-md-9" id = "QuizResult">
                
                  <form method = "POST">
                    <?php 
                    if(!$QuizResult){
                        echo '<div class="alert alert-danger" role="alert" style = "font-size: 16px;"> Opps!... No Quiz Result Found </div>';
                    }
                    else{

                    if($QuizResult->num_rows>0){
                           
                    ?>
                    
                <table class="table table-stripped table-hover">
                    <thead>
                        <tr>
                            <th> Total </th>
                            <th> Username </th>
                            <th> Teacher </th>
                            <th> Subject </th>
                            <th> Correct </th>
                            <th> Wrong  </th>
                            <th> Result </th>
                            <th> Date </th>
                            <th> View Result </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                <?php 
                $i=0;
                while($rows = $QuizResult->fetch_assoc()){ ?>
                    <tr>
                        <td> <?php echo $rows['TotalNumberOfQuestion'];?> </td>
                        <td> <?php echo $rows['Username'];?> </td> 
                        <td> <?php echo $rows['Teacher'];?> </td>
                        <td> <?php echo $rows['Subject'];?> </td>
                        <td> <?php echo $rows['Correct_Answer']?> </td>
                        <td> <?php echo $rows['Wrong_Answer'];?> </td>
                        <td> <?php echo $rows['Result'].' %';?> </td>
                        <td> <?php echo $rows['Submit_Date'];?> </td>
                        <td> <a href = "ViewResult.php?id=<?php echo $rows['Result_ID'];?>" style="color: #32C5D2;"> View Result </td>
                        <td> <a onclick="return confirm('are you sure you want to delete')" href="DeleteHistory.php?del=<?php echo $rows['Result_ID'];?>" style="color: #D05454;"  data-toggle="tooltip" data-placement="top" title="Delete Quiz Result"> <i class = "fa fa-times"></i> Delete</a> </td>
                    </tr>
                
                <?php $i++; }
            } 
                else{
                    echo '<div class="alert alert-danger" role="alert" style = "font-size: 16px;"> Opps!... No Quiz Result Found </div>';
                    echo "<br>";
                    }
                    }
                  
                    ?>
                    </table>
                    </form>
            <!-- END CONTENT BODY -->
            <?php 
                    if (isset($error)) {
                        echo "<span style = 'color: red;' class = 'pull-right'> $error </span>";
                    }
                    else if (isset($msg)) {
                        echo "<span style = 'color: green;' class = 'pull-right'> $msg </span>";
                    }
                ?>
            </div>
    		</div>
    	</div>
<?php 
include('./_Partial Components/Footer.php');
?>    
<?php

if(!isset($_SESSION['Username'])){
    header('Location: sign_in.php');
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

    <div class="jumbotron" id = "jbt" style="background-image: url('./assets/img/IBPS-Banne.jpg'); background-size: cover;">
        <div class="container">
            <div id="details" class="animated zoomInDown">
            <h1><?= strtoupper($lang['online_quiz']); ?></h1>
            <p class="paragraph"><?= $lang['test_intellect']; ?></p>
        </div>
        </div>
    </div>
    	<div class="container">
    		<div class="row">
                <div class="col-sm-3">
                    <nav class="nav-profile" id = "#nav-left-side"> 
						<a href="profile.php">
							<i class='fa fa-user'></i>
							<?= $lang['view_profile']; ?>
						</a>

						<a href="edit_profile.php">
							<i class='fa fa-pencil'></i>
							<?= $lang['edit_profile']; ?>
						</a>

						<a href="quiz_history.php">
							<i class='fa fa-list'></i>
							<?= $lang['view_quiz_history']; ?>
						</a>

						<a class="active" href="change_pass.php">
							<i class='fa fa-lock'></i>
							<?= $lang['change_password']; ?>
						</a>

						<a href="logout.php">
							<i class='fa fa-power-off'></i>
							<?= $lang['logout']; ?>
						</a>                    
                    </nav>
                </div>    		
<?php

include('./_Partial Components/Header.php');

include('./_Partial Components/profile_nav.php');
?>   
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
                        <td> <?php echo "<img src='assets/img/_ProfilePicture/$chk_img' alt='' class='img-cicle' width='150px' height='130px'/>";?> </td>
                    </tr>
                        <tr>
                            <th> <?= $lang['id']; ?> </th>
                            <td> <?php echo $result['User_ID'];?></td>
                        </tr>
                        <tr>
                            <th> <?= $lang['full_name']; ?> </th>
                            <td> <?php echo $result['Full_Name']; ?> </td>
                        </tr>
                        <tr>
                            <th> <?= $lang['username']; ?> </th>
                            <td> <?php echo $result['Username']; ?> </td>
                        </tr>
                        <tr>
                            <th> <?= $lang['email']; ?> </th>
                            <td> <?php echo $result['Email']; ?> </td>
                        </tr>
                        <tr>
                            <th> <?= $lang['gender']; ?> </th>
                            <td> <?php echo $result['Gender']; ?> </td>
                        </tr>
                        <tr>
                            <th> <?= $lang['phone_no']; ?> </th>
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
<?php

include('./_Partial Components/Header.php');

include('./_Partial Components/profile_nav.php');

?>
    		    <div class="col-md-6">
				<form class="form-horizontal" action = "" method = "POST">
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
                        <!-- <tr>
                            <td>  </td>
                        </tr> -->
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <?php echo "<img src='assets/img/_ProfilePicture/$chk_img' alt='' class='img-cicle' width='150px' height='130px'/>";?>
                            </div>
                        </div>
                    </tbody>
                    </table>
                    <?php } 
                else{
                    echo "<h2> No Users Available ! </h2> ";
                    echo "<br>";
                    }
                    }
                    ?>
                         <input type="text" style = "display: none;" value="<?php echo $result['User_ID']; ?>" class="form-control" id = "User_ID" name="Username" >
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 ">Full_Name</label>
                            <div class="col-sm-10">
                              <input type="text" value="<?php echo $result['Full_Name']; ?>" class="form-control" id = "Username" name="Username" placeholder="Subject">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2"> Password </label>
                            <div class="col-sm-10">
                              <input type="password" value="<?php ?>"class="form-control" name="Pass" id = "Password" placeholder="Change Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="button-start-the-quiz" name="submit" id = "btn-update-password" style = "width: 200px; "> Change Password </button>
                                <span id="span-valid" class="span-validation"></span>
                            </div>
                        </div>
                    </form>
				</div>
    		</div>
    	</div>
<?php 
include('./_Partial Components/Footer.php');
?>    
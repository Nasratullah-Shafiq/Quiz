<?php

include('./_Partial Components/Header.php');


// include_once('./_Partial Components/link.php');

?>
<div class="jumbotron" id = "jbt" style="padding-top: 60px; background-image: url('./assets/img/IBPS-Banne.jpg'); background-size: cover;">
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
    <script>
          $(document).ready(function() {
        //     $("#btn_send_message").click(function(){
        //     var Full_Name = $("#Full_Name").val();
        //     var Email = $("#Email").val();
        //     var Phone_No = $("#Phone_No").val();
        //     var Message = $("#Message").val();
            
        //     var dataString = 'Full_Name='+Full_Name+'&Email='+Email+'&Phone_No='+Phone_No+'&Message='+Message;
        //     $.ajax({
        //     type: "POST",
        //     url: "sendMessage.php",
        //     data: dataString,
        //     success: function(data){
        //         $("#div_message").show();
        //         $("#span-valid").html(data);
        //     }
        //     });
        //     return false;
        // });
            });

        </script>



    	<div class="container">
    		<div class="row">
            <div class="col-12">
                <div class="p-4 mb-4 bg-light border-start border-5 border-primary rounded shadow-sm">
                    <h4 class="mb-3">
                        <?= $lang['contact_us']; ?>
                    </h4>

                    <p class="mb-0 text-muted fs-6">
                        <?= $lang['contact_description']; ?>
                    </p>
                </div>
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
                            <?= $lang['full_name']; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="text"
                                class="form-control"
                                id="Full_Name"
                                name="Full_Name"
                                placeholder="<?= $lang['enter_full_name']; ?>">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="row mb-3">
                        <label for="Email" class="col-sm-3 col-form-label">
                            <?= $lang['email']; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="email"
                                class="form-control"
                                id="Email"
                                name="Email"
                                placeholder="<?= $lang['enter_email']; ?>">
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="row mb-3">
                        <label for="Phone_No" class="col-sm-3 col-form-label">
                            <?= $lang['phone_no']; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="text"
                                class="form-control"
                                id="Phone_No"
                                name="Phone_No"
                                placeholder="<?= $lang['enter_phone_number']; ?>">
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="row mb-3">
                        <label for="Message" class="col-sm-3 col-form-label">
                            <?= $lang['message']; ?>
                        </label>
                        <div class="col-sm-9">
                            <textarea class="form-control"
                                    id="Message"
                                    name="Message"
                                    rows="5"
                                    placeholder="<?= $lang['enter_your_message']; ?>"></textarea>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="row">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="button" id='btn_send_message' name="submit" class="btn btn-primary">
                                <?= $lang['send_message']; ?>
                            </button>

                            <div class="mt-3">
                                <div class="alert alert-success" id="div_message" style="display: none;">
                                    <span id="span-valid"></span>
                                </div>
                                
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
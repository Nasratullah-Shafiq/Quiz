<?php

include_once('./_Partial Components/link.php');

?>
<body class="body">
    <div class = "form-control" id="reset-form">

        <div class = "font">
        <p class="reset-signin"> Reset Your password</p>
        </div>
        <form method = "POST">
        <div class="form-group" >
                <input type="text" style = "display: none;" value = "<?php echo $row['User_ID']; ?>" id = "User_ID" class="form-control " name = "User_ID" placeholder="New Password">
            <div class="form-group" >
                <div class="input-group"style="padding-left: 10px;">
                    <span class = "input-group-addon" id = "span-signin"><i class='fa fa-lock'></i></span>
                    <input type="password" class="form-control " name = "Password" id = "Password" placeholder="New Password">
                </div>
            </div>
            <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <button type="submit" class="btn-signup-next" name = "submit" id = "btn-update-password"> Update</button>    
                </div>
                <div class="col-sm-6">
                    <a href="sign_in.php">
                    <button type="button" class="btn-signup-next" name = "" id="bn-signup" > Sign in </button>
                    </a>  
                </div>
            </div>
            <span id="span-valid" class="span-validation"></span> 
            </div>
        </form>
    </div>

<script src="./js/tests/vendor/jquery.min.js"></script>
<script src="./js/transition.js"></script>
<script src="./js/tooltip.js"></script>
<script src = "./js/OnlineQuiz.js"></script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

</body>
</html>

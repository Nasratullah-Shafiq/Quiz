<?php
ob_start();
// $filepath = realpath(dirname(__FILE__));
include_once('./_Partial Components/Database.php');
include_once('./_Partial Components/Format.php');

include_once('./_Partial Components/CRUD.php');
spl_autoload_register(function($class){
include_once "_Partial Components/".$class.".php";
});

?>
<!DOCTYPE html>
<title> Sign in </title>
<head> 
  <meta name="viewport" content=" width=device-width, initial-scale=1" />
    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/signin_style.css">
    <link rel="stylesheet" href="./assets/css/animated.css">
    <link rel="stylesheet" href="./assets/css/font-awesome.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="./assets/img/Graduation Cap_48px.png">

    <!-- JavaScript -->
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- <script src="./assets/tests/vendor/js/jquery.min.js"></script> -->
    <script src="assets/js/OnlineQuiz.js"></script>

</head>
<body class="body"> 
<script type="text/javascript">
  
  $('#Password').keyup(function(){
  var val=$(this).val();
  if(val.length>5){
  $('.message').html('Password must be at least 5 characters');

  }
  });
</script>
<div class = "form-control box" id="signin-form">

<div class = "font">
<p class="p-signin"> Sign in </p>
</div>

<form method = "POST" action = "" class="form-horizontal">

  <div class="form-group" >
  <div class="input-group inputBox" style="padding-left: 10px;">
    <span class = "input-group-addon" id = "span-signin"><i class="fa fa-user" aria-hidden="true"></i></span>
        <input  type="text" class="form-control" name = "Username" id = "Username" required="">
        <label> Username </label>
    </div>
  </div>
  
    <div class="form-group" >
    <div class="input-group inputBox"style="padding-left: 10px;">
    <span class = "input-group-addon" id = "span-signin"><i class='fa fa-lock'></i></span>
        <input type="password" class="form-control" name = "Password" id = "Password" required="">
        <label> Password </label>
    </div>
  </div>

  <div class="form-group" style="padding-left: 10px;">
        <button type="button" class="btn-signup-next" data-toggle="tooltip" id = "btn-signin" value = "Login here" data-placement="right" title="Insert Email & Password to Sign in">Sign in
            <i class='fa fa-user'></i>
        </button>
        <button class="btn-signup-next" data-toggle="tooltip" id = "btn-test">click me !
            <i class='fa fa-user'></i>
        </button>
  </div>

      
      
  <div class="form-group animated shake" style = "padding-left: 15px; margin-top: 10px;">
      <span class = "empty" style = "display: none;"> Wrong Username and Password </span>
      <span class = "incorrect" style = "display: none; color: red;"> Fields are empty! </span>
      <span class = "failed" style = "display: none;"> Password field empty! </span>
      <span class = "error" style = "display: none;"> Email and password not matched </span>
      <span class = "disable" style = "display: none;">User is Disable !</span>    
  </div>
  <div class = "message" style="background-color: red;"> </div>
</form>
        <script type="text/javascript">
            // $(document).ready(function () {

            //     $("#btn-signin").click(function () {

            //         var Username = $("#Username").val().trim();
            //         var Password = $("#Password").val().trim();

            //         if (Username === "") {
            //             alert("Username is empty");
            //             return false;
            //         }

            //         if (Password === "") {
            //             alert("Password is empty");
            //             return false;
            //         }

            //         alert("Username: " + Username + "\nPassword: " + Password);

            //     });

            // });
        </script>

<div class = "form_footer">
    <div class="row">
        <div class="col-sm-7">
            <p>Languge you sign with?</p>
        </div>
        <div class="col-sm-3">
            <a href = "sign_in.php" class="language-signin"> English </a>
        </div>
        <div class="col-sm-2">
            <a href = "sign_in.php" class="language-signin"> دری </a>
        </div>
    </div>
<!-- <hr style = "width: 100%;"> -->
<label> <a href = "forgot-password.php" > forgot Password?</a> </label> 
<p class="signin-footer"> Don't have account yet?</p>
<a href = "signup.php" class="create-account"> Create an acount? </a>

</div>
</div>
<script type="text/javascript">
        $(document).ready(function () {

                $("#btn-test").click(function () {
                    alert("Button clicked is clicked you won the game!");
                });
                
 $("#btn-signin").click(function () {

    var Username = $("#Username").val().trim();
    var Password = $("#Password").val().trim();

    // Check empty fields first
    if (Username === "" || Password === "") {
        $(".empty").show();

        setTimeout(function () {
            $(".empty").fadeOut();
        }, 5000);

        $(".incorrect").hide();
        $(".disable").hide();
        $(".error").hide();
        $(".failed").hide();

        return false; // Stop execution
    }

    $.ajax({
        type: "POST",
        url: "getLogin.php",
        data: {
            Username: Username,
            Password: Password
        },
        success: function (data) {

            if ($.trim(data) == "incorrect") {
                $(".incorrect").show();
                setTimeout(function () {
                    $(".incorrect").fadeOut();
                }, 5000);
            }
            else if ($.trim(data) == "failed") {
                $(".failed").show();
                setTimeout(function () {
                    $(".failed").fadeOut();
                }, 5000);
            }
            else if ($.trim(data) == "disable") {
                $(".disable").show();
                setTimeout(function () {
                    $(".disable").fadeOut();
                }, 5000);
            }
            else if ($.trim(data) == "error") {
                $(".error").show();
                setTimeout(function () {
                    $(".error").fadeOut();
                }, 5000);
            }
            else {
                // Successful login
                window.location.href = "index.php";
            }
        }
    });

    return false;
});
                
        </script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/OnlineQuiz.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    </body>
</html>

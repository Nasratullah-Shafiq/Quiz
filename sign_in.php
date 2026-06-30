<?php

include_once('./_Partial Components/link.php');

?>

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
<label> <a href = "forgot_password.php" > forgot Password?</a> </label> 
<p class="signin-footer"> Don't have account yet?</p>
<a href = "sign_up.php" class="create-account"> Create an acount? </a>

</div>
</div>

    <script src="assets/js/tests/vendor/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/online.quiz.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    </body>
</html>

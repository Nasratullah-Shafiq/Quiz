<?php

include_once('./_Partial Components/link.php');

?>

<body class="body"> 

<div class = "form-control" id="forgot-form">

<div class = "font">
<p class="p-forgot" > Insert your Email to reset your password </p>
</div>

<form method = "POST" action = "">
 <div class="form-group" >
	<div class="input-group " style="padding-left: 10px;">
		<span class = "input-group-addon" id = "span-signin"><i class="fa fa-user"></i></span>
      	<input  type="text" class="form-control " name = "Username" id = "Username"placeholder="Username">
    </div>
  </div>
  <div class="form-group" >
		<div class="input-group"style="padding-left: 10px;">
		<span class = "input-group-addon" id = "span-signin"><i class='fa fa-envelope'></i></span>
      	<input type="email" class="form-control " name = "Email" id = "Email" placeholder="Email">
    </div>
  </div>
	<div class="form-group" style="margin-bottom: 20px;">
		<div>
  		<div class="col-sm-6">
  			<button type="submit" class="btn-signup-next"  id="btn-forgot-pass"> Next </button>
  		</div>
  		<div class="col-sm-6">
			<a href="sign_in.php">
  			<button type="button" class="btn-signup-next" id="btn-next-back"> back </button>
  			</a>  		
  		</div>
  		</div>  
	</div>
  	<div class="form-group">
  		<span class = "empty" style = "display: none;"> incorrect Username or Email Address </span>
   		<span class = "error" style = "display: none;"> Email and Username not matched </span>
  	</div>
</form>
    
</div>
<script src="./assets/js/tests/vendor/jquery.min.js"></script>
<script src="./assets/js/transition.js"></script>
<script src="./assets/js/tooltip.js"></script>
<script src="./assets/js/OnlineQuiz.js"></script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

</body>
</html>

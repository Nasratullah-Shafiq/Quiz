<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'../_Partial Components/Users.php');
	$usr = new Users();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$Username = $_POST['Username'];
		$Email = $_POST['Email'];
		
		$userforgo = $usr->forgotPassword($Username, $Email);
	}
?>
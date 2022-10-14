<?php
	error_reporting(0);
	session_start();
	require_once 'auth.php';
	$cuser = new Auth();

	if (!isset($_SESSION['user'])) {
		header("Location:index.php");
		die;
	}
	
	$cemail = $_SESSION['user'];

	$data = $cuser->currentUser($cemail);

	$cid = $data['id'];
	$cname = $data['name'];
	$cpass = $data['password'];
	$cphoto = $data['photo'];
	$created = $data['created_at'];
	$role = $data['role'];

	$reg_on = date('d M Y', strtotime($created));

	$verified = $data['verified'];

	$fname = strtok($cname, " ");

	if ($verified == 0) {
		$verified = 'Not Verified';
	} else {
		$verified = 'Verified';
	}

	$address = $data['address'];
	$city = $data['city'];
	$state = $data['state'];
	$zipcode = $data['zip_code'];
	$country = $data['country'];

?>
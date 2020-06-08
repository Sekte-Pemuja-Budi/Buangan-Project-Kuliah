<?php
require 'config.php';
require 'inc/session.php';

if(isset($_POST['a']) && isset($_POST['user']) && isset($_POST['pass'])) {
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	if($user == '' || $pass == '') die('2');
	
	if($_session->login($user, $pass) == false)
	
		die('1');
	die('3');
}

if($_session->isLogged())
	header('Location: home.php');
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
	<title>Login</title>
	<link href="media/css/bootstrap.min.css" rel="stylesheet">
	<link href="media/css/datepicker3.css" rel="stylesheet">
	<link href="media/css/styles.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,600" rel="stylesheet" type="text/css">
	<link rel="icon" href="media/img/favicon.ico" type="image/x-icon" />
	
	<script type="text/javascript" src="media/js/jquery.min.js"></script>
	<script type="text/javascript" src="media/js/login.js"></script>
</head>
<body>
	<div id="center"></div>
	<div id="content">
		<!--<div id="logo">
			<img src="media/img/logo3x-login.png" width="225" height="75" alt="Invento" />
		</div> -->
		<div id="login" class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
			<div id="error"></div>
			<form method="POST" action="" name="login">
				USERNAME:<br />
				<input class="form-control" type="text" name="username" /><br />
				PASSWORD:<br />
				<input class="form-control" type="password" name="password" /><br />
				
				<input class="btn btn-primary" type="submit" name="send" value="Login" />
			</form>
		</div>
	</div>
</div>
</div>
</div>
</div>
</body>
</html>
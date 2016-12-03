<!DOCTYPE html>
<html>
	<head>
		<title>Auth OOP</title>
		<link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
		<h3>Auth Dengan PHP OOP</h3>
		<?php
			if (!Session::check('username')) {
		?>
		<a class="btn btn-primary btn-sm" href="register.php">Register</a>
		<a class="btn btn-primary btn-sm" href="login.php">Login</a>
		<?php
			} else {
		?>
		<a class="btn btn-primary btn-sm" href="profile.php">Profile</a>
		<a class="btn btn-primary btn-sm" href="logout.php">Logout</a>
		<?php
			}
		?>
		<hr>

		
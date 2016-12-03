<?php

	require_once 'core/init.php';

	if (empty(Session::check('username'))) {
		header("location:login.php");
	}

	require_once 'templates/header.php';

	if (Session::check('profile')) {
		echo "<div class='alert alert-danger'><span>" . Session::flash('profile') . "</span></div>";
	}

	if (Input::get('nama')) {
		$data_user 	=	$user->get_data(Input::get('nama'));
	} else {
		$data_user 	=	$user->get_data(Session::get('username'));
	}

?>

	<h3>Halo <?=$data_user['username'] ?></h3>

<?php

	if (Input::get('nama')) {
		if ($user->is_admin(Input::get('nama'))) {
			echo "<h3>Selamat Datang Admin!</h3>";
			echo "<a href='change_password.php' class='btn btn-primary btn-sm'>Ganti Password</a>";
			echo "<a href='admin.php' class='btn btn-primary btn-sm'>Admin Dashboard</a><br><br>";
		}
	} else {
		if ($user->is_admin(Session::get('username'))) {
			echo "<h3>Selamat Datang Admin!</h3>";
			echo "<a href='change_password.php' class='btn btn-primary btn-sm'>Ganti Password</a>";
			echo "<a href='admin.php' class='btn btn-primary btn-sm'>Admin Dashboard</a><br><br>";
		}
	}

	require_once 'templates/footer.php';

?>
<?php

	require_once 'core/init.php';

	if (Session::check('username')) {
		header("location:profile.php");
	}

	$errors = array();

	if (Input::get('submit')) {
		if (Token::check(Input::get('token'))) {
			$validation = $validation->check(array(
						'username'	=>	array(
									'required'	=>	true
								),
						'password'	=>	array(
									'required'	=>	true
								)
					  ));

			if ($validation->passed()) {
				if ($user->cek_nama(Input::get('username'))) {
					if ($user->login_user(Input::get('username'), Input::get('password'))) {
						Session::set('username', Input::get('username'));
						header("location:profile.php");
					} else {
						$errors[] = "Login Gagal";
					}
				} else {
					$errors[] =	 "Username belum terdaftar";
				}
			} else {
				$errors = $validation->errors();
			}
		}
	}

	require_once 'templates/header.php';

?>

	<form method="POST">
		<div class="form-group">
			<label>Username</label>
			<input type="text" name="username" class="form-control">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="password" class="form-control">
		</div>

		<input type="hidden" name="token" value="<?php echo Token::generate();?>">

		<input type="submit" name="submit" class="btn btn-primary form-control" value="Login Sekarang"><br><br>
		<?php if (!empty($errors)) { ?>
			<div class="alert alert-danger">
				<?php foreach ($errors as $error) { ?>
					<span><?=$error ?></span><br>
				<?php } ?>
			</div>
		<?php } ?>
	</form><br><br>

<?php

	require_once 'templates/footer.php';

?>
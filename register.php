<?php

	require_once 'core/init.php';

	if (Session::check('username')) {
		Redirect::to('profile');
	}

	$errors = array();

	if (Input::get('submit')) {
		$validation = $validation->check(array(
						'username'	=>	array(
									'required'	=>	true, 
									'max'		=>	51,
									'min'		=>	2
								),
						'password'	=>	array(
									'required'	=>	true,
									'min'		=>	3
								),
						'password_verify' =>  array(
									'required'	=>	true,
									'match'		=>  'password'
								)
					  ));

		if ($user->cek_nama(Input::get('username'))) {
			$errors[]	=	"Username sudah terdaftar";
		} else {
			if ($validation->passed()) {
				$user->register_user(array(
					'username'	=>	Input::get('username'),
					'password'	=>	password_hash(Input::get('password'), PASSWORD_DEFAULT)
				));

				Session::flash('profile', 'Selamat anda berhasil mendaftar');
				Session::set('username', Input::get('username'));
				header("location:profile.php");
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
		<div class="form-group">
			<label>Ulangi Password</label>
			<input type="password" name="password_verify" class="form-control">
		</div>
		<input type="submit" name="submit" class="btn btn-primary form-control" value="Register Sekarang"><br><br>
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
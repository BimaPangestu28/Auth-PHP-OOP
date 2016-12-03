<?php

	require_once 'core/init.php';

	$errors = array();

	$data	= $user->get_data(Session::get('username'));

	if (empty(Session::check('username'))) {
		header("location:login.php");
	}

	if (Input::get('submit')) {
		if (password_verify(Input::get('password'), $data['password'])) {
			$validation  =  $validation->check(array(
					'password'		  => array(
										'required' => true,
									    ),
					'password_baru'	  => array(
										'required' => true,
										'min'	   => 3
									    ),
					'password_verify' => array(
										 'required' => true,
										 'match'	=> 'password_baru'
										)
				));
			if ($validation->passed()) {
				if (Token::check(Input::get('token'))) {
					$user->change_password(array('password' => password_hash(Input::get('password_baru'), 									 PASSWORD_DEFAULT)), $data['id']);

					Session::flash('profile', 'Password berhasil diperbarui');
					Redirect::to('profile');
				}
			} else {
				$errors = $validation->errors();
			}
		} else {
			$errors[] = "Password lama anda salah";
		}
	}

	require_once 'templates/header.php';

?>

	<form method="POST">
		<div class="form-group">
			<label>Password Lama</label>
			<input type="password" name="password" class="form-control">
		</div>
		<div class="form-group">
			<label>Password Baru</label>
			<input type="password" name="password_baru" class="form-control">
		</div>
		<div class="form-group">
			<label>Password Verify</label>
			<input type="password" name="password_verify" class="form-control">
		</div>

		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

		<input type="submit" name="submit" class="btn btn-primary form-control" value="Ganti Password">
		<?php
			if (!empty($errors)) {
		?>	
			<br><br><div class="alert alert-danger">
			<?php
				foreach ($errors as $error) {
					echo "<span>". $error . "</span>";
				}
			?>
			</div>
		<?php
			}
		?>
	</form><br>

<?php

	require_once 'templates/footer.php';

?>
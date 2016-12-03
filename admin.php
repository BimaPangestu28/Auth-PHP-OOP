<?php

	require_once 'core/init.php';

	require_once 'templates/header.php';

	$data = $user->list_data();

	if (!$user->is_admin(Session::get('username'))) {
		Redirect::to('profile');
		Session::flash('profile', 'Anda bukan admin');
	}

?>

	<h3>Halo <?=Session::get('username') ?></h3>

	<?php
		foreach ($data as $_user) {
			echo "<a href='profile.php?nama=" . $_user['username'] . "'>" . $_user['username'] . "</a><br>";
		}
	?>

<?php

	require_once 'templates/footer.php';

?>
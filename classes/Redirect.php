<?php

	class Redirect {
		public static function to($location){
			header("location:" . $location . ".php");
		}
	}

?>
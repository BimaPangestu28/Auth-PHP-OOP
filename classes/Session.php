<?php

	class Session {

		public static function set($nama, $nilai){
			return $_SESSION[$nama]	= $nilai;
		}

		public static function get($nama){
			return $_SESSION[$nama];
		}

		public static function check($nama){
			if (isset($_SESSION[$nama])) {
				return true;
			} else {
				return false;
			}
		}

		public static function flash($nama, $msg = ''){
			if (self::check($nama)) {
				$session = self::get($nama);
				self::delete($nama);
				return $session;
			} else {
				self::set($nama, $msg);
			}
		}

		public static function delete($nama){
			unset($_SESSION[$nama]);
		}

	}
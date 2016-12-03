<?php

	class User {
		private $connect;

		public function __construct(){
			$this->connect = Database::getInstance();
		}

		public function register_user($fields = array()){
			if ($this->connect->insert('users', $fields)) {
				return true;
			} else {
				return false;
			}
		}

		public function login_user($username, $password){
			$data 	=	$this->connect->cek_login('users', 'username', $username);

			if (password_verify($password, $data['password'])) {
				return true;
			} else {
				return false;
			}
		}

		public function cek_nama($username){
			$data 	=	$this->connect->cek_login('users', 'username', $username);

			if (empty($data)) {
				return false;
			} else {
				return true;
			}
		}

		public function is_admin($username){
			$data 	=	$this->connect->cek_login('users', 'username', $username);

			if ($data['role'] == 1) {
				return true;
			} else {
				return false;
			}	
		}

		public function get_data($username){
			if ($this->cek_nama($username) == $username) {
				return $this->connect->cek_login('users', 'username', $username);
			} else {
				return false;
			}
		}

		public function change_password($fields = array(), $id){
			if ($this->connect->update('users', $fields, $id)) {
				return true;
			} else {
				return false;
			}
		}

		public function list_data(){
			if ($this->connect->cek_login('users')) {
				return $this->connect->cek_login('users');
			} else {
				return false;
			}
		}
	}

?>
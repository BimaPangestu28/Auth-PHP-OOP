<?php

	class Database {

		private static $instance = null;

		private $dbcon,
				$host 	=	"localhost",
				$user   =   "root",
				$pass 	=	"root",
				$db 	=	"tutorial";

		public function __construct(){
			$this->dbcon = new mysqli($this->host, $this->user, $this->pass, $this->db);
			if (mysqli_connect_error()) {
				die("Error");
			}
		}

		public static function getInstance(){
			if (!isset(self::$instance)) {
				self::$instance = new Database();
			}

			return self::$instance;
		}

		public function insert($table, $fields = array()){
			/*
			* Mendapatkan column dengan memisahkan keys dengan metode implode
			*/
			$column	=	implode(", ", array_keys($fields));


			/*
			* Mendapatkan values
			*/
			$valueArrays	=	array();
			$i 				=	0;
			foreach ($fields as $key => $value) {
				if (is_int($value)) {
					$valueArrays[$i]	=	$this->escape($value);
				} else {
					$valueArrays[$i]	=	"'" . $this->escape($value) . "'";
				}
				$i++;
			}
			$values =	implode(", ", $valueArrays);

			$sql 	=	"INSERT INTO $table ($column) VALUES($values)";

			$this->run_query($sql, "Masalah saat register");
		}

		public function cek_login($table, $column = '', $value = ''){
			if (!is_int($value)) {
				$value = "'" . $value . "'";
			}

			if ($column != '' && $value != '') {
				$sql 	 =	$this->dbcon->query("SELECT * FROM $table WHERE $column = $value");
				while ($rows   = $sql->fetch_array()) {
					return $rows;
				}
			} else {
				$sql 	 =	$this->dbcon->query("SELECT * FROM $table");
				while ($rows   = $sql->fetch_array()) {
					$results[] = $rows;
				}

				return $results;
			}
		}

		public function update($table, $fields = array(), $id){
			$valueArrays = array();
			$i 			 = 0;
			foreach ($fields as $key => $value) {
				if (is_int($value)) {
					$valueArrays[$i]	=	$key . "=" . $this->escape($value);
				} else {
					$valueArrays[$i]	=	$key . "='" . $this->escape($value) . "'";
				}
				$i++;
			}
			$value 	=	implode(", ", $valueArrays);

			$sql 	=	"UPDATE $table SET $value WHERE id=$id";

			$this->run_query($sql, "Gagal mengubah password");
		}

		public function escape($name){
			return $this->dbcon->real_escape_string($name);
		}

		public function run_query($sql, $msg){
			if ($this->dbcon->query($sql)) {
				return true;
			} else {
				die($msg);
			}
		}
	}

?>
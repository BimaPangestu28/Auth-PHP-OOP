<?php

	class Validation {

		private $errors = array(),
				$passed = false;

		public function check($items = array()){
			foreach ($items as $item => $rules) {
				foreach ($rules as $rule => $rule_value) {
					switch ($rule) {
						case 'required':
							if (trim(Input::get($item) == false && $rule_value == true)) {
								$this->addErrors("$item wajib diisi");
							}
							break;
						case 'min':
							if (strlen(Input::get($item)) < $rule_value) {
								$this->addErrors("$item minimal $rule_value karakter");
							}
							break;
						case 'max':
							if (strlen(Input::get($item) > $rule_value)) {
								$this->addErrors("$item maximal $rule_value karakter");
							}
							break;
						case 'match':
							if (Input::get($item) != Input::get($rule_value)) {
								$this->addErrors("$item harus sama dengan $rule_value");
							}
							break;
						
						default:
							break;
					}
				}
			}

			if (empty($this->errors)) {
				$this->passed = true;
			}

			return $this;
		}

		private function addErrors($error){
			$this->errors[]	 =	$error;
		}

		public function errors(){
			return $this->errors;
		}

		public function passed(){
			return $this->passed;
		}

	}
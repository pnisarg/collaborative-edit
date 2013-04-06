<?php

class User{

	public $id;
	public $login;
	public $first;
	public $last;
	public $password;
	public $salt;
	public $email;

	public function encryptPassword($clearPassword){
		$this->salt = mt_rand();
		 $this->password = sha1($this->salt . $clearPassword);
	
	}

	public function comparePassword($clearPassword){
		if($this->password == sha1($this->salt . $clearPassword))
			return true;
		return false;
	}

	public function getFullname(){
		return $this->first . $this->last;
	}

}
?>
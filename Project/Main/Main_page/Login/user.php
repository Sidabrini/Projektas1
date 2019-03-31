<?php

	require_once("config/database.php");
	
	class User{
		public $name;
        public $lastname;
        public $birthdate;
		public $email;
		public $pass;
		
		public function set($name, $lastname, $birthdate, $email, $pass){
			$this->name = $name;
            $this->lastname = $lastname;
            $this->birthdate = $birthdate;
			$this->email = $email;
			$this->pass = $pass;
		}
	}
	
	class Person{
	
		private $user = array();
		public $counter = 0;
		
		public function Add (User $User) {
			$this->user[$this->counter] = $User;
			$this->counter++;
		}
		
		public function GetByIndex($index) {
			return $this->user[$index];
		}
		
		public function GetBy($by, $name) {
			$return = FALSE;
    
			for ($i = 0; $i < $this->counter; $i++) {
      
			if($this->user[$i]->$by == $name) 
				$return = $this->user[$i];
			}
    
			return $return;
		}

	}
	
	$Person = new Person;
	
	$query = $Database->query("SELECT * FROM person");
	
	while ($row = $query->fetch_assoc()) {
        $user = new User;
		$user->set($row["Name"], $row["Lastname"], $row["Birthdate"], $row["Email"], $row["Password_hash"]);
		
		$Person->Add($user);
    }
	
?>
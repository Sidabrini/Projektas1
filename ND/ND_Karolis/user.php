<?php

	require_once("config/database.php");
	
	class User{
		public $ID;
		public $email;
		public $pass;
		
		public function set($ID, $email, $pass){
			$this->ID = $ID;
			$this->email = $email;
			$this->pass = $pass;
		}
	}
	
	class EventData{
		public $ID;
		public $name;
		public $city;
		
		public function set($ID, $name, $city){
			$this->ID = $ID;
			$this->name = $name;
			$this->city = $city;
		}
	}
	
	class EventListData{
		public $ID;
		public $user_id;
		public $event_id;
		
		public function set($ID, $user_id, $event_id){
			$this->ID = $ID;
			$this->user_id = $user_id;
			$this->event_id = $event_id;
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
	
	$query = $Database->query("SELECT * FROM user");
	
	while ($row = $query->fetch_assoc()) {
        $user = new User;
		$user->set($row["ID"], $row["Email"], $row["Password_hash"]);
		
		$Person->Add($user);
    }
	
	class Event{
	
		private $event = array();
		public $counter = 0;
		
		public function Add (EventData $Event) {
			$this->event[$this->counter] = $Event;
			$this->counter++;
		}
		
		public function GetByIndex($index) {
			return $this->event[$index];
		}
		
		public function GetBy($by, $name) {
			$return = FALSE;
    
			for ($i = 0; $i < $this->counter; $i++) {
      
			if($this->event[$i]->$by == $name) 
				$return = $this->event[$i];
			}
    
			return $return;
		}
		
		public function GetLength() {
			return count($this->event);
		}
		
		public function Out($at){
			$zodis = "name";
			$text = $this->event[$at]->$zodis;
			return $text;
		}

	}
	
	$Event = new Event;
	
	$query = $Database->query("SELECT * FROM event");
	
	while ($row = $query->fetch_assoc()) {
        $event = new EventData;
		$event->set($row["ID"], $row["name"], $row["city"]);
		
		$Event->Add($event);
    }
	
	class EventList{
	
		private $eventlistas = array();
		public $counter = 0;
		
		public function Add (EventListData $Event) {
			$this->eventlistas[$this->counter] = $Event;
			$this->counter++;
		}
		
		public function GetByIndex($index) {
			return $this->eventlistas[$index];
		}
		
		public function GetBy($by, $get, $name) {
			$return = array();
			$index = 0;
			for ($i = 0; $i < $this->counter; $i++) {
				if($this->eventlistas[$i]->$by == $name) {
					$return[$index] = $this->eventlistas[$i]->$get;
					$index++;
				}
			}
			return $return;
		}
		
		public function Contains($by, $name) {
			$return = FALSE;
			for ($i = 0; $i < $this->counter; $i++) {
				if($this->eventlistas[$i]->$by == $name) {
					$return = TRUE;
				}
			}
			return $return;
		}
		public function GetLength() {
			return count($this->eventlistas);
		}

	}
	
	$EventList = new EventList;
	
	$query = $Database->query("SELECT * FROM event_list");
	
	while ($row = $query->fetch_assoc()) {
        $eventList = new EventListData;
		$eventList->set($row["ID"], $row["user_id"], $row["event_id"]);
		
		$EventList->Add($eventList);
    }
?>
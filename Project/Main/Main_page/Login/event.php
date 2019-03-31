 <?php

	require_once("config/database.php");
	
	class Event{
		public $title;
        public $category;
        public $city;
		public $address;
		public $place;
        public $date;
        public $time;
        public $duration;
        public $price;
        public $description;
		
		public function set($title, $category, $city, $address, $place, $date, $time, $duration, $price, $description){
			$this->title = $title;
            $this->category = $category;
            $this->city = $city;
            $this->address = $address;
            $this->place = $place;
            $this->date = $date;
            $this->time = $time;
            $this->duration = $duration;
            $this->price = $price;
            $this->description = $description;
		}

		public function GetTitle(){
		    return $this->title;
        }

        public function Loop ($j){
            if($j == 0)
                return $this->title;
            if($j == 1)
                return $this->category;
            if($j == 2)
                return $this->city;
            if($j == 3)
                return $this->address;
            if($j == 4)
                return $this->place;
            if($j == 5)
                return $this->date;
            if($j == 6)
                return $this->time;
            if($j == 7)
                return $this->duration;
            if($j == 8)
                return $this->price;
            if($j == 9)
                return $this->description;
        }
	}
	
	class Events{
	
		private $event = array();
		public $counter = 0;

		public function Add (Event $Event) {
			$this->event[$this->counter] = $Event;
			$this->counter++;
		}

		public function GetLength (){
		    return $this->counter;
        }

        public function GetArray (){
            return $this->event;
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

	}
	
	$Events = new Events;
	
	$query = $Database->query("SELECT * FROM event_");
	
	while ($row = $query->fetch_assoc()) {
        $event = new Event;
		$event->set($row["Title"], $row["Category"], $row["City"], $row["Address"], $row["Place"], $row["Date"], $row["Time"], $row["Duration"], $row["Price"], $row["Description"]);
		$Events->Add($event);
    }
	
?>
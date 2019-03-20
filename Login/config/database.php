<?php

class Database {
	
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $database = "semestro_projektas";
	public $db; 
	
	public function connect(){
		$this->db = new mysqli($this->servername, $this->username, $this->password, $this->database);
	}
	
	public function set_charset($charset){
		$this->db->set_charset($charset);
	}
	
	public function query($query) {
		return $this->db->query($query);
	}
}

$Database = new Database;
$Database->connect();
$Database->set_charset("utf8");

?>
<?php

	class Users{
		public $User = array(
			"vienas@vienas.com" => '$2y$10$yRObQdAPyCyV0FA/zoZbneyf57A0a4OioryiiV0HPM8EYhtYaIEVi', 	// vienas1
			"du@du.com" => '$2y$10$00cFCAkvr.jQKbCyg0fUVeZqthBNLDx/gj34Qua1wcTG9smwHrNTu', 			// du2
			"trys@trys.com" => '$2y$10$sDrr8iX/OHxNfzabV/sKhekFeaL2ZHnYPbjeMi1b2LGEQdM43jjF.', 		// trys3
			"keturi@keturi.com" => '$2y$10$upk/pkDn35GpbVjeWJ4V.uAaHD5GjrT/s8KfWbYRFsET5dvKXpcJW', 	// keturi4
			"penki@penki.com" => '$2y$10$ddkAypS9Amzqetgx2voTROoaI0HCMeBs874U7nyAP60nPlLRUUNQC'  	// penki5
		); 
		
		public function get_user_pass($index){ 
			if(isset($this->User[$index])) { 
				return $this->User[$index];
			}
			else {
				return false; 
			}
		}
	}
	
	$Users = new Users;

?>
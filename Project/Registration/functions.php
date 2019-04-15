<?php

    require_once ("database.php");
	session_start();

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'semestro_projektas');
	// variable declaration
	$name = "";
	$email    = "";
	$surname = "";
	$birthdate = "";
	$errors   = array();


// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
    register();
}


	// REGISTER USER
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$name=e($_POST['name']);
        $surname  =  e($_POST['surname']);
        $birthdate   =  e($_POST['birthdate']);
		$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($name)) {
			array_push($errors, "Name is required");
		}
        if (empty($surname)) {
            array_push($errors, "Surname is required");
        }
        if (empty($birthdate )) {
            array_push($errors, "Birthdate is required");
        }
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = password_hash($password_1, PASSWORD_DEFAULT);//encrypt the password before saving in the database

			if (isset($_POST['email'])) {
				$query = "INSERT INTO users (Name,Surname,Birthday,Email,Password) 
						  VALUES('$name','$surname','$birthdate','$email', '$password')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";
				header('location: index.php');
			}else{
                $query = "INSERT INTO users (Name,Surname,Birthday,Email,Password) 
						  VALUES('$name','$surname','$birthdate','$email', '$password')";
				mysqli_query($db, $query);

			}

		}

	}
	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

?>
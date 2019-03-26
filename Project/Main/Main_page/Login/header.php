<?php
	ob_start();
	session_start();
	
	require_once("config/database.php");
	require_once("user.php");
	
	$logged = FALSE;
	
	if(isset($_SESSION["login"])) {
		if(isset($_SESSION["login"]["email"]) && isset($_SESSION["login"]["pass"])) {
			$user = $Person->GetBy("email",$_SESSION["login"]["email"]);
			if(password_verify($_SESSION["login"]["pass"], $user->pass)){
				$logged = TRUE;
			}
		}
	}
	
	if(isset($_GET["id"])) $ID = $_GET["id"]; else $ID = "";
?>
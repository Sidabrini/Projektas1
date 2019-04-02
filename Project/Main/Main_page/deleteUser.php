<?php
require_once ("Login/config/database.php");
$email = $_GET["email"];
$Database->query("Delete FROM user_ where Email='$email'");
$Database->query("Delete from person where Email='$email'");
header('Location: usersList.php');
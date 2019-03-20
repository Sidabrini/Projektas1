<?php	
	require_once("header.php");
	require_once("config/database.php");
	require_once("user.php");
?>
<!doctype html>
<html>
<head>
	<link href="style.css?t=<?php echo time(); ?>" rel="stylesheet"/> 
</head>
<body>
	<div class="login">
	
		<?php if(!$logged) { ?>
		
		<h1>Prisijungimas</h1>
		<?php 
			
			if(isset($_POST["submit"])) {
				
				if(!empty($_POST["email"]) && !empty($_POST["pass"])){ 
					
					$user = $Person->GetBy("email", $_POST["email"]);
					
					if($user && password_verify($_POST["pass"], $user->pass)) {
						echo "<div class=\"alert\" id=\"success\">Prisijungta</div>";
						
						$_SESSION["login"] = array();
						$_SESSION["login"]["email"] = $_POST["email"];
						$_SESSION["login"]["pass"] = $_POST["pass"];
						
						header("Location: index.php");
					}
					else { 
						echo "<div class=\"alert\" id=\"error\">Neteisingi duomenys</div>"; 
					}
					
				}
				else {
					echo "<div class=\"alert\" id=\"error\">Neįvesti duomenys</div>";
				}
			}
		?>
		<form method="post" action="?">
			<input type="email" placeholder="Elektroninis paštas" name="email"/><br/>
			<input type="password" placeholder="Slaptažodis" name="pass"/><br/>
			<input type="submit" value="Prisijungti" name="submit"/>
		</form>
		
		<?php } else { ?>
			
			<?php if($ID == "") { ?>
				<h1>Esate prisijungęs, <?php echo $user->email ?></h1>
				<a href="?id=change_password">Keisti slaptažodį</a><br/>
				<a href="?id=logout">Atsijungti</a>
			<?php } ?>
			
			<?php if($ID == "change_password") { ?>
				<h1>Slaptažodžio keitimas</h1>
				
				<?php
				if(isset($_POST["submit"])) {
					
					if(!empty($_POST["pass"]) && !empty($_POST["newpass"])){
						$pass = $_POST["pass"]; 
						$newpass = $_POST["newpass"]; 
						
						if($pass === $newpass) { 
							if(strlen($pass)> 5) {
								echo "<div class=\"alert\" id=\"success\">Slaptažodis pakeistas</div>";
								$newpass = password_hash($newpass, PASSWORD_DEFAULT);
								$Database->query("UPDATE person SET Password_hash = '$newpass' WHERE Email = '".$user->email."'");
								$_SESSION["login"]["pass"] = $pass;
							}
							else {
								echo "<div class=\"alert\" id=\"error\">Per trumpas</div>"; 
							}
						}
						else { 
							echo "<div class=\"alert\" id=\"error\">Nesutampa</div>"; 
						}
						
					}
					else {
						echo "<div class=\"alert\" id=\"error\">Neįvesti duomenys</div>";
					}
				}
				?>
				
				<form method="post" action="?id=change_password">
					<input type="password" placeholder="Įveskite naują slaptažodį" name="pass"/><br/>
					<input type="password" placeholder="Pakartokite slaptažodį" name="newpass"/><br/>
					<input type="submit" value="Atnaujinti" name="submit"/>
				</form>
			<?php } ?>
			
			<?php if($ID == "logout") {
				$_SESSION["login"] = NULL;
				header("Location: ?id=");
			} ?>
			
			<?php if($ID != "") { echo "<a class='footer_link' href='?id='>Pagrindinis</a>"; } ?>
			
		<?php } ?>
		
	</div>
</body>
</html>
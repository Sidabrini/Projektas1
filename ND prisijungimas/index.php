<?php
	require_once("userClass.php");
?>
<!doctype html>
<html>
<head>
	<link href="style.css" rel="stylesheet"/>
</head>
<body>
	<div class="login">
		<h1>Prisijungimas</h1>
		<?php 
			
			if(isset($_POST["submit"])) {
				
				if(!empty($_POST["email"]) && !empty($_POST["pass"])){ 
					$email = $_POST["email"]; 
					$pass = $_POST["pass"]; 
					
					if(password_verify($pass, $Users->get_user_pass($email))) { 
						echo "<div class=\"alert\" id=\"success\">Prisijungta</div>";
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
	</div>
</body>
</html>
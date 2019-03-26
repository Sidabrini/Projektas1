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
				<h1>Esate užsiregistrave į šiuos renginius: </h1>
				<?php 
				$result = array();
				$resultevent = new Event;
				if($EventList->Contains("user_id",$user->ID)){
					$result = $EventList->GetBy("user_id","event_id",$user->ID);
					for($i = 0; $i < count($result); $i++){
						$resultevent->Add($Event->GetBy("ID", $result[$i]));?>
						<h3><?php echo $resultevent->Out($i); ?></h3>
				<?php 
					}
				}
				?>
				<a href="?id=logout">Atsijungti</a>
			<?php } 			
			if($ID == "logout") {
				$_SESSION["login"] = NULL;
				header("Location: ?id=");
			} ?>
			
			<?php if($ID != "") { echo "<a class='footer_link' href='?id='>Pagrindinis</a>"; } ?>
			
		<?php } ?>
		
	</div>
</body>
</html>
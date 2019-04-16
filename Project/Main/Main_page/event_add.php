<?php
require_once("Login/event.php");
require_once("Login/config/database.php");

 session_start();
if(isset($_GET["id"])) $ID = $_GET["id"]; else $ID = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HomePage</title>

    <link rel="stylesheet" type="text/css" href="style.css?t=<?php echo time(); ?>">
</head>
<body>

<div class="header">
    <h1>My Website</h1>
    <p>Resize the browser window to see the effect.</p>
</div>

<div class="topnav">
    <?php if(isset($_SESSION["login"]["email"])) {?>
    <a href="?id=logout" style="float:right">Atsijungti</a>
    <a href="#" style="float:right">Keisti slaptažodį</a>
    <a href="#" style="float:right"><?php echo $_SESSION["login"]["email"]?></a>
    <a href="index.php" style="float:left">Pagrindinis</a>
        <?php if($_SESSION["login"]["type"] == "admin"){?>
            <a href="event_add.php" style="float:right">Pridėti renginį</a>
            <a href="events.php" style="float:right">Renginiai</a>
        <?php }}
          else { ?>
              <a href="#" style="float:right">Register</a>
              <a href="Login/index.php" style="float:right">Login</a>
          <?php }
                if($ID == "logout") {
				$_SESSION["login"] = NULL;
				header("Location: ?id=");
			    } ?>

</div>
</form>
<div class="row">
    <div class="leftcolumn">
        <div class="card">
            <?php if(isset($_POST["add"])) {
                if(!empty($_POST["title"]) && !empty($_POST["category"]) && !empty($_POST["city"]) && !empty($_POST["address"]) && !empty($_POST["place"]) && !empty($_POST["date"]) && !empty($_POST["time"]) && !empty($_POST["duration"]) && !empty($_POST["price"]) && !empty($_POST["description"])) {
                    $query = "INSERT INTO event_ VALUES ('" . $_POST["title"] . "', '" . $_POST["category"] . "', '" . $_POST["city"] . "', '" .
                        $_POST["address"] . "', '" . $_POST["place"] . "', '" . $_POST["date"] . "', '" . $_POST["time"] . "', '" .
                        $_POST["duration"] . "', '" . $_POST["price"] . "', '" . $_POST["description"] . "', '" . 3 . "', '" . $_SESSION["login"]["email"]. "');";
                    $result = $Database->query($query);
                    header("Location:index.php");
                }
            }?>
            <h2>Naujas renginys</h2>
            <form method="post" action="?">
                <input type="text" placeholder="Pavadinimas" name="title"/><br/>
                <input type="text" placeholder="Kategorija" name="category"/><br/>
                <input type="text" placeholder="Miestas" name="city"/><br/>
                <input type="text" placeholder="Adresas" name="address"/><br/>
                <input type="text" placeholder="Vieta" name="place"/><br/>
                <input type="date" placeholder="Data" name="date"/><br/>
                <input type="time" placeholder="Laikas" name="time"/><br/>
                <input type="time" placeholder="Trukmė" name="duration"/><br/>
                <input type="number" placeholder="Kaina" name="price"/><br/>
                <textarea rows="3" cols="100" placeholder="Aprašymas" name="description"></textarea><br/>
                <input type="submit" value="Pridėti" name="add"/>
        </div>
    </div>
    <div class="rightcolumn">
        <div class="card">
            <h2>About Me</h2>
            <div class="fakeimg" style="height:100px;">
                <img id="logo" class="logo-large" src="https://ktu.edu/wp-content/uploads/2016/03/KTU.svg" alt="">
            </div>
            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
        </div>
        <div class="card">
            <h3>Popular Post</h3>
            <div class="fakeimg"><p>Image</p></div>
            <div class="fakeimg"><p>Image</p></div>
            <div class="fakeimg"><p>Image</p></div>
        </div>
        <div class="card">
            <h3>Follow Me</h3>
            <p>Some text..</p>
        </div>
    </div>
</div>

<div class="footer">
    <h2>Footer</h2>
</div>

</body>
</html>

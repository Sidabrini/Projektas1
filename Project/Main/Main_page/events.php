<?php
require_once("Login/event.php");
require_once("Login/config/database.php");

 session_start();
    $query = $Database->query("SELECT * FROM event_");
    $Events = new Events;
    while ($row = $query->fetch_assoc()) {
        $Event = new Event;
        $Event->set($row["Title"], $row["Category"], $row["City"], $row["Address"], $row["Place"], $row["Date"],  $row["Time"],
                     $row["Duration"], $row["Price"], $row["Description"], $row["id_Event"], $row["fk_AdminEmail"]);
        $Events->Add($Event);
    }
    $Naujas = $Events->GetArray();
    $Events = $Naujas;
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
    <?php }
          else { ?>
              <a href="#" style="float:right">Register</a>
              <a href="Login/index.php" style="float:right">Login</a>
          <?php }
                if($ID == "logout") {
				$_SESSION["login"] = NULL;
				header("Location: ?id=");
			    } ?>

</div>

<div class="row">
    <div class="leftcolumn">
        <?php
        if($Events != NULL){
            if(0 != sizeof($Events)) {
                for ($i = 0; $i < sizeof($Events); $i++) {
                    if(isset($_POST["delete".$Events[$i]->loop(10)])) {
                        $Database->query("DELETE FROM event_ WHERE id_Event=" . $Events[$i]->loop(10));
                        header("Location: index.php");
                    }
                    ?>
                    <div class="card">
                        <?php if($_SESSION["login"]["type"] == "admin"){?>
                        <form  method="post" action="?">
                            <input class="deletion" type="submit" value="Pašalinti" name="delete<?php echo $Events[$i]->loop(10)?>"/>
                        </form>
                        <?php }?>
                        <h2><?php echo $Events[$i]->loop(0); ?></h2>
                        <h5><?php echo $Events[$i]->loop(2);
                            echo " " . $Events[$i]->loop(6); ?></h5>
                        <div class="fakeimg" style="height:125px;">
                            <b>Kategorija</b>: <?php echo $Events[$i]->loop(1);?><br>
                            <b>Adresas</b>: <?php echo $Events[$i]->loop(3); ?><br>
                            <b>Vieta</b>: <?php echo $Events[$i]->loop(4); ?><br>
                            <b>Trukmė</b>: <?php echo $Events[$i]->loop(7); ?><br>
                            <b>Kaina</b>: <?php echo $Events[$i]->loop(8); ?><br>
                        </div>
                        <p><?php echo $Events[$i]->loop(9); ?></p>
                    </div>
                    <?php
                }
            }
        }
        if($Events == NULL)
        {?>
            <div class="card">
                <h2>Kolkas nėra vykstančių renginių</h2>
            </div>
        <?php }
        elseif(sizeof($Events) == 0)
        {?>
        <div class="card">
            <h2>Kolkas nėra vykstančių renginių</h2>
        </div>
        <?php }?>
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

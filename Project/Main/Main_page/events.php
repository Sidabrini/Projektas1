<?php
require_once("Login/event.php");
 session_start();
if($_SESSION["events"] == NULL){
    $events = $Events->GetArray();
    $_SESSION["events"] = array();
    for($i = 0; $i < sizeof($events); $i++) {
        for ($j = 0; $j < 10; $j++) {
            $_SESSION["events"][$i][$j] = $events[$i]->Loop($j);
        }
    }
}
if(isset($_GET["id"])) $ID = $_GET["id"]; else $ID = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HomePage</title>

    <link rel="stylesheet" type="text/css" href="style.css">
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
    <a href="index.php" style="float:right">Pagrindinis</a>
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
        if($_SESSION["events"] != NULL){
            if(0 != sizeof($_SESSION["events"])) {
                for ($i = 0; $i < sizeof($_SESSION["events"]); $i++) { ?>
                    <div class="card">
                        <h2><?php echo $_SESSION["events"][$i][0] ?></h2>
                        <h5><?php echo $_SESSION["events"][$i][2];
                            echo " " . $_SESSION["events"][$i][6] ?></h5>
                        <div class="fakeimg" style="height:125px;">
                            <b>Kategorija</b>: <?php echo $_SESSION["events"][$i][1] ?><br>
                            <b>Adresas</b>: <?php echo $_SESSION["events"][$i][3] ?><br>
                            <b>Vieta</b>: <?php echo $_SESSION["events"][$i][4] ?><br>
                            <b>Trukmė</b>: <?php echo $_SESSION["events"][$i][7] ?><br>
                            <b>Kaina</b>: <?php echo $_SESSION["events"][$i][8] ?><br>
                        </div>
                        <p><?php echo $_SESSION["events"][$i][9] ?></p>
                    </div>
                    <?php
                }
            }
        }
        if($_SESSION["events"] == NULL)
        {?>
            <div class="card">
                <h2>Kolkas nėra vykstančių renginių</h2>
            </div>
        <?php }
        elseif(sizeof($_SESSION["events"]) == 0)
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

<?php
/**
 * Created by PhpStorm.
 * User: vsida
 * Date: 3/19/2019
 * Time: 6:06 PM
 */
 session_start(); /*var_dump($_SESSION["login"]);*/
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
    <a href="events.php" style="float:right">Renginių sąrašas</a>
    <?php }
          else { ?>
              <a href="#" style="float:right">Register</a>
              <a href="Login/index.php" style="float:right">Login</a>
          <?php }
                if($ID == "logout") {
				$_SESSION["login"] = NULL;
				$_SESSION["events"] = NULL;
 				header("Location: ?id=");
			    } ?>

</div>

<div class="row">
    <div class="leftcolumn">
        <div class="card">
            <h2>TITLE HEADING</h2>
            <h5>Title description, Dec 7, 2017</h5>
            <div class="fakeimg" style="height:200px;">Image</div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
        </div>
        <div class="card">
            <h2>TITLE HEADING</h2>
            <h5>Title description, Sep 2, 2017</h5>
            <div class="fakeimg" style="height:200px;">Image</div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
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

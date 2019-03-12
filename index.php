<?php
    require_once ("User.php");
?>
<!doctype html>
<html>
<head>
    <link href = "style.css" rel = "stylesheet" />
</head>
<body>
<div class="login">
    <h1>Login</h1>
    <?php
    $users = array(
            new User("abc@abc.com","abc"),
            new User("vienas@vienas.com","vienas"),
            new User("du@du.com","du"),
            new User("trys@trys.com","trys"),
            new User("keturi@keturi.com","keturi"));

    $message = "Enter your email and password.";

    if(isset($_POST["submit"])) {

        $message_was_changed = 0; //if message was changed, it must have value of 1

        if(!empty($_POST["email"]) && !empty($_POST["pass"])){
            $email = $_POST["email"];
            $pass = $_POST["pass"];

            foreach ($users as $one_user){
                if($one_user->login_verify($pass,$email)) {
                    $message = "Successfully login";
                    $message_was_changed = 1;
                    break;
                }
            }
            if($message_was_changed === 0){
                $message = "Wrong password or email. Please try again.";
            }
        }

        if($message_was_changed === 0){
            echo "<div class=\"alert\" id=\"error\">$message</div>";
        }
        else{
            echo "<div class=\"alert\" id=\"success\">$message</div>";
        }
    }
    ?>
    <form method="post" action="?">
        <input type="email" placeholder="Enter email" name="email"/><br/>
        <input type="password" placeholder="Enter password" name="pass"/><br/>
        <input type="submit" value="Login" name="submit"/>
    </form>
</div>
</body>
</html>
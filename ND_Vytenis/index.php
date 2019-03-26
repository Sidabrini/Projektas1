<?php
/**
 * Created by PhpStorm.
 * User: vsida
 * Date: 3/10/2019
 * Time: 4:33 PM
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Yantramanav:100,300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body>
<div class="header">
    <h1>Please login</h1>
</div>

<div class="log">
    <?php
    session_start();
    $message = "Enter your email and password.";

    if(isset($_POST["submit"])){

        if(!empty($_POST["email"]) && !empty($_POST["password"])){
            $email = $_POST["email"];
            $password =$_POST["password"];

            $conn = new mysqli("localhost", "root", "", "nd");
            $hash = password_hash($password, 1);
            $sql = "SELECT Email, Password_hash FROM user";

            $result = $conn->query($sql);
            if ($result ->num_rows > 0){
                while($row = $result -> fetch_assoc()){
                    if(password_verify($password, $row["Password_hash"]) && $row["Email"]){
                        $_SESSION['user'] = $email;
                        header('Location: logged_in.php');
                    }
                }
            }
            $conn ->close();
            $message = "Wrong password or email! Try again.";
        }
        echo "<div class=\"alert\" id=\"error\">$message</div>";

    }

    ?>
    <form method="post" action="?">
        <input type="email" placeholder="Email" name="email"/><br/>
        <input type="password" placeholder="Password" name="password"/><br/>
        <input type="submit" value="Login" name="submit"/>
    </form>
</div>
</body>
</html>
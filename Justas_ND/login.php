<!doctype html>
<html>
<head>
    <link href = "styles.css" rel = "stylesheet" />
</head>
<body>
<div class="login">
    <h1>Login</h1>
    <?php
    session_start();
    $message = "Enter your email and password.";
    if(isset($_POST["submit"])) {
        if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
            $email = $_POST["email"];
            $pass = $_POST["pass"];
            $conn = new mysqli("localhost", "root", "", "DB");
            $hash = password_hash($pass, 1);
            $sql = "SELECT Email, Password_hash FROM users";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (password_verify($pass, $row["Password_hash"]) && $email === $row["Email"]) {
                        $_SESSION['user'] = $email;
                        header('Location: index.php');
                    }
                }
            }
            $conn->close();
            $message = "Wrong user info. Please try again";
        }
        echo "<div class=\"alert\" id=\"error\">$message</div>";
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
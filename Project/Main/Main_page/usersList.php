<?php
session_start();
if($_SESSION == null){
    header('Location: index.php');
}
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
    <a href="index.php?id=logout" style="float:right">Atsijungti</a>
    <a href="#" style="float:right">Keisti slaptažodį</a>
    <a href="#" style="float:right"><?php echo $_SESSION["login"]["email"]?></a>
    <a href="index.php" style="float:left">Pagrindinis</a>
</div>
<div>
    <br>
    <table>
        <tr>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Gimimo diena</th>
            <th>El.Paštas</th>
            <th>Galimos operacijos</th>
        </tr>
<?php
require_once ("Login/config/database.php");

$users_emails = $Database->query("SELECT * FROM user_");
if($users_emails->num_rows > 0){
    while ($row = $users_emails->fetch_assoc()){
        $email = $row["Email"];
        $person_data = $Database->query("SELECT * FROM person where Email = '$email'");
        if($person_data->num_rows > 0){
            while ($person = $person_data->fetch_assoc()){
                $name =  $person["Name"];
                $lastname = $person["Lastname"];
                $birthdate = $person["Birthdate"];
                echo "<tr>
                        <td>$name</td>
                        <td>$lastname</td>
                        <td>$birthdate</td>
                        <td>$email</td>
                        <td>
                        <button style=\"float:center\" onclick=\"document.location.href ='deleteUser.php?email=$email'\">Šalinti paskyrą</button>
                        </td>
                        </tr>";
            }
        }
    }
}
?>
    </table>
</div>

</body>
</html>

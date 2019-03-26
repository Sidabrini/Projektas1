<?php
/**
 * Created by PhpStorm.
 * User: vsida
 * Date: 3/18/2019
 * Time: 8:17 PM
 */
?>
<!doctype html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body>
    <div class "Events">
    <h2>Events</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Date and time</th>
            <th>Place</th>
            <th>Event number</th>
            <th>Event creator</th>
        </tr>
        <?php
        session_start();
        if($_SESSION['user'] != null){
            $conn = new mysqli("localhost", "root", "", "nd");
            $email = $_SESSION['user'];
            $sql = "SELECT * FROM event where Creator = '$email'";

            $result = $conn->query($sql);
            if($result -> num_rows > 0) {
                while($row = $result -> fetch_assoc()){
                    if($row["Creator"] === $_SESSION['user']){
                        $name = $row["Name"];
                        $date_time = $row["Date_and_time"];
                        $place = $row["Place"];
                        $number = $row["ID"];
                        $creator = $row["Creator"];
                        echo "<tr>
                                    <td>$name</td>
                                    <td>$date_time</td>
                                    <td>$place</td>
                                    <td>$number</td>
                                    <td>$creator</td>
                                    </tr>";
                    }
                }
            }
            else{
                echo "<div class\"alert\" id=\"error\">No event created</div>";
            }
            $conn -> close();
        }
        else{
            session_destroy();
            header('Location: index.php');
        }
        ?>
    </table>
    </div>
<h3>Create new Event</h3>
<form method="post" action="?">
    <input type="name" placeholder="Enter event name" name="name"/><br/>
    <input type="date" placeholder="Enter event date" name="date"/><br/>
    <input type="time" placeholder="Enter event time" name="time"/><br/>
    <input type="place" placeholder="Enter event place" name="place"/><br/>
    <input type="submit" value="Create" name="submit1"/>
</form>
    <?php
    if (isset($_POST["submit1"])){
        $name = $_POST["name"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $date_time = date("Y-m-d H:i:s", strtotime("$date $time"));
        $place = $_POST["place"];
        $conn = new mysqli("localhost","root","","nd");
        $sql = "INSERT INTO `event` (`Name`, `Date_and_time`, `Place`, `Creator`) 
                    VALUES ('$name', '$date_time', '$place', '$email')";
        $result = $conn->query($sql);
        $conn->close();
        header("Refresh:0");
    }
    ?>
    <form method="post" action="?">
    <br/>
    <input type="submit" value="Logout" name="logout"/>
</form>
<?php
if(isset($_POST["logout"])){
    session_destroy();
    header('Location: index.php');
}
?>
</form>
</body>
</html>

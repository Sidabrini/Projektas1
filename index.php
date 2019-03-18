<!doctype html>
<html>
<head>
    <link href = "styles.css" rel = "stylesheet" />
</head>
<body>
<div class="Events">
    <h2>User's created events</h2>
    <table>
        <tr>
            <th>Event name</th>
            <th>Date and time</th>
            <th>Place</th>
            <th>ID</th>
            <th>Event creator</th>
        </tr>
        <?php
        session_start();
        if($_SESSION['user'] != null){
            $conn = new mysqli("localhost","root","","DB");
            $email = $_SESSION['user'];
            $sql = "SELECT * FROM events where Creator = '$email'";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    if($row["Creator"] === $_SESSION['user']){
                        $name = $row["Name"];
                        $date_time = $row["Date_and_time"];
                        $place = $row["Place"];
                        $id = $row["id"];
                        $creator = $row["Creator"];
                        echo "<tr>
                            <td>$name</td>
                            <td>$date_time</td>
                            <td>$place</td>
                            <td>$id</td>
                            <td>$creator</td>
                            </tr>";
                    }
                }
            }
            else{
                echo "<div class=\"alert\" id=\"error\">No events created</div>";
            }
            $conn->close();
        }
        else{
            session_destroy();
            header('Location: index.php');
        }
        ?>
    </table>
</div>
<form method="post" action="?">
    <br/>
    <br/>

</form>

</body>
</html>
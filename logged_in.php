<!doctype html>
<html>
<head>
    <link href = "style.css" rel = "stylesheet" />
</head>
<body>
<div class="Events">
    <h2>Events</h2>
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
            $conn = new mysqli("localhost","root","","nd");
            $sql = "SELECT * FROM event";

            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    if($row["Creator"] === $_SESSION['user']){
                        $name = $row["Name"];
                        $date_time = $row["Date_and_time"];
                        $place = $row["Place"];
                        $id = $row["ID"];
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
            $conn->close();

        }
        ?>
    </table>
</div>
</body>
</html>

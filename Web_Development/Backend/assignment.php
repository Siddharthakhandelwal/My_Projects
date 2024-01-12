<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$Db="history";
$conn = new mysqli($servername, $username, $password,$Db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$table=$_SESSION["user_number"];
$sql = "SELECT * FROM `$table`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Sub</th><th>Photo</th><th>Descriptions</th><th>Money</th><th>Date of Submission</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Sub"] . "</td>";
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row["Photo"]) . "' alt='Image'></td>";
        echo "<td>" . $row["descriptions"] . "</td>";
        echo "<td>" . $row["moneys"] . "</td>";
        echo "<td>" . $row["Date of Submission"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nothing to show";
}
$conn->close();
?>

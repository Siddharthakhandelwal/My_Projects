<?php
$servername = "localhost";
$username = "root";
$password = "";
$Db = "data";
$conn = new mysqli($servername, $username, $password, $Db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$number = $_POST["number"];
$mail=$_POST["mail"];
$checkUserQuery = "SELECT * FROM data WHERE number = ? LIMIT 1";
$stmt = $conn->prepare($checkUserQuery);
$stmt->bind_param("s", $number);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $storedmail = $user["Mail"];
    $userpass=$user["Password"];
    if ($storedmail==$mail) {
        echo $userpass;
        exit();
    } else {
        echo "Invalid credentials. Please try again or register yourself.";
    }
} else {
    echo "Invalid credentials. Please try again or register yourself.";
}
$stmt->close();
$conn->close();
?>
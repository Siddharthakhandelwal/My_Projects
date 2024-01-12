<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$Db = "data";
$conn = new mysqli($servername, $username, $password, $Db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$number = $_POST["number"];
$enteredPassword = $_POST["password"];
$_SESSION["user_number"]=$number;
$checkUserQuery = "SELECT * FROM data WHERE number = ? LIMIT 1";
$stmt = $conn->prepare($checkUserQuery);
$stmt->bind_param("s", $number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $storedPassword = $user["Password"];
    if ($storedPassword==$enteredPassword) {
        header("Location:home.html");
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
</body>
</html>
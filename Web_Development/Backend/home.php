<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$Db = "history";
$conn = new mysqli($servername, $username, $password, $Db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sub = isset($_POST['sub']) ? $_POST['sub'] : '';
$number = isset($_SESSION["user_number"]) ? $_SESSION["user_number"] : '';
$photo = isset($_FILES['photo']['tmp_name']) ? file_get_contents($_FILES['photo']['tmp_name']) : null;
$dis = isset($_POST['Description']) ? $_POST['Description'] : '';
$money = isset($_POST['money']) ? $_POST['money'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$table=$_SESSION["user_number"];
if ($photo === null) {
    echo "Error: File upload failed or file not selected.";
    exit;
}

// table
$quero = "CREATE TABLE IF NOT EXISTS `$table` (
    `Sub` VARCHAR(100),
    `Photo` BLOB,
    `descriptions` VARCHAR(10000),
    `moneys` VARCHAR(1000),
    `Date of Submission` VARCHAR(100)
)";
$conn->query($quero);

// insert
$insertQuery = "INSERT INTO `$table` (`Sub`, `Photo`, `descriptions`, `moneys`, `Date of Submission`) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param("ssssb", $sub, $photo, $dis, $money, $date);

if ($stmt->execute()) {
    echo "Upload successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

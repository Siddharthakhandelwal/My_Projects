<?php
session_start();
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$userPassword = $_POST['password']; 
$_SESSION["user_number"]=$_POST['number'];


$servername = "localhost";
$username = "root";
$dbPassword = "";
$Db = "data";

$conn = new mysqli($servername, $username, $dbPassword, $Db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$checkUserQuery = "SELECT * FROM data WHERE Number='$number' LIMIT 1";
$result = $conn->query($checkUserQuery);

if ($result->num_rows > 0) {
    header("Location: index.html");
    echo"You are already registered";
    
} else {
    $sql = "INSERT INTO data (`Name`, `Number`, `Mail`, `Password`) VALUES ('$name', '$number', '$email', '$userPassword')";
    if ($conn->query($sql) === TRUE) {
      echo "Registration successful!", "<br>", "Please Login now";
      header("Location:home.html");
    } else {
      echo "Error <br> Please try again";}
}
$conn->close();
?>

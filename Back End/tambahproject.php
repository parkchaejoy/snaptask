<?php
session_start();
include 'configgabung.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_SESSION['username'];

    $stmt = $conn->prepare("INSERT INTO Projects (username, name) VALUES (?, ?)");
    $stmt->execute([$username, $name]);

    if ($stmt->rowCount()) {
        
        header("Location: homepage.php");
        exit;
    } else {
        header("Location: error.php");
    }
}
?>

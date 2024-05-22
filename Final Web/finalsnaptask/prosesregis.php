<?php
session_start(); 

include 'configgabung.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $stmt = $conn->prepare("INSERT INTO Users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);

    if ($stmt->rowCount()) {
        $_SESSION['username'] = $username;
        echo "Registrasi berhasil!";
        header("Location: homepage.php"); 
        exit;
    } else {
        header("Location: error.php");
    }
}
?>

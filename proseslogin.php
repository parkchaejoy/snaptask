<?php
session_start();

include 'configgabung.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Siapkan query
    $stmt = $conn->prepare("SELECT username, password FROM Users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        echo "Login berhasil!";
        header("Location: homepage.php");
        exit;
    } else {
        header("Location: error.php");
    }
}
?>

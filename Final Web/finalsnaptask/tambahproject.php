<?php
session_start();
include 'configgabung.php';

// Cek metode request dan keberadaan input 'name'
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    // Sanitasi input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

    // Cek jika input 'name' kosong atau tidak ada username dalam session
    if (empty($name) || !isset($_SESSION['username'])) {
        // Redirect ke error page jika form tidak lengkap atau tidak ada user session
        header("Location: error.php");
        exit;
    }

    $username = $_SESSION['username'];

    try {
        // Prepare dan bind parameter ke SQL statement untuk insert project baru
        $stmt = $conn->prepare("INSERT INTO Projects (username, name) VALUES (?, ?)");
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $name, PDO::PARAM_STR);
        $stmt->execute();

        // Cek jika project berhasil ditambahkan
        if ($stmt->rowCount() > 0) {
            // Redirect ke homepage jika penambahan project sukses
            header("Location: homepage.php");
            exit;
        } else {
            // Redirect ke error page jika penambahan project gagal
            header("Location: error.php");
            exit;
        }
    } catch (PDOException $e) {
        // Log error atau kirim ke software tracking error
        error_log("Failed to insert new project: " . $e->getMessage());
        // Redirect ke error page jika terjadi error terkait database
        header("Location: error.php");
        exit;
    }
} else {
    // Redirect ke error page jika metode request bukan POST atau nama project tidak diset
    header("Location: error.php");
    exit;
}
?>

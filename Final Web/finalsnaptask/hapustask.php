<?php
session_start();
include 'configgabung.php';

if (!isset($_SESSION['username'])) {
    header("Location: proseslogin.php");
    exit;
}

if (!isset($_POST['project_id']) || !isset($_POST['task_id'])) {
    header("Location: homepage.php");
    exit;
}

$project_id = $_POST['project_id'];
$task_id = $_POST['task_id'];

$stmt = $conn->prepare("DELETE FROM Tasks WHERE task_id = ? AND project_id = ?");
$stmt->execute([$task_id, $project_id]);

header("Location: projectdetail.php?project_id=$project_id");
exit;
?>

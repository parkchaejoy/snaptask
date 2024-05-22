<?php
session_start();
include 'configgabung.php';

if (!isset($_SESSION['username'])) {
    header("Location: proseslogin.php");
    exit;
}

if (!isset($_POST['task_id']) || !isset($_POST['project_id'])) {
    header("Location: error.php");
    exit;
}

$task_id = $_POST['task_id'];
$project_id = $_POST['project_id'];

$stmt = $conn->prepare("SELECT * FROM Tasks WHERE task_id = ? AND project_id = ?");
$stmt->execute([$task_id, $project_id]);
$task = $stmt->fetch();

if (!$task) {
    header("Location: projectdetail.php?project_id=$project_id");
    exit;
}

$stmt = $conn->prepare("UPDATE Tasks SET status = 'Done' WHERE task_id = ?");
$stmt->execute([$task_id]);

header("Location: projectdetail.php?project_id=$project_id");
exit;
?>

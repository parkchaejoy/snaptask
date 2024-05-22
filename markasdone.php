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
$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM Projects WHERE project_id = ? AND username = ?");
$stmt->execute([$project_id, $username]);
$project = $stmt->fetch();

if (!$project) {
    header("Location: error.php");
    exit;
}

$stmt = $conn->prepare("UPDATE Tasks SET status = 'Done', done_or_not = TRUE WHERE task_id = ? AND project_id = ?");
$stmt->execute([$task_id, $project_id]);

header("Location: projectdetail.php?project_id=" . $project_id);
exit;
?>
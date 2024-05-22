<?php
session_start();
include 'configgabung.php';

if (!isset($_SESSION['username'])) {
    header("Location: proseslogin.php");
    exit;
}

if (!isset($_POST['task_id'])) {
    header("Location: homepage.php");
    exit;
}

$task_id = $_POST['task_id'];

if (empty($_POST['title']) || empty($_POST['description']) || empty($_POST['due_date']) || empty($_POST['status'])) {
    header("Location: edittask.php?task_id=$task_id&error=empty_fields");
    exit;
}

$title = $_POST['title'];
$description = $_POST['description'];
$due_date = $_POST['due_date'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE Tasks SET title = ?, description = ?, due_date = ?, status = ? WHERE task_id = ?");
if (!$stmt) {
    header("Location: error.php");
    exit;
}

$result = $stmt->execute([$title, $description, $due_date, $status, $task_id]);
if (!$result) {
    header("Location: error.php");
    exit;
}

// Redirect to projectdetail.php with the appropriate project_id
header("Location: projectdetail.php?project_id=" . $_POST['project_id']);
exit;
?>

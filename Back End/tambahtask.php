<?php
include 'configgabung.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectId = $_POST['project_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $dueDate = $_POST['due_date'];
    $status = $_POST['status'];

    $currentDate = new DateTime();
    $dueDateObj = new DateTime($dueDate);
    $interval = $currentDate->diff($dueDateObj);
    $daysDifference = $interval->format('%R%a');

    if ($daysDifference == 0) {
        $dateCategory = "Today";
    } elseif ($daysDifference == 1) {
        $dateCategory = "Tomorrow";
    } else {
        $dateCategory = "Upcoming";
    }

    $stmt = $conn->prepare("INSERT INTO Tasks (project_id, title, description, due_date, date_categories, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$projectId, $title, $description, $dueDate, $dateCategory, $status]);

    header("Location: projectdetail.php?project_id=$projectId");
    exit();
} else {
    header("Location: error.php");
    exit();
}
?>
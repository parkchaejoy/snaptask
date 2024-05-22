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

$stmt = $conn->prepare("SELECT * FROM Tasks WHERE task_id = ?");
$stmt->execute([$task_id]);
$task = $stmt->fetch();

if (!$task) {
    header("Location: error.php");
    exit;
}

$title = $task['title'];
$description = $task['description'];
$due_date = $task['due_date'];
$status = $task['status'];
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>
    <?php
    $stmt = $conn->prepare("SELECT * FROM Tasks WHERE task_id = ?");
    $stmt->execute([$_POST['task_id']]);
    $task = $stmt->fetch();
    ?>
    <form action="prosesedittask.php" method="post">
        <input type="hidden" name="project_id" value="<?php echo $_POST['project_id']; ?>">
        <input type="hidden" name="task_id" value="<?php echo $_POST['task_id']; ?>">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $task['title']; ?>"><br> <!-- input nama task -->
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo $task['description']; ?></textarea><br> <!-- input deskripsi -->
        <label for="due_date">Due Date:</label><br>
        <input type="date" id="due_date" name="due_date" value="<?php echo $task['due_date']; ?>"><br> <!-- input deadline -->
        <label for="status">Status:</label><br>
        <select id="status" name="status"> <!-- input status, yang bawah pilihannya -->
            <option value="To-Do" <?php if ($task['status'] == 'To-Do') echo 'selected'; ?>>To-Do</option>
            <option value="On-Going" <?php if ($task['status'] == 'On-Going') echo 'selected'; ?>>On-Going</option>
            <option value="Testing" <?php if ($task['status'] == 'Testing') echo 'selected'; ?>>Testing</option>
            <option value="Done" <?php if ($task['status'] == 'Done') echo 'selected'; ?>>Done</option>
        </select><br>
        <input type="submit" value="Update Task"> <!-- tombol submit task -->
    </form>
</body>
</html>

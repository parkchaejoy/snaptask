<?php
session_start();
include 'configgabung.php';

if (!isset($_SESSION['username'])) {
    header("Location: proseslogin.php");
    exit;
}

if (!isset($_GET['project_id'])) {
    header("Location: homepage.php");
    exit;
}

$project_id = $_GET['project_id'];
$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM Projects WHERE project_id = ? AND username = ?");
$stmt->execute([$project_id, $username]);
$project = $stmt->fetch();

if (!$project) {
    header("Location: error.php");
    exit;
}

$stmt = $conn->prepare("SELECT task_id, title, due_date FROM Tasks WHERE project_id = ?");
$stmt->execute([$project_id]);
$tasks = $stmt->fetchAll();

$today_tasks = array();
$tomorrow_tasks = array();
$upcoming_tasks = array();

foreach ($tasks as $task) {
    $due_date = strtotime($task['due_date']);
    $today = strtotime(date('Y-m-d'));
    if ($due_date == $today) {
        $today_tasks[] = $task;
    } elseif ($due_date == strtotime('+1 day', $today)) {
        $tomorrow_tasks[] = $task;
    } else {
        $upcoming_tasks[] = $task;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Detail - <?php echo $project['name']; ?></title>
</head>
<body>
    <h1>Project Detail - <?php echo $project['name']; ?></h1>
    <h2>Today</h2>
    <ul>
        <?php foreach ($today_tasks as $task): ?>
            <li>
            <?php echo $task['title']; ?>
            <?php if (isset($task['due_date'])): ?>
            <?php endif; ?>
            <form action="edittask.php" method="post">
                <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                <input type="submit" value="Edit"> <!-- tombol edit buat kolom today -->
            </form>
            <form action="hapustask.php" method="post">
                <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                <input type="submit" value="Delete"> <!-- tombol delete buat kolom today -->
            </form>
            <form action="markasdone.php" method="post">
                <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                <input type="submit" value="Mark as Done"> <!-- tombol mark as done buat kolom today-->
            </form>
        </li>
        <?php endforeach; ?>
    </ul>
    <h2>Tomorrow</h2>
    <ul>
        <?php foreach ($tomorrow_tasks as $task): ?>
            <li>
            <?php echo $task['title']; ?>
            <?php if (isset($task['due_date'])): ?>
            <?php endif; ?>
            <form action="edittask.php" method="post">
                <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                <input type="submit" value="Edit"> <!-- tombol edit buat kolom tomorrow -->
            </form>
            <form action="hapustask.php" method="post">
                <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                <input type="submit" value="Delete"> <!-- tombol delete buat kolom tomorrow -->
            </form>
            <form action="markasdone.php" method="post">
                <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                <input type="submit" value="Mark as Done"> <!-- tombol mark as done buat kolom tomorrow -->
            </form>
        </li>
        <?php endforeach; ?>
    </ul>
    <h2>Upcoming</h2>
    <ul>
        <?php foreach ($upcoming_tasks as $task): ?>
            <li>
            <?php echo $task['title']; ?>
            <?php if (isset($task['due_date'])): ?>
            <?php endif; ?>
            <form action="edittask.php" method="post">
                <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                <input type="submit" value="Edit"> <!-- tombol edit buat kolom upcoming -->
            </form>
            <form action="hapustask.php" method="post">
                <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                <input type="submit" value="Delete"> <!-- tombol delete buat kolom upcoming -->
            </form>
            <form action="markasdone.php" method="post">
                <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                <input type="submit" value="Mark as Done"> <!-- tombol mark as done buat kolom upcoming -->
            </form>
        </li>
        <?php endforeach; ?>
    </ul>
    
    <form action="formtask.php" method="get">
        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
        <input type="submit" value="Add Task"> <!-- tombol tambahkan task -->
    </form>
    <br>
    <a href="homepage.php">Back to Homepage</a> <!-- tombol buat ke homepage -->
</body>
</html>

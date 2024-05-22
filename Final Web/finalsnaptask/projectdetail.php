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

$stmt = $conn->prepare("SELECT task_id, title, due_date, status FROM Tasks WHERE project_id = ?");
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
    <title><?php echo htmlspecialchars($project['name']); ?></title>
    <link rel="stylesheet" href="nicepage.css">
    <link rel="stylesheet" href="Project-Detail.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            background-image: url('images/6.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .section-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .task-column {
            width: 30%;
            background-color: rgba(76, 115, 151, 0.5); 
            padding: 20px;
            border-radius: 30px; 
            color: rgba(255, 255, 255, 0.8);
        }
        .task-list {
            list-style-type: none;
            padding: 0;
            color: rgba(255, 255, 255, 0.8);
        }
        .task-list li {
            margin-bottom: 10px;
        }
        .task-list .task-buttons {
            display: flex;
            justify-content: flex-start;
            gap: 5px;
            margin-top: 5px;
        }
        .task-list input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        .task-list input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .task-list input[type="submit"].delete {
            background-color: #f1b5b8;
        }
        .task-list input[type="submit"].delete:hover {
            background-color: #c82333;
        }
        .task-list input[type="submit"].done {
            background-color: #28a745;
        }
        .task-list input[type="submit"].done:hover {
            background-color: #218838;
        }
        form[action="formtask.php"] input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        form[action="formtask.php"] input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .home-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .home-button:hover {
            background-color: #0056b3;
        }
        .task-done {
            text-decoration: line-through;
            color: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <header class="u-clearfix u-header u-palette-1-dark-2 u-header">
        <div class="u-clearfix u-sheet u-sheet-1">
            <a href="homepage.php" class="u-image u-logo u-image-1" data-image-width="4000" data-image-height="2000">
                <img src="images/4.png" class="u-logo-image u-logo-image-1">
            </a>
            <nav class="u-menu u-menu-one-level u-offcanvas u-menu-1">
                <div class="menu-collapse" style="font-size: 1.25rem; letter-spacing: 0px;">
                    <a class="u-button-style u-nav-link" href="#">
                        <svg class="u-svg-link" viewBox="0 0 24 24"><use xlink:href="#menu-hamburger"></use></svg>
                        <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><g><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect></g></svg>
                    </a>
                </div>
                <div class="u-custom-menu u-nav-container">
                    <ul class="u-nav u-unstyled u-nav-1">
                        <li class="u-nav-item"><a class="u-nav-link" href="homepage.php">Home</a></li>
                        <li class="u-nav-item"><a class="u-nav-link" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div class="section-container">
        <div class="task-column">
            <h2>Today</h2>
            <ul class="task-list">
                <?php if (!empty($today_tasks)): ?>
                    <?php foreach ($today_tasks as $task): ?>
                        <li class="<?php echo $task['status'] === 'done' ? 'task-done' : ''; ?>">
                            - <?php echo htmlspecialchars($task['title']); ?>
                            <div class="task-buttons">
                                <form action="edittask.php" method="post">
                                    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                                    <input type="submit" value="✏️">
                                </form>
                                <form action="hapustask.php" method="post">
                                    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                                    <input type="submit" value="❌" class="delete">
                                </form>
                                <form action="markasdone.php" method="post">
                                    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                                    <input type="submit" value="Done" class="done">
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No tasks for today.</p>
                <?php endif; ?>
            </ul>
        </div>
        <div class="task-column">
            <h2>Tomorrow</h2>
            <ul class="task-list">
                <?php if (!empty($tomorrow_tasks)): ?>
                    <?php foreach ($tomorrow_tasks as $task): ?>
                        <li class="<?php echo $task['status'] === 'done' ? 'task-done' : ''; ?>">
                            - <?php echo htmlspecialchars($task['title']); ?>
                            <div class="task-buttons">
                                <form action="edittask.php" method="post">
                                    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                                    <input type="submit" value="✏️">
                                </form>
                                <form action="hapustask.php" method="post">
                                    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                                    <input type="submit" value="❌" class="delete">
                                </form>
                                <form action="markasdone.php" method="post">
                                    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                                    <input type="submit" value="Done" class="done">
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No tasks for tomorrow.</p>
                <?php endif; ?>
            </ul>
        </div>
        <div class="task-column">
            <h2>Upcoming</h2>
            <ul class="task-list">
                <?php if (!empty($upcoming_tasks)): ?>
                    <?php foreach ($upcoming_tasks as $task): ?>
                        <li class="<?php echo $task['status'] === 'done' ? 'task-done' : ''; ?>">
                            - <?php echo htmlspecialchars($task['title']); ?>
                            <div class="task-buttons">
                                <form action="edittask.php" method="post">
                                    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                                    <input type="submit" value="✏️">
                                </form>
                                <form action="hapustask.php" method="post">
                                    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                                    <input type="submit" value="❌" class="delete">
                                </form>
                                <form action="markasdone.php" method="post">
                                    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                                    <input type="submit" value="Done" class="done">
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No upcoming tasks.</p>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <form action="formtask.php" method="get">
        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
        <input type="submit" value="Add Task">
    </form>
    <br>
    <a href="homepage.php" class="home-button">Home</a>
</body>
</html>

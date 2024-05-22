<?php
session_start();
include 'configgabung.php';

if (!isset($_SESSION['username'])) {
    header("Location: proseslogin.php");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {

    if (isset($_GET['project_id'])) {
        $project_id = $_GET['project_id'];
        $username = $_SESSION['username'];

        $stmt = $conn->prepare("DELETE FROM Projects WHERE project_id = ? AND username = ?");
        $stmt->execute([$project_id, $username]);

        header("Location: homepage.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>   
    <h2>Your Projects:</h2>
    <ul>
        <?php
        $username = $_SESSION['username'];
        $stmt = $conn->prepare("SELECT project_id, name FROM Projects WHERE username = ?"); 
        $stmt->execute([$username]);
        $projects = $stmt->fetchAll(); 
        
        foreach ($projects as $project):
        ?>
        <li>
            <a href="projectdetail.php?project_id=<?php echo $project['project_id']; ?>"><?php echo $project['name']; ?></a> <!-- tombol yang masuk ke project detail, ini tombolnya tuh tulisan nama projectnya -->

            <a href="homepage.php?action=delete&project_id=<?php echo $project['project_id']; ?>">Delete</a> <!-- tombol delete project -->
        </li>
        <?php endforeach; ?>
    </ul>
    
    <form action="formproject.php" method="get">
        <input type="submit" value="Add Project"> <!-- tombol tambah project -->
    </form>
    
</body>
</html>

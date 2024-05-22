<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
</head>
<body>
    <h1>Add Task</h1>
    <form action="tambahtask.php" method="post">
        <label for="title">Task Title:</label><br>
        <input type="text" id="title" name="title" required><br><br> <!-- input nama task -->
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br> <!-- input deskripsi -->
        
        <label for="due_date">Due Date:</label><br>
        <input type="date" id="due_date" name="due_date" required><br><br> <!-- input tanggal deadline -->
        
        <label for="status">Status:</label><br>
        <select id="status" name="status"> <!-- input statusnya, yang dibawah ini pilihan statusnya -->
            <option value="To-Do">To-Do</option>
            <option value="On-Going">On-Going</option>
            <option value="Testing">Testing</option>
            <option value="Done">Done</option>
        </select><br><br>
        
        <input type="hidden" name="project_id" value="<?php echo $_GET['project_id']; ?>">
        
        <input type="submit" value="add Task"> <!-- tombol tambahkan task -->
    </form>
</body>
</html>

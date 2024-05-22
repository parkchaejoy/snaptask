<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SnapTask</title>
</head>
<body>
    <h1>Login</h1>
    <form action="proseslogin.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br> <!-- input username-->
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br> <!-- input password-->
        
        <input type="submit" value="Masuk"> <!-- tombol submit -->
    </form>
</body>
</html>

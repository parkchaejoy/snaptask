<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - SnapTask</title>
</head>
<body>
    <h1>Registrasi</h1>
    <form action="prosesregis.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br> <!-- input username-->
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br> <!-- input password-->
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br> <!-- input password-->
        
        <input type="submit" value="Daftar"> <!-- tombol submit -->
    </form>
</body>
</html>

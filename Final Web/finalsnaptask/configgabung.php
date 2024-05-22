<?php
$host = "localhost";       
$port = 5432;               
$dbname = "snaptask";      
$user = "postgres";         
$password = "NamikZ743";  

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>

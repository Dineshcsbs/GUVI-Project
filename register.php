<?php
require_once 'config.php';

 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username1'];
    $email = $_POST['email1'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // MySQL Insert
    $mysql_conn = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);

    if ($mysql_conn->connect_error) {
        die("MySQL Connection failed: " . $mysql_conn->connect_error);
    }

    $mysql_stmt = $mysql_conn->prepare("INSERT INTO users (email,username, password) VALUES (?,?, ?)");
    $mysql_stmt->bind_param("sss", $email,$username, $password);
    $mysql_stmt->execute();

    $mysql_stmt->close();
    $mysql_conn->close();
    
    echo 'Registration successful!';
    }   
 else {
    echo 'Invalid request';
}  
?>


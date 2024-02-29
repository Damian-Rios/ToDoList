<?php
    $dsn = 'mysql:host=localhost; port=4306; dbname=todolist';
    $username = 'root';
    // $password = '1qaz2WSX';

try {
    $db = new PDO($dsn, $username);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error = "Database Error: ";
    $error .= $e->getMessage();
    $error .= " (Error Code: " . $e->getCode() . ", SQLSTATE: " . $e->errorInfo[0] . ")";
    include('view/error.php');
    exit();
}
?>
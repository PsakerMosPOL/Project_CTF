<?php
$dsn = 'mysql:host=localhost;dbname=jest_ctf;charset=utf8';
$username = 'root';
$password = '';
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Ошибка подключения: ' . $e->getMessage());
}
?>
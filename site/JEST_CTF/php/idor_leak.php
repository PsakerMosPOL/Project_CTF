<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($user) {
    if ($user_id == 1) {
        echo json_encode([
            'username' => $user['username'],
            'email' => $user['email'],
            'flag' => 'JEST_IDOR_FLAG_2025'
        ]);
    } else {
        echo json_encode([
            'username' => $user['username'],
            'email' => $user['email']
        ]);
    }
} else {
    echo json_encode(['error' => 'Пользователь не найден']);
}
?>
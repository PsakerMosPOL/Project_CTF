<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    if ($email) {
        $user_id = $_SESSION['user_id'];
        $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
        $stmt->execute([$email, $user_id]);

        // Проверка на флаг
        if ($email === 'hacked@jest.ru') {
            echo '<p class="success">Успех! Флаг: JEST_CSRF_FLAG_2025</p>';
        } else {
            echo '<p class="success">Email обновлён!</p>';
        }
    } else {
        echo '<p class="error">Введите email.</p>';
    }
}
?>
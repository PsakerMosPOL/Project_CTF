<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flag = $_POST['flag'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("SELECT id, challenge FROM flags WHERE flag = ?");
    $stmt->execute([$flag]);
    $flag_data = $stmt->fetch();

    if ($flag_data) {
        $flag_id = $flag_data['id'];
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_flags WHERE user_id = ? AND flag_id = ?");
        $stmt->execute([$user_id, $flag_id]);
        if ($stmt->fetchColumn() == 0) {
            $stmt = $pdo->prepare("INSERT INTO user_flags (user_id, flag_id) VALUES (?, ?)");
            $stmt->execute([$user_id, $flag_id]);
            echo json_encode(['success' => true, 'message' => "Флаг верный! Задача: {$flag_data['challenge']}"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Этот флаг уже был введён.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Неверный флаг.']);
    }
}
?>
<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT f.flag, f.challenge, uf.submitted_at
                       FROM user_flags uf
                       JOIN flags f ON uf.flag_id = f.id
                       WHERE uf.user_id = ?");
$stmt->execute([$user_id]);
$flags = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет | JESTь</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>
        <h1>Личный кабинет</h1>
        <p>Добро пожаловать, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <a href="logout.php" class="logout-button">Выйти</a>
    </header>

    <div class="container">
        <h2>Ваш прогресс</h2>
        <ul class="progress-list">
            <?php foreach ($flags as $flag): ?>
                <li class="success"><?php echo htmlspecialchars($flag['challenge']); ?>: <?php echo htmlspecialchars($flag['flag']); ?> (<?php echo $flag['submitted_at']; ?>)</li>
            <?php endforeach; ?>
        </ul>
        <p>Найдено флагов: <?php echo count($flags); ?> из 6</p>

        <h2>Отправить флаг</h2>
        <input type="text" id="flag-input" placeholder="Введите флаг">
        <button onclick="submitFlag()">Проверить</button>
        <div class="output" id="output"></div>
    </div>

    <footer>
        <p>© 2025 JESTь. Создано Пановым Александром и Мустафиным Маратом.</p>
    </footer>

    <script src="../scripts.js"></script>
</body>
</html>
<?php
require 'auth.php';  // Проверка, авторизован ли пользователь
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Profile</title>
</head>
<body>
    <!-- Переключатель темы -->
    <div class="theme-toggle">
        <button id="theme-switch">
            <span class="icon-moon">🌙</span>
            <span class="icon-sun" style="display:none;">☀️</span>
        </button>
    </div>

    <div class="profile-container">
        <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Скрипт для переключения темы -->
    <script src="script.js"></script>
</body>
</html>

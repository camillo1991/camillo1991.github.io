<?php
session_start();
require 'database.php';

// Генерация CSRF токена
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['login'])) {
    if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header('Location: profile.php');
            exit;
        } else {
            echo "Invalid login details";
        }
    } else {
        echo "Invalid CSRF token";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <!-- Переключатель темы -->
    <div class="theme-toggle">
        <button id="theme-switch">
            <span class="icon-moon">🌙</span>
            <span class="icon-sun" style="display:none;">☀️</span>
        </button>
    </div>

    <div class="login-container">
        <h1>Hi, Welcome back.</h1>
        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>

    <!-- Скрипт для переключения темы -->
    <script src="script.js"></script>
</body>
</html>

<?php
require 'database.php';

// Генерация CSRF токена
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['register'])) {
    if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $invitation = $_POST['invitation'];

        if ($invitation === 'test') {
            $stmt = $db->prepare("INSERT INTO users (username, password, invitation) VALUES (:username, :password, :invitation)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':invitation', $invitation);

            if ($stmt->execute()) {
                $_SESSION['username'] = $username;
                header('Location: profile.php');
                exit;
            } else {
                echo "Error: Could not register";
            }
        } else {
            echo "Invalid invitation code";
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
    <title>Register</title>
</head>
<body>
    <!-- Переключатель темы -->
    <div class="theme-toggle">
        <button id="theme-switch">
            <span class="icon-moon">🌙</span>
            <span class="icon-sun" style="display:none;">☀️</span>
        </button>
    </div>

    <div class="register-container">
        <h1>Register</h1>
        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="invitation" placeholder="Invitation Code" required>
            <button type="submit" name="register">Register</button>
        </form>
    </div>

    <!-- Скрипт для переключения темы -->
    <script src="script.js"></script>
</body>
</html>

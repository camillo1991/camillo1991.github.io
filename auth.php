<?php
session_start();

// Если пользователь не авторизован, перенаправляем на страницу входа
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
?>

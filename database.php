<?php
// Подключение к базе данных SQLite
$db = new PDO('sqlite:database.db');

// Устанавливаем режим обработки ошибок
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Создаем таблицу пользователей, если она еще не существует
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    invitation TEXT
)";
$db->exec($sql);
?>

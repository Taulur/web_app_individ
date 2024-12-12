<?php
// logout.php - Выход из системы
session_start();

// Уничтожение всех данных сессии
session_unset();
session_destroy();

// Перенаправление на страницу входа
header('Location: index.php');
exit();
?>
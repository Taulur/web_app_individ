<?php
// add_art.php - Форма добавления картины
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Подключение к базе данных
    $conn = new mysqli('localhost', 'root', '', 'houses');
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }

    $desc = $_POST['desc'];
    $rentdays = $_POST['rentdays'];
    $metres = $_POST['metres'];

    $sql = "INSERT INTO allhouses (`desc`, rentdays, metres) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("ssi", $desc, $rentdays, $metres);

    if ($stmt->execute()) {
        echo "<p>Art added successfully!</p>";
    } else {
        echo "<p>Error adding art: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add house</title>
</head>
<body>
    <h1>Add new дом</h1>
    <form action="" method="POST">
        <label for="desc">Описание:</label>
        <input type="text" id="desc" name="desc" required><br>

        <label for="rentdays">Аренда:</label>
        <input type="number" id="rentdays" name="rentdays" required><br>

        <label for="metres">Площадь:</label>
        <input type="number" id="metres" name="metres" required><br>

        <button type="submit">Добавить дом</button>
    </form>
    <a href="admin.php">Вернуться к панели</a>
</body>
</html>

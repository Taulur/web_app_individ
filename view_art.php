<?php
// view_art.php - Просмотр картин
session_start();

if (!isset($_SESSION['user_role'])) {
    header('Location: index.php');
    exit();
}

// Подключение к базе данных
$conn = new mysqli('localhost', 'root', '', 'houses');
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$sql = "SELECT * FROM allhouses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>View Art</title>
</head>
<body>
    <h1>Список</h1>
    <table>
        <thead>
            <tr>
                <th>Описание</th>
                <th>Аренда</th>
                <th>Площадь</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['desc']); ?></td>
                    <td><?php echo htmlspecialchars($row['rentdays']); ?></td>
                    <td><?php echo htmlspecialchars($row['metres']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="<?php echo $_SESSION['user_role'] === 'admin' ? 'admin.php' : 'user.php'; ?>">ВернутЬся к панели</a>
</body>
</html>

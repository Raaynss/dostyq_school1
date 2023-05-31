<?php
header('Content-Type: text/html; charset=UTF-8');
// Подключение к базе данных
$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'td_user';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Извлечение товаров из базы данных
$sql = "SELECT * FROM book";
$result = $conn->query($sql);

$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Закрытие соединения с базой данных
$conn->close();

// Отправка данных в формате JSON
header('Content-Type: application/json');
echo json_encode($products);
?>

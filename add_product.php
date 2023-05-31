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

// Обработка данных формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Обработка загруженного изображения
    $image = $_FILES['image'];
    $imagePath = 'uploads/' . $image['name'];

    // Перемещение изображения в папку uploads
    move_uploaded_file($image['tmp_name'], $imagePath);

    // Вставка товара в базу данных
    $sql = "INSERT INTO book (product_name, price, quantity, image_path) VALUES ('$productName', $price, $quantity, '$imagePath')";
    if ($conn->query($sql) === TRUE) {
        echo "Кітап қосылды!";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

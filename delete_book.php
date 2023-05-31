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

// Обработка удаления или обновления данных
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_one'])) {
        // Удаление определенного значения из базы данных
        $field = $_POST['field'];
        $value = $_POST['value'];

        // Экранируем специальные символы
        $field = $conn->real_escape_string($field);
        $value = $conn->real_escape_string($value);

        $sql = "UPDATE book SET $field = NULL WHERE $field = '$value'";
        if ($conn->query($sql) === TRUE) {
            echo "Значение успешно удалено!";
        } else {
            echo "Ошибка при удалении значения: " . $conn->error;
        }
    } elseif (isset($_POST['delete_all'])) {
        // Удаление всех значений из базы данных
        $sql = "UPDATE book SET product_name = NULL, quantity = NULL, price = NULL";
        if ($conn->query($sql) === TRUE) {
            echo "Все значения успешно удалены!";
        } else {
            echo "Ошибка при удалении всех значений: " . $conn->error;
        }
    }
}

$conn->close();
?>

<?php
// Подключение к базе данных
$servername = "127.0.0.1";
$username = "root";
$dbpassword = "";
$dbname = "td_user";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

if ($conn->connect_error) {
  die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Обработка формы входа
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $password = $_POST["password"];

  // Проверка имени пользователя и пароля в базе данных
  $sql = "SELECT * FROM tb WHERE name = '$name' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    // Успешный вход
    session_start();
    $_SESSION["name"] = $username;
    header("Location: index1.html"); // Перенаправление на страницу после входа
    exit();
  }
  elseif ($name === 'админ' && $password === 'админ') {
    header("Location: administrator.html"); // Перенаправление на админскую страницу
    exit();
  } else {
    echo "Произошла ошибка при регистрации.";
  }
  } else {
    // Неверные учетные данные
    $error_message = "Неверное имя пользователя или пароль.";
  }

?>
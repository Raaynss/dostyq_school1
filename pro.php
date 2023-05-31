<?php
$name = $_POST['name'];
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = $_POST['password'];

$servername = "127.0.0.1";
$username = "root";
$dbpassword = "";
$dbname = "td_user";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

$sql = "INSERT INTO tb (name, full_name, email, password) VALUES ('$name', '$full_name', '$email', '$password')";

$result = $conn->query($sql);



if ($result) {
    header("Location: index1.html");
    exit;
} 

else {
    echo "Произошла ошибка при регистрации.";
}
?>

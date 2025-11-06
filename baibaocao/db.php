<?php
$servername = "localhost";
$username = "root";
$password = "123456"; // Để trống nếu bạn dùng XAMPP mặc định
$dbname = "qlsro";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Kết nối thất bại: " . $conn->connect_error);
}
?>

<?php
session_start();
include 'db.php'; // Đảm bảo tệp này đã được sửa (Bước 1)

$user = $_POST['username'];
$pass = $_POST['password']; // $pass bây giờ là "123"

// 1. Chuẩn bị câu lệnh (chống SQL Injection)
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $password_from_db = $row['password']; // $password_from_db bây giờ là "123"

  // 2. So sánh mật khẩu văn bản thường
  // Chúng ta so sánh "123" (từ form) với "123" (từ database)
  if ($pass === $password_from_db) {
    
    // ĐÚNG MẬT KHẨU!
    $_SESSION['user'] = $user;
    header("Location: showroom.php");
    exit();

  } else {
    // Sai mật khẩu
    echo "<script>alert('Sai tài khoản hoặc mật khẩu!'); window.location='index.php';</script>";
  }
} else {
  // Sai username
  echo "<script>alert('Sai tài khoản hoặc mật khẩu!'); window.location='index.php';</script>";
}
$stmt->close();
$conn->close();
?>
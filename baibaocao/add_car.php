<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit();
}
include 'db.php';

$message = ""; // Biến để lưu thông báo

// Kiểm tra nếu form đã được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Lấy thông tin cơ bản
  $name = $_POST['name'];
  $brand = $_POST['brand'];
  $price = $_POST['price'];

  // Xử lý upload file ảnh
  if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
    $target_dir = "images/"; // Thư mục bạn đã tạo
    
    // Tạo tên file duy nhất để tránh bị ghi đè
    $file_extension = strtolower(pathinfo($_FILES["image_file"]["name"], PATHINFO_EXTENSION));
    $new_image_name = uniqid('car_', true) . '.' . $file_extension;
    $target_file = $target_dir . $new_image_name;

    // Kiểm tra định dạng file
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($file_extension, $allowed_types)) {
      
      // Di chuyển file đã upload vào thư mục images/
      if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
        
        // File upload thành công, tiến hành lưu vào database
        $stmt = $conn->prepare("INSERT INTO cars (name, brand, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $name, $brand, $price, $new_image_name);

        if ($stmt->execute()) {
          header("Location: showroom.php"); // Chuyển hướng về trang showroom
          exit();
        } else {
          $message = "Lỗi khi lưu vào database: " . $stmt->error;
        }
        $stmt->close();
        
      } else {
        $message = "Lỗi khi tải file lên server.";
      }
    } else {
      $message = "Chỉ chấp nhận file ảnh JPG, JPEG, PNG & GIF.";
    }
  } else {
    $message = "Vui lòng chọn một file ảnh.";
  }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thêm xe mới</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  
  <!-- Menu (Copy từ showroom.php để đồng bộ) -->
  <div style="display: flex; justify-content: center; padding-top: 20px;">
    <div class="nav">
      <div class="container">
        <!-- Chuyển link Home thành Trang chủ và trỏ về showroom.php -->
        <a href="showroom.php" class="btn">Trang chủ</a> 
        <a href="add_car.php" class="btn">+ Thêm xe mới</a>
        <a href="#" class="btn">Hỗ trợ</a> <!-- Placeholder -->
        <a href="logout.php" class="btn">Đăng xuất</a>
        <svg
          class="outline"
          overflow="visible"
          width="400"
          height="60"
          viewBox="0 0 400 60"
          xmlns="http://www.w3.org/2000/svg"
        >
          <rect
            class="rect"
            pathLength="100"
            x="0"
            y="0"
            width="400"
            height="60"
            fill="transparent"
            stroke-width="5"
          ></rect>
        </svg>
      </div>
    </div>
  </div>
  <!-- Kết thúc Menu -->

  <div class="form-container">
    <h2>Thêm xe mới</h2>
    <?php if (!empty($message)) { echo "<p style='color: #ff8686; text-align: center;'>$message</p>"; } ?>
    
    <!-- Form PHẢI có enctype="multipart/form-data" để upload file -->
    <form method="POST" enctype="multipart/form-data">
      <label for="name">Tên xe:</label>
      <input type="text" id="name" name="name" placeholder="Tên xe (vd: Honda Civic)" required>
      
      <label for="brand">Hãng xe:</label>
      <input type="text" id="brand" name="brand" placeholder="Hãng xe (vd: Honda)" required>
      
      <label for="price">Giá xe:</label>
      <input type="number" id="price" name="price" placeholder="Giá (VNĐ)" required>
      
      <label for="image_file">Chọn ảnh xe:</label>
      <!-- Thay đổi từ type="text" thành type="file" -->
      <input type="file" id="image_file" name="image_file" required>
      
      <button type="submit">Lưu xe</button>
    </form>
  </div>
</body>
</html>
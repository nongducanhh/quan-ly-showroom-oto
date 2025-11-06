<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit();
}
include 'db.php';

$message = "";
$id = $_GET['id'];

// Xử lý khi submit form (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $name = $_POST['name'];
  $brand = $_POST['brand'];
  $price = $_POST['price'];
  $current_image = $_POST['current_image']; // Lấy tên ảnh cũ
  
  $new_image_name = $current_image; // Mặc định là giữ ảnh cũ

  // Kiểm tra xem có file ảnh MỚI được upload không
  if (isset($_FILES['image_file']) && !empty($_FILES['image_file']['name']) && $_FILES['image_file']['error'] == 0) {
    
    $target_dir = "images/";
    $file_extension = strtolower(pathinfo($_FILES["image_file"]["name"], PATHINFO_EXTENSION));
    $new_image_name = uniqid('car_', true) . '.' . $file_extension;
    $target_file = $target_dir . $new_image_name;
    
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($file_extension, $allowed_types)) {
      
      if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
        // Upload ảnh mới thành công
        // (Tùy chọn) Xóa ảnh cũ để tiết kiệm dung lượng
        if (!empty($current_image) && file_exists($target_dir . $current_image)) {
          unlink($target_dir . $current_image);
        }
      } else {
        $message = "Lỗi khi tải file mới lên server.";
        $new_image_name = $current_image; // Vẫn dùng ảnh cũ nếu upload lỗi
      }
    } else {
      $message = "File ảnh mới không hợp lệ. Chỉ chấp nhận JPG, JPEG, PNG, GIF.";
      $new_image_name = $current_image; // Vẫn dùng ảnh cũ nếu file không hợp lệ
    }
  }
  
  // Cập nhật database với thông tin mới
  if (empty($message)) { // Chỉ cập nhật nếu không có lỗi upload
    $stmt = $conn->prepare("UPDATE cars SET name = ?, brand = ?, price = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $name, $brand, $price, $new_image_name, $id);
    
    if ($stmt->execute()) {
      header("Location: showroom.php"); // Chuyển hướng về trang chủ
      exit();
    } else {
      $message = "Lỗi khi cập nhật database: " . $stmt->error;
    }
    $stmt->close();
  }
}

// Lấy thông tin xe hiện tại để hiển thị (GET)
$stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  $car = $result->fetch_assoc();
} else {
  die("Không tìm thấy xe này.");
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Sửa thông tin xe</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Menu (Copy từ showroom.php để đồng bộ) -->
  <div style="display: flex; justify-content: center; padding-top: 20px;">
    <div class="nav">
      <div class="container">
        <a href="showroom.php" class="btn">Trang chủ</a>
        <a href="add_car.php" class="btn">+ Thêm xe mới</a>
        <a href="#" class="btn">Hỗ trợ</a>
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
    <h2>Sửa thông tin xe</h2>
    <?php if (!empty($message)) { echo "<p style='color: #ff8686; text-align: center;'>$message</p>"; } ?>
    
    <form method="POST" enctype="multipart/form-data">
      <label for="name">Tên xe:</label>
      <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($car['name']); ?>" required>
      
      <label for="brand">Hãng xe:</label>
      <input type="text" id="brand" name="brand" value="<?php echo htmlspecialchars($car['brand']); ?>" required>
      
      <label for="price">Giá xe:</label>
      <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($car['price']); ?>" required>
      
      <label>Ảnh hiện tại:</label>
      <div style="margin: 10px 0;">
        <img src="images/<?php echo htmlspecialchars($car['image']); ?>" alt="Ảnh xe" style="width: 100%; max-width: 300px; border-radius: 8px;">
      </div>
      
      <!-- Input ẩn để lưu tên ảnh CŨ -->
      <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($car['image']); ?>">
      
      <label for="image_file">Thay đổi ảnh (để trống nếu không muốn đổi):</label>
      <input type="file" id="image_file" name="image_file">
      
      <button type="submit">Cập nhật</button>
    </form>
  </div>
</body>
</html>
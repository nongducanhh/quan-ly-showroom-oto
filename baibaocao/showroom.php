<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit();
}
include 'db.php';

// Thực thi câu truy vấn
$cars = $conn->query("SELECT * FROM cars");

// Kiểm tra xem truy vấn có thành công không
if ($cars === false) {
  // Ghi lại lỗi chi tiết (cho lập trình viên)
  error_log("SQL Error: " . $conn->error);
  // Đặt $cars thành một mảng rỗng để vòng lặp while không bị lỗi
  $cars_data = [];
  $num_rows = 0;
  $query_error = true;
} else {
  // Truy vấn thành công
  $cars_data = $cars;
  $num_rows = $cars->num_rows;
  $query_error = false;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Showroom Ô tô - Quản lý</title>
  <link rel="stylesheet" href="style.css">
  <!-- Import font Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
  
  <!-- Navbar mới (Kiểu Audi y như ảnh) -->
  <nav class="audi-nav">
    <!-- Cột 1: Logo SVG -->
    <div class="nav-logo-svg">
      <svg width="60" height="20" viewBox="0 0 114 34" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M11.954 33.5C5.352 33.5 0 28.148 0 21.546V11.954C0 5.352 5.352 0 11.954 0C18.556 0 23.908 5.352 23.908 11.954V21.546C23.908 28.148 18.556 33.5 11.954 33.5ZM11.954 27.67C15.355 27.67 18.078 24.947 18.078 21.546V11.954C18.078 8.553 15.355 5.83 11.954 5.83C8.553 5.83 5.83 8.553 5.83 11.954V21.546C5.83 24.947 8.553 27.67 11.954 27.67Z" fill="white"/>
        <path d="M44.972 33.5C38.37 33.5 33.018 28.148 33.018 21.546V11.954C33.018 5.352 38.37 0 44.972 0C51.574 0 56.926 5.352 56.926 11.954V21.546C56.926 28.148 51.574 33.5 44.972 33.5ZM44.972 27.67C48.373 27.67 51.096 24.947 51.096 21.546V11.954C51.096 8.553 48.373 5.83 44.972 5.83C41.571 5.83 38.848 8.553 38.848 11.954V21.546C38.848 24.947 41.571 27.67 44.972 27.67Z" fill="white"/>
        <path d="M78.008 33.5C71.406 33.5 66.054 28.148 66.054 21.546V11.954C66.054 5.352 71.406 0 78.008 0C84.61 0 89.962 5.352 89.962 11.954V21.546C89.962 28.148 84.61 33.5 78.008 33.5ZM78.008 27.67C81.409 27.67 84.132 24.947 84.132 21.546V11.954C84.132 8.553 81.409 5.83 78.008 5.83C74.607 5.83 71.884 8.553 71.884 11.954V21.546C71.884 24.947 74.607 27.67 78.008 27.67Z" fill="white"/>
        <path d="M111.028 33.5C104.426 33.5 99.074 28.148 99.074 21.546V11.954C99.074 5.352 104.426 0 111.028 0C117.63 0 122.982 5.352 122.982 11.954V21.546C122.982 28.148 117.63 33.5 111.028 33.5ZM111.028 27.67C114.429 27.67 117.152 24.947 117.152 21.546V11.954C117.152 8.553 114.429 5.83 111.028 5.83C107.627 5.83 104.904 8.553 104.904 11.954V21.546C104.904 24.947 107.627 27.67 111.028 27.67Z" fill="white"/>
      </svg>
    </div>

    <!-- Cột 2: Links (Căn giữa) -->
    <div class="nav-links-center">
      <a href="showroom.php">Tất cả các model</a>
      <a href="#">Dịch vụ Hậu mãi</a>
      <a href="#">Tin tức & Sự kiện</a>
      <!-- Link Admin của bạn -->
      <a href="add_car.php" class="admin-link">+ Thêm xe</a>
      <a href="logout.php">Đăng xuất</a>
    </div>

    <!-- Cột 3: Icon Tìm kiếm SVG -->
    <div class="nav-search-svg">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
  </nav>
  
  <!-- Banner Ảnh Lớn Toàn Màn Hình -->
  <div class="hero-banner">
    <h1>SHOWROOM Ô TÔ</h1>
    <p>Khám phá bộ sưu tập xe cao cấp của chúng tôi.</p>
  </div>
  
  <!-- Nội dung chính -->
  <main class="main-content">
    
    <!-- Tiêu đề "Danh sách xe" -->
    <div class="center-container">
      <h2 class="list-header">Danh sách xe hiện có</h2>
    </div>

    <!-- Lưới danh sách xe -->
    <div class="car-list">
      <?php 
      // Kiểm tra nếu có lỗi SQL (như bảng 'cars' không tồn tại)
      if ($query_error) { 
      ?>
        <p class="no-cars" style="color: #ff8686;">
          <strong>Lỗi Database:</strong> Không thể tải danh sách xe. (Có thể bảng 'cars' không tồn tại).
        </p>
      <?php 
      // Kiểm tra nếu truy vấn thành công nhưng không có xe nào
      } else if ($num_rows > 0) { 
        while ($row = $cars_data->fetch_assoc()) { 
      ?>
        <div class="car-card">
          <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
          <div class="car-info">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p><strong>Hãng:</strong> <?php echo htmlspecialchars($row['brand']); ?></p>
            <p><strong>Giá:</strong> <?php echo number_format($row['price']); ?> VNĐ</p>
          </div>
          <!-- Các nút Sửa/Xóa được làm tinh tế hơn -->
          <div class="actions">
            <a href="edit_car.php?id=<?php echo $row['id']; ?>" class="edit-btn">Sửa</a>
            <a href="delete_car.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa xe này?')">Xóa</a>
          </div>
        </div>
      <?php 
        } // Kết thúc vòng lặp while
      } else { 
      ?>
        <!-- Hiển thị khi không có xe nào trong database -->
        <p class="no-cars">Chưa có xe nào trong showroom. Bạn hãy nhấn "+ Thêm xe".</p>
      <?php 
      } // Kết thúc else
      $conn->close(); // Đóng kết nối
      ?>
    </div> <!-- Kết thúc .car-list -->
    
  </main> <!-- Kết thúc .main-content -->
  
</body>
</html>
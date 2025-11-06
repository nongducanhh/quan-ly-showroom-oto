<?php
include 'db.php';
$id = $_GET['id'];

// Kiểm tra xem id có phải là số không
if (filter_var($id, FILTER_VALIDATE_INT)) {
    // Sử dụng prepared statements
    $stmt = $conn->prepare("DELETE FROM cars WHERE id=?");
    if ($stmt === false) {
        die("Lỗi chuẩn bị câu lệnh: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID không hợp lệ.";
}

$conn->close();
header("Location: showroom.php");
exit();
?>
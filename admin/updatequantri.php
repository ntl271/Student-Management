<?php
// Nhận dữ liệu từ form
$id = $_POST['id'];
$email = $_POST['email'];
$password = $_POST['password'];

// Kết nối CSDL
require_once '../config/dbcon.php';

// Viết lệnh SQL sử dụng Prepared Statement
$updatesql = "UPDATE users SET email=?, password=? WHERE id=?";

// Chuẩn bị câu lệnh
$stmt = mysqli_prepare($conn, $updatesql);

// Kiểm tra xem câu lệnh đã được chuẩn bị thành công chưa
if ($stmt) {
    // Bind các tham số vào câu lệnh
    mysqli_stmt_bind_param($stmt, "ssi", $email, $password, $id);

    // Thực thi câu lệnh
    if (mysqli_stmt_execute($stmt)) {
        // Chuyển về trang quản trị
        header("Location: quantri.php");
        exit;
    } else {
        // In thông báo lỗi nếu có
        echo "Lỗi: " . mysqli_error($conn);
    }

    // Đóng câu lệnh
    mysqli_stmt_close($stmt);
} else {
    // In thông báo lỗi nếu có
    echo "Lỗi: " . mysqli_error($conn);
}

// Đóng kết nối CSDL
mysqli_close($conn);
?>

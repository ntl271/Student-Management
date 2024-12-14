<?php
// Kiểm tra xem smagv đã được truyền hay chưa
if (isset($_GET['smagv'])) {
    // Lấy dữ liệu id cần xóa
    $smagv = $_GET['smagv'];

    // Ket noi
    require_once '../config/dbcon.php';

    // Sử dụng Prepared Statement để tránh SQL injection
    $xoa_sql = "DELETE FROM giaovien WHERE magv = ?";
    $stmt = $conn->prepare($xoa_sql);
    $stmt->bind_param("s", $smagv);

    // Thực hiện truy vấn
    $stmt->execute();

    // Đóng Prepared Statement
    $stmt->close();

    // Đóng kết nối
    $conn->close();

    // Chuyển hướng về trang liệt kê
    header("Location: giaovien.php");
} else {
    // Nếu smagv không tồn tại, thông báo lỗi
    echo "ID không hợp lệ";
}
?>

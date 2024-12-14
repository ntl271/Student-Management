<?php
// Kiểm tra xem sid đã được truyền hay chưa
if (isset($_GET['sid'])) {
    // Lấy dữ liệu id cần xóa
    $sid = $_GET['sid'];

    // Ket noi
    require_once '../config/dbcon.php';

    // Sử dụng Prepared Statement để tránh SQL injection
    $xoa_sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($xoa_sql);
    $stmt->bind_param("s", $sid);

    // Thực hiện truy vấn
    $stmt->execute();

    // Đóng Prepared Statement
    $stmt->close();

    // Đóng kết nối
    $conn->close();

    // Chuyển hướng về trang liệt kê
    header("Location: quantri.php");
} else {
    // Nếu sid không tồn tại, thông báo lỗi
    echo "ID không hợp lệ";
}
?>

<?php
// Kiểm tra xem smamh đã được truyền hay chưa
if (isset($_GET['smamh'])) {
    // Lấy dữ liệu id cần xóa
    $smamh = $_GET['smamh'];

    // Ket noi
    require_once '../config/dbcon.php';

    // Sử dụng Prepared Statement để tránh SQL injection
    $xoa_sql = "DELETE FROM monhoc WHERE mamh = ?";
    $stmt = $conn->prepare($xoa_sql);
    $stmt->bind_param("s", $smamh);

    // Thực hiện truy vấn
    $stmt->execute();

    // Đóng Prepared Statement
    $stmt->close();

    // Đóng kết nối
    $conn->close();

    // Chuyển hướng về trang liệt kê
    header("Location: monhoc.php");
} else {
    // Nếu smamh không tồn tại, thông báo lỗi
    echo "ID không hợp lệ";
}
?>

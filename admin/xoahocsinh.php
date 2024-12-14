<?php
// Kiểm tra xem smahs đã được truyền hay chưa
if (isset($_GET['smahs'])) {
    // Lấy dữ liệu id cần xóa
    $smahs = $_GET['smahs'];

    // Ket noi
    require_once '../config/dbcon.php';

    // Sử dụng Prepared Statement để tránh SQL injection
    $xoa_sql = "DELETE FROM hocsinh WHERE mahs = ?";
    $stmt = $conn->prepare($xoa_sql);
    $stmt->bind_param("s", $smahs);

    // Thực hiện truy vấn
    $stmt->execute();

    // Đóng Prepared Statement
    $stmt->close();

    // Đóng kết nối
    $conn->close();

    // Chuyển hướng về trang liệt kê
    header("Location: hocsinh.php");
} else {
    // Nếu smahs không tồn tại, thông báo lỗi
    echo "ID không hợp lệ";
}
?>

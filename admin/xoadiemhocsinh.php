<?php
// Lấy dữ liệu id cần xóa
$smahs = isset($_GET['smahs']) ? $_GET['smahs'] : '';

// Kiểm tra xem smahs có được thiết lập không
if(empty($smahs)) {
    echo "Vui lòng chọn một học sinh để xóa.";
    exit;
}

// Kết nối đến cơ sở dữ liệu
require_once '../config/dbcon.php';

// Bảo vệ khỏi SQL injection
$smahs = mysqli_real_escape_string($conn, $smahs);

// Câu lệnh SQL cần thực hiện
$xoa_sql = "DELETE FROM diemthi WHERE mahs = '$smahs'";

// Thực hiện câu lệnh SQL
mysqli_query($conn, $xoa_sql);

// Kiểm tra và xử lý lỗi
if (mysqli_error($conn)) {
    echo "Lỗi xóa dữ liệu: " . mysqli_error($conn);
} else {
    // Chuyển hướng sau khi xóa thành công
    header("Location: diemthi.php");
}

// Đóng kết nối
mysqli_close($conn);
?>

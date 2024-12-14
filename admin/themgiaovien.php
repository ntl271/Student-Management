<?php
// Nhận dữ liệu từ form
$magv = $_POST['magv'];
$hoten = $_POST['hoten'];
$ngaysinh = $_POST['ngaysinh'];
$monday = $_POST['monday'];
$email = $_POST['email'];
$sdt = $_POST['sdt'];

// Kết nối CSDL
require_once '../config/dbcon.php';

// Biến để kiểm tra lỗi
$errors = [];

// Kiểm tra xem mã giáo viên đã tồn tại trong cơ sở dữ liệu hay chưa
$kiemtra_sql = "SELECT magv FROM giaovien WHERE magv = '$magv'";
$kiemtra_result = mysqli_query($conn, $kiemtra_sql);
if (mysqli_num_rows($kiemtra_result) > 0) {
    $errors[] = "Lỗi: Mã giáo viên đã tồn tại trong cơ sở dữ liệu!";
}

// Kiểm tra và thêm lỗi vào mảng $errors
if (!preg_match("/^[a-zA-ZÀ-Ỹà-ỹ ]+$/u", $hoten)) {
    $errors[] = "Lỗi: Họ tên chỉ được chứa chữ cái và dấu cách!";
}
// Kiểm tra định dạng ngày sinh là "DD/MM/YYYY"
if (!preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(19|20)\d{2}$/", $ngaysinh)) {
    $errors[] = "Lỗi: Ngày sinh không đúng định dạng (DD/MM/YYYY)!";
}
if (!preg_match("/^[0-9]{10,13}$/", $sdt)) {
    $errors[] = "Lỗi: Số điện thoại phải có từ 10 đến 13 chữ số!";
}

// Nếu không có lỗi, thực thi câu lệnh SQL và điều hướng người dùng
if (empty($errors)) {
    // Viết câu lệnh SQL để thêm dữ liệu
    $themsql = "INSERT INTO giaovien (magv, hoten, ngaysinh, monday, email, sdt) VALUES ('$magv', '$hoten', '$ngaysinh', '$monday', '$email', '$sdt')";

    // Thực thi câu lệnh và kiểm tra lỗi
    if (mysqli_query($conn, $themsql)) {
        // In thông báo thành công
        // Trở về trang liệt kê
        header("Location: giaovien.php");
        exit; // Đảm bảo không có mã HTML khác được xuất ra
    } else {
        echo "Lỗi: " . mysqli_error($conn); // In lỗi SQL nếu có
    }
} else {
    // Nếu có lỗi, hiển thị thông báo lỗi
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}

?>

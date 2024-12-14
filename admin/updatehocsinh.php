<?php
// Function to update student information
function updateStudentInfo($conn, $mahs, $hovaten, $ngaysinh, $malop, $diachi, $sdt, $gvcn, &$errors) {
    // Kiểm tra và thêm lỗi vào mảng $errors
    if (!preg_match("/^[a-zA-ZÀ-Ỹà-ỹ ]+$/u", $hovaten)) {
        $errors[] = "Lỗi: Họ tên chỉ được chứa chữ cái và dấu cách!";
    }
    // Kiểm tra định dạng ngày sinh là "DD/MM/YYYY"
    if (!preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(19|20)\d{2}$/", $ngaysinh)) {
        $errors[] = "Lỗi: Ngày sinh không đúng định dạng (DD/MM/YYYY)!";
    }
    if (!preg_match("/^[0-9]{10,13}$/", $sdt)) {
        $errors[] = "Lỗi: Số điện thoại phải có từ 10 đến 13 chữ số!";
    }

    // Nếu có lỗi, không thực hiện cập nhật và kết thúc hàm
    if (!empty($errors)) {
        return;
    }

    // Prepare the SQL statement for update
    $updatesql = "UPDATE hocsinh SET 
        hovaten='$hovaten', ngaysinh='$ngaysinh', malop='$malop', diachi='$diachi', sdt='$sdt', gvcn='$gvcn'
        WHERE mahs='$mahs'";

    // Execute the update query and handle errors
    if (mysqli_query($conn, $updatesql)) {
        // Success: Redirect to the list page
        header("Location: hocsinh.php");
        exit;
    } else {
        // Failure: Display error message
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receive data from the form
    $mahs = $_POST['mahs'];
    $hovaten = $_POST['hovaten'];
    $ngaysinh = $_POST['ngaysinh'];
    $malop = $_POST['malop'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];
    $gvcn = $_POST['gvcn'];

    // Include database connection
    require_once '../config/dbcon.php';

    // Biến để kiểm tra lỗi
    $errors = [];

    // Call the updateStudentInfo function
    updateStudentInfo($conn, $mahs, $hovaten, $ngaysinh, $malop, $diachi, $sdt, $gvcn, $errors);

    // Nếu có lỗi, hiển thị thông báo lỗi
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

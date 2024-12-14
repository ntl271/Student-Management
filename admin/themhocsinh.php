<?php
// Function to add student information to the database
function addStudentToDatabase($conn, $mahs, $hovaten, $ngaysinh, $malop, $diachi, $sdt, $gvcn, &$errors) {
    // Kiểm tra xem mã học sinh đã tồn tại trong cơ sở dữ liệu hay chưa
    $kiemtra_sql = "SELECT mahs FROM hocsinh WHERE mahs = '$mahs'";
    $kiemtra_result = mysqli_query($conn, $kiemtra_sql);
    if (mysqli_num_rows($kiemtra_result) > 0) {
        $errors[] = "Lỗi: Mã học sinh đã tồn tại trong cơ sở dữ liệu!";
        return; // Kết thúc hàm nếu có lỗi
    }

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

    // Nếu có lỗi, không thực hiện thêm dữ liệu và kết thúc hàm
    if (!empty($errors)) {
        return;
    }

    // Build the SQL query to insert data
    $themsql = "INSERT INTO hocsinh (mahs, hovaten, ngaysinh, malop, diachi, sdt, gvcn) 
                VALUES ('$mahs', '$hovaten', '$ngaysinh', '$malop', '$diachi', '$sdt', '$gvcn')";
    
    // Execute the SQL query
    if (mysqli_query($conn, $themsql)) {
        // If successful, redirect to the page listing the students
        header("Location: hocsinh.php");
    } else {
        // If there's an error, display an error message
        echo "Error: " . $themsql . "<br>" . mysqli_error($conn);
    }
}


// Check if the form has been submitted
if ($_SERVER && isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $mahs = $_POST['mahs'];
    $hovaten = $_POST['hovaten'];
    $ngaysinh = $_POST['ngaysinh'];
    $malop = $_POST['malop'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];
    $gvcn = $_POST['gvcn'];

    // Include the database connection file
    require_once '../config/dbcon.php';

    // Biến để kiểm tra lỗi
    $errors = [];

    // Call the function to add student information to the database
    addStudentToDatabase($conn, $mahs, $hovaten, $ngaysinh, $malop, $diachi, $sdt, $gvcn, $errors);

    // Nếu có lỗi, hiển thị thông báo lỗi
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If the form hasn't been submitted, display an error message
    echo '<p class="alert alert-danger">Invalid request method.</p>';
}
?>

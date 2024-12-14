<?php
// Function to add exam scores to the database
function addExamScoresToDatabase($conn, $mahs, $hoten, $ngaysinh, $malop, $kihoc, $namhoc, $toan, $van, $anh, $lichsu, $diali, $vatli, $hoahoc, $sinhhoc, $tinhoc, $congnghe, $gdcd, $theduc, &$errors) {
    // Kiểm tra và thêm lỗi vào mảng $errors
    if (!preg_match("/^[a-zA-ZÀ-Ỹà-ỹ ]+$/u", $hoten)) {
        $errors[] = "Lỗi: Họ tên chỉ được chứa chữ cái và dấu cách!";
    }
    // Kiểm tra định dạng ngày sinh là "DD/MM/YYYY"
    if (!preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(19|20)\d{2}$/", $ngaysinh)) {
        $errors[] = "Lỗi: Ngày sinh không đúng định dạng (DD/MM/YYYY)!";
    }

    // Nếu có lỗi, không thực hiện thêm dữ liệu và kết thúc hàm
    if (!empty($errors)) {
        return;
    }

    // Build the SQL query to insert data
    $themsql = "INSERT INTO diemthi (mahs, hoten, ngaysinh, malop, kihoc, namhoc, toan, van, anh, lichsu, diali, vatli, hoahoc, sinhhoc, tinhoc, congnghe, gdcd, theduc) 
                VALUES ('$mahs', '$hoten', '$ngaysinh', '$malop', '$kihoc', '$namhoc', '$toan', '$van', '$anh', '$lichsu', '$diali', '$vatli', '$hoahoc', '$sinhhoc', '$tinhoc', '$congnghe', '$gdcd', '$theduc')";
    
    // Execute the SQL query
    if (mysqli_query($conn, $themsql)) {
        // If successful, redirect to the page listing the exam scores
        header("Location: diemthi.php");
    } else {
        // If there's an error, display an error message
        echo "Error: " . $themsql . "<br>" . mysqli_error($conn);
    }
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $mahs = $_POST['mahs'];
    $hoten = $_POST['hoten'];
    $ngaysinh = $_POST['ngaysinh'];
    $malop = $_POST['malop'];
    $kihoc = $_POST['kihoc'];
    $namhoc = $_POST['namhoc'];
    $toan = $_POST['toan'];
    $van = $_POST['van'];
    $anh = $_POST['anh'];
    $lichsu = $_POST['lichsu'];
    $diali = $_POST['diali'];
    $vatli = $_POST['vatli'];
    $hoahoc = $_POST['hoahoc'];
    $sinhhoc = $_POST['sinhhoc'];
    $tinhoc = $_POST['tinhoc'];
    $congnghe = $_POST['congnghe'];
    $gdcd = $_POST['gdcd'];
    $theduc = $_POST['theduc'];

    // Include the database connection file
    require_once '../config/dbcon.php';

    // Biến để kiểm tra lỗi
    $errors = [];

    // Call the function to add exam scores to the database
    addExamScoresToDatabase($conn, $mahs, $hoten, $ngaysinh, $malop, $kihoc, $namhoc, $toan, $van, $anh, $lichsu, $diali, $vatli, $hoahoc, $sinhhoc, $tinhoc, $congnghe, $gdcd, $theduc, $errors);

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

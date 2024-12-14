<?php
// Function to add subject information to the database
function addSubjectToDatabase($conn, $mamh, $tenmonhoc, $sotiet, $hinhthucthi, &$errors) {
    // Kiểm tra xem mã môn học đã tồn tại trong cơ sở dữ liệu hay chưa
    $kiemtra_sql = "SELECT mamh FROM monhoc WHERE mamh = ?";
    $stmt = mysqli_prepare($conn, $kiemtra_sql);
    mysqli_stmt_bind_param($stmt, "s", $mamh);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        $errors[] = "Lỗi: Mã môn học đã tồn tại trong cơ sở dữ liệu!";
        mysqli_stmt_close($stmt);
        return; // Kết thúc hàm nếu có lỗi
    }
    mysqli_stmt_close($stmt);

    // Kiểm tra và thêm lỗi vào mảng $errors
    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $tenmonhoc)) {
        $errors[] = "Lỗi: Tên môn học chỉ được chứa chữ cái, số và dấu cách!";
    }
    if (!is_numeric($sotiet) || $sotiet < 1 || $sotiet > 150) {
        $errors[] = "Lỗi: Số tiết phải là một số nguyên dương không lớn hơn 150!";
    }

    // Nếu có lỗi, không thực hiện thêm dữ liệu và kết thúc hàm
    if (!empty($errors)) {
        return;
    }

    // Prepare the SQL statement with a prepared statement
    $themsql = "INSERT INTO monhoc (mamh, tenmonhoc, sotiet, hinhthucthi) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $themsql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ssis", $mamh, $tenmonhoc, $sotiet, $hinhthucthi);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // If successful, redirect to the page listing the subjects
        header("Location: monhoc.php");
        exit;
    } else {
        // If there's an error, display an error message
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}


// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $mamh = $_POST['mamh'];
    $tenmonhoc = $_POST['tenmonhoc'];
    $sotiet = $_POST['sotiet'];
    $hinhthucthi = $_POST['hinhthucthi'];

    // Include the database connection file
    require_once('../config/dbcon.php');

    // Biến để kiểm tra lỗi
    $errors = [];

    // Call the function to add subject information to the database
    addSubjectToDatabase($conn, $mamh, $tenmonhoc, $sotiet, $hinhthucthi, $errors);

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

<?php
// Function to update class information
function updateClassInfo($conn, $malop, $tenlop, $magv, $siso, &$errors) {
    // Kiểm tra và thêm lỗi vào mảng $errors (nếu có)
    if (!preg_match("/^[a-zA-Z0-9\s]+$/", $tenlop)) {
        $errors[] = "Lỗi: Tên lớp chỉ được chứa chữ cái, số và khoảng trắng!";
    }
    if (!preg_match("/^[0-9]+$/", $siso)) {
        $errors[] = "Lỗi: Sỉ số phải là số nguyên!";
    }

    // Nếu có lỗi, không thực hiện cập nhật và kết thúc hàm
    if (!empty($errors)) {
        return;
    }

    // Prepare the SQL statement for update
    $updatesql = "UPDATE lop SET tenlop=?, magv=?, siso=? WHERE malop=?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $updatesql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ssss", $tenlop, $magv, $siso, $malop);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Success: Redirect to the list page
        header("Location: ../admin/lop.php");
        exit;
    } else {
        // Failure: Display error message
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receive data from the form
    $malop = $_POST['malop'];
    $tenlop = $_POST['tenlop'];
    $magv = $_POST['magv'];
    $siso = $_POST['siso'];

    // Include database connection
    require_once '../config/dbcon.php';

    // Biến để kiểm tra lỗi
    $errors = [];

    // Call the updateClassInfo function
    updateClassInfo($conn, $malop, $tenlop, $magv, $siso, $errors);

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

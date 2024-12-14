<?php
// Function to add class information to the database
function addClassToDatabase($conn, $malop, $tenlop, $magv, $siso, &$errors) {
    // Kiểm tra xem mã lớp đã tồn tại trong cơ sở dữ liệu hay chưa
    $kiemtra_sql = "SELECT malop FROM lop WHERE malop = '$malop'";
    $kiemtra_result = mysqli_query($conn, $kiemtra_sql);
    if (mysqli_num_rows($kiemtra_result) > 0) {
        $errors[] = "Lỗi: Mã lớp đã tồn tại trong cơ sở dữ liệu!";
        return; // Kết thúc hàm nếu có lỗi
    }

    // Kiểm tra và thêm lỗi vào mảng $errors
    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $tenlop)) {
        $errors[] = "Lỗi: Tên lớp chỉ được chứa chữ cái, số và dấu cách!";
    }
    if (!preg_match("/^\d+$/", $siso) || $siso > 100) {
        $errors[] = "Lỗi: Sĩ số phải là số nguyên và không lớn hơn 100!";
    }

    // Nếu có lỗi, không thực hiện thêm dữ liệu và kết thúc hàm
    if (!empty($errors)) {
        return;
    }

    // Build the SQL query to insert data
    $themsql = "INSERT INTO lop (malop, tenlop, magv, siso) 
                VALUES ('$malop', '$tenlop', '$magv', $siso)";
    
    // Execute the SQL query
    if (mysqli_query($conn, $themsql)) {
        // If successful, redirect to the page listing the classes
        header("Location: lop.php");
    } else {
        // If there's an error, display an error message
        echo "Error: " . $themsql . "<br>" . mysqli_error($conn);
    }
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $malop = $_POST['malop'];
    $tenlop = $_POST['tenlop'];
    $magv = $_POST['magv'];
    $siso = $_POST['siso'];

    // Include the database connection file
    require_once '../config/dbcon.php';

    // Biến để kiểm tra lỗi
    $errors = [];

    // Call the function to add class information to the database
    addClassToDatabase($conn, $malop, $tenlop, $magv, $siso, $errors);

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

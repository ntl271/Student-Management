<?php
// Function to retrieve the information for editing a record
function getRecordForEdit($conn, $sid) {
    // SQL query to retrieve information for editing
    $edit_sql = "SELECT * FROM users WHERE id='$sid'";
    
    // Execute the query and handle errors
    $result = mysqli_query($conn, $edit_sql);
    
    if ($result) {
        // Check if any rows were returned
        if ($row = mysqli_fetch_assoc($result)) {
            // Data found, return the row
            return $row;
        } else {
            // No data found, handle accordingly (e.g., redirect or display an error message)
            echo "Không tìm thấy dữ liệu cho Mã tài khoản: $sid";
            exit;
        }
    } else {
        // Error handling
        echo "Error executing query: " . mysqli_error($conn);
        exit;
    }
}

// Lay id cua edit
$sid = isset($_GET['sid']) ? $_GET['sid'] : '';

// Ket noi
require_once '../config/dbcon.php';

// Get record for editing
$row = getRecordForEdit($conn, $sid);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin tài khoản</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Sửa môn học</h1>
        <form action="updatequantri.php" method="post">
            <input type="hidden" name="sid" value="<?php echo $id; ?>" id="">
            <div class="form-group">
                <label for="">ID</label>
                <input type="text" name="id" id="id" class="form-control" value="<?php echo $row['id'] ?>">
            </div>
            <div class="form-group">
                <label for="">Tên tài khoản</label>
                <input type="text" id="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
            </div>
            <div class="form-group">
                <label for="">Mật khẩu</label>
                <input type="text" id="password" class="form-control" name="password" value="<?php echo $row['password'] ?>">
            </div>
            <button class="btn btn-success">Cập nhật thông tin</button>
        </form>
    </div>
</body>
</html>

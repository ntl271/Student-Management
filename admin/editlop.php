<?php
// Function to retrieve the information for editing a record
function getRecordForEdit($conn, $smalop) {
    // SQL query to retrieve information for editing
    $edit_sql = "SELECT * FROM lop WHERE malop='$smalop'";
    
    // Execute the query and handle errors
    $result = mysqli_query($conn, $edit_sql);
    
    if ($result) {
        // Check if any rows were returned
        if ($row = mysqli_fetch_assoc($result)) {
            // Data found, return the row
            return $row;
        } else {
            // No data found, handle accordingly (e.g., redirect or display an error message)
            echo "Không tìm thấy dữ liệu cho Mã lớp: $smalop";
            exit;
        }
    } else {
        // Error handling
        echo "Error executing query: " . mysqli_error($conn);
        exit;
    }
}

// Lay id cua edit
$smalop = isset($_GET['smalop']) ? $_GET['smalop'] : '';

// Ket noi
require_once '../config/dbcon.php';

// Get record for editing
$row = getRecordForEdit($conn, $smalop);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa lớp</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <br>
        <h1>Sửa lớp học</h1>
        <br>
        <form action="../admin/updatelop.php" method="post">
            <input type="hidden" name="smalop" value="<?php echo $malop;?>" id="">
            <div class="form-group">
                <label for="malop">Mã lớp</label>
                <input type="text" id="malop" class="form-control" name="malop" value="<?php echo $row['malop']?>">
            </div>
            <div class="form-group">
                <label for="tenlop">Tên lớp</label>
                <input type="text" name="tenlop" id="tenlop" class="form-control"  value="<?php echo $row['tenlop']?>">
            </div>
            <div class="form-group">
                <label for="magv">Giáo viên chủ nhiệm</label>
                <input type="text" id="magv" name="magv" class="form-control"  value="<?php echo $row['magv']?>">
            </div>
            <div class="form-group">
                <label for="lop">Sĩ số</label>
                <input type="text" id="siso" name="siso" class="form-control"  value="<?php echo $row['siso']?>">
            </div>
            <button class="btn btn-success">Cập nhật thông tin</button>
        </form>
    </div>
</body>

</html>
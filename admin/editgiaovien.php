<?php
// Function to retrieve the information for editing a record
function getRecordForEdit($conn, $smagv) {
    // SQL query to retrieve information for editing
    $edit_sql = "SELECT * FROM giaovien WHERE magv='$smagv'";

    // Execute the query and handle errors
    $result = mysqli_query($conn, $edit_sql);

    if ($result) {
        // Check if any rows were returned
        if ($row = mysqli_fetch_assoc($result)) {
            // Data found, return the row
            return $row;
        } else {
            // No data found, handle accordingly (e.g., redirect or display an error message)
            echo "Không tìm thấy dữ liệu cho Mã giáo viên: $smagv";
            exit;
        }
    } else {
        // Error handling
        echo "Error executing query: " . mysqli_error($conn);
        exit;
    }
}

// Lay id cua edit
$smagv = isset($_GET['smagv']) ? $_GET['smagv'] : '';

// Ket noi
require_once '../config/dbcon.php';

// Get record for editing
$row = getRecordForEdit($conn, $smagv);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa giáo viên</title>
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
        <h1>Sửa giáo viên</h1>
        <form action="updategiaovien.php" method="post">
            <input type="hidden" name="smagv" value="<?php echo $magv;?>" id="">
            <div class="form-group">
                <label for="">Mã Giáo Viên</label>
                <input type="text" name="magv" id="magv" class="form-control" name="magv" value="<?php echo $row['magv']?>"></div>
            <div class="form-group">
                <label for="">Họ Tên</label>
                <input type="text" id="hoten" class="form-control" name="hoten" value="<?php echo $row['hoten']?>"></div> 
            <div class="form-group">
                <label for="">Ngày Sinh</label>
                <input type="text" id="ngaysinh"  class="form-control" name="ngaysinh" value="<?php echo $row['ngaysinh']?>"></div>
            <div class="form-group">
                <label for="">Môn dạy</label>
                <input type="text" id="monday"  class="form-control" name="monday" value="<?php echo $row['monday']?>"></div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" id="email" class="form-control" name="email" value="<?php echo $row['email']?>"></div>
            <div class="form-group">
                <label for="">Số Điện Thoại</label>
                <input type="text" id="sdt" class="form-control" name="sdt" value="<?php echo $row['sdt']?>"></div>   
            <button class="btn btn-success">Cập nhật thông tin</button>
            </form>

    </div>
    
</body>
</html>




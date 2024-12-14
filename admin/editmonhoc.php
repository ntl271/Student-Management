<?php
// Function to retrieve the information for editing a record
function getRecordForEdit($conn, $smamh) {
    // SQL query to retrieve information for editing
    $edit_sql = "SELECT * FROM monhoc WHERE mamh='$smamh'";
    
    // Execute the query and handle errors
    $result = mysqli_query($conn, $edit_sql);
    
    if ($result) {
        // Check if any rows were returned
        if ($row = mysqli_fetch_assoc($result)) {
            // Data found, return the row
            return $row;
        } else {
            // No data found, handle accordingly (e.g., redirect or display an error message)
            echo "Không tìm thấy dữ liệu cho Mã môn học: $smamh";
            exit;
        }
    } else {
        // Error handling
        echo "Error executing query: " . mysqli_error($conn);
        exit;
    }
}

// Lay id cua edit
$smamh = isset($_GET['smamh']) ? $_GET['smamh'] : '';

// Ket noi
require_once '../config/dbcon.php';

// Get record for editing
$row = getRecordForEdit($conn, $smamh);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa môn học</title>
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
        <form action="updatemonhoc.php" method="post">
            <input type="hidden" name="smamh" value="<?php echo $smamh;?>" id="">
            <div class="form-group">
                <label for="">Mã Môn Học</label>
                <input type="text" name="mamh" id="mamh" class="form-control" value="<?php echo $row['mamh']?>"></div>
            <div class="form-group">
                <label for="">Tên Môn Học</label>
                <input type="text" id="tenmonhoc" class="form-control" name="tenmonhoc" value="<?php echo $row['tenmonhoc']?>"></div> 
            <div class="form-group">
                <label for="">Số Tiết</label>
                <input type="text" id="sotiet"  class="form-control" name="sotiet" value="<?php echo $row['sotiet']?>"></div>
            <div class="form-group">
                <label for="">Hình Thức Thi</label>
                <input type="text" id="hinhthucthi" class="form-control" name="hinhthucthi" value="<?php echo $row['hinhthucthi']?>"></div>
            <button class="btn btn-success">Cập nhật thông tin</button>
            </form>

    </div>
    
</body>
</html>




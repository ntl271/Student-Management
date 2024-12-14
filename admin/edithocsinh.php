<?php
// Function to retrieve the information for editing a record
function getRecordForEdit($conn, $smahs) {
    // SQL query to retrieve information for editing
    $edit_sql = "SELECT * FROM hocsinh WHERE mahs ='$smahs'";
    
    // Execute the query and handle errors
    $result = mysqli_query($conn, $edit_sql);
    
    if ($result) {
        // Check if any rows were returned
        if ($row = mysqli_fetch_assoc($result)) {
            // Data found, return the row
            return $row;
        } else {
            // No data found, handle accordingly (e.g., redirect or display an error message)
            echo "Không tìm thấy dữ liệu cho Mã học sinh: $smahs";
            exit;
        }
    } else {
        // Error handling
        echo "Error executing query: " . mysqli_error($conn);
        exit;
    }
}

// Lay id cua edit
$smahs = isset($_GET['smahs']) ? $_GET['smahs'] : '';

// Ket noi
require_once '../config/dbcon.php';

// Get record for editing
$row = getRecordForEdit($conn, $smahs);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit sinh vien</title>
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
        <h1>Form sửa sinh viên</h1>
        <form action="updatehocsinh.php" method="post">
            <input type="hidden" name="smahs" value="<?php echo $smahs;?>" id="">
            <div class="form-group">
                <label for="mahs">Mã sinh viên</label>
                <input type="text" id="mahs" class="form-control" name="mahs" value="<?php echo $row['mahs']?>" required>
            </div>
            <div class="form-group">
                <label for="hovaten">Họ và tên</label>
                <input type="text" id="hovaten" class="form-control" name="hovaten" value="<?php echo $row['hovaten']?>" required>
            </div>
            <div class="form-group">
                <label for="ngaysinh">Ngày sinh</label>
                <input type="text" name="ngaysinh" id="ngaysinh" class="form-control"  value="<?php echo $row['ngaysinh']?>" required>
            </div>
            <div class="form-group">
                <label for="malop">Lớp</label>
                <input type="text" id="malop" name="malop" class="form-control"  value="<?php echo $row['malop']?>" required>
            </div>
            <div class="form-group">
               <label for="diachi">Địa chỉ</label>
               <input type="text" id="diachi" name="diachi" class="form-control"  value="<?php echo $row['diachi']?>" required>
           </div>
           <div class="form-group">
               <label for="sdt">SĐT</label>
               <input type="text" id="sdt" name="sdt" class="form-control"  value="<?php echo $row['sdt']?>" required>
           </div>
           <div class="form-group">
               <label for="gvcn">Giáo viên chủ nhiệm</label>
               <input type="text" id="gvcn" name="gvcn" class="form-control"  value="<?php echo $row['gvcn']?>" required>
           </div>
            
            
            <button class="btn btn-success">Cập nhật thông tin</button>
        </form>
    </div>
</body>

</html>


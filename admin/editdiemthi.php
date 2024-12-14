<?php
// Function to retrieve the information for editing a record
function getRecordForEdit($conn, $smahs) {
    // SQL query to retrieve information for editing
    $edit_sql = "SELECT * FROM diemthi WHERE mahs='$smahs'";

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
        <h1>Sửa điểm thi</h1>
        <br>
        <form action="../admin/updatediemthi.php" method="post">
        <div class="form-group">
                <label for="mahs">Mã Học Sinh</label>
                <input type="text" id="mahs" class="form-control" name="mahs" value="<?php echo $row['mahs']?>">
            </div>
            <div class="form-group">
                <label for="hoten">Họ Tên</label>
                <input type="text" id="hoten" class="form-control" name="hoten" value="<?php echo $row['hoten']?>">
            </div>
            <div class="form-group">
                <label for="ngaysinh">Ngày Sinh</label>
                <input type="text" name="ngaysinh" id="ngaysinh" class="form-control" value="<?php echo $row['ngaysinh']?>">
            </div>
            <div class="form-group">
                <label for="malop">Lớp</label>
                <input type="text" id="malop" name="malop" class="form-control" value="<?php echo $row['malop']?>">
            </div>
            <div class="form-group">
                <label for="kihoc">Kì học</label>
                <input type="text" id="kihoc" name="kihoc" class="form-control" value="<?php echo $row['kihoc']?>">
            </div>
            <div class="form-group">
                <label for="namhoc">Năm học</label>
                <input type="text" id="namhoc" name="namhoc" class="form-control" value="<?php echo $row['namhoc']?>">
            </div>
            <div class="form-group">
                <label for="toan">Toán</label>
                <input type="text" id="toan" name="toan" class="form-control" value="<?php echo $row['toan']?>">
            </div>
            <div class="form-group">
                <label for="van">Ngữ Văn</label>
                <input type="text" id="van" name="van" class="form-control" value="<?php echo $row['van']?>">
            </div>
            <div class="form-group">
                <label for="anh">Tiếng Anh</label>
                <input type="text" id="anh" name="anh" class="form-control" value="<?php echo $row['anh']?>">
            </div>
            <div class="form-group">
                <label for="lichsu">Lịch Sử</label>
                <input type="text" id="lichsu" name="lichsu" class="form-control" value="<?php echo $row['lichsu']?>">
            </div>
            <div class="form-group">
                <label for="diali">Địa Lí</label>
                <input type="text" id="diali" name="diali" class="form-control" value="<?php echo $row['diali']?>">
            </div>
            <div class="form-group">
                <label for="vatli">Vật Lí</label>
                <input type="text" id="vatli" name="vatli" class="form-control" value="<?php echo $row['vatli']?>">
            </div>
            <div class="form-group">
                <label for="hoahoc">Hóa Học</label>
                <input type="text" id="hoahoc" name="hoahoc" class="form-control" value="<?php echo $row['hoahoc']?>">
            </div>
            <div class="form-group">
                <label for="sinhhoc">Sinh Học</label>
                <input type="text" id="sinhhoc" name="sinhhoc" class="form-control" value="<?php echo $row['sinhhoc']?>">
            </div>
            <div class="form-group">
                <label for="tinhoc">Tin Học</label>
                <input type="text" id="tinhoc" name="tinhoc" class="form-control" value="<?php echo $row['tinhoc']?>">
            </div>
            <div class="form-group">
                <label for="congnghe">Công Nghệ</label>
                <input type="text" id="congnghe" name="congnghe" class="form-control" value="<?php echo $row['congnghe']?>">
            </div>
            <div class="form-group">
                <label for="gdcd">GDCD</label>
                <input type="text" id="gdcd" name="gdcd" class="form-control" value="<?php echo $row['gdcd']?>">
            </div>
            <div class="form-group">
                <label for="theduc">Thể dục</label>
                <input type="text" id="theduc" name="theduc" class="form-control" value="<?php echo $row['theduc']?>">
            </div>
            <button class="btn btn-success">Cập nhật thông tin</button>
        </form>
    </div>
</body>

</html>
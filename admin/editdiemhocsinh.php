<?php
// Include database connection
require_once '../config/dbcon.php';

// Function to retrieve the information for editing a record
function getRecordForEdit($conn, $smahs) {
    // Prepare the SQL query to retrieve information for editing
    $edit_sql = "SELECT * FROM diemthi WHERE mahs=?";

    // Prepare and bind parameters to avoid SQL injection
    $stmt = $conn->prepare($edit_sql);
    $stmt->bind_param("s", $smahs);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Data found, fetch the row
        return $result->fetch_assoc();
    } else {
        // No data found, handle accordingly
        echo "Không tìm thấy dữ liệu cho Mã học sinh: $smahs";
        exit;
    }
}

// Get the ID for editing
$smahs = isset($_GET['smahs']) ? $_GET['smahs'] : '';

// Get record for editing
$row = getRecordForEdit($conn, $smahs);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa điểm thi</title>
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
                <input type="text" id="mahs" class="form-control" name="mahs" value="<?php echo $row['mahs'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="tenmonhoc">Tên Môn Học</label>
                <input type="text" id="tenmonhoc" class="form-control" name="tenmonhoc" value="<?php echo $row['tenmonhoc'] ?>">
            </div>
            <div class="mb-3">
                <label for="diem15pki1" class="form-label">Điểm 15 phút (Kì 1):</label>
                <input type="text" name="diem15pki1" id="diem15pki1" class="form-control" value="<?php echo $row['diem15pki1'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="diemgiuaki1">Điểm giữa kì (Kì 1):</label>
                <input type="text" name="diemgiuaki1" id="diemgiuaki1" class="form-control" value="<?php echo $row['diemgiuaki1'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="diemcuoiki1">Điểm cuối kì (Kì 1):</label>
                <input type="text" name="diemcuoiki1" id="diemcuoiki1" class="form-control" value="<?php echo $row['diemcuoiki1'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="diem15pki2">Điểm 15 phút (Kì 2):</label>
                <input type="text" name="diem15pki2" id="diem15pki2" class="form-control" value="<?php echo $row['diem15pki2'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="diemgiuaki2">Điểm giữa kì (Kì 2):</label>
                <input type="text" name="diemgiuaki2" id="diemgiuaki2" class="form-control" value="<?php echo $row['diemgiuaki2'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="diemcuoiki2">Điểm cuối kì (Kì 2):</label>
                <input type="text" name="diemcuoiki2" id="diemcuoiki2" class="form-control" value="<?php echo $row['diemcuoiki2'] ?>" required>
            </div>

            <div class="mb-3">
                <input type="submit" value="Lưu điểm" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>

</html>

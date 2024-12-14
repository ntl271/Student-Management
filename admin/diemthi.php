<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');

function connectToDatabase() {
    require_once '../config/dbcon.php';
    return $conn;
}

function getClassList($conn) {
    $classList = array();

    $lietke_sql = "SELECT * FROM hocsinh ORDER BY mahs, hovaten, ngaysinh, malop";
    $result = mysqli_query($conn, $lietke_sql);

    if ($result === false) {
        die("Error in query: " . mysqli_error($conn));
    }

    while ($r = mysqli_fetch_assoc($result)) {
        $class_sql = "SELECT tenlop FROM lop WHERE malop = '" . $r['malop'] . "'";
        $class_result = mysqli_query($conn, $class_sql);

        if ($class_result === false) {
            die("Error in class query: " . mysqli_error($conn));
        }

        $class_row = mysqli_fetch_assoc($class_result);

        $r['class_name'] = isset($class_row['tenlop']) ? $class_row['tenlop'] : 'N/A';
        $classList[] = $r;
    }

    return $classList;
}

$conn = connectToDatabase();
$classList = getClassList($conn);
?>

<div class="container">
    <br>
    <h1>Danh sách điểm học sinh</h1>
    <div class="panel-heading">
        <br>
        <form method="get" action="timkiemdiemthi.php" style="display: flex">
            <input type="text" name="s" class="form-control" style="margin-top: 15px; margin-bottom: 15px; margin-right: 40px" placeholder="Tìm kiếm theo tên">
            <input type="submit" class="btn btn-primary" value="Tìm kiếm">
        </form>
    </div>

    <br> <br>
    <table class="table" style="text-align: center;">
        <thead class="thead-dark">
            <tr style="text-align: center;">
                <th>Mã học sinh</th>
                <th>Họ Tên</th>
                <th>Ngày Sinh</th>
                <th>Lớp</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($classList as $student) : ?>
                <tr>
                    <td><?php echo $student['mahs']; ?></td>
                    <td><?php echo $student['hovaten']; ?></td>
                    <td><?php echo $student['ngaysinh']; ?></td>
                    <td><?php echo $student['class_name']; ?></td>
                    <td>
                        <a href="xemdiemthi.php?smahs=<?php echo $student['mahs']; ?>" class="btn btn-info">Xem điểm</a>
                        <a href="nhapdiemthi.php?smahs=<?php echo $student['mahs']; ?>" class="btn btn-info">Nhập điểm</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include('includes/footer.php'); ?>

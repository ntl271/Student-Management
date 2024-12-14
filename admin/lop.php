<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');

function connectToDatabase() {
    $conn = mysqli_connect("localhost", "root", "", "qlhs");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}


function getListOfClasses($conn) {
    $list = array();

    $lietke_sql = "SELECT * FROM lop ORDER BY tenlop, magv, siso";
    $result = mysqli_query($conn, $lietke_sql);

    if ($result === false) {
        die("Error in query: " . mysqli_error($conn));
    }

    while ($r = mysqli_fetch_assoc($result)) {
        $teacherName = getTeacherName($conn, $r['magv']);
        $r['teacher_name'] = isset($teacherName) ? $teacherName : 'N/A';
        $list[] = $r;
    }

    return $list;
}

function getTeacherName($conn, $teacherCode) {
    $teacher_sql = "SELECT hoten FROM giaovien WHERE magv = '" . $teacherCode . "'";
    $teacher_result = mysqli_query($conn, $teacher_sql);

    if ($teacher_result === false) {
        die("Error in teacher query: " . mysqli_error($conn));
    }

    $teacher_row = mysqli_fetch_assoc($teacher_result);
    return isset($teacher_row['hoten']) ? $teacher_row['hoten'] : null;
}

function displayClassList($classList) {
    foreach ($classList as $class) {
?>
        <tr>
            <td><?php echo $class['malop']; ?></td>
            <td><?php echo $class['tenlop']; ?></td>
            <td><?php echo $class['teacher_name']; ?></td>
            <td><?php echo $class['siso']; ?></td>
            <td>
                <a href="editlop.php?smalop=<?php echo $class['malop']; ?>" class="btn btn-primary">Sửa</a>
                <a onclick="return confirm('Bạn có muốn xoá lớp này không');" href="xoalop.php?smalop=<?php echo $class['malop']; ?>" class="btn btn-danger">Xoá</a>
            </td>
        </tr>
<?php
    }
}

$conn = connectToDatabase();
$classList = getListOfClasses($conn);
?>

<div class="container">
    <br>
    <h1>Danh sách lớp</h1>
    <div class="panel-heading">
        <form method="get" action="timkiemlop.php" style="display: flex">
            <input type="text" name="s" class="form-control" style="margin-top: 15px; margin-bottom: 15px; margin-right: 40px" placeholder="Tìm kiếm theo tên lớp">
            <input type="submit" class="btn btn-primary" value="Tìm kiếm">
        </form>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Thêm lớp
    </button>

    <br> <br>
    <table class="table" style="text-align: center;">
        <thead class="thead-dark">
            <tr>
                <th>Mã lớp</th>
                <th>Tên lớp</th>
                <th>Giáo viên chủ nhiệm</th>
                <th>Sĩ số</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php displayClassList($classList); ?>
        </tbody>
    </table>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Thêm lớp</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="themlop.php" method="post">
                    <div class="form-group">
                        <label for="malop">Mã lớp</label>
                        <input type="text" id="malop" class="form-control" name="malop" required>
                    </div>
                    <div class="form-group">
                        <label for="tenlop">Tên lớp</label>
                        <input type="text" name="tenlop" id="tenlop" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="magv">Giáo viên chủ nhiệm</label>
                        <input type="text" id="magv" name="magv" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="siso">Sĩ số</label>
                        <input type="text" id="siso" name="siso" class="form-control" required>
                    </div>
                    <button class="btn btn-success">Thêm lớp</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include('includes/footer.php'); ?>

<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');

require_once '../config/dbcon.php';

// Function to retrieve student list from the database
function getStudentList($conn) {
    $studentList = array();

    // SQL query to retrieve student data
    $lietke_sql = "SELECT * FROM hocsinh ORDER BY hovaten,ngaysinh,malop,diachi,sdt,gvcn";

    // Execute the SQL query
    $result = mysqli_query($conn, $lietke_sql);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Loop through the results and add each student to the list
    while ($r = mysqli_fetch_assoc($result)) {
        $studentList[] = $r;
    }

    return $studentList;
}

// Retrieve the list of students
$studentList = getStudentList($conn);
?>

<div class="container">
    <br>
    <h1>Danh sách học sinh</h1>
    <div class="panel-heading">
        <form method="get" action="timkiemhocsinh.php" style="display: flex">
            <input type="text" name="s" class="form-control" style="margin-top: 15px; margin-bottom: 15px; margin-right: 40px" placeholder="Tìm kiếm theo tên">
            <input type="submit" class="btn btn-primary" value="Tìm kiếm">
        </form>
    </div>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Thêm mới học sinh
    </button>
    <br>
    <br>
    <table class="table" style="text-align: center;">
        <thead class="thead-dark">
            <tr>
                <th>Mã học sinh</th>
                <th>Họ và tên</th>
                <th>Ngày sinh</th>
                <th>Lớp</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại liên hệ</th>
                <th>Giáo viên chủ nhiệm</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($studentList as $student) : ?>
                <tr>
                    <td><?php echo $student['mahs']; ?></td>
                    <td><?php echo $student['hovaten']; ?></td>
                    <td><?php echo $student['ngaysinh']; ?></td>
                    <td><?php echo $student['malop']; ?></td>
                    <td><?php echo $student['diachi']; ?></td>
                    <td><?php echo $student['sdt']; ?></td>
                    <td><?php echo $student['gvcn']; ?></td>
                    <td>
                        <a href="edithocsinh.php?smahs=<?php echo $student['mahs']; ?>" class="btn btn-primary">Sửa</a>
                        <a onclick="return confirm('Bạn có muốn xoá sinh viên này không');" href="xoahocsinh.php?smahs=<?php echo $student['mahs']; ?>" class="btn btn-danger">Xoá</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Form thêm thông tin học sinh</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="themhocsinh.php" method="post">
                    <div class="form-group">
                        <label for="mahs">Mã học sinh</label>
                        <input type="text" id="mahs" class="form-control" name="mahs" required>
                    </div>
                    <div class="form-group">
                        <label for="hovaten">Họ và tên</label>
                        <input type="text" id="hovaten" class="form-control" name="hovaten" required>
                    </div>
                    <div class="form-group">
                        <label for="ngaysinh">Ngày sinh</label>
                        <input type="text" name="ngaysinh" id="ngaysinh" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="malop">Lớp</label>
                        <input type="text" id="malop" name="malop" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="diachi">Địa chỉ</label>
                        <input type="text" name="diachi" id="diachi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sdt">SĐT</label>
                        <input type="text" name="sdt" id="sdt" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="gvcn">Giáo viên chủ nhiệm</label>
                        <input type="text" name="gvcn" id="gvcn" class="form-control" required>
                    </div>

                    <button class="btn btn-success">Thêm học sinh</button>
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

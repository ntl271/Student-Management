<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

require_once '../config/dbcon.php';

// Function to retrieve subject list from the database
function getSubjectList($conn) {
    $subjectList = array();

    // SQL query to retrieve subject data
    $lietke_sql = 'SELECT * FROM monhoc ORDER BY mamh, tenmonhoc';

    // Execute the SQL query
    $result = mysqli_query($conn, $lietke_sql);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Loop through the results and add each subject to the list
    while ($r = mysqli_fetch_assoc($result)) {
        $subjectList[] = $r;
    }

    return $subjectList;
}



// Retrieve the list of subjects
$subjectList = getSubjectList($conn);
?>

<div class="container">
    <h1>Danh sách môn học</h1>
    <div class="panel-heading">
        <form method="get" action="timkiemmonhoc.php" style="display: flex">
            <input type="text" name="s" class="form-control" style="margin-top: 15px; margin-bottom: 15px; margin-right: 40px" placeholder="Tìm kiếm theo tên môn học">
            <input type="submit" class="btn btn-primary" value="Tìm kiếm">
        </form>
    </div>
    <br>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Thêm môn học mới
    </button>
    <br>
    <br>
    <table class="table" style="text-align:center">
        <thead class="thead-dark">
            <tr>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
                <th>Số tiết</th>
                <th>Hình thức thi</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subjectList as $subject) : ?>
                <tr>
                    <td><?php echo $subject['mamh']; ?></td>
                    <td><?php echo $subject['tenmonhoc']; ?></td>
                    <td><?php echo $subject['sotiet']; ?></td>
                    <td><?php echo $subject['hinhthucthi']; ?></td>
                    <td>
                        <a href="editmonhoc.php?smamh=<?php echo $subject['mamh']; ?>" class="btn btn-primary">Sửa</a>
                        <a onclick="return confirm('Bạn có muốn xóa môn học này không ?');" href="xoamonhoc.php?smamh=<?php echo $subject['mamh']; ?>" class="btn btn-danger">Xóa</a>
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
                <h4 class="modal-title">Thêm môn học mới</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="themmonhoc.php" method="post">
                    <div class="form-group">
                        <label for="mamh">Mã Môn Học</label>
                        <input type="text" id="mamh" class="form-control" name="mamh" required>
                    </div>
                    <div class="form-group">
                        <label for="tenmonhoc">Tên Môn Học</label>
                        <input type="text" id="tenmonhoc" class="form-control" name="tenmonhoc" required>
                    </div>
                    <div class="form-group">
                        <label for="sotiet">Số Tiết</label>
                        <input type="text" id="sotiet" class="form-control" name="sotiet" required>
                    </div>
                    <div class="form-group">
                        <label for="hinhthucthi">Hình Thức Thi</label>
                        <input type="text" id="hinhthucthi" class="form-control" name="hinhthucthi" required>
                    </div>
                    <button class="btn btn-success">Thêm Môn Học</button>
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

<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');

require_once '../config/dbcon.php';

// Function to retrieve teacher list from the database
function getTeacherList($conn) {
    $teacherList = array();

    // SQL query to retrieve teacher data
    $lietke_sql = 'SELECT * FROM giaovien ORDER BY magv, hoten, ngaysinh, monday, email, sdt';
    
    // Execute the SQL query
    $result = mysqli_query($conn, $lietke_sql);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        while ($r = mysqli_fetch_assoc($result)) {
            $teacherList[] = $r;
        }
    }

    return $teacherList;
}


// Retrieve the list of teachers
$teacherList = getTeacherList($conn);
?>


<div class="container">
    <h1>Danh sách giáo viên</h1>
    <div class="panel-heading">
        <form method="get" action="timkiemgiaovien.php" style="display: flex">
            <input type="text" name="s" class="form-control" style="margin-top: 15px; margin-bottom: 15px; margin-right: 40px"
                placeholder="Tìm kiếm theo tên">
            <input type="submit" class="btn btn-primary" value="Tìm kiếm">
        </form>
    </div>
    <br>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Thêm giáo viên mới
    </button>
    <br>
    <br>
    <table class="table" style="text-align:center">
        <thead class="thead-dark">
            <tr>
                <th>Mã giáo viên</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Môn dạy</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teacherList as $teacher) : ?>
                <tr>
                    <td><?php echo $teacher['magv']; ?></td>
                    <td><?php echo $teacher['hoten']; ?></td>
                    <td><?php echo $teacher['ngaysinh']; ?></td>
                    <td><?php echo $teacher['monday']; ?></td>
                    <td><?php echo $teacher['email']; ?></td>
                    <td><?php echo $teacher['sdt']; ?></td>
                    <td>
                        <a href="editgiaovien.php?smagv=<?php echo $teacher['magv']; ?>" class="btn btn-primary">Sửa</a>
                        <a onclick="return confirm('Bạn có muốn xóa giáo viên này không ?');"
                            href="xoagiaovien.php?smagv=<?php echo $teacher['magv']; ?>" class="btn btn-danger">Xóa</a>
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
        <h4 class="modal-title">Thêm giáo viên mới</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form action="themgiaovien.php" method="post">
            <div class="form-group">
                <label for="">Mã Giáo Viên</label>
                <input type="text" name="magv" id="magv" class="form-control" required></div>
            <div class="form-group">
                <label for="">Họ Tên</label>
                <input type="text" id="hoten" class="form-control" name="hoten" required></div> 
            <div class="form-group">
                <label for="">Ngày Sinh</label>
                <input type="text" id="ngaysinh"  class="form-control" name="ngaysinh" required></div>
            <div class="form-group">
                <label for="">Môn dạy</label>
                <input type="text" id="monday"  class="form-control" name="monday" required></div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" id="email" class="form-control" name="email" required></div>
            <div class="form-group">
                <label for="">Số Điện Thoại</label>
                <input type="text" id="sdt" class="form-control" name="sdt" required></div>   
            <button class="btn btn-success">Thêm Giáo Viên</button>
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


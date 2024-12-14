<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');
?>
<?php
// Kết nối CSDL
require_once '../config/dbcon.php';

// Lấy từ khóa tìm kiếm
$searchKeyword = $_GET['s'];

// Câu lệnh SQL với điều kiện tìm kiếm
$timkiem_sql = "SELECT * FROM monhoc WHERE mamh LIKE '%$searchKeyword%' OR tenmonhoc LIKE '%$searchKeyword%' OR sotiet LIKE '%$searchKeyword%' OR hinhthucthi LIKE '%$searchKeyword%'";

// Thực thi câu lệnh
$result = mysqli_query($conn, $timkiem_sql);
?>
<div class="container">
    <br>
    <h1>Kết quả tìm kiếm</h1>
    <br>
    <!-- Bảng hiển thị kết quả tìm kiếm -->
    <table class="table" style="text-align: center;">
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
            <?php
            // Duyệt qua kết quả tìm kiếm và hiển thị
            while ($r = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $r['mamh'];?></td>
                    <td><?php echo $r['tenmonhoc'];?></td>
                    <td><?php echo $r['sotiet'];?></td>
                    <td><?php echo $r['hinhthucthi'];?></td>
                    <td>
                        <a href="editmonhoc.php?smamh=<?php echo $r['mamh'];?>" class="btn btn-primary">Sửa</a>
                        <a onclick="return confirm('Bạn có muốn xóa môn học này không ?');" href="xoamonhoc.php?smamh=<?php echo $r['mamh'];?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include('includes/footer.php'); ?>

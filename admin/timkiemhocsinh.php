<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');
?>

<div class="container">
    <br>
    <h1>Kết quả tìm kiếm</h1>
    <br>
    <?php
    // Kiểm tra xem có dữ liệu từ form tìm kiếm không
    // Kiểm tra xem có dữ liệu từ form tìm kiếm không
    if (isset($_GET['s'])) {
    //ketnoi
    require_once '../config/dbcon.php';

    $searchTerm = $_GET['s'];

    // Sử dụng Prepared Statement để tránh SQL injection
    $stmt = $conn->prepare("SELECT * FROM hocsinh WHERE mahs LIKE ? OR hovaten LIKE ? OR ngaysinh LIKE ? OR malop LIKE ? OR diachi LIKE ? OR diachi LIKE ? OR sdt LIKE ?");
    $searchTerm = "%{$searchTerm}%";
    $stmt->bind_param("sssssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);

    // Thực hiện truy vấn
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra xem có dữ liệu trả về không
    if ($result->num_rows > 0) {
        // Code hiển thị kết quả
    } else {
        echo "<p>Không tìm thấy kết quả.</p>";
    }



        // Kiểm tra xem có dữ liệu trả về không
        if ($result->num_rows > 0) {
            echo "<table class='table'>
                    <thead class='thead-dark'>
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
                    <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['mahs']}</td>
                        <td>{$row['hovaten']}</td>
                        <td>{$row['ngaysinh']}</td>
                        <td>{$row['malop']}</td>
                        <td>{$row['diachi']}</td>
                        <td>{$row['sdt']}</td>
                        <td>{$row['gvcn']}</td>
                        <td>
                            <a href='edithocsinh.php?smahs={$row['mahs']}' class='btn btn-primary'>Sửa</a>
                            <a onclick=\"return confirm('Bạn có muốn xoá lớp này không');\" href='xoahocsinh.php?smahs={$row['mahs']}' class='btn btn-danger'>Xoá</a>
                        </td>
                    </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<p>Không tìm thấy kết quả.</p>";
        }

        // Đóng kết nối Prepared Statement
        $stmt->close();

        // Đóng kết nối
        $conn->close();
    }
    ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include('includes/footer.php'); ?>

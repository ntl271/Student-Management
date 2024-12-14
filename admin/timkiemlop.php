<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');
?>

<div class="container">
    <br>
    <h1>Kết quả tìm kiếm lớp</h1>
    <br>
    <?php
    // Kiểm tra xem có dữ liệu từ form tìm kiếm không
    if (isset($_GET['s'])) {
        //ketnoi
        require_once '../config/dbcon.php';

        $searchTerm = $_GET['s'];

        // Sử dụng Prepared Statement để tránh SQL injection
        $stmt = $conn->prepare("SELECT * FROM lop WHERE tenlop LIKE ? OR magv LIKE ?");
        $searchTerm = "%{$searchTerm}%";
        $stmt->bind_param("ss", $searchTerm, $searchTerm);

        // Thực hiện truy vấn
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra xem có dữ liệu trả về không
        if ($result->num_rows > 0) {
            echo "<table class='table'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>Mã lớp</th>
                            <th>Tên lớp</th>
                            <th>Giáo viên chủ nhiệm</th>
                            <th>Sĩ số</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['malop']}</td>
                        <td>{$row['tenlop']}</td>
                        <td>{$row['magv']}</td>
                        <td>{$row['siso']}</td>
                        <td>
                            <a href='editlop.php?smalop={$row['malop']}' class='btn btn-primary'>Sửa</a>
                            <a onclick=\"return confirm('Bạn có muốn xoá lớp này không');\" href='xoalop.php?smalop={$row['malop']}' class='btn btn-danger'>Xoá</a>
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

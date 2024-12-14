<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');
?>

<div class="container">
    <br>
    <h1>Kết quả tìm kiếm điểm thi</h1>
    <br>
    <?php
    // Kiểm tra xem có dữ liệu từ form tìm kiếm không
    if (isset($_GET['s'])) {
        // Kết nối CSDL
        require_once '../config/dbcon.php';

        $searchTerm = $_GET['s'];

        // Sử dụng Prepared Statement để tránh SQL injection
        $stmt = $conn->prepare("SELECT * FROM hocsinh WHERE mahs LIKE ? OR hovaten LIKE ? OR ngaysinh LIKE ? OR lop LIKE ?");
        
        // Kiểm tra xem câu truy vấn có thành công không
        if ($stmt) {
            $searchTerm = "%{$searchTerm}%";
            $stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);

            // Thực hiện truy vấn
            $stmt->execute();
            $result = $stmt->get_result();

            // Kiểm tra xem có dữ liệu trả về không
            if ($result->num_rows > 0) {
                echo "<table class='table'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>Mã Học Sinh</th>
                                <th>Họ Tên</th>
                                <th>Ngày Sinh</th>
                                <th>Lớp</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['mahs']}</td>
                            <td>{$row['hovaten']}</td>
                            <td>{$row['ngaysinh']}</td>
                            <td>{$row['lop']}</td>
                            <td>
                                <a href='xemdiemthi.php?smahs={$row['mahs']}' class='btn btn-primary'>Xem điểm</a>
                            </td>
                        </tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "<p>Không tìm thấy kết quả.</p>";
            }

            // Đóng kết nối Prepared Statement
            $stmt->close();
        } else {
            // Xử lý lỗi câu truy vấn
            echo "Lỗi câu truy vấn: " . $conn->error;
        }

        // Đóng kết nối
        $conn->close();
    }
    ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include('includes/footer.php'); ?>

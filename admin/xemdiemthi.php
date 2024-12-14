<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem Điểm Thi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container-fluid">
    <br>
    <h1>Xem điểm học sinh</h1>
    <br>

    <?php
    if (isset($_GET['smahs'])) {
        $mahs = $_GET['smahs'];

        include_once('../config/dbcon.php');

        $hocsinh_query = "SELECT * FROM hocsinh WHERE mahs = '$mahs'";
        $hocsinh_result = mysqli_query($conn, $hocsinh_query);
        $hocsinh = mysqli_fetch_assoc($hocsinh_result);

        if ($hocsinh) {
            $namhoc_query = "SELECT DISTINCT namhoc FROM diemthi WHERE mahs = '$mahs'";
            $namhoc_result = mysqli_query($conn, $namhoc_query);
            ?>

            <h2>Thông tin học sinh: <?php echo $hocsinh['hovaten']; ?></h2>
            <table class="table" style="text-align: center;">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã học sinh</th>
                        <th>Họ Tên</th>
                        <th>Ngày Sinh</th>
                        <th>Lớp</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $hocsinh['mahs']; ?></td>
                        <td><?php echo $hocsinh['hovaten']; ?></td>
                        <td><?php echo $hocsinh['ngaysinh']; ?></td>
                        <td><?php echo $hocsinh['malop']; ?></td>
                    </tr>
                </tbody>
            </table>

            <?php
            while ($namhoc_info = mysqli_fetch_assoc($namhoc_result)) {
                $namhoc = $namhoc_info['namhoc'];
                echo "<h2>Điểm học sinh (Năm học: $namhoc)</h2>";

                $diem_query = "SELECT * FROM diemthi WHERE mahs = '$mahs' AND namhoc = '$namhoc'";
                $diem_result = mysqli_query($conn, $diem_query);
                include('../admin/diemhocsinh.php');
            }
        } else {
            echo '<p class="alert alert-danger">Học sinh không tồn tại.</p>';
        }
    } else {
        echo '<p class="alert alert-warning">Vui lòng chọn một học sinh để xem điểm.</p>';
    }
    ?>

</div>

</body>
</html>


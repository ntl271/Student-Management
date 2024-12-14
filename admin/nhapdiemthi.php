<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');

// Function to validate exam scores
function validateExamScores($scores) {
    foreach ($scores as $score) {
        if (floatval($score) < 0 || floatval($score) > 10) {
            return false;
        }
    }
    return true;
}

?>

<div class="container mt-5">
    <?php
    if (isset($_GET['smahs'])) {
        $mahs = $_GET['smahs'];

        require_once('../config/dbcon.php');
        $query = "SELECT * FROM hocsinh WHERE mahs = '$mahs'";
        $result = mysqli_query($conn, $query);
        $hocsinh = mysqli_fetch_assoc($result);

        if ($hocsinh) {
            ?>
            <h2 class="mb-4">Nhập điểm cho học sinh: <?php echo $hocsinh['hovaten']; ?></h2>
                <!-- Form nhập điểm -->
            <form action="luudiemthi.php" method="post" id="diemForm">
                <input type="hidden" name="mahs" value="<?php echo $mahs; ?>">
                <div class="mb-3">
                    <label for="namhoc" class="form-label">Nhập năm học:</label>
                    <input type="text" name="namhoc" id="namhoc" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="tenmonhoc" class="form-label">Chọn môn học:</label>
                    <select name="tenmonhoc" id="tenmonhoc" class="form-select">
                        <option value="Ngữ Văn">Ngữ Văn</option>
                        <option value="Toán">Toán</option>
                        <option value="Ngoại ngữ">Ngoại ngữ</option>
                        <option value="Giáo dục thể chất">Giáo dục thể chất</option>
                        <option value="Lịch sử">Lịch sử</option>
                        <option value="Địa lí">Địa lí</option>
                        <option value="Vật lí">Vật lí</option>
                        <option value="Hóa học">Hóa học</option>
                        <option value="Sinh học">Sinh học</option>
                        <option value="Công nghệ">Công nghệ</option>
                        <option value="Tin học">Tin học</option>
                        <option value="Giáo dục công dân">Giáo dục công dân</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="diem15pki1" class="form-label">Điểm 15 phút (Kì 1):</label>
                    <input type="text" name="diem15pki1" id="diem15pki1" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="diemgiuaki1">Điểm giữa kì (Kì 1):</label>
                    <input type="text" name="diemgiuaki1" id="diemgiuaki1" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="diemcuoiki1">Điểm cuối kì (Kì 1):</label>
                    <input type="text" name="diemcuoiki1" id="diemcuoiki1" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="diem15pki2">Điểm 15 phút (Kì 2):</label>
                    <input type="text" name="diem15pki2" id="diem15pki2" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="diemgiuaki2">Điểm giữa kì (Kì 2):</label>
                    <input type="text" name="diemgiuaki2" id="diemgiuaki2" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="diemcuoiki2">Điểm cuối kì (Kì 2):</label>
                    <input type="text" name="diemcuoiki2" id="diemcuoiki2" class="form-control" required>
                </div>

                <div class="mb-3">
                    <input type="submit" value="Lưu điểm" class="btn btn-primary">
                </div>
            </form>
            
            <script>
                document.getElementById('diemForm').addEventListener('submit', function (event) {
                    var scores = [
                        'diem15pki1', 'diemgiuaki1', 'diemcuoiki1',
                        'diem15pki2', 'diemgiuaki2', 'diemcuoiki2'
                    ];

                    for (var i = 0; i < scores.length; i++) {
                        var input = document.getElementById(scores[i]);
                        if (input && (parseFloat(input.value) < 0 || parseFloat(input.value) > 10)) {
                            alert('Vui lòng nhập điểm từ 0 đến 10.');
                            event.preventDefault();
                            return;
                        }
                    }
                });
            </script>

            <?php
        } else {
            echo '<p class="alert alert-danger">Học sinh không tồn tại.</p>';
        }
    } else {
        echo '<p class="alert alert-warning">Vui lòng chọn một học sinh để nhập điểm.</p>';
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include('includes/footer.php'); ?>

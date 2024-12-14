<?php
// Function to save exam scores
function saveExamScores($conn, $mahs, $namhoc, $tenmonhoc, $diem15pki1, $diemgiuaki1, $diemcuoiki1, $diem15pki2, $diemgiuaki2, $diemcuoiki2) {
    // SQL query to check if the record already exists
    $checkQuery = "SELECT * FROM diemthi WHERE mahs = '$mahs' AND tenmonhoc = '$tenmonhoc'";
    $checkResult = mysqli_query($conn, $checkQuery);

    // Check if the record already exists
    if (mysqli_num_rows($checkResult) > 0) {
        return '<p class="alert alert-danger">Đã tồn tại một bản ghi với mã học sinh và môn học này.</p>';
    } else {
        // SQL query to insert new exam scores
        $query = "INSERT INTO diemthi (mahs, namhoc, tenmonhoc, diem15pki1, diemgiuaki1, diemcuoiki1, diem15pki2, diemgiuaki2, diemcuoiki2)
                  VALUES ('$mahs', '$namhoc', '$tenmonhoc', '$diem15pki1', '$diemgiuaki1', '$diemcuoiki1', '$diem15pki2', '$diemgiuaki2', '$diemcuoiki2')";

        // Execute the query and handle errors
        if (mysqli_query($conn, $query)) {
            // Redirect to view exam scores page after successful insertion
            header("Location: ../admin/xemdiemthi.php?smahs=" . $_POST['mahs']);
            exit;
        } else {
            // Return error message if insertion fails
            return '<p class="alert alert-danger">Lưu điểm không thành công. Lỗi: ' . mysqli_error($conn) . '</p>';
        }
    }
}

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $mahs = $_POST['mahs'];
    $namhoc = $_POST['namhoc'];
    $tenmonhoc = $_POST['tenmonhoc'];
    $diem15pki1 = $_POST['diem15pki1'];
    $diemgiuaki1 = $_POST['diemgiuaki1'];
    $diemcuoiki1 = $_POST['diemcuoiki1'];
    $diem15pki2 = $_POST['diem15pki2'];
    $diemgiuaki2 = $_POST['diemgiuaki2'];
    $diemcuoiki2 = $_POST['diemcuoiki2'];

    // Require database connection
    require_once('../config/dbcon.php');

    // Call the function to save exam scores
    $saveResult = saveExamScores($conn, $mahs, $namhoc, $tenmonhoc, $diem15pki1, $diemgiuaki1, $diemcuoiki1, $diem15pki2, $diemgiuaki2, $diemcuoiki2);

    // Close database connection
    mysqli_close($conn);

    // Output the result
    echo $saveResult;
} else {
    // Output error message for invalid request method
    echo '<p class="alert alert-danger">Invalid request method.</p>';
}
?>

<?php
require_once '../config/dbcon.php';

if (isset($_GET['class'])) {
    $classId = mysqli_real_escape_string($conn, $_GET['class']);
    $studentQuery = mysqli_query($conn, "SELECT mahs, hoten FROM diemthi WHERE malop = '$classId'");
    $students = [];
    while ($student = mysqli_fetch_assoc($studentQuery)) {
        $students[] = $student;
    }
    echo json_encode($students);
}
?>

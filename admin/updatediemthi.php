<?php
// Include database connection
require_once '../config/dbcon.php';

// Function to update exam results
function updateExamResults($conn, $mahs, $tenmonhoc, $diem15pki1, $diemgiuaki1, $diemcuoiki1, $diem15pki2, $diemgiuaki2, $diemcuoiki2) {
    // Prepare the SQL statement for update
    $updatesql = "UPDATE diemthi SET 
        tenmonhoc=?, diem15pki1=?, diemgiuaki1=?, diemcuoiki1=?, diem15pki2=?, diemgiuaki2=?, diemcuoiki2=?
        WHERE mahs=?";

    // Prepare and bind parameters to avoid SQL injection
    $stmt = $conn->prepare($updatesql);
    $stmt->bind_param("ssssssss", $tenmonhoc, $diem15pki1, $diemgiuaki1, $diemcuoiki1, $diem15pki2, $diemgiuaki2, $diemcuoiki2, $mahs);

    // Execute the update query and handle errors
    if ($stmt->execute()) {
        // Success: Redirect to the list page
        header("Location: xemdiemthi.php?smahs=" . $mahs);
        exit;
    } else {
        // Failure: Display error message
        echo "Error updating record: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Check if the form has been submitted and mahs is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mahs'])) {
    // Receive data from the form
    $mahs = $_POST['mahs'];
    $tenmonhoc = $_POST['tenmonhoc'];
    $diem15pki1 = $_POST['diem15pki1'];
    $diemgiuaki1 = $_POST['diemgiuaki1'];
    $diemcuoiki1 = $_POST['diemcuoiki1'];
    $diem15pki2 = $_POST['diem15pki2'];
    $diemgiuaki2 = $_POST['diemgiuaki2'];
    $diemcuoiki2 = $_POST['diemcuoiki2'];

    // Call the updateExamResults function
    updateExamResults($conn, $mahs, $tenmonhoc, $diem15pki1, $diemgiuaki1, $diemcuoiki1, $diem15pki2, $diemgiuaki2, $diemcuoiki2);

    // Close the database connection
    mysqli_close($conn);
} else {
    // If mahs is not set, redirect back to the list page
    header("Location: xemdiemthi.php");
    exit;
}
?>

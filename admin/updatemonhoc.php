<?php
// Function to update subject information
function updateSubjectInfo($conn, $mamh, $tenmonhoc, $sotiet, $hinhthucthi, &$errors) {
    if (!preg_match("/^[0-9]+$/", $sotiet)) {
        $errors[] = "Lỗi: Số tiết phải là số nguyên!";
    }

    // If there are errors, do not perform the update and end the function
    if (!empty($errors)) {
        return;
    }

    // Prepare the SQL statement for update
    $updatesql = "UPDATE monhoc SET tenmonhoc=?, sotiet=?, hinhthucthi=? WHERE mamh=?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $updatesql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "siss", $tenmonhoc, $sotiet, $hinhthucthi, $mamh);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Success: Redirect to the list page
        header("Location: monhoc.php");
        exit;
    } else {
        // Failure: Display error message
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receive data from the form
    $mamh = $_POST['mamh'];
    $tenmonhoc = $_POST['tenmonhoc'];
    $sotiet = $_POST['sotiet'];
    $hinhthucthi = $_POST['hinhthucthi'];

    // Include database connection
    require_once '../config/dbcon.php';

    // Variable to check for errors
    $errors = [];

    // Call the updateSubjectInfo function
    updateSubjectInfo($conn, $mamh, $tenmonhoc, $sotiet, $hinhthucthi, $errors);

    // If there are errors, display error messages
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

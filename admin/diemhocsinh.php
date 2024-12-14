<?php

function connectToDatabase() {
    $conn = mysqli_connect("localhost", "root", "", "qlhs");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}


function getGradeList($conn) {
    $list = array();

    // SQL query to retrieve grade list from the database
    $grade_sql = "SELECT * FROM diemthi";

    // Execute the SQL query
    $result = mysqli_query($conn, $grade_sql);

    // Check if the query was successful
    if ($result === false) {
        die("Error in query: " . mysqli_error($conn));
    }

    // Loop through the results and add each grade to the list
    while ($grade = mysqli_fetch_assoc($result)) {
        // Calculate semester averages
        $grade['ki1_average'] = ($grade['diem15pki1'] + $grade['diemgiuaki1'] * 2 + $grade['diemcuoiki1'] * 3) / 6;
        $grade['ki2_average'] = ($grade['diem15pki2'] + $grade['diemgiuaki2'] * 2 + $grade['diemcuoiki2'] * 3) / 6;

        // Calculate overall average
        $grade['overall_average'] = ($grade['ki1_average'] + $grade['ki2_average'] * 2) / 3;

        $list[] = $grade;
    }

    return $list;
}


function displayGradeList($gradeList) {
    foreach ($gradeList as $grade) {
?>
        <tr>
            <td><?php echo $grade['tenmonhoc']; ?></td>
            <td><?php echo $grade['diem15pki1']; ?></td>
            <td><?php echo $grade['diemgiuaki1']; ?></td>
            <td><?php echo $grade['diemcuoiki1']; ?></td>
            <td><?php echo round($grade['ki1_average'], 2); ?></td>
            <td><?php echo $grade['diem15pki2']; ?></td>
            <td><?php echo $grade['diemgiuaki2']; ?></td>
            <td><?php echo $grade['diemcuoiki2']; ?></td>
            <td><?php echo round($grade['ki2_average'], 2); ?></td>
            <td><?php echo round($grade['overall_average'], 2); ?></td>
            <td>
                <a href="editdiemhocsinh.php?smahs=<?php echo $grade['mahs'];?>" class="btn btn-info">Sửa</a> 
                <a onclick="return confirm('Bạn có muốn xoá điểm thi này không');" href="xoadiemhocsinh.php?smahs=<?php echo $grade['mahs'];?>" class="btn btn-danger">Xoá</a>
            </td>
        </tr>
<?php
    }
}


$conn = connectToDatabase();
$gradeList = getGradeList($conn);
?>

<table class="table" style="text-align: center;">
    <thead class="thead-dark">
        <tr>
            <th>Môn học</th>
            <th>Điểm 15p kì 1</th>
            <th>Điểm giữa kì 1</th>
            <th>Điểm cuối kì 1</th>
            <th>Điểm trung bình kì 1</th>
            <th>Điểm 15p kì 2</th>
            <th>Điểm giữa kì 2</th>
            <th>Điểm cuối kì 2</th>
            <th>Điểm trung bình kì 2</th>
            <th>Điểm tổng kết cả năm</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php displayGradeList($gradeList); ?>
    </tbody>
</table>

<?php include('includes/footer.php'); ?>

<?php
//lay du lieu id can xoa
$smalop = $_GET['smalop'];
// echo $id;
//ket noi
require_once '../config/dbcon.php';
//cau lenh sql 
$xoa_sql = "DELETE FROM lop WHERE malop=$smalop";

mysqli_query($conn, $xoa_sql);
// echo "<h1>Xoa thanh cong</h1>";
//tro ve trang liet ke
header("Location: lop.php");
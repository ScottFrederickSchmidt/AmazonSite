<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// https://stackoverflow.com/questions/11575432/having-trouble-executing-a-select-query-in-a-prepared-statement
// https://stackoverflow.com/questions/36732114/select-from-sql-table-using-prepared-statement
$conn = mysqli_connect($local, $username, $password, $database);
$conne = new mysqli($local, $username, $password, $database);

if (!$conn) {
    echo $conn->error();
}

$min=$_POST['min'];
$max=$_POST['max'];

// $records = "SELECT * from tbl where price between '$min' and '$max'  ";
// $records=mysqli_query($conn, $records);

$stmt = $conn->prepare("SELECT * from tbl where price between ? and ? ");
$stmt->bind_param('ss', $min, $max) ;
if (!$stmt){ mysqli_error($conn); }
$stmt->execute();
$records = $stmt->get_result();
//$records = $res->fetch_all();
//echo $records;

   while($row = $records->fetch_assoc()) {
echo $row['name']; 
// echo $row['price'];
}
?>

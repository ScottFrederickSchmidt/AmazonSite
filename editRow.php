<?php
$conn_cart = mysqli_connect($l, $u, $p, $d);
?>

<?php
$editID=$_POST['edit_id'];
$sql="select*from tbl where id='$editID' ";
$records=mysqli_query($conn_cart, $sql);

$row = mysqli_fetch_array($records);

echo $row[3];

?>

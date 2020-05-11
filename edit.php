<?php
$conn_cart = mysqli_connect($l, $u, $p, $d);
    
// Check connection
if (!$conn_cart) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";

$qtd = $_POST['qtd'];
$total = $_POST['total'];
$edit_id=$_POST['edit_id'];

$stmt = $conn_cart->prepare("UPDATE tbl SET qtd=?, total=? WHERE id=?");
$stmt->bind_param('sss', $qtd, $total, $edit_id);
if(!$stmt) { mysqli_error($conn_cart);  }
$confirmUpdate = $stmt->execute();

if($confirmUpdate) {
    echo 1;
   }
   if(!$confirmUpdate) {
       echo 0;
   }
?>

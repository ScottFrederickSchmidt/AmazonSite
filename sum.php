<?php
$u = 'username';
$p = '';
$d   = 'database';
$l = 'localhost';
    
$conn_cart = mysqli_connect($l, $u, $p, $d);
//  https://stackoverflow.com/questions/12655734/single-result-from-sum-with-mysqli
//  $sum=mysqli_query($conn_cart, "Select sum(total) from tbl");

$res = mysqli_query($conn_cart,'SELECT sum(total) FROM tbl');
if (FALSE === $res) die(mysqli_error);
$row = mysqli_fetch_row($res);
$sum = $row[0];
$sum = round($sum, 2);

echo $sum;
?>

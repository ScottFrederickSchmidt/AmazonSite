<?php
$conn_cart = mysqli_connect($l, $u, $p, $d);
?>

<?php
$sql="SELECT MAX(Id) FROM tbl";

$result=mysqli_query($conn_cart, $sql);
$id = $result->fetch_array(MYSQLI_NUM);
  $id=$id[0];
  //echo $id;
  
  $sql2="select * from tbl where id='$id' ";
  $records=mysqli_query($conn_cart, $sql2);
  $row = mysqli_fetch_array($records);
  echo $row[1];
  echo " on ";
  echo $row['date'];
  
$arr = explode(' ',trim($row[1]));
$brand=$arr[0];

  ?>

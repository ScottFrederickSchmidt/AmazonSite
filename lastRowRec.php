<style>
  .item{
  font-weight:bold;
  font-size:110%;
}
.item-price{
  font-weight:bold;
}
.box{
  text-align:center;
}
</style>

<?php
$database "";
$local = "localhost";
$username = "";
$password = "";
$conn = mysqli_connect($local, $username, $password, $database);

$u = '';
$p = '';
$d   = '';
$l = 'localhost';
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

$arr = explode(' ',trim($row[1]));
$word=$arr[0];
$word= "%" . $word . "%";

$word2= $arr[1];
$word2= "%" . $word2 . "%";

// $sql3="select * from tbl where name like '%$word%'";
// $records3=mysqli_query($conn, $sql3); distinct 

//$records3 = mysqli_query($conn, "SELECT name, price, image, id, info from tbl where name like '$word' or name like '$word2' or info like '$word'");


 $stmt = $conn->prepare("SELECT name, price, image, id, info from tbl where name like ? or name like ? LIMIT 5");
$stmt->bind_param('ss', $word, $word2) ;
if (!$stmt){ mysqli_error($conn); }
$stmt->execute();
$records3 = $stmt->get_result();

$row3 = mysqli_fetch_array($records3);

while( $row3 = mysqli_fetch_array($records3) ) {
// echo $row3['name'];
//echo $row['price'];
?>

<div class="container-fluid">
  <div class="row">
  <div class="col-xs-12 col-sm-6 col-md-3 box">
<h5 class="item"> <?php echo $row3['name'];?> </h5>

<img src="<?php echo $row3['image'];?>" width="90px" height="90px"> 
      <h5 class="item-price">$<?php echo $row3['price'];?></h5>
      <h5 class="item-price"><?php echo $row3['info'];?></h5>
      <!--<h5 class="rec-id" id="rec-id"><?php echo $row3['id'];?></h5>-->
      <button class="btn btn-md btn-success cart-btn rec_btn" data-id="<?php echo $row3['id'];?>" id="<?php echo $row3['id'];?>" >Add to Cart 
    </div>

<?php
}
?>
   </div></div>  <!--   container/row -->
   

  

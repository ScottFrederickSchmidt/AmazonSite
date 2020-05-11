<?php
//https://stackoverflow.com/questions/12235595/find-most-frequent-value-in-sql-column

$conn_cart = mysqli_connect($l, $u, $p, $d);

$sql="SELECT       `name`
    FROM     `tbl`
    GROUP BY `name`
    ORDER BY COUNT(*) DESC";
    
    $result=mysqli_query($conn_cart, $sql);
     $common = $result->fetch_array(MYSQLI_NUM);
  
$countAll="select count(*) from tbl";
  $countAll=mysqli_query($conn_cart, $countAll);
   $count = $countAll->fetch_array(MYSQLI_NUM);
   //echo $count[0];

     $countCommon="select count(*) from tbl where name='$common[0]' ";
  $countCommon=mysqli_query($conn_cart, $countCommon);
   $countCommon = $countCommon->fetch_array(MYSQLI_NUM);
  // echo $countCommon[0];
   
   echo $common[0];
   echo(" <br> ");
   echo(" was purchased ");
   echo round($countCommon[0] / $count[0]*100);
    echo("% of all orders. " );
    ?>

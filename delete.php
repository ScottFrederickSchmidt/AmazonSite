<?php
$conn_cart = mysqli_connect($l, $u, $p, $d);

$del_id=$_POST['del_id']; 

         $stmt= $conn_cart->prepare("DELETE from tbl where id = ?" );
 $stmt->bind_param('s', $del_id) ;
    $delete=$stmt-> execute(); 

        if($delete){
            echo 1;
        }
        if(!$delete) {
            echo 0;
        }
       ?>

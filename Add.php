<?php
$conn_cart = mysqli_connect($l, $u, $p, $d);
    
    // $stmt = $conn->prepare("INSERT INTO tbl (name, date, subtotal, total, phone) VALUES(?, ?, ?, ?, ?)"); 
  //  $stmt->bind_param("sssss", $_POST['name'], $_POST['date'], $_POST['subtotal'],  $_POST['total'], $_POST['phone']);
  //  $add=$stmt->execute(); 
    $date= date("y-m-d");
    
     $stmt= $conn_cart->prepare("insert into tbl (name, price, qtd, total, date) values(?,?, ?, ?, ?)");
$stmt->bind_param('sssss',  $_POST['name'], $_POST['price'], $_POST['qtd'], $_POST['total'], $date) ;
if(!$stmt) { $conn->error(); }
$add=$stmt-> execute(); 

    if($add){
        echo 1;
    }
    if(!$add) {
        echo 0;
    }
    
    ?>

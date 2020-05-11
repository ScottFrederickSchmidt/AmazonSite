$conn = mysqli_connect($local, $username, $password, $database);
    
    // $stmt = $conn->prepare("INSERT INTO tbl (name, date, subtotal, total, phone) VALUES(?, ?, ?, ?, ?)"); 
  //  $stmt->bind_param("sssss", $_POST['name'], $_POST['date'], $_POST['subtotal'],  $_POST['total'], $_POST['phone']);
  //  $add=$stmt->execute(); 
   
    $id=$_POST['rec_id'];
    // echo $id;
    $records=mysqli_query($conn, "select id, name, info, price from tbl where id='$id' ");
  $row = mysqli_fetch_array($records);
  if (!$row) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
  $id= $row[0];
$name= $row[1];
//$info= $row[2];
  $qtd= 1;
  $price= $row[3];
   $date= date("y-m-d");
    $total=$row[3];
    
$stmt = $conn_cart->prepare("INSERT INTO tbl (name, price, qtd, total, date) VALUES(?, ?, ?, ?, ?)"); 
$stmt->bind_param("sssss", $name, $price, $qtd, $total, $date);
  if (!$stmt) {
    printf("Error: %s\n", mysqli_error($conn_cart));
    exit();
}
$add=$stmt->execute(); 
 if (!$add) {
    printf("Error: %s\n", mysqli_error($conn_cart));
    exit();
}

    if($add){
        echo 1;
    }
    if(!$add) {
        echo 0;
    }

    
//       $stmt= $conn->prepare("SELECT name, id, price from tbl where id = ?" );
//  $stmt->bind_param('s', $id) ;
//  if (!$stmt) {
//      $conn->mysqli_error();
//  }
//     $stmt-> execute(); 
//   $records = $stmt->get_result();

//   while($row = $records->fetch_assoc()) {
// echo $row['name']; 
// // echo $row['price'];
// }
//      $stmt= $conn_cart->prepare("insert into tbl (name, price, qtd, total, date) values(?,?, ?, ?, ?)");
// $stmt->bind_param('sssss',  $_POST['name'], $_POST['price'], $_POST['qtd'], $_POST['total'], $date) ;
// if(!$stmt) { $conn->error(); }
// $add=$stmt-> execute(); 

    // if($add){
    //     echo 1;
    // }
    // if(!$add) {
    //     echo 0;
    // }
    
    ?>
